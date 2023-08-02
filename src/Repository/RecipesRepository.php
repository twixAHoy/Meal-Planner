<?php

namespace App\Repository;

use App\Entity\Meals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityRepository;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Error\RuntimeError;

/**
 * @extends ServiceEntityRepository<Recipes>
 *
 * @method Recipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipes[]    findAll()
 * @method Recipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipesRepository extends ServiceEntityRepository
{
    public EntityManagerInterface $entityManager;
    //public $repository = $this;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Meals::class);
    }

    public function addNewRecipeToMeal($recipe){
        try{
            $this->entityManager->persist($recipe);
            $this->entityManager->flush();
        }catch(Exception $e){
            return new Response($e->getMessage());
        }
    }
    
   
}
