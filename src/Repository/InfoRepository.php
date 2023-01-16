<?php

namespace App\Repository;

use App\Entity\ServerInfo;
use App\Entity\IikoResponse;
use App\Security\User;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\Exception\TimeoutException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Uid\Uuid;

class InfoRepository extends BaseRepository
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function checkServerAviable(User $user): bool
    {
        $path = "/get_server_info.jsp?encoding=utf-8";
        $url = $user->getUrl() . $path;
        $response = $this->client->request(
            'GET',
            $url,
        );
        try {
            $statusCode = $response->getStatusCode();
        } catch (TransportException) {
            return false;
        } catch (TimeoutException) {
            return false;
        }

        return $statusCode === 200;
    }

    public function getServerInfo(User $user): ServerInfo
    {
        $path = "/get_server_info.jsp?encoding=utf-8";
        $url = $user->getUrl() . $path;
        $response = $this->client->request(
            'GET',
            $url,
        );

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }
        return ServerInfo::fromXml($response->getContent());
    }

    public function getFingerPrints(User $user): IikoResponse
    {
        $uuid  = Uuid::v4();
        $path = "/services/authorization?methodName=getCurrentFingerPrints";
        $url = $user->getUrl() . $path;
        $xmlData  = [
            'entities-version' => -1,
            'client-type' => 'BACK',
            'enable-warnings' => 'false',
            'client-call-id' => $uuid,
            'license-hash' => '0',
            'restrictions-state-hash' => '0',
            'obtained-license-connections-ids' => '',
            'use-raw-entities' => 'true',
        ];
        $xml = new \SimpleXMLElement('<args/>');
        foreach ($xmlData as $key => $value) {
            $xml->addChild($key, $value);
        }
        $body =  $xml->asXML();

        $header  = $this->getRequestHeader($user, $uuid);
        $response = $this->client->request('POST', $url, [
          'headers' => $header,
          'body' => $body,
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }
        return IikoResponse::fromXml($response->getContent());
    }
}
