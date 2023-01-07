<?php

namespace App\Repository;

use App\Security\User;
use Exception;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\Exception\TimeoutException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\ServerInfo;

class InfoRepository
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
            throw new Exception($response->getContent(), $statusCode);
        }
        return ServerInfo::fromXml($response->getContent());
    }

    public function getFingerPrints(User $user): string
    {
        $path = "/services/authorization?methodName=getCurrentFingerPrints";
        $url = $user->getUrl() . $path;
        $xmlData  = [
            'entities-version' => -1,
            'client-type' => 'BACK',
            'enable-warnings' => 'false',
            'client-call-id' => $user->getClientId(),
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
        $response = $this->client->request('POST', $url, [
          'headers' => [
            'Content-Type' => 'text/plain',
            'X-Resto-CorrelationId' => $user->getClientId(),
            'X-Resto-LoginName' => $user->getLogin(),
            'X-Resto-PasswordHash' => $user->getPassword(), //hash printf "resto#test" | sha1sum
            'X-Resto-BackVersion' => $user->getVersion(),
            'X-Resto-AuthType' => 'BACK',
            'X-Resto-ServerEdition' => 'IIKO_RMS',
            'Accept-Language' => 'ru'
          ],
          'body' => $body,
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new Exception($response->getContent(), $statusCode);
        }
        return  $response->getContent();
    }
}
