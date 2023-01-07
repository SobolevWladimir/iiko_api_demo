<?php

namespace App\Repository;

use App\Security\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeliveryRepository
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getTerminals(User $user)
    {

        $path = "/resto/services/deliveryTerminal?methodName=getAllDeliveryTerminals";
        $url = $user->getUrl() . $path;

        $xmlData  = [
            'entities-version' => -1,
            'client-type' => 'BACK',
            'enable-warnings' => 'false',
            'client-call-id' => $user->getClientId(), // TODO:  должно обыть равно с  X-Resto-CorrelationId, которая в свою очередь динамически генерируется
            'license-hash' => '0', //TODO: добавить из fingerPrints
            'restrictions-state-hash' => '0', // stateHash из fingerPrints
            'obtained-license-connections-ids' => '', // это какая то хрень // нужна
            'use-raw-entities' => 'true',
        ];
    }
}
