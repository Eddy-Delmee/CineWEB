<?php

namespace App\Controller;

use App\Repository\MoviesRepository;
use App\Repository\SessionsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(MoviesRepository $moviesRepository, SessionsRepository $sessionsRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'movies' => $moviesRepository->findAll(),
            'movieCarousel' => $moviesRepository->sortById(),
            'sessions' => $sessionsRepository->findByDate(),
        ]);
    }
}
