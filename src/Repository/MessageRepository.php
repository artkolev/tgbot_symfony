<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Chat;
use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function getCount(): int
    {
        return $this
            ->createQueryBuilder('m')
            ->select('COUNT(1) as count')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllByPaginator(int $page, int $pageSize): array
    {
        $query = $this
            ->createQueryBuilder('m')
            ->andWhere('m.new_chat_members IS NULL')
            ->orderBy('m.date', 'DESC');

        $paginator = new Paginator($query);
        $totalItems = count($paginator);
        $pagesCount = (int) ceil($totalItems / $pageSize);

        $messagesList = $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page-1))
            ->setMaxResults($pageSize)
            ->getResult();

        return [
            'messagesList' => $messagesList,
            'totalItems' => $totalItems,
            'pagesCount' => $pagesCount
        ];
    }

    public function getPopularUsersByChat(Chat $chat, int $limit = 5): array
    {
        $result = $this
            ->createQueryBuilder('m')
            ->select('COUNT(m.id) as count, m.user')
            ->andWhere('m.chat_id = :chat')
            ->setParameter('chat', $chat)
            ->andWhere('m.date >= :start')
            ->setParameter('start', (new \DateTime())->format('Y-m-d 00:00:00'))
            ->andWhere('m.date <= :end')
            ->setParameter('end', (new \DateTime())->format('Y-m-d 23:59:59'))
            ->orderBy('count', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();

        return $result;
    }
}
