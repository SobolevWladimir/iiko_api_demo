<?php

namespace App\Controller;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryController extends AbstractController
{
     /**
     * Получить сылку на скачивания iikoOffice
     *
     * @Route("/api/delivery/terminals", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Массив с именами файлов",
     * )
     * @OA\Parameter(
     *     name="host",
     *     in="query",
     *     description="host https://arseniy-cloud.iiko.it:443",
     *     @OA\Schema(type="string")
     * )
     */
    public function getTerminals()
    {
        return new JsonResponse(['hello']);
    }
}
