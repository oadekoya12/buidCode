<?php


include_once "\125\164\151\154\x69\x74\151\x65\x73\x2e\x70\150\160";
class SAML2SPLogoutRequest
{
    private $tagName;
    private $id;
    private $issuer;
    private $destination;
    private $issueInstant;
    private $certificates;
    private $validators;
    private $notOnOrAfter;
    private $encryptedNameId;
    private $nameId;
    private $sessionIndexes;
    public function __construct(DOMElement $mD = NULL)
    {
        $this->tagName = "\x4c\x6f\147\x6f\165\x74\x52\145\161\x75\145\163\164";
        $this->id = SAMLSPUtilities::generateID();
        $this->issueInstant = time();
        $this->certificates = array();
        $this->validators = array();
        if (!($mD === NULL)) {
            goto Q9;
        }
        return;
        Q9:
        if ($mD->hasAttribute("\111\104")) {
            goto Lb;
        }
        throw new Exception("\x4d\x69\x73\x73\151\x6e\x67\x20\111\x44\x20\141\164\x74\162\x69\x62\165\x74\145\x20\x6f\156\x20\123\101\x4d\114\40\155\x65\x73\163\141\x67\x65\x2e");
        Lb:
        $this->id = $mD->getAttribute("\111\x44");
        if (!($mD->getAttribute("\126\x65\162\x73\151\157\156") !== "\62\56\60")) {
            goto cD;
        }
        throw new Exception("\125\x6e\163\165\x70\160\x6f\x72\164\x65\144\40\166\145\x72\x73\151\157\156\72\x20" . $mD->getAttribute("\126\145\162\x73\x69\x6f\x6e"));
        cD:
        $this->issueInstant = SAMLSPUtilities::xsDateTimeToTimestamp($mD->getAttribute("\111\163\163\165\x65\111\156\x73\x74\141\156\x74"));
        if (!$mD->hasAttribute("\x44\145\x73\164\x69\x6e\141\164\x69\x6f\156")) {
            goto Pq;
        }
        $this->destination = $mD->getAttribute("\x44\x65\x73\x74\x69\156\x61\x74\x69\157\156");
        Pq:
        $TX = SAMLSPUtilities::xpQuery($mD, "\x2e\57\x73\x61\155\154\x5f\141\x73\163\145\x72\164\x69\x6f\x6e\x3a\x49\163\x73\165\x65\x72");
        if (empty($TX)) {
            goto IN;
        }
        $this->issuer = trim($TX[0]->textContent);
        IN:
        try {
            $NO = SAMLSPUtilities::validateElement($mD);
            if (!($NO !== FALSE)) {
                goto Ru;
            }
            $this->certificates = $NO["\x43\145\x72\164\x69\146\151\x63\x61\164\x65\x73"];
            $this->validators[] = array("\106\165\156\x63\x74\151\157\x6e" => array("\x55\x74\x69\x6c\151\x74\x69\145\163", "\x76\141\154\x69\144\x61\x74\145\x53\x69\x67\156\141\x74\x75\162\145"), "\104\x61\164\141" => $NO);
            Ru:
        } catch (Exception $sK) {
        }
        $this->sessionIndexes = array();
        if (!$mD->hasAttribute("\116\157\x74\117\156\117\x72\x41\146\x74\x65\x72")) {
            goto vi;
        }
        $this->notOnOrAfter = SAMLSPUtilities::xsDateTimeToTimestamp($mD->getAttribute("\x4e\x6f\164\x4f\156\117\162\x41\x66\164\x65\x72"));
        vi:
        $am = SAMLSPUtilities::xpQuery($mD, "\x2e\x2f\x73\x61\x6d\154\137\141\163\163\x65\x72\x74\x69\157\x6e\x3a\116\141\x6d\145\111\x44\x20\x7c\40\56\x2f\x73\141\x6d\x6c\x5f\x61\x73\x73\x65\x72\x74\151\x6f\x6e\72\105\156\x63\x72\171\160\164\x65\x64\111\x44\57\x78\145\x6e\143\72\x45\156\x63\162\171\160\164\x65\x64\x44\x61\164\141");
        if (empty($am)) {
            goto gw;
        }
        if (count($am) > 1) {
            goto ho;
        }
        goto w7;
        gw:
        throw new Exception("\x4d\151\163\x73\x69\x6e\x67\40\74\163\x61\x6d\x6c\x3a\x4e\141\x6d\145\x49\x44\76\x20\157\162\40\74\163\141\155\154\72\105\x6e\x63\162\171\x70\x74\145\144\x49\x44\x3e\x20\x69\x6e\x20\74\163\x61\x6d\x6c\160\x3a\x4c\157\x67\x6f\165\x74\x52\145\x71\x75\x65\x73\x74\76\56");
        goto w7;
        ho:
        throw new Exception("\x4d\157\162\145\40\164\150\141\x6e\40\157\156\145\x20\x3c\x73\x61\155\x6c\x3a\116\141\x6d\x65\111\104\76\40\157\x72\x20\74\x73\x61\x6d\154\72\105\156\x63\162\171\x70\164\145\144\104\x3e\x20\x69\156\40\74\x73\x61\155\x6c\160\x3a\114\157\x67\x6f\165\164\x52\x65\x71\x75\x65\x73\164\x3e\56");
        w7:
        $am = $am[0];
        if ($am->localName === "\x45\156\143\162\171\160\164\x65\144\x44\x61\x74\x61") {
            goto MQ;
        }
        $this->nameId = SAMLSPUtilities::parseNameId($am);
        goto CT;
        MQ:
        $this->encryptedNameId = $am;
        CT:
        $Ex = SAMLSPUtilities::xpQuery($mD, "\x2e\x2f\x73\141\x6d\x6c\137\x70\x72\x6f\x74\157\x63\x6f\x6c\72\123\145\163\x73\151\157\x6e\x49\156\x64\145\170");
        foreach ($Ex as $OF) {
            $this->sessionIndexes[] = trim($OF->textContent);
            Rl:
        }
        BP:
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($OU)
    {
        $this->notOnOrAfter = $OU;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto M5;
        }
        return TRUE;
        M5:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $Yy)
    {
        $mZ = new DOMDocument();
        $W1 = $mZ->createElement("\x72\157\x6f\x74");
        $mZ->appendChild($W1);
        SAML2_Utils::addNameId($W1, $this->nameId);
        $am = $W1->firstChild;
        SAML2_Utils::getContainer()->debugMessage($am, "\x65\156\x63\162\171\x70\x74");
        $qh = new XMLSecEnc();
        $qh->setNode($am);
        $qh->type = XMLSecEnc::Element;
        $tu = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $tu->generateSessionKey();
        $qh->encryptKey($Yy, $tu);
        $this->encryptedNameId = $qh->encryptNode($tu);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $Yy, array $NH = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto j1;
        }
        return;
        j1:
        $am = SAML2_Utils::decryptElement($this->encryptedNameId, $Yy, $NH);
        SAML2_Utils::getContainer()->debugMessage($am, "\144\145\143\x72\x79\160\164");
        $this->nameId = SAML2_Utils::parseNameId($am);
        $this->encryptedNameId = NULL;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto Jv;
        }
        throw new Exception("\x41\x74\x74\145\155\x70\164\145\144\x20\164\x6f\40\162\x65\164\162\x69\145\166\x65\40\145\156\143\x72\171\x70\x74\x65\144\40\x4e\141\155\145\111\104\40\167\x69\x74\x68\157\x75\x74\40\144\145\x63\x72\171\160\164\151\156\147\x20\151\x74\40\146\x69\x72\x73\164\56");
        Jv:
        return $this->nameId;
    }
    public function setNameId($am)
    {
        $this->nameId = $am;
    }
    public function getSessionIndexes()
    {
        return $this->sessionIndexes;
    }
    public function setSessionIndexes(array $Ex)
    {
        $this->sessionIndexes = $Ex;
    }
    public function getSessionIndex()
    {
        if (!empty($this->sessionIndexes)) {
            goto gC;
        }
        return NULL;
        gC:
        return $this->sessionIndexes[0];
    }
    public function setSessionIndex($OF)
    {
        if (is_null($OF)) {
            goto rR;
        }
        $this->sessionIndexes = array($OF);
        goto Qi;
        rR:
        $this->sessionIndexes = array();
        Qi:
    }
    public function toUnsignedXML()
    {
        $W1 = parent::toUnsignedXML();
        if (!($this->notOnOrAfter !== NULL)) {
            goto wj;
        }
        $W1->setAttribute("\116\157\x74\x4f\x6e\117\162\x41\x66\164\145\162", gmdate("\131\55\155\x2d\x64\134\x54\x48\72\x69\72\x73\134\x5a", $this->notOnOrAfter));
        wj:
        if ($this->encryptedNameId === NULL) {
            goto NM;
        }
        $al = $W1->ownerDocument->createElementNS(SAML2_Const::NS_SAML, "\163\x61\x6d\x6c\72" . "\x45\x6e\143\x72\x79\160\x74\x65\x64\x49\x44");
        $W1->appendChild($al);
        $al->appendChild($W1->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto F3;
        NM:
        SAML2_Utils::addNameId($W1, $this->nameId);
        F3:
        foreach ($this->sessionIndexes as $OF) {
            SAML2_Utils::addString($W1, SAML2_Const::NS_SAMLP, "\x53\145\163\x73\151\157\156\111\x6e\x64\145\x78", $OF);
            S1:
        }
        gg:
        return $W1;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($yo)
    {
        $this->id = $yo;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($Qu)
    {
        $this->issueInstant = $Qu;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function setDestination($C_)
    {
        $this->destination = $C_;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($TX)
    {
        $this->issuer = $TX;
    }
}
