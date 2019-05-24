<?php


include "\x41\x73\x73\145\162\164\x69\157\156\56\160\x68\x70";
class SAML2SPResponse
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $mD = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($mD === NULL)) {
            goto zv;
        }
        return;
        zv:
        $NO = SAMLSPUtilities::validateElement($mD);
        if (!($NO !== FALSE)) {
            goto O3;
        }
        $this->certificates = $NO["\103\x65\x72\164\x69\146\x69\x63\x61\164\145\x73"];
        $this->signatureData = $NO;
        O3:
        if (!$mD->hasAttribute("\x44\x65\163\164\x69\x6e\x61\x74\151\x6f\156")) {
            goto xI;
        }
        $this->destination = $mD->getAttribute("\x44\145\x73\164\151\x6e\141\164\x69\157\x6e");
        xI:
        $Wl = $mD->firstChild;
        Tv:
        if (!($Wl !== NULL)) {
            goto jw;
        }
        if (!($Wl->namespaceURI !== "\x75\x72\x6e\x3a\157\x61\163\151\x73\72\156\141\x6d\145\163\72\164\x63\72\123\x41\115\114\x3a\x32\56\60\x3a\141\163\163\x65\162\164\151\x6f\156")) {
            goto R2;
        }
        goto m0;
        R2:
        if (!($Wl->localName === "\x41\163\x73\x65\x72\x74\151\x6f\156" || $Wl->localName === "\x45\x6e\x63\x72\171\x70\164\x65\x64\101\163\163\145\162\164\x69\157\x6e")) {
            goto Fn;
        }
        $this->assertions[] = new SAML2SPAssertion($Wl);
        Fn:
        m0:
        $Wl = $Wl->nextSibling;
        goto Tv;
        jw:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $vY)
    {
        $this->assertions = $vY;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $W1 = parent::toUnsignedXML();
        foreach ($this->assertions as $Cu) {
            $Cu->toXML($W1);
            ow:
        }
        cY:
        return $W1;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
}
