<?php

namespace App\Controller;

use App\Security\User;
use App\Repository\DeliveryRepository;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

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
    public function getTerminals(DeliveryRepository $repository, #[CurrentUser] ?User $user)
    {
        $result = $repository->getTerminals($user);
        return new JsonResponse($result);
    }
}
