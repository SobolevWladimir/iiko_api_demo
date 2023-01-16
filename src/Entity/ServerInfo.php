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
    public function toArray()
    {
        return get_object_vars($this);
    }

    public static function fromXml(string $xml): ServerInfo
    {
        $parse = new \SimpleXMLElement($xml);
        $result = new ServerInfo();
        $result->setServerName($parse->serverName);
        $result->setEdition($parse->edition);
        $result->setVersion($parse->version);
        $result->setComputerName($parse->computerName);
        $result->setServerState($parse->serverState);
        return $result;
    }
}
