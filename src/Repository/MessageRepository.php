<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Configuration;
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
        $config = new Configuration();
        $config->enableNativeLazyObjects(true);

        $query = $this
            ->createQueryBuilder('m')
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
}
