<?php

declare(strict_types=1);

namespace App\Entity;

class DeliverOrder
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
  //private DeliveryGuests $guests;
  
    private string $id;
    private string $revision;
    private Customer $customer;
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

}
