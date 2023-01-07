<?php

namespace App\Controller;

use App\Security\User;
use App\Repository\InfoRepository;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiLoginController extends AbstractController
{
     /**
     * Получение токена.
     *
     * @Route("/api/login", methods={"POST"})
     * @OA\Response(
     *     response=200,
     *     description="Токен доступа",
     *     @OA\Schema(type="string")
     * )
     * @OA\Response(
     *     response=400,
     *     description="Ошибка",
     *     @OA\Schema(type="string")
     * )
     */
    public function getTokenUser(Request $request, InfoRepository $repository): Response
    {
        $data  = $request->toArray();

        $user = new User();
        $user->setLogin($data['login']);
        $user->setUrl($data['url']);
        $user->setPassword(sha1($data['password']));
        $user->setClientId($data['clientId']);

        if (!$repository->checkServerAviable($user)) {
            return new Response('The server is not available', Response::HTTP_BAD_REQUEST);
        }
        $serverInfo  = $repository->getServerInfo($user);
        $user->setVersion($serverInfo->getVersion());
        $fingerPrints = $repository->getFingerPrints($user);
        return new Response($fingerPrints);
    }
}
