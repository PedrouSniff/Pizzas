<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{
    #[Route('/update/pizza/{id}', name: 'app_update')]

    public function modify(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {

            // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
            $form = $this->createForm(PizzaType::class, $pizza);

            // Indique à Symfony de prendre les données et de les associer au formulaire
            $form->handleRequest($request);

            // Vérification si le formulaire est soumis et qu'il est valide
            if ($form->isSubmitted() && $form->isValid()) {
                // On marque les informations de l'objet pizza prêt à être envoyé en base de données
                $entityManager->persist($pizza);
                // On envoie les données
                $entityManager->flush();

                // Message de succès
                $this->addFlash('success', 'La pizza ajouté avec succès !');

                // Redirection
                return $this->redirectToRoute('app_home');
            }

            return $this->render('update/update.html.twig', [
                'pizzaform'=>$form->createView(),   
            ]);
        }
}
