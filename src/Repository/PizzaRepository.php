<?php

namespace App\Repository;

use App\Entity\Pizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pizza>
 */
class PizzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizza::class);
    }

    public function findAllWithIngredients(): array
    {
        return $this->createQueryBuilder('p')
        ->leftJoin('p.ingredients', 'i')   // join con ingredientes
        ->addSelect('i')                   // seleccionar ingredientes para evitar lazy loading
        ->getQuery()
        ->getResult();
    }
}
