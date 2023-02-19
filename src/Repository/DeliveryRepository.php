<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\DeliveryTerminal;
use App\Entity\IikoResponse;
use App\Entity\DeliveryOrders;
use App\Security\User;
use DateTime;
use Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeliveryRepository extends BaseRepository
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param User $user
     *
     * @return DeliveryTerminal[]
     *
     * @throws TransportExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws ServerExceptionInterface
     * @throws \Exception
     */
    public function getTerminals(User $user): array
    {
        $clientId = $this->generateNewClientId();
        $path = '/services/deliveryTerminal?methodName=getAllDeliveryTerminals';
        $url = $user->getUrl() . $path;
        $body = $this->getRequestBody($user, $clientId);
        $header = $this->getRequestHeader($user, $clientId);
        $response = $this->client->request('POST', $url, [
          'headers' => $header,
          'body'    => $body->asXML(),
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }
        $res = IikoResponse::fromXml($response->getContent());

        return DeliveryTerminal::fromIIKOResponse($res);
    }

    /**
     * @param User $user 
     * @param DateTime $dateFrom 
     * @param DateTime $dateTo 
     * @return DeliveryOrders 
     * @throws TransportExceptionInterface 
     * @throws RedirectionExceptionInterface 
     * @throws ClientExceptionInterface 
     * @throws ServerExceptionInterface 
     * @throws Exception 
     */
    public function getDeliveryOrders(User $user, \DateTime $dateFrom, \DateTime $dateTo): DeliveryOrders
    {

        $dateFromFormat = $dateFrom->format(\DateTimeInterface::RFC3339_EXTENDED);
        $dateToFormat = $dateTo->format(\DateTimeInterface::RFC3339_EXTENDED);
        $clientId = $this->generateNewClientId();
        $path = '/services/deliveryOrdersLoading?methodName=getAllDeliveryOrdersBrdData';
        $url = $user->getUrl() . $path;
        $body = $this->getRequestBody($user, $clientId);
        $request = $body->addChild('request');
        $deliveryOrdersLoadingRequest = $request->addChild('deliveryOrdersLoadingRequest');
        $deliveryOrdersLoadingRequest->addChild('dateFrom', $dateFromFormat);
        $deliveryOrdersLoadingRequest->addChild('dateTo', $dateToFormat);
        $request->addChild('deliveryTerminalsRevision', '-1');
        $request->addChild('deliveryTerminalsExchangeStatesRevision', '-1');
        $header = $this->getRequestHeader($user, $clientId);
        $response = $this->client->request('POST', $url, [
          'headers' => $header,
          'body'    => $body->asXML(),
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }
        $res = IikoResponse::fromXml($response->getContent());
        return DeliveryOrders::fromIIKOResponse($res);
    }
}
