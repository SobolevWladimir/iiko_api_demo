<?php

declare(strict_types=1);

namespace App\Entity;

class DeliveryAddress
{
    private ?string $house;
    private ?string $building;
    private ?string $flat;
    private ?string $entrance;
    private ?string $floor;
    private ?string $doorphone;
    // private string $additionalInfo;
    private ?string $street;
    private ?string $region;
    // private ?string $externalCartographyId;

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(?string $house): void
    {
        $this->house = $house;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): void
    {
        $this->building = $building;
    }

    public function getFlat(): ?string
    {
        return $this->flat;
    }

    public function setFlat(?string $flat): void
    {
        $this->flat = $flat;
    }

    public function getEntrance(): ?string
    {
        return $this->entrance;
    }

    public function setEntrance(?string $entrance): void
    {
        $this->entrance = $entrance;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): void
    {
        $this->floor = $floor;
    }

    public function getDoorphone(): ?string
    {
        return $this->doorphone;
    }

    public function setDoorphone(?string $doorphone): void
    {
        $this->doorphone = $doorphone;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): void
    {
        $this->region = $region;
    }

  public static function fromXml(\SimpleXMLElement $xml): DeliveryAddress
  {
      $result = new DeliveryAddress();
      $result->setHouse($xml->house);
      $result->setBuilding($xml->building);
      $result->setFlat($xml->flat);
      $result->setEntrance($xml->entrance);
      $result->setFloor($xml->floor);
      $result->setDoorphone($xml->doorphone);
      $result->setStreet($xml->street);
      $result->setRegion($xml->region);

      return $result;
  }
}
