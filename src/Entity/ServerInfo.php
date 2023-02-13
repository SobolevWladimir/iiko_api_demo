<?php

declare(strict_types=1);

namespace App\Entity;

class ServerInfo
{
    private string $serverName;

    private string $edition;

    private string $version;

    private string $computerName;

    private string $serverState;

    public function getServerName(): string
    {
        return $this->serverName;
    }

    public function setServerName(string $serverName): void
    {
        $this->serverName = $serverName;
    }

    public function getEdition(): string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): void
    {
        $this->edition = $edition;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function getComputerName(): string
    {
        return $this->computerName;
    }

    public function setComputerName(string $computerName): void
    {
        $this->computerName = $computerName;
    }

    public function getServerState(): string
    {
        return $this->serverState;
    }

    public function setServerState(string $serverState): void
    {
        $this->serverState = $serverState;
    }

    /** @return mixed[]  */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function fromXml(string $xml): ServerInfo
    {
        $parse = new \SimpleXMLElement($xml);
        $result = new ServerInfo();
        $result->setServerName((string) $parse->serverName);
        $result->setEdition((string) $parse->edition);
        $result->setVersion((string) $parse->version);
        $result->setComputerName((string) $parse->computerName);
        $result->setServerState((string) $parse->serverState);

        return $result;
    }
}
