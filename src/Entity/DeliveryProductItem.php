<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryProductItem
{
    // Не распарсенные переменные
    // lastModifyNode
    // rank;
    // deliveryOrder;
    // comboId
    // comboGroupId;
    // splitted
    // orderItemsAggregationId
    // private bool $mainPiece;
    // size;
    // comment
    // deletionMethod
    // guestId;
    // waiter;
    // modifiers

    private string $id;
    private string $revision;
    private float $amount;
    private float $price;
    private bool $pricePredefined;
    private string $product;
    private float $sum;
    private bool $deleted;
    private string $status;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getRevision(): string
    {
        return $this->revision;
    }

    public function setRevision(string $revision): void
    {
        $this->revision = $revision;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPricePredefined(): bool
    {
        return $this->pricePredefined;
    }

    public function setPricePredefined(bool $pricePredefined): void
    {
        $this->pricePredefined = $pricePredefined;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function setProduct(string $product): void
    {
        $this->product = $product;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }

    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public static function fromXML(\SimpleXMLElement $xml): DeliveryProductItem
    {
        $result = new DeliveryProductItem();
        
        $result->setId((string) $xml->attributes()->eid);
        $result->setRevision((string) $xml->revision);
        $result->setAmount((float) $xml->amount);
        $result->setPrice((float) $xml->price);
        $result->setPricePredefined((bool) $xml->pricePredefined);
        $result->setProduct((string) $xml->product);
        $result->setSum((float) $xml->sum);
        $result->setDeleted($xml->deleted == "true");
        $result->setStatus((string) $xml->status);
        return $result;
    }
}
