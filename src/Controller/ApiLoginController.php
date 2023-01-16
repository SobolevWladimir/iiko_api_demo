<?php

namespace App\Controller;

use App\Security\User;
use App\Repository\InfoRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use OpenApi\Annotations as OA;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

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
    public function getTokenUser(Request $request, InfoRepository $repository, JWTTokenManagerInterface $JWTManager): Response
    {
        $data  = $request->toArray();

        $user = new User();
        $user->setLogin($data['login']);
        $user->setUrl($data['url']);
        $user->setPassword(sha1($data['password']));
        if (!$repository->checkServerAviable($user)) {
            return new Response('The server is not available', Response::HTTP_BAD_REQUEST);
        }
        $serverInfo  = $repository->getServerInfo($user);
        $user->setVersion($serverInfo->getVersion());
        $fingerPrint = null;
        try {
            $fingerPrint = $repository->getFingerPrints($user);
        } catch (\Exception) {
             return new Response('Ошибка авторзиции', Response::HTTP_BAD_GATEWAY);
        }
        $payload = [
            'url'       => $user->getUrl(),
            'password'  => $user->getPassword(),
            'version'   => $user->getVersion(),
            'state-hash' => $fingerPrint->getLicenseInfo()->getStateHash(),
            'license-hash' => $fingerPrint->getLicenseInfo()->getLicenseHash(),
        ];
        $token  = $JWTManager->createFromPayload($user, $payload);
        return new JWTAuthenticationSuccessResponse($token);
    }

     /**
     * Получение данных о пользователе.
     *
     * @Route("/api/user/info", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Получить информацию о текущем пользователе",
     *     @Model(type=User::class)
     * )
     * @OA\Response(
     *     response=400,
     *     description="Ошибка",
     *     @OA\Schema(type="string")
     * )
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
