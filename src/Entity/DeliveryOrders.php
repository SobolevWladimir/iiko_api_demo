<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryOrders
{

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
