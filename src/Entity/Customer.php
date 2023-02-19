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
    private \DateTIme $dateCreated;
    private bool $receivesOrderStatusNotifications;
    private bool $receivesLoyaltySystemNotifications;
    private bool $receivesPromotionalNotifications;
}
