<?php

namespace App\Controller;

use App\Security\User;
use App\Repository\DeliveryRepository;
use App\Entity\DeliveryTerminal;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

/**
 * Class DeliveryController
 * @Security(name="Bearer")
 * @OA\Tag(name="Доставки")
 */
class DeliveryController extends AbstractController
{
    /**
    *  Получить список терминалов
    *
    * @Route("/api/delivery/terminals", methods={"GET"})
    * @OA\Response(
    *     response=200,
    *     description="Получить терминалы доставки",
    *     @OA\JsonContent(
    *        description="Возвращает список терминалов доставки",
    *        type="array",
    *         @OA\Items(ref=@Model(type=DeliveryTerminal::class))
    *     )
    * )
    */
    public function getTerminals(DeliveryRepository $repository, #[CurrentUser] User $user): Response
    {
        $result = $repository->getTerminals($user);
        return new JsonResponse($result);
    }

     /**
     * Получить  список доставок
     *
     * @Route("/api/delivery/orders", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Массив с именами файлов",
     * )
     */
    public function getDeliveryOrders(DeliveryRepository $repository, #[CurrentUser] User $user): Response
    {
        $result = $repository->getDeliveryOrders($user);
        return new JsonResponse($result);
    }
}
