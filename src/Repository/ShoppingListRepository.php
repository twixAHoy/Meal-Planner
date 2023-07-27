<?php

namespace App\Repository;

use App\Entity\ShoppingList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShoppingList>
 *
 * @method ShoppingList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingList[]    findAll()
 * @method ShoppingList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingList::class);
    }

    public function save(ShoppingList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShoppingList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    #[Route('shoppingList/', name:'shopping_list_view')]
    public function showShoppingList(): Response{
        $shoppingListIngredients = $this->slRepository->findAll();

        return $this->render('shopping-list/index.html.twig',[
            'ingredients' => $shoppingListIngredients
        ]);
    }

    #[Route('/shoppingList/addNew',methods:['POST'], name:'add_new_ingredient')]
    public function addNewIngredientUsingAjax(Request $request){
        $newIngredientName = $request->request->get('ingredient');
        $newIngredient = new ShoppingList();

        $newIngredient->setName($newIngredientName);

        $this->em->persist($newIngredient);
        $this->em->flush();

        return $this->redirectToRoute('shopping_list_view');
    }

    #[Route('/shoppingList/add', name:'add_to_shopping_list')]
    public function addIngredientToShoppingList($ingredient, Request $request): Response{
        $currentShoppingList = (array)$this->shoppingList;
        $errorMessage = 'Ingredient Already Exists';

        if(in_array($ingredient, $currentShoppingList)){
            return $this->render('shopping-list/index.html.twig',[
                'error' => $errorMessage
            ]);
        }

        $form = $this->createForm(AddIngredientForm::class, $ingredient);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($ingredient);
            $this->em->flush();
        }

        return $this->redirectToRoute('shopping_list_view',[
            'form' => $form
        ]);
    }

    #[Route('shoppingList/edit/{id}', name:'modify_ingredient_on_shopping_list')]
    public function modifyIngredientOnShoppingList($id, Request $request): Response{
        $ingredientToModify = $this->slRepository->find($id);

        $form = $this->createForm(EditIngredientForm::class, ingredientToModify);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $ingredientToModify->setName($form->get('name')->getData());
        }

        return $this->redirectToRoute('shopping_list_view');
    }


    //Delete a single ingredient
    #[Route('/shoppingList/delete/{id}', name:'delete_ingredient_from_shopping_list', methods:['POST'])]
    public function deleteIngredientFromShoppingList(Request $request): Response{
        $ingredientToDelete = $request->attributes->get('id');
        $ingredientToDelete = $this->slRepository->find($ingredientToDelete);

        $this->em->remove($ingredientToDelete);
        $this->em->flush();

        return $this->redirectToRoute('shopping_list_view');
    }


    //Restart shopping list - delete all
    #[Route('/shoppingList/restartList/', name:'delete_all_ingredients_from_shopping_list')]
    public function deleteAllIngredeientsFromShoppingList(): Response{
        $ingredientsToDelete = $this->slRepository->findAll();

        foreach($ingredientsToDelete as $ingredient){
            $this->em->remove($ingredient);
        }
        $this->em->flush();
        
        return $this->redirectToRoute('shopping_list_view');
    }

//    /**
//     * @return ShoppingList[] Returns an array of ShoppingList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ShoppingList
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
