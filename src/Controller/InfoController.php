<?php

namespace App\Controller;

use App\Security\User;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

/**
 * Class InfoController.
 *
 * @OA\Tag(name="Информация о сервере")
 */
class InfoController
{
    /**
     * Получаем список ссылок доступных для скачивания на сервере.
     *
     * @Route("/api/info/links", methods={"GET"})
     *
     * @OA\Parameter(
     *     name="order",
     *     in="query",
     *     description="The field used to order rewards",
     *
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Response(
     *     response=200,
     *     description="массив с ссылками",
     * )
     *
     * @Security(name="Bearer")
     */
    public function links(#[CurrentUser] User $user): JsonResponse
    {
        $host = $user->getUrl();
        $link = ['office' => "$host/update/BackOffice/Setup.RMS.BackOffice.exe"];

        return new JsonResponse($link);
    }
}
