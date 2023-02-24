<?php

namespace App\Controller;

use App\Repository\NomenclatureRepository;
use App\Security\User;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

/**
 * Class NomenclatureController .
 *
 * @Security(name="Bearer")
 *
 * @OA\Tag(name="Товары и скады")
 */
class NomenclatureController extends AbstractController
{
    /**
     *  Получить общую информацию о товарах.
     *
     * @Route("/api/nomenclature/list", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="",
     * )
     *
     * @Security(name="Bearer")
     */
    public function getAll(NomenclatureRepository $repository, #[CurrentUser] User $user): Response
    {
        $result = $repository->getAll($user);

        return new JsonResponse($result);
    }
}
