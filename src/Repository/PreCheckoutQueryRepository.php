<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PreCheckoutQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PreCheckoutQueryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreCheckoutQuery::class);
    }
}
