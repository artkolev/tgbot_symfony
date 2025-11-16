<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CommandSlapPhases;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommandSlapPhasesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandSlapPhases::class);
    }
}
