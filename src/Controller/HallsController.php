<?php

namespace App\Controller;

use App\Entity\Halls;
use App\Form\HallsType;
use App\Repository\HallsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/halls')]
class HallsController extends AbstractController
{
    #[Route('/', name: 'app_halls_index', methods: ['GET'])]
    public function index(HallsRepository $hallsRepository): Response
    {
        return $this->render('halls/index.html.twig', [
            'halls' => $hallsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_halls_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HallsRepository $hallsRepository): Response
    {
        $hall = new Halls();
        $form = $this->createForm(HallsType::class, $hall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hallsRepository->save($hall, true);

            return $this->redirectToRoute('app_halls_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('halls/new.html.twig', [
            'hall' => $hall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_halls_show', methods: ['GET'])]
    public function show(Halls $hall): Response
    {
        return $this->render('halls/show.html.twig', [
            'hall' => $hall,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_halls_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Halls $hall, HallsRepository $hallsRepository): Response
    {
        $form = $this->createForm(HallsType::class, $hall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hallsRepository->save($hall, true);

            return $this->redirectToRoute('app_halls_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('halls/edit.html.twig', [
            'hall' => $hall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_halls_delete', methods: ['POST'])]
    public function delete(Request $request, Halls $hall, HallsRepository $hallsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hall->getId(), $request->request->get('_token'))) {
            $hallsRepository->remove($hall, true);
        }

        return $this->redirectToRoute('app_halls_index', [], Response::HTTP_SEE_OTHER);
    }
}
