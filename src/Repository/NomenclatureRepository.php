<?php

namespace App\Repository;

use App\Entity\IikoResponse;
use App\Security\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NomenclatureRepository extends BaseRepository
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAll(User $user): IikoResponse
    {
        $clientId = $this->generateNewClientId();
        $path = '/services/compositeUpdate?methodName=getBackOfficeNomenclatureUpdateForced';
        $url = $user->getUrl() . $path;
        $header = $this->getRequestHeader($user, $clientId);
        $body = $this->getRequestBody($user, $clientId);
        $response = $this->client->request('POST', $url, [
          'headers' => $header,
          'body'    => $body->asXML(),
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }
        $res = IikoResponse::fromXml($response->getContent());

        return $res;
    }
}
