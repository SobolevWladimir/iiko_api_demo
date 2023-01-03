<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Service\MessageGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiLoginController extends AbstractController
{
    #[Route('/login')]
    public function getTokenUser(MessageGenerator $messageGenerator): JsonResponse
    {
        ///$message = $request->query->get('get');
        $message = $messageGenerator->getHappyMessage();
        return new JsonResponse(['token' => $message]);
    }
}
