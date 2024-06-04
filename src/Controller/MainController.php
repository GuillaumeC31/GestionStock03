<?php

namespace App\Controller;

use App\Repository\UserInfosRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(UsersRepository $userRepo, UserInfosRepository $userInfoRepo): Response
    {
        
        return $this->render('main/index.html.twig', [
            'user' => $userRepo->findAll(),
            'uinfos' => $userInfoRepo->findAll(),
        ]);
    }
}
