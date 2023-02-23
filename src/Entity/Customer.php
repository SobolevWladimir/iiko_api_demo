<?php

declare(strict_types=1);

namespace App\Entity;

class Customer
{
    // Не распарсенные переменные
    // private string $lastModifyNode;
    // private string $personalDataConsent;
    // private \DateTime $processingDateFrom;
    // private \DateTime $processingDateTo;
    // private string $surname;
    // private string $nick;
    // private DeliveryAddresses $addresses;
    // private CustomerPhones $phones;
    // private string $emails;
    // private string $counteragentInfo;
    // private string $iikoBizInfo;
    // private string $blackListInfo;
    // private string $marketingSource;
    // private string $linkedCounteragent;
    // private string $dateLatestSurvey;
    // private string $gender;
    // private string $birthdate;
    // lastOrderDate
    // revisionPart
    // timestamp
    // timestampId
    private string $id;
    private int $revision;
    private bool $deleted;
    private string $personalDataStatus;
    private \DateTime $consentDateFrom;
    private \DateTime $consentDateTo;
    private string $name;
    private string $comment;
    private string $cardNumber;
    private string $discountCardType;
    private string $initialBalance;
    private \DateTime $dateCreated;
    private bool $receivesOrderStatusNotifications;
    private bool $receivesLoyaltySystemNotifications;
    private bool $receivesPromotionalNotifications;

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

    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function getPersonalDataStatus(): string
    {
        return $this->personalDataStatus;
    }

    public function setPersonalDataStatus(string $personalDataStatus): void
    {
        $this->personalDataStatus = $personalDataStatus;
    }

    public function getConsentDateFrom(): \DateTime
    {
        return $this->consentDateFrom;
    }

    public function setConsentDateFrom(\DateTime $consentDateFrom): void
    {
        $this->consentDateFrom = $consentDateFrom;
    }

    public function getConsentDateTo(): \DateTime
    {
        return $this->consentDateTo;
    }

    public function setConsentDateTo(\DateTime $consentDateTo): void
    {
        $this->consentDateTo = $consentDateTo;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    public function getDiscountCardType(): string
    {
        return $this->discountCardType;
    }

    public function setDiscountCardType(string $discountCardType): void
    {
        $this->discountCardType = $discountCardType;
    }

    public function getInitialBalance(): string
    {
        return $this->initialBalance;
    }

    public function setInitialBalance(string $initialBalance): void
    {
        $this->initialBalance = $initialBalance;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getReceivesOrderStatusNotifications(): bool
    {
        return $this->receivesOrderStatusNotifications;
    }

    public function setReceivesOrderStatusNotifications(bool $receivesOrderStatusNotifications): void
    {
        $this->receivesOrderStatusNotifications = $receivesOrderStatusNotifications;
    }

    public function getReceivesLoyaltySystemNotifications(): bool
    {
        return $this->receivesLoyaltySystemNotifications;
    }

    public function setReceivesLoyaltySystemNotifications(bool $receivesLoyaltySystemNotifications): void
    {
        $this->receivesLoyaltySystemNotifications = $receivesLoyaltySystemNotifications;
    }

    public function getReceivesPromotionalNotifications(): bool
    {
        return $this->receivesPromotionalNotifications;
    }

    public function setReceivesPromotionalNotifications(bool $receivesPromotionalNotifications): void
    {
        $this->receivesPromotionalNotifications = $receivesPromotionalNotifications;
    }
}
