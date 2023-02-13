<?php

declare(strict_types=1);

namespace App\Entity;

class TerminalSettings implements \JsonSerializable
{
    private int $averageDeliveryProcessingTimeInMinutes;

    private int $averageDeliverySelfServiceProcessingTimeInMinutes;

    public static function fromXML(\SimpleXMLElement $xml): TerminalSettings
    {
        $result = new TerminalSettings();
        $result->setAverageDeliveryProcessingTimeInMinutes((int) $xml->averageDeliveryProcessingTimeInMinutes);
        $result->setAverageDSSPTInMinutes((int) $xml->averageDeliverySelfServiceProcessingTimeInMinutes);

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'averageDeliveryProcessingTimeInMinutes'            => $this->getAverageDeliveryProcessingTimeInMinutes(),
            'averageDeliverySelfServiceProcessingTimeInMinutes' => $this->getAverageDSSPTInMinutes(),
        ];
    }

    public function getAverageDeliveryProcessingTimeInMinutes(): int
    {
        return $this->averageDeliveryProcessingTimeInMinutes;
    }

    public function setAverageDeliveryProcessingTimeInMinutes(int $averageDeliveryProcessingTimeInMinutes): void
    {
        $this->averageDeliveryProcessingTimeInMinutes = $averageDeliveryProcessingTimeInMinutes;
    }

    public function getAverageDSSPTInMinutes(): int
    {
        return $this->averageDeliverySelfServiceProcessingTimeInMinutes;
    }

    public function setAverageDSSPTInMinutes(int $averageDeliverySelfServiceProcessingTimeInMinutes): void
    {
        $this->averageDeliverySelfServiceProcessingTimeInMinutes = $averageDeliverySelfServiceProcessingTimeInMinutes;
    }
}
