<?php

namespace App\Controller;

use App\Entity\HistoriqueRapport;
use App\Form\HistoriqueRapportType;
use App\Repository\HistoriqueRapportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/historique/rapport')]
class HistoriqueRapportController extends AbstractController
{
    
    #[Route('/', name: 'app_historique_rapport_index', methods: ['GET'])]
    public function index(HistoriqueRapportRepository $historiqueRapportRepository): Response
    {
        return $this->render('historique_rapport/index.html.twig', [
            'historique_rapports' => $historiqueRapportRepository->findAll(),
        ]);
    }
    
    #[Route('/new', name: 'app_historique_rapport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $historiqueRapport = new HistoriqueRapport();
        $form = $this->createForm(HistoriqueRapportType::class, $historiqueRapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($historiqueRapport);
            $entityManager->flush();

            return $this->redirectToRoute('app_historique_rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('historique_rapport/new.html.twig', [
            'historique_rapport' => $historiqueRapport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_historique_rapport_show', methods: ['GET'])]
    public function show(HistoriqueRapport $historiqueRapport): Response
    {
        return $this->render('historique_rapport/show.html.twig', [
            'historique_rapport' => $historiqueRapport,
        ]);
    }

    
    #[Route('/{id}/edit', name: 'app_historique_rapport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HistoriqueRapport $historiqueRapport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HistoriqueRapportType::class, $historiqueRapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_historique_rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('historique_rapport/edit.html.twig', [
            'historique_rapport' => $historiqueRapport,
            'form' => $form,
        ]);
    }

    
    #[Route('/{id}', name: 'app_historique_rapport_delete', methods: ['POST'])]
    public function delete(Request $request, HistoriqueRapport $historiqueRapport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historiqueRapport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($historiqueRapport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_historique_rapport_index', [], Response::HTTP_SEE_OTHER);
    }
}
