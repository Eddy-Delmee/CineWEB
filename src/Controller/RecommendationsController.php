<?php

namespace App\Controller;

use App\Entity\Recommendations;
use App\Form\RecommendationsType;
use App\Repository\RecommendationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recommendations')]
class RecommendationsController extends AbstractController
{
    #[Route('/', name: 'app_recommendations_index', methods: ['GET'])]
    public function index(RecommendationsRepository $recommendationsRepository): Response
    {
        return $this->render('recommendations/index.html.twig', [
            'recommendations' => $recommendationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recommendations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RecommendationsRepository $recommendationsRepository): Response
    {
        $recommendation = new Recommendations();
        $form = $this->createForm(RecommendationsType::class, $recommendation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recommendationsRepository->save($recommendation, true);

            return $this->redirectToRoute('app_recommendations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recommendations/new.html.twig', [
            'recommendation' => $recommendation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recommendations_show', methods: ['GET'])]
    public function show(Recommendations $recommendation): Response
    {
        return $this->render('recommendations/show.html.twig', [
            'recommendation' => $recommendation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recommendations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recommendations $recommendation, RecommendationsRepository $recommendationsRepository): Response
    {
        $form = $this->createForm(RecommendationsType::class, $recommendation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recommendationsRepository->save($recommendation, true);

            return $this->redirectToRoute('app_recommendations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recommendations/edit.html.twig', [
            'recommendation' => $recommendation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recommendations_delete', methods: ['POST'])]
    public function delete(Request $request, Recommendations $recommendation, RecommendationsRepository $recommendationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recommendation->getId(), $request->request->get('_token'))) {
            $recommendationsRepository->remove($recommendation, true);
        }

        return $this->redirectToRoute('app_recommendations_index', [], Response::HTTP_SEE_OTHER);
    }
}
