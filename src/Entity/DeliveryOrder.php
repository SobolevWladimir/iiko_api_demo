<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryOrder
{
    // Не распарсенные переменные
    // private string $movedDeliveryId;
    // private string isDeliveryDateSelectedManuallyForExternalOrder  ;
    // private DeliveryProblem $problem;
    // private Courier $courier;
    // private string $ecsData;
    // private string $conception;
    // private string $marketingSource;
    // private string $printTime;
    // private string $sourceKey;
    // private string $latitude;
    // private string $longitude;
    // private string $zone;
    // private string $indexInCourierRoute;
    // private string $opinionComment;
    // private string $avgMark;
    // private string $avgCourierMark;
    // private string $avgOperatorMark;
    // private string $avgFoodMark;
    // private ?DeliveryCombos $combos;
    // private string $opinionMarks;
    // private string $discounts;
    // private string $appliedManualConditions;
    // private string $lastDefaultTerminalDeliveryDurationInMinutes;
    // private string $iikoCard5Coupon;
    // private string $referrerId;
    // private string $customApiData;
    // private DeliveryGuests $guests;

    private string $id;
    private string $revision;
    private ?Customer $customer;
    private string $customerId;
    private string $terminalId;
    private DeliveryTerminal $deliveryTerminal;
    private string $sourceId;
    private string $orderId;
    private string $deliveryStatus;
    private string $phoneNumber;
    private string $customerName;
    private string $emailAddress;
    private string $comment;
    private float $orderSum;
    private DeliveryAddress $address;
    private \DateTime $deliveryDate;
    private string $deliveryCancelCause;
    private string $deliveryCancelComment;
    private string $deliveryNumber;
    private string $lastModifyDeliveryNode;
    private string $orderType;
    private bool $isSelfService;
    private bool $isCourierSelectedManually;
    private string $deliveryOperator;
    private ?\DateTime $createdTime;
    private ?\DateTime $confirmTime;
    private ?\DateTime $cookingFinishTime;
    private ?\DateTime $billTime;
    private ?\DateTime $sendTime;
    private ?\DateTime $actualTime;
    private ?\DateTime $closeTime;
    private ?\DateTime $cancelTime;
    private ?\DateTime $forceCloseTime;
    private \DateTime $lastModifyDate;
    private ?\DateTime $predictedCookingCompleteTime;
    private ?\DateTime $predictedDeliveryTime;
    private int $deliveryDurationInMinutes;
    private int $personsCount;
    private bool $splitBetweenPersons;
    private bool $isCustomerAuthorizedInIikoBiz;
    private bool $forceClosed;
    private DeliveryProductItems $items; // array
    private PaymentItems $paymentItems; // array
    private string $lastVerifiedDeliveryRestrictionsHash;

    public function getEid(): string
    {
        return $this->id;
    }

    public function setEid(string $id): void
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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getTerminalId(): string
    {
        return $this->terminalId;
    }

    public function setTerminalId(string $terminalId): void
    {
        $this->terminalId = $terminalId;
    }

    public function getDeliveryTerminal(): DeliveryTerminal
    {
        return $this->deliveryTerminal;
    }

    public function setDeliveryTerminal(DeliveryTerminal $deliveryTerminal): void
    {
        $this->deliveryTerminal = $deliveryTerminal;
    }

    public function getSourceId(): string
    {
        return $this->sourceId;
    }

    public function setSourceId(string $sourceId): void
    {
        $this->sourceId = $sourceId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getDeliveryStatus(): string
    {
        return $this->deliveryStatus;
    }

    public function setDeliveryStatus(string $deliveryStatus): void
    {
        $this->deliveryStatus = $deliveryStatus;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getOrderSum(): float
    {
        return $this->orderSum;
    }

    public function setOrderSum(float $orderSum): void
    {
        $this->orderSum = $orderSum;
    }

    public function getAddress(): DeliveryAddress
    {
        return $this->address;
    }

    public function setAddress(DeliveryAddress $address): void
    {
        $this->address = $address;
    }

    public function getDeliveryDate(): \DateTime
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTime $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getDeliveryCancelCause(): string
    {
        return $this->deliveryCancelCause;
    }

    public function setDeliveryCancelCause(string $deliveryCancelCause): void
    {
        $this->deliveryCancelCause = $deliveryCancelCause;
    }

    public function getDeliveryCancelComment(): string
    {
        return $this->deliveryCancelComment;
    }

    public function setDeliveryCancelComment(string $deliveryCancelComment): void
    {
        $this->deliveryCancelComment = $deliveryCancelComment;
    }

    public function getDeliveryNumber(): string
    {
        return $this->deliveryNumber;
    }

    public function setDeliveryNumber(string $deliveryNumber): void
    {
        $this->deliveryNumber = $deliveryNumber;
    }

    public function getLastModifyDeliveryNode(): string
    {
        return $this->lastModifyDeliveryNode;
    }

    public function setLastModifyDeliveryNode(string $lastModifyDeliveryNode): void
    {
        $this->lastModifyDeliveryNode = $lastModifyDeliveryNode;
    }

    public function getOrderType(): string
    {
        return $this->orderType;
    }

    public function setOrderType(string $orderType): void
    {
        $this->orderType = $orderType;
    }

    public function getIsSelfService(): bool
    {
        return $this->isSelfService;
    }

    public function setIsSelfService(bool $isSelfService): void
    {
        $this->isSelfService = $isSelfService;
    }

    public function getIsCourierSelectedManually(): bool
    {
        return $this->isCourierSelectedManually;
    }

    public function setIsCourierSelectedManually(bool $isCourierSelectedManually): void
    {
        $this->isCourierSelectedManually = $isCourierSelectedManually;
    }

    public function getDeliveryOperator(): string
    {
        return $this->deliveryOperator;
    }

    public function setDeliveryOperator(string $deliveryOperator): void
    {
        $this->deliveryOperator = $deliveryOperator;
    }

    public function getCreatedTime(): ?\DateTime
    {
        return $this->createdTime;
    }

    public function setCreatedTime(?\DateTime $createdTime): void
    {
        $this->createdTime = $createdTime;
    }

    public function getConfirmTime(): ?\DateTime
    {
        return $this->confirmTime;
    }

    public function setConfirmTime(?\DateTime $confirmTime): void
    {
        $this->confirmTime = $confirmTime;
    }

    public function getCookingFinishTime(): ?\DateTime
    {
        return $this->cookingFinishTime;
    }

    public function setCookingFinishTime(?\DateTime $cookingFinishTime): void
    {
        $this->cookingFinishTime = $cookingFinishTime;
    }

    public function getBillTime(): ?\DateTime
    {
        return $this->billTime;
    }

    public function setBillTime(?\DateTime $billTime): void
    {
        $this->billTime = $billTime;
    }

    public function getSendTime(): ?\DateTime
    {
        return $this->sendTime;
    }

    public function setSendTime(?\DateTime $sendTime): void
    {
        $this->sendTime = $sendTime;
    }

    public function getActualTime(): ?\DateTime
    {
        return $this->actualTime;
    }

    public function setActualTime(?\DateTime $actualTime): void
    {
        $this->actualTime = $actualTime;
    }

    public function getCloseTime(): ?\DateTime
    {
        return $this->closeTime;
    }

    public function setCloseTime(?\DateTime $closeTime): void
    {
        $this->closeTime = $closeTime;
    }

    public function getCancelTime(): ?\DateTime
    {
        return $this->cancelTime;
    }

    public function setCancelTime(?\DateTime $cancelTime): void
    {
        $this->cancelTime = $cancelTime;
    }

    public function getForceCloseTime(): ?\DateTime
    {
        return $this->forceCloseTime;
    }

    public function setForceCloseTime(?\DateTime $forceCloseTime): void
    {
        $this->forceCloseTime = $forceCloseTime;
    }

    public function getLastModifyDate(): \DateTime
    {
        return $this->lastModifyDate;
    }

    public function setLastModifyDate(\DateTime $lastModifyDate): void
    {
        $this->lastModifyDate = $lastModifyDate;
    }

    public function getPredictedCookingCompleteTime(): ?\DateTime
    {
        return $this->predictedCookingCompleteTime;
    }

    public function setPredictedCookingCompleteTime(?\DateTime $predictedCookingCompleteTime): void
    {
        $this->predictedCookingCompleteTime = $predictedCookingCompleteTime;
    }

    public function getPredictedDeliveryTime(): ?\DateTime
    {
        return $this->predictedDeliveryTime;
    }

    public function setPredictedDeliveryTime(?\DateTime $predictedDeliveryTime): void
    {
        $this->predictedDeliveryTime = $predictedDeliveryTime;
    }

    public function getDeliveryDurationInMinutes(): int
    {
        return $this->deliveryDurationInMinutes;
    }

    public function setDeliveryDurationInMinutes(int $deliveryDurationInMinutes): void
    {
        $this->deliveryDurationInMinutes = $deliveryDurationInMinutes;
    }

    public function getPersonsCount(): int
    {
        return $this->personsCount;
    }

    public function setPersonsCount(int $personsCount): void
    {
        $this->personsCount = $personsCount;
    }

    public function getSplitBetweenPersons(): bool
    {
        return $this->splitBetweenPersons;
    }

    public function setSplitBetweenPersons(bool $splitBetweenPersons): void
    {
        $this->splitBetweenPersons = $splitBetweenPersons;
    }

    public function getIsCustomerAuthorizedInIikoBiz(): bool
    {
        return $this->isCustomerAuthorizedInIikoBiz;
    }

    public function setIsCustomerAuthorizedInIikoBiz(bool $isCustomerAuthorizedInIikoBiz): void
    {
        $this->isCustomerAuthorizedInIikoBiz = $isCustomerAuthorizedInIikoBiz;
    }

    public function getForceClosed(): bool
    {
        return $this->forceClosed;
    }

    public function setForceClosed(bool $forceClosed): void
    {
        $this->forceClosed = $forceClosed;
    }

    public function getItems(): DeliveryProductItems
    {
        return $this->items;
    }

    public function setItems(DeliveryProductItems $items): void
    {
        $this->items = $items;
    }

    public function getPaymentItems(): PaymentItems
    {
        return $this->paymentItems;
    }

    public function setPaymentItems(PaymentItems $paymentItems): void
    {
        $this->paymentItems = $paymentItems;
    }

    public function getLastVerifiedDeliveryRestrictionsHash(): string
    {
        return $this->lastVerifiedDeliveryRestrictionsHash;
    }

    public function setLastVerifiedDeliveryRestrictionsHash(string $lastVerifiedDeliveryRestrictionsHash): void
    {
        $this->lastVerifiedDeliveryRestrictionsHash = $lastVerifiedDeliveryRestrictionsHash;
    }

    public static function fromXML(\SimpleXMLElement $xml): DeliveryOrder
    {
        $result = new DeliveryOrder();

        $attributes = $xml->attributes();
        $eid = '';
        if ($attributes !== null && $attributes->eid !== null) {
            $eid = (string) $attributes->eid;
        }
        $result->setEid($eid);
        $result->setRevision((string)$xml->revision);
        $customerAttributes = $xml->customer->attributes();
        $result->setCustomerId((string) $customerAttributes->eid);
        $result->setTerminalId((string)$xml->terminalId);
        $result->setDeliveryTerminal(DeliveryTerminal::fromXML($xml->deliveryTerminal));
        $result->setSourceId((string)$xml->sourceId);
        $result->setOrderId((string)$xml->orderId);
        $result->setDeliveryStatus((string)$xml->deliveryStatus);
        $result->setPhoneNumber((string)$xml->phoneNumber);
        $result->setCustomerName((string)$xml->customerName);
        $result->setEmailAddress((string)$xml->emailAddress);
        $result->setComment((string)$xml->comment);
        $result->setOrderSum((float)$xml->orderSum);
        $result->setDeliveryDate(new \DateTime((string) $xml->deliveryDate));
        $result->setDeliveryCancelCause((string) $xml->deliveryCancelCause);
        $result->setDeliveryCancelComment((string) $xml->deliveryCancelComment);
        $result->setDeliveryNumber((string) $xml->deliveryNumber);
        $result->setLastModifyDeliveryNode((string) $xml->lastModifyDeliveryNode);
        $result->setOrderType((string) $xml->orderType);
        $result->setIsSelfService(IikoResponse::parseBool($xml->isSelfService));
        $result->setIsCourierSelectedManually(IikoResponse::parseBool($xml->isCourierSelectedManually));
        $result->setDeliveryOperator((string)$xml->deliveryOperator);
        $result->setCreatedTime(IikoResponse::parseTime($xml->createdTime));
        $result->setConfirmTime(IikoResponse::parseTime($xml->confirmTime));
        $result->setCookingFinishTime(IikoResponse::parseTime($xml->cookingFinishTime));
        $result->setBillTime(IikoResponse::parseTime($xml->billTime));
        $result->setSendTime(IikoResponse::parseTime($xml->sendTime));
        $result->setActualTime(IikoResponse::parseTime($xml->actualTime));
        $result->setCloseTime(IikoResponse::parseTime($xml->closeTime));
        $result->setCancelTime(IikoResponse::parseTime($xml->cancelTime));
        $result->setForceCloseTime(IikoResponse::parseTime($xml->forceCloseTime));
        $lastModifyDate = IikoResponse::parseTime($xml->lastModifyDate);
        $result->setLastModifyDate($lastModifyDate);
        $result->setPredictedCookingCompleteTime(IikoResponse::parseTime($xml->predictedCookingCompleteTime));
        $result->setPredictedDeliveryTime(IikoResponse::parseTime($xml->predictedDeliveryTime));
        $result->setDeliveryDurationInMinutes((int) $xml->deliveryDurationInMinutes);
        $result->setPersonsCount((int) $xml->personsCount);
        $result->setSplitBetweenPersons(IikoResponse::parseBool($xml->splitBetweenPersons));
        $result->setIsCustomerAuthorizedInIikoBiz(IikoResponse::parseBool($xml->isCustomerAuthorizedInIikoBiz));
        $result->setForceClosed(IikoResponse::parseBool($xml->forceClosed));
        $result->setAddress(DeliveryAddress::fromXML($xml->address));
        $result->setItems(DeliveryProductItems::fromXML($xml->items));
        $result->setPaymentItems(PaymentItems::fromXML($xml->paymentItems));
        $result->setLastVerifiedDeliveryRestrictionsHash((string)$xml->lastVerifiedDeliveryRestrictionsHash);

        return $result;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }
}
