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
    private int $revision;
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

    public function getRevision(): int
    {
        return $this->revision;
    }

    public function setRevision(int $revision): void
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
}
