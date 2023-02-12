<?php

namespace App\Controller;

use App\Entity\AuthData;
use App\Repository\InfoRepository;
use App\Security\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
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
 * Class ApiLoginController.
 *
 * @OA\Tag(name="Пользователь")
 */
class ApiLoginController extends AbstractController
{
    /**
     * Получение токена.
     *
     * @Route("/api/login", methods={"POST"})
     *
     * @OA\RequestBody(@Model(type=AuthData::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Токен доступа",
     *
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Response(
     *     response=400,
     *     description="Ошибка",
     *
     *     @OA\Schema(type="string")
     * )
     */
    public function getTokenUser(
        Request $request,
        InfoRepository $repository,
        JWTTokenManagerInterface $JWTManager
    ): Response {
        $authData = AuthData::fromArray($request->toArray());
        $user = $authData->toUser();
        if (!$repository->checkServerAviable($user)) {
            return new Response('Сервер не доступен. Попробуйте указать другой сервер', Response::HTTP_BAD_REQUEST);
        }
        $serverInfo = $repository->getServerInfo($user);
        $user->setVersion($serverInfo->getVersion());
        $fingerPrint = null;
        try {
            $fingerPrint = $repository->getFingerPrints($user);
        } catch (\Exception) {
            return new Response('Ошибка авторизации! Попробуйте другой login/password', Response::HTTP_BAD_GATEWAY);
        }
        $payload = [
            'url' => $user->getUrl(),
            'password' => $user->getPassword(),
            'version' => $user->getVersion(),
            'state-hash' => $fingerPrint->getLicenseInfo()->getStateHash(),
            'license-hash' => $fingerPrint->getLicenseInfo()->getLicenseHash(),
        ];
        $token = $JWTManager->createFromPayload($user, $payload);

        return new Response($token);
    }

    /**
     * Получение данных о пользователе.
     *
     * @Route("/api/user/info", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Получить информацию о текущем пользователе",
     *
     *     @Model(type=User::class)
     * )
     *
     * @OA\Response(
     *     response=400,
     *     description="Ошибка",
     *
     *     @OA\Schema(type="string")
     * )
     *
     * @Security(name="Bearer")
     */
    public function getUserInfo(#[CurrentUser] User $user): Response
    {
        $result = [
          'login' => $user->getLogin(),
          'url' => $user->getUrl(),
          'version' => $user->getVersion(),
          'license-hash' => $user->getLicenseHash(),
          'state-hash' => $user->getStateHash(),
        ];

        return new JsonResponse($result);
    }
}
