<?php


include_once "\x55\164\x69\154\151\x74\x69\x65\x73\56\160\150\x70";
class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $mD = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $q8 = SAMLSPUtilities::xpQuery($mD, "\56\57\x73\x61\155\154\137\155\x65\x74\x61\x64\x61\164\x61\x3a\x45\x6e\x74\x69\x74\171\x44\x65\163\x63\x72\151\160\x74\x6f\162");
        foreach ($q8 as $ET) {
            $GT = SAMLSPUtilities::xpQuery($ET, "\x2e\x2f\163\141\155\154\137\x6d\145\x74\141\x64\x61\x74\x61\72\x49\x44\x50\x53\123\117\x44\x65\x73\x63\x72\151\x70\164\157\162");
            if (!(isset($GT) && !empty($GT))) {
                goto hI;
            }
            array_push($this->identityProviders, new IdentityProviders($ET));
            hI:
            cl:
        }
        gX:
    }
    public function getIdentityProviders()
    {
        return $this->identityProviders;
    }
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }
}
class IdentityProviders
{
    private $idpName;
    private $entityID;
    private $loginDetails;
    private $logoutDetails;
    private $signingCertificate;
    private $encryptionCertificate;
    private $signedRequest;
    public function __construct(DOMElement $mD = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$mD->hasAttribute("\145\156\x74\x69\164\x79\111\x44")) {
            goto gA;
        }
        $this->entityID = $mD->getAttribute("\x65\x6e\x74\151\164\171\x49\104");
        gA:
        if (!$mD->hasAttribute("\127\141\156\x74\101\165\164\150\x6e\122\145\x71\165\x65\163\x74\163\x53\x69\x67\x6e\145\144")) {
            goto Pp;
        }
        $this->signedRequest = $mD->getAttribute("\127\141\x6e\164\x41\165\164\x68\x6e\x52\145\x71\165\x65\x73\164\x73\x53\151\x67\156\145\144");
        Pp:
        $GT = SAMLSPUtilities::xpQuery($mD, "\x2e\57\163\x61\155\x6c\x5f\155\145\x74\x61\144\141\x74\141\72\111\x44\x50\x53\x53\117\x44\x65\163\x63\x72\x69\x70\164\x6f\x72");
        if (count($GT) > 1) {
            goto OS;
        }
        if (empty($GT)) {
            goto NL;
        }
        goto IL;
        OS:
        throw new Exception("\x4d\x6f\x72\x65\x20\x74\150\141\x6e\40\x6f\x6e\145\x20\74\x49\104\x50\123\123\x4f\x44\x65\x73\143\162\x69\160\164\157\x72\x3e\x20\x69\x6e\x20\74\x45\156\x74\151\x74\x79\104\x65\163\143\162\151\160\164\157\162\x3e\x2e");
        goto IL;
        NL:
        throw new Exception("\x4d\151\x73\x73\x69\x6e\x67\x20\162\145\161\165\151\x72\145\x64\40\x3c\111\x44\x50\x53\x53\117\104\x65\x73\143\162\x69\x70\164\157\x72\x3e\x20\x69\156\40\x3c\x45\156\x74\151\164\171\104\145\163\x63\x72\151\160\164\157\162\x3e\x2e");
        IL:
        $te = $GT[0];
        $nU = SAMLSPUtilities::xpQuery($mD, "\x2e\x2f\163\x61\x6d\x6c\x5f\155\x65\x74\141\144\141\164\x61\x3a\x45\x78\x74\145\x6e\163\151\157\x6e\163");
        if (!$nU) {
            goto N2;
        }
        $this->parseInfo($te);
        N2:
        $this->parseSSOService($te);
        $this->parseSLOService($te);
        $this->parsex509Certificate($te);
    }
    private function parseInfo($mD)
    {
        $xS = SAMLSPUtilities::xpQuery($mD, "\x2e\x2f\155\x64\x75\x69\72\x55\111\x49\156\146\157\57\x6d\x64\165\x69\72\x44\151\163\x70\154\x61\171\116\x61\155\145");
        foreach ($xS as $yK) {
            if (!($yK->hasAttribute("\170\x6d\154\x3a\154\x61\156\147") && $yK->getAttribute("\170\x6d\154\72\x6c\x61\156\147") == "\145\156")) {
                goto Cg;
            }
            $this->idpName = $yK->textContent;
            Cg:
            J0:
        }
        La:
    }
    private function parseSSOService($mD)
    {
        $ma = SAMLSPUtilities::xpQuery($mD, "\x2e\x2f\163\x61\x6d\x6c\137\155\x65\x74\x61\144\x61\164\x61\x3a\x53\151\x6e\x67\x6c\145\x53\151\147\x6e\117\156\123\145\x72\x76\x69\x63\145");
        foreach ($ma as $Sy) {
            $l8 = str_replace("\165\162\156\x3a\x6f\141\x73\x69\x73\x3a\156\141\x6d\x65\163\x3a\164\143\x3a\x53\x41\115\x4c\x3a\62\56\x30\72\x62\151\156\x64\151\156\x67\163\72", '', $Sy->getAttribute("\102\151\156\x64\x69\x6e\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($l8 => $Sy->getAttribute("\114\x6f\143\x61\164\151\x6f\x6e")));
            ng:
        }
        lL:
    }
    private function parseSLOService($mD)
    {
        $ix = SAMLSPUtilities::xpQuery($mD, "\x2e\57\x73\141\x6d\x6c\137\155\145\x74\141\x64\x61\x74\x61\72\123\x69\x6e\x67\x6c\x65\x4c\x6f\147\157\165\x74\123\x65\162\x76\151\x63\x65");
        foreach ($ix as $zH) {
            $l8 = str_replace("\165\162\156\72\x6f\141\163\151\163\72\156\x61\155\x65\x73\72\x74\143\x3a\123\101\115\x4c\x3a\x32\56\60\x3a\x62\151\x6e\x64\151\x6e\147\163\72", '', $zH->getAttribute("\x42\x69\156\x64\x69\x6e\x67"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($l8 => $zH->getAttribute("\114\157\143\x61\x74\151\x6f\156")));
            tW:
        }
        Mj:
    }
    private function parsex509Certificate($mD)
    {
        foreach (SAMLSPUtilities::xpQuery($mD, "\56\x2f\x73\141\155\154\137\155\145\164\141\144\141\x74\x61\72\113\x65\171\x44\145\x73\143\x72\151\x70\x74\157\162") as $so) {
            if ($so->hasAttribute("\x75\x73\x65")) {
                goto Lf;
            }
            $this->parseSigningCertificate($so);
            goto bT;
            Lf:
            if ($so->getAttribute("\x75\x73\x65") == "\145\156\x63\x72\171\x70\x74\151\157\x6e") {
                goto p9;
            }
            $this->parseSigningCertificate($so);
            goto EG;
            p9:
            $this->parseEncryptionCertificate($so);
            EG:
            bT:
            N4:
        }
        Oz:
    }
    private function parseSigningCertificate($mD)
    {
        $Wn = SAMLSPUtilities::xpQuery($mD, "\56\x2f\x64\163\72\x4b\x65\171\x49\x6e\x66\157\57\x64\163\x3a\x58\x35\60\71\x44\x61\x74\141\57\144\x73\x3a\130\x35\x30\x39\103\x65\x72\164\x69\x66\151\143\x61\x74\145");
        $cr = trim($Wn[0]->textContent);
        $cr = str_replace(array("\xd", "\xa", "\x9", "\40"), '', $cr);
        if (empty($Wn)) {
            goto F5;
        }
        array_push($this->signingCertificate, SAMLSPUtilities::sanitize_certificate($cr));
        F5:
    }
    private function parseEncryptionCertificate($mD)
    {
        $Wn = SAMLSPUtilities::xpQuery($mD, "\56\57\x64\x73\x3a\113\x65\171\111\x6e\x66\157\x2f\144\x73\x3a\130\65\60\x39\104\141\x74\x61\57\x64\x73\x3a\130\x35\x30\x39\103\145\x72\x74\x69\146\x69\x63\141\164\145");
        $cr = trim($Wn[0]->textContent);
        $cr = str_replace(array("\xd", "\xa", "\x9", "\40"), '', $cr);
        if (empty($Wn)) {
            goto Gr;
        }
        array_push($this->encryptionCertificate, $cr);
        Gr:
    }
    public function getIdpName()
    {
        return $this->idpName;
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($l8)
    {
        return $this->loginDetails[$l8];
    }
    public function getLogoutURL($l8)
    {
        return $this->logoutDetails[$l8];
    }
    public function getLoginDetails()
    {
        return $this->loginDetails;
    }
    public function getLogoutDetails()
    {
        return $this->logoutDetails;
    }
    public function getSigningCertificate()
    {
        return $this->signingCertificate;
    }
    public function getEncryptionCertificate()
    {
        return $this->encryptionCertificate[0];
    }
    public function isRequestSigned()
    {
        return $this->signedRequest;
    }
}
class ServiceProviders
{
}
