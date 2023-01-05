<?php

namespace App\Repository;

use App\Security\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InfoRepository
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getServerInfo(User $user)
    {
        $path = "/get_server_info.jsp?encoding=utf-8";
        $url = $user->getUrl() . $path;
        $response = $this->client->request(
            'GET',
            $url,
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        return $content;
    }
}
