<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Service\MessageGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ApiLoginController extends AbstractController
{
    #[Route('/login')]
    public function getTokenUser(Request $request): JsonResponse
    {

        ///$message = $request->query->get('get');
        return new JsonResponse(['token' => $message]);
    }
}
