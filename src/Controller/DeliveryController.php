<?php

namespace App\Controller;

use App\Entity\DeliveryTerminal;
use App\Repository\DeliveryRepository;
use App\Security\User;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

/**
 * Class DeliveryController.
 *
 * @Security(name="Bearer")
 *
 * @OA\Tag(name="Доставки")
 */
class DeliveryController extends AbstractController
{
    /**
     *  Получить список терминалов.
     *
     * @Route("/api/delivery/terminals", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Получить терминалы доставки",
     *
     *     @OA\JsonContent(
     *        description="Возвращает список терминалов доставки",
     *        type="array",
     *
     *         @OA\Items(ref=@Model(type=DeliveryTerminal::class))
     *     )
     * )
     *
     * @Security(name="Bearer")
     */
    public function getTerminals(DeliveryRepository $repository, #[CurrentUser] User $user): Response
    {
        $result = $repository->getTerminals($user);

        return new JsonResponse($result);
    }

    /**
     * Получить  список доставок.
     *
     * @Route("/api/delivery/orders", methods={"GET"})
     *
     * @OA\Parameter(
     *     name="datefrom",
     *     in="query",
     *     description="Дата от в форматe: YYYY-MM-DD",
     *     required=true,
     *
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Parameter(
     *     name="dateto",
     *     in="query",
     *     description="Дата до в форматe: YYYY-MM-DD",
     *     required=true,
     *
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Response(
     *     response=200,
     *     description="Массив с именами файлов",
     * )
     *
     * @Security(name="Bearer")
     */
    public function getDeliveryOrders(
        Request $request,
        DeliveryRepository $repository,
        #[CurrentUser] User $user
    ): Response {
        $dateFromStr = (string) $request->query->get('datefrom');
        $dateToStr = (string) $request->query->get('dateto');
        if ($dateFromStr === '' || $dateToStr === '') {
            return new JsonResponse('Необходимо указать datefrom и dateto', Response::HTTP_BAD_REQUEST);
        }
        $datefrom = new \DateTime($dateFromStr);
        $dateto = new \DateTime($dateToStr);
        $result = $repository->getDeliveryOrders($user, $datefrom, $dateto);

        return new JsonResponse($result);
    }
}
