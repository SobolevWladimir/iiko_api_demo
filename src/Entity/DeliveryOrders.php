<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryOrders implements \Countable, \Iterator
{
    /** @var DeliveryOrder[] * */
    protected array $container = [];

    private $positon = 0;

    public function __construct($array = null)
    {
        if (!is_null($array)) {
            $this->container = $array;
        }
        $this->positon = 0;
    }

    public function current(): mixed
    {
        return $this->container[$this->positon];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): mixed
    {
        return $this->positon;
    }

    public function valid(): bool
    {
        return isset($this->container[$this->position]);
    }

    public function rewind(): void
    {
        $this->positon = 0;
    }

    public function count(): int
    {
        return count($this->container);
    }

    public function add(DeliveryOrder $order)
    {
        $this->container[] = $order;
    }

    public function at($index): DeliveryOrder
    {
        return $this->container[$index];
    }

    public static function fromXML(\SimpleXMLElement $xml): DeliveryOrders
    {
        $result = new DeliveryOrders();
        // парсинг  customers

        // парсим  delivery orders
        foreach ($xml->deliveryOrdersLoadingResponse->deliveryOrders->i as $deliveryOrder) {
            $item = DeliveryOrder::fromXML($deliveryOrder);
            $result->add($item);
        }
        return $result;
    }

    public static function fromIIKOResponse(IikoResponse $response): DeliveryOrders
    {
        $xml = $response->getReturnValue();
        $result  = self::fromXML($xml);

        return $result;
    }
}
