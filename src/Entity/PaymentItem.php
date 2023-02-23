<?php

declare(strict_types=1);

namespace App\Entity;

class PaymentItem
{
    private string $id;
    private int $revision;
    // lastModifyNode
    // deliveryOrder
    // paymentType;
    // additionalData
    // chequeAdditionalInfo
    // organizationDetailsInfo
    private float $sum;
    private bool $isPrepay;
    private bool $isPreliminary;
    private bool $isExternal;
    private bool $isProcessedExternally;
    private bool $isFiscalizedExternally;

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

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }

    public function getIsPrepay(): bool
    {
        return $this->isPrepay;
    }

    public function setIsPrepay(bool $isPrepay): void
    {
        $this->isPrepay = $isPrepay;
    }

    public function getIsPreliminary(): bool
    {
        return $this->isPreliminary;
    }

    public function setIsPreliminary(bool $isPreliminary): void
    {
        $this->isPreliminary = $isPreliminary;
    }

    public function getIsExternal(): bool
    {
        return $this->isExternal;
    }

    public function setIsExternal(bool $isExternal): void
    {
        $this->isExternal = $isExternal;
    }

    public function getIsProcessedExternally(): bool
    {
        return $this->isProcessedExternally;
    }

    public function setIsProcessedExternally(bool $isProcessedExternally): void
    {
        $this->isProcessedExternally = $isProcessedExternally;
    }

    public function getIsFiscalizedExternally(): bool
    {
        return $this->isFiscalizedExternally;
    }

    public function setIsFiscalizedExternally(bool $isFiscalizedExternally): void
    {
        $this->isFiscalizedExternally = $isFiscalizedExternally;
    }
}
