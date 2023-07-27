<?php

namespace App\Controller;

use App\Entity\ShoppingList;
use App\Repository\ShoppingListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingListController extends AbstractController
{
    public $shoppingList;
    private $slRepository;
    private $em;



    public function __construct(ShoppingListRepository $slRepository, EntityManagerInterface $em){
        $this->shoppingList = new ShoppingList();
        $this->slRepository = $slRepository;
        $this->em = $em;
    }
}
