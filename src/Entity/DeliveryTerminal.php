<?php

namespace App\Entity;

class DeliveryTerminal implements \JsonSerializable
{
    private string $eid;

    private string $revision;

    private string $terminal;

    private bool $registered;

    private bool $deleted;

    private string $name;

    private string $departmentEntityId;

    private string $groupId;

    private TerminalSettings $terminalSettings;

    private string $fullRMSVersion;

    private string $protocolVersion;

    public static function fromXML(\SimpleXMLElement $xml): DeliveryTerminal
    {
        $result = new DeliveryTerminal();

        $attributes  = $xml->attributes();
        $result->setEid($attributes->eid);
        $result->setRevision($xml->revision);
        $result->setTerminal($xml->terminal);
        $result->setRegistered($xml->registered == "true");
        $result->setDeleted($xml->deleted == "true");
        $result->setName($xml->name);
        $result->setDepartmentEntityId($xml->departmentEntityId);
        $result->setGroupId($xml->groupId);
        $result->setTerminalSettings(TerminalSettings::fromXML($xml->terminalSettings));
        $result->setFullRMSVersion($xml->fullRMSVersion);
        $result->setProtocolVersion($xml->protocolVersion);
        return $result;
    }

    public static function fromIIKOResponse(IikoResponse $response): array
    {
        $result  = [];
        $xml  = $response->getReturnValue();
        foreach ($xml->i as $item) {
            $result[] = self::fromXML($item);
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return [
          'eid' => $this->getEid(),
          'revision' => $this->getRevision(),
          'terminal' => $this->getTerminal(),
          'registered' => $this->getRegistered(),
          'deleted' => $this->getDeleted(),
          'name' => $this->getName(),
          'departmentEntityId' => $this->getDepartmentEntityId(),
          'groupId' => $this->getGroupId(),
          'terminalSettings' => $this->getTerminalSettings(),
          'fullRMSVersion' => $this->getFullRMSVersion(),
          'protocolVersion' => $this->getProtocolVersion(),
        ];
    }

    public function getEid(): string
    {
        return $this->eid;
    }

    public function setEid(string $eid): void
    {
        $this->eid = $eid;
    }

    public function getRevision(): string
    {
        return $this->revision;
    }

    public function setRevision(string $revision): void
    {
        $this->revision = $revision;
    }

    public function getTerminal(): string
    {
        return $this->terminal;
    }

    public function setTerminal(string $terminal): void
    {
        $this->terminal = $terminal;
    }

    public function getRegistered(): bool
    {
        return $this->registered;
    }

    public function setRegistered(bool $registered): void
    {
        $this->registered = $registered;
    }

    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDepartmentEntityId(): string
    {
        return $this->departmentEntityId;
    }

    public function setDepartmentEntityId(string $departmentEntityId): void
    {
        $this->departmentEntityId = $departmentEntityId;
    }

    public function getGroupId(): string
    {
        return $this->groupId;
    }

    public function setGroupId(string $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function getTerminalSettings(): TerminalSettings
    {
        return $this->terminalSettings;
    }

    public function setTerminalSettings(TerminalSettings $terminalSettings): void
    {
        $this->terminalSettings = $terminalSettings;
    }

    public function getFullRMSVersion(): string
    {
        return $this->fullRMSVersion;
    }

    public function setFullRMSVersion(string $fullRMSVersion): void
    {
        $this->fullRMSVersion = $fullRMSVersion;
    }

    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    public function setProtocolVersion(string $protocolVersion): void
    {
        $this->protocolVersion = $protocolVersion;
    }
}
