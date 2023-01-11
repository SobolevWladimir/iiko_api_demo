<?php

namespace App\Repository;

use App\Security\User;
use App\Entity\IikoResponse;
use App\Entity\DeliveryTerminal;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeliveryRepository extends BaseRepository
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getTerminals(User $user): array
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
        $res =  IikoResponse::fromXml($response->getContent());
        return DeliveryTerminal::fromIIKOResponse($res);
    }

    public function getDeliveryOrders(User $user)
    {
        $clientId = $this->generateNewClientId();
        $path = "/services/deliveryOrdersLoading?methodName=getAllDeliveryOrdersBrdData";
        $url = $user->getUrl() . $path;
        $body = $this->getRequestBody($user, $clientId);
        $request  = $body->addChild('request');
        $request->addChild('deliveryTerminalsRevision', '-1');
        $request->addChild('deliveryTerminalsExchangeStatesRevision', '-1');
        $header  = $this->getRequestHeader($user, $clientId);
        $response = $this->client->request('POST', $url, [
          'headers' => $header,
          'body' => $body->asXML(),
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }
        $res =  IikoResponse::fromXml($response->getContent());
        return  $res;
    }
}
