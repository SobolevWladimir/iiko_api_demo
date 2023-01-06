<?php

namespace App\Repository;

use App\Security\User;
use Exception;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\Exception\TimeoutException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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

    public function getServerInfo(User $user): string
    {
        $path = "/get_server_info.jsp?encoding=utf-8";
        $url = $user->getUrl() . $path;
        $response = $this->client->request(
            'GET',
            $url,
        );

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new Exception($response->getContent());
        }
        $content = $response->getContent();
        return $content;
    }
}
