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
  //additionalData 
  //chequeAdditionalInfo
  //organizationDetailsInfo
  private float $sum; 
  private bool $isPrepay;
  private bool $isPreliminary;
  private bool $isExternal; 
  private bool $isProcessedExternally; 
  private bool $isFiscalizedExternally;
}
