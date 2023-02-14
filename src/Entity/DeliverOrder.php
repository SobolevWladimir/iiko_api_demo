<?php

declare(strict_types=1);

namespace App\Entity;

class DeliverOrder
{
  private string $revision; 
  private Customer $customer; 
  private string $terminalId;
  private DeliveryTerminal $deliveryTerminal; 
  private string $sourceId; 
}
