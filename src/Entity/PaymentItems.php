<?php

declare(strict_types=1);

namespace App\Entity;

class PaymentItems implements \Countable, \Iterator
{
    /** @var PaymentItem[] * */
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

    public function add(PaymentItem $order)
    {
        $this->container[] = $order;
    }

    public function at($index): PaymentItem
    {
        return $this->container[$index];
    }

    public static function fromXML(\SimpleXMLElement $xml): PaymentItems
    {
        $result = new PaymentItems();

        return $result;
    }
}
