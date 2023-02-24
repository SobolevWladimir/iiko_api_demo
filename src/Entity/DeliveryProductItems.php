<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryProductItems implements \Iterator, \Countable, \JsonSerializable
{
    /** @var DeliveryProductItem[] * */
    private $container = [];
    private int $position = 0;

    /**
     * @param DeliveryProductItem[]|null $array
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

    public function add(DeliveryProductItem $order): void
    {
        $this->container[] = $order;
    }

    public function at(int $index): DeliveryProductItem
    {
        return $this->container[$index];
    }

    public static function fromXML(\SimpleXMLElement $xml): DeliveryProductItems
    {
        $result = new DeliveryProductItems();
        foreach ($xml->i as $item) {
            $result->add(DeliveryProductItem::fromXML($item));
        }

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        $result = [];
        foreach ($this->container as $item) {
            $result[] = $item->jsonSerialize();
        }

        return $result;
    }
}
