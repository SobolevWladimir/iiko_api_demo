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

    public function waitEntityesUpdate(User $user, string $fromRevision): string
    {
        $clientId = $this->generateNewClientId();
        $path = '/services/update?methodName=waitEntitiesUpdate';
        $url = $user->getUrl() . $path;
        $header = $this->getRequestHeader($user, $clientId);
        $body = $this->getRequestBodyForUpdate($user, $clientId, $fromRevision);

        $response = $this->client->request('POST', $url, [
        'headers' => $header,
        'body'    => $body->asXML(),
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception($response->getContent(), $statusCode);
        }

        return $response->getContent();
    }

    public function getRequestBodyForUpdate(User $user, string $clientId, string $revision = '-1'): \SimpleXMLElement
    {
        $xmlData = [
            'entities-version'                 => $revision,
            'client-type'                      => 'BACK',
            'enable-warnings'                  => 'false',
            'client-call-id'                   => $clientId,
            'license-hash'                     => $user->getLicenseHash(),
            'restrictions-state-hash'          => $user->getStateHash(),
            'obtained-license-connections-ids' => '',
            'use-raw-entities'                 => 'true',
            'fromRevision'                     => $revision,
            'timeoutMillis'                    => '0',
        ];
        $xml = new \SimpleXMLElement('<args/>');
        foreach ($xmlData as $key => $value) {
            $xml->addChild((string) $key, (string) $value);
        }

        return $xml;
    }
}
