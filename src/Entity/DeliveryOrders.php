<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryOrders implements \Countable, \Iterator, \JsonSerializable
{
    /** @var DeliveryOrder[] * */
    protected array $container = [];

    private int $position = 0;

    /**
     * @param DeliveryOrder[]|null $array
     *
     * @return void
     */
    public function __construct(array $array = null)
    {
        if (!is_null($array)) {
            $this->container = $array;
        }
        $this->position = 0;
    }

    public function jsonSerialize(): mixed
    {
        $result = [];
        foreach ($this->container as $item) {
            $result[] = $item->jsonSerialize();
        }

        return $result;
    }

    public function current(): mixed
    {
        return $this->container[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->container[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->container);
    }

    public function add(DeliveryOrder $order): void
    {
        $this->container[] = $order;
    }

    public function at(int $index): DeliveryOrder
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
        $result = self::fromXML($xml);

        return $result;
    }
}
