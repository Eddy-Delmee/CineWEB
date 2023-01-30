<?php

namespace App\Controller;

use App\Entity\Movies;
use App\Form\MoviesType;
use App\Repository\MoviesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/movies')]
class MoviesController extends AbstractController
{
    #[Route('/', name: 'app_movies_index', methods: ['GET'])]
    public function index(MoviesRepository $moviesRepository): Response
    {
        return $this->render('movies/index.html.twig', [
            'movies' => $moviesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_movies_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, MoviesRepository $moviesRepository, SluggerInterface $slugger): Response
    {
        $movie = new Movies();
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $imageFile = $form->get('imageMovie')->getData();
            if ($imageFile) {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
            $imageFile->move(
            $this->getParameter('images_directory'),
            $newFilename
            );
            $movie->setimageMovie($newFilename);
            $moviesRepository->save($movie, true);

            $moviesRepository->save($movie, true);

            return $this->redirectToRoute('app_movies_index', [], Response::HTTP_SEE_OTHER);
        }
    }

        return $this->renderForm('movies/new.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_movies_show', methods: ['GET'])]
    public function show(Movies $movie): Response
    {
        return $this->render('movies/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_movies_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Movies $movie, MoviesRepository $moviesRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('imageMovie')->getData();
            if ($imageFile) {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
            $imageFile->move(
            $this->getParameter('images_directory'),
            $newFilename
            );
            $movie->setimageMovie($newFilename);
            $moviesRepository->save($movie, true);

            $moviesRepository->save($movie, true);

            return $this->redirectToRoute('app_movies_index', [], Response::HTTP_SEE_OTHER);
        }
    }

        return $this->renderForm('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_movies_delete', methods: ['POST'])]
    public function delete(Request $request, Movies $movie, MoviesRepository $moviesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $moviesRepository->remove($movie, true);
        }

        return $this->redirectToRoute('app_movies_index', [], Response::HTTP_SEE_OTHER);
    }
}
