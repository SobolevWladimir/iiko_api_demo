<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController
{
    #[Route('/info')]
    public function files(): Response
    {
        return new JsonResponse(['hello']);
    }
}
