<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    
    public function add(Request $request, EntityManagerInterface $entityManager, PizzaRepository $repository): Response 
    {
        $pizza = new Pizza(); // Création d'un nouvel objet Pizza

        $pizzas = $repository->findAll();
    
        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(PizzaType::class, $pizza);
    
        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);
    
        // Vérification si le formulaire est soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On marque les informations de l'objet pizza prêt à être envoyé en bdd
            $entityManager->persist($pizza);
    
            // On envoie les données
            $entityManager->flush();
    
            // Message de succès
            $this->addFlash('success', 'Pizza ajouté avec succès !');
    
            // Redirection
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'pizzaform'=>$form->createView(),
            'pizzas'=>$pizzas,
        ]);
    }
}
