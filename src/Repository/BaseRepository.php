<?php

declare(strict_types=1);

namespace App\Repository;

use App\Security\User;
use Symfony\Component\Uid\Uuid;

class BaseRepository
{
    public function generateNewClientId(): string
    {
        return (string) Uuid::v4();
    }

    public function getRequestBody(User $user, string $clientId): \SimpleXMLElement
    {
        $xmlData = [
            'entities-version'  => -1,
            'client-type' => 'BACK',
            'enable-warnings' => 'false',
            'client-call-id' => $clientId,
            'license-hash' => $user->getLicenseHash(),
            'restrictions-state-hash' => $user->getStateHash(),
            'obtained-license-connections-ids' => '',
            'use-raw-entities' => 'true',
            'revision' => '-1',
        ];
        $xml = new \SimpleXMLElement('<args/>');
        foreach ($xmlData as $key => $value) {
            $xml->addChild((string) $key, (string) $value);
        }

        return $xml;
    }

    /**
     * @param User $user
     * @param string $clientId
     *
     * @return array<string, string|null>
     */
    public function getRequestHeader(User $user, string $clientId): array
    {
        $result = [
            'Content-Type' => 'text/plain',
            'X-Resto-CorrelationId' => $clientId,
            'X-Resto-LoginName' => $user->getLogin(),
            'X-Resto-PasswordHash' => $user->getPassword(), // hash printf "resto#test" | sha1sum
            'X-Resto-BackVersion' => $user->getVersion(),
            'X-Resto-AuthType' => 'BACK',
            'X-Resto-ServerEdition' => 'IIKO_RMS',
            'Accept-Language' => 'ru',
        ];

        return $result;
    }
}
