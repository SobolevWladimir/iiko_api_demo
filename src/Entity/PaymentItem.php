<?php

declare(strict_types=1);

namespace App\Entity;

class PaymentItem implements \JsonSerializable
{
    // lastModifyNode
    // deliveryOrder
    // paymentType;
    // additionalData
    // chequeAdditionalInfo
    // organizationDetailsInfo
    private string $id;
    private string $revision;
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

    public function getRevision(): string
    {
        return $this->revision;
    }

    public function setRevision(string $revision): void
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

    public static function fromXML(\SimpleXMLElement $xml): PaymentItem
    {
        $result = new PaymentItem();
        $result->setId((string) $xml->attributes()?->eid);
        $result->setRevision((string) $xml->revision);
        $result->setSum((float) $xml->sum);
        $result->setIsPrepay(IikoResponse::parseBool($xml->isPrepay));
        $result->setIsPrepay(IikoResponse::parseBool($xml->isPreliminary));
        $result->setIsPrepay(IikoResponse::parseBool($xml->isExternal));
        $result->setIsPrepay(IikoResponse::parseBool($xml->isProcessedExternally));
        $result->setIsPrepay(IikoResponse::parseBool($xml->isFiscalizedExternally));

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
