<?php

namespace App\Entity;

class LicenseInfo implements \JsonSerializable
{
    private string $licenseHash;

    private string $licenseData;

    private string $stateHash;

    private string $stateData;

    private string $validTill;


    public static function fromXml(\SimpleXMLElement $parse): LicenseInfo
    {
        $result = new LicenseInfo();
        $result->setLicenseHash($parse->licenseHash);
        $result->setLicenseData($parse->licenseData);
        $result->setStateHash($parse->stateHash);
        $result->setStateData($parse->stateData);
        $result->setValidTill($parse->validTill);
        return $result;
    }

    public function jsonSerialize()
    {
        return [
            'licenseHash' => $this->getLicenseHash(),
            'licenseData' => $this->getLicenseData(),
            'stateHash' => $this->getStateHash(),
            'stateData' => $this->getStateData(),
            'validTill' => $this->getValidTill(),
        ];
    }

    public function getLicenseHash(): string
    {
        return $this->licenseHash;
    }

    public function setLicenseHash(string $licenseHash): void
    {
        $this->licenseHash = $licenseHash;
    }

    public function getLicenseData(): string
    {
        return $this->licenseData;
    }

    public function setLicenseData(string $licenseData): void
    {
        $this->licenseData = $licenseData;
    }

    public function getStateHash(): string
    {
        return $this->stateHash;
    }

    public function setStateHash(string $stateHash): void
    {
        $this->stateHash = $stateHash;
    }

    public function getStateData(): string
    {
        return $this->stateData;
    }

    public function setStateData(string $stateData): void
    {
        $this->stateData = $stateData;
    }

    public function getValidTill(): string
    {
        return $this->validTill;
    }

    public function setValidTill(string $validTill): void
    {
        $this->validTill = $validTill;
    }
}
