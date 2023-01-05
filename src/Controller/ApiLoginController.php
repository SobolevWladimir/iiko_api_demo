<?php

namespace App\Controller;

use App\Repository\InfoRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Security\User;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

class ApiLoginController extends AbstractController
{
     /**
     * Получение токена.
     *
     * @Route("/api/login", methods={"POST"})
     * @OA\Response(
     *     response=200,
     *     description="Токен доступа",
     * )
     */
    public function getTokenUser(Request $request, InfoRepository $repository): Response
    {
        $data  = $request->toArray();

        $user = new User();
        $user->setLogin($data['login']);
        $user->setUrl($data['url']);
        $user->setPassword($data['password']);

        if (!$repository->checkServerAviable($user)) {
            return new JsonResponse(['message' => 'The server is not available'], Response::HTTP_BAD_REQUEST);
        }
        ///$message = $request->query->get('get');
        return new JsonResponse(['token' => 'test']);
    }
}
