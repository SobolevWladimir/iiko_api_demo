<?php

namespace App\Entity;

class IikoResponse implements \JsonSerializable
{
    private \SimpleXMLElement $returnValue;

    private string $success;

    private string $errorString;

    private string $resultStatus;

   //TODO: пока не стал парсить
   // private  string $stackTrace;
   // private  string $entitiesUpdate;

    private LicenseInfo $licenseInfo;

    public static function fromXml(string $xml): IikoResponse
    {
        $result = new IikoResponse();
        $parse = new \SimpleXMLElement($xml);
        $result->setReturnValue($parse->returnValue);
        $result->setSuccess($parse->success);
        $result->setErrorString($parse->errorString);
        $result->setResultStatus($parse->resultStatus);
        $result->setLicenseInfo(LicenseInfo::fromXml($parse->licenseInfo));
        return $result;
    }

    public function jsonSerialize()
    {
        return [
            'returnValue' => $this->getReturnValue(),
            'success' => $this->getSuccess(),
            'errorString' => $this->getErrorString(),
            'resultStatus' => $this->getResultStatus(),
            'licenseInfo' => $this->getLicenseInfo(),
        ];
    }

    public function getReturnValue(): \SimpleXMLElement
    {
        return $this->returnValue;
    }

    public function setReturnValue(\SimpleXMLElement $returnValue): void
    {
        $this->returnValue = $returnValue;
    }

    public function getSuccess(): string
    {
        return $this->success;
    }

    public function setSuccess(string $success): void
    {
        $this->success = $success;
    }

    public function getErrorString(): string
    {
        return $this->errorString;
    }

    public function setErrorString(string $errorString): void
    {
        $this->errorString = $errorString;
    }

    public function getResultStatus(): string
    {
        return $this->resultStatus;
    }

    public function setResultStatus(string $resultStatus): void
    {
        $this->resultStatus = $resultStatus;
    }

    public function getLicenseInfo(): LicenseInfo
    {
        return $this->licenseInfo;
    }

    public function setLicenseInfo(LicenseInfo $licenseInfo): void
    {
        $this->licenseInfo = $licenseInfo;
    }
}