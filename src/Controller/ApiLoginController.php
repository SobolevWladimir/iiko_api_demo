<?php

namespace App\Controller;

use App\Repository\InfoRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Security\User;

class ApiLoginController extends AbstractController
{
    #[Route('/login')]
    public function getTokenUser(Request $request, InfoRepository $repository): JsonResponse
    {
        $data  = $request->toArray();

        $user = new User();
        $user->setLogin($data['login']);
        $user->setUrl($data['url']);
        $user->setPassword($data['password']);



        $content = $repository->getServerInfo($user);
        ///$message = $request->query->get('get');
        return new JsonResponse(['token' => $content]);
    }
}
