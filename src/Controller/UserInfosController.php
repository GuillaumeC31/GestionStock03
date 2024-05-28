<?php

namespace App\Controller;

use App\Entity\UserInfos;
use App\Form\UserInfosType;
use App\Repository\UserInfosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/infos')]
class UserInfosController extends AbstractController
{
    #[Route('/', name: 'app_user_infos_index', methods: ['GET'])]
    public function index(UserInfosRepository $userInfosRepository): Response
    {
        return $this->render('user_infos/index.html.twig', [
            'user_infos' => $userInfosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_infos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userInfo = new UserInfos();
        $form = $this->createForm(UserInfosType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userInfo);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_infos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_infos/new.html.twig', [
            'user_info' => $userInfo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_infos_show', methods: ['GET'])]
    public function show(UserInfos $userInfo): Response
    {
        return $this->render('user_infos/show.html.twig', [
            'user_info' => $userInfo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_infos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserInfos $userInfo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserInfosType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_infos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_infos/edit.html.twig', [
            'user_info' => $userInfo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_infos_delete', methods: ['POST'])]
    public function delete(Request $request, UserInfos $userInfo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userInfo->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($userInfo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_infos_index', [], Response::HTTP_SEE_OTHER);
    }
}
