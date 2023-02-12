<?php

namespace App\Controller;

use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InfoController.
 *
 * @OA\Tag(name="Информация о сервере")
 */
class InfoController
{
    /**
     * Получаем список файлов доступных для скачивания на сервере.
     *
     * @Route("/api/info", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Массив с именами файлов",
     * )
     */
    public function files(): JsonResponse
    {
        return new JsonResponse(['hello']);
    }

    /**
     * Получить сылку на скачивания iikoOffice.
     *
     * @Route("/api/office", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Массив с именами файлов",
     * )
     *
     * @OA\Parameter(
     *     name="host",
     *     in="query",
     *     description="host https://arseniy-cloud.iiko.it:443",
     *
     *     @OA\Schema(type="string")
     * )
     */
    public function office(): JsonResponse
    {
        return new JsonResponse(['hello']);
    }
}
