<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryOrders implements \ArrayAccess, \Countable
{
    protected array $container = [];

    public function __construct($array = null)
    {
        if (!is_null($array)) {
            $this->container = $array;
        }
    }

    public function count(): int
    {
        return count($this->container);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->offsetExists($offset) ? $this->container[$offset] : null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    public static function fromXML(\SimpleXMLElement $xml): DeliveryOrders
    {
         $result = new DeliveryOrders();
        // $attributes = $xml->attributes();
        // $eid = '';
        // if ($attributes !== null && $attributes->eid !== null) {
        //     $eid = (string) $attributes->eid;
        // }
        // $result->setEid($eid);
        // $result->setRevision($xml->revision !== null ? (string) $xml->revision : '');
        // $result->setTerminal($xml->terminal !== null ? (string) $xml->terminal : '');
        // $result->setRegistered($xml->registered == 'true');
        // $result->setDeleted($xml->deleted == 'true');
        // $result->setName((string) $xml->name);
        // $result->setDepartmentEntityId((string) $xml->departmentEntityId);
        // $result->setGroupId((string) $xml->groupId);
        // $result->setTerminalSettings(TerminalSettings::fromXML($xml->terminalSettings));
        // $result->setFullRMSVersion((string) $xml->fullRMSVersion);
        // $result->setProtocolVersion((string) $xml->protocolVersion);

        return $result;
    }
    public static function fromIIKOResponse(IikoResponse $response): DeliveryOrders
    {
        $result = [];
        $xml = $response->getReturnValue();
        foreach ($xml->deliveryOrdersLoadingResponse->i as $item) {
            $result[] = self::fromXML($item);
        }

        return $result;
    }
}
