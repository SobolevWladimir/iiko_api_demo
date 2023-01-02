<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class InfoController
{
     /**
     * Получаем список файлов доступных для скачивания на сервере.
     *
     * @Route("/api/info", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Массив с именами файлов",
     * )
     */
    public function files(): JsonResponse
    {
        return new JsonResponse(['hello']);
    }
}
