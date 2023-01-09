<?php

namespace App\Repository;

use App\Security\User;
use App\Entity\IikoResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeliveryRepository extends BaseRepository
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getTerminals(User $user)
    {
        $clientId = $this->generateNewClientId();
        $path = "/services/deliveryTerminal?methodName=getAllDeliveryTerminals";
        $url = $user->getUrl() . $path;
        $body = $this->getRequestBody($user, $clientId);
        $header  = $this->getRequestHeader($user, $clientId);
        $response = $this->client->request('POST', $url, [
          'headers' => $header,
          'body' => $body->asXML(),
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }
        return IikoResponse::fromXml($response->getContent());
    }
}
