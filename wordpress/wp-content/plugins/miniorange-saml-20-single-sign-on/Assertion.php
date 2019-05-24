<?php


include_once "\125\164\x69\x6c\x69\164\151\145\163\x2e\160\150\160";
class SAML2SPAssertion
{
    private $id;
    private $issueInstant;
    private $issuer;
    private $nameId;
    private $encryptedNameId;
    private $encryptedAttribute;
    private $encryptionKey;
    private $notBefore;
    private $notOnOrAfter;
    private $validAudiences;
    private $sessionNotOnOrAfter;
    private $sessionIndex;
    private $authnInstant;
    private $authnContextClassRef;
    private $authnContextDecl;
    private $authnContextDeclRef;
    private $AuthenticatingAuthority;
    private $attributes;
    private $nameFormat;
    private $signatureKey;
    private $certificates;
    private $signatureData;
    private $requiredEncAttributes;
    private $SubjectConfirmation;
    protected $wasSignedAtConstruction = FALSE;
    public function __construct(DOMElement $mD = NULL)
    {
        $this->id = SAMLSPUtilities::generateId();
        $this->issueInstant = SAMLSPUtilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = SAMLSPUtilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\x72\156\x3a\x6f\x61\x73\x69\x73\72\x6e\141\x6d\145\163\72\164\143\x3a\x53\x41\115\x4c\72\x31\56\61\72\x6e\x61\155\x65\151\144\55\x66\157\x72\x6d\x61\x74\x3a\165\x6e\x73\160\x65\143\x69\146\x69\145\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($mD === NULL)) {
            goto bA;
        }
        return;
        bA:
        if (!($mD->localName === "\x45\156\143\x72\x79\160\x74\x65\144\x41\x73\163\x65\x72\164\x69\157\x6e")) {
            goto DC;
        }
        $ui = SAMLSPUtilities::xpQuery($mD, "\x2e\x2f\x78\x65\x6e\x63\72\105\x6e\x63\162\x79\x70\164\145\144\x44\141\x74\141");
        $IH = SAMLSPUtilities::xpQuery($mD, "\56\x2f\x78\x65\x6e\x63\72\105\x6e\x63\x72\x79\x70\x74\x65\x64\x44\x61\164\x61\57\144\x73\72\x4b\145\x79\111\156\146\157\x2f\170\x65\x6e\143\72\105\156\x63\162\171\x70\x74\x65\144\113\145\171");
        $kb = $IH[0]->firstChild->getAttribute("\x41\x6c\x67\157\162\151\x74\x68\155");
        $Sp = SAMLSPUtilities::getEncryptionAlgorithm($kb);
        if (count($ui) === 0) {
            goto gr;
        }
        if (count($ui) > 1) {
            goto qo;
        }
        goto WO;
        gr:
        throw new Exception("\x4d\151\163\163\x69\x6e\x67\40\145\x6e\143\162\171\160\x74\x65\144\x20\144\141\164\x61\x20\151\156\x20\74\x73\141\x6d\154\72\x45\x6e\143\x72\x79\x70\164\145\144\x41\163\163\145\x72\x74\151\x6f\x6e\76\x2e");
        goto WO;
        qo:
        throw new Exception("\115\157\x72\145\40\164\150\141\156\x20\x6f\156\145\40\145\156\x63\x72\171\x70\164\x65\x64\40\x64\x61\164\141\x20\145\x6c\145\155\145\156\164\x20\x69\156\40\x3c\163\141\x6d\154\72\x45\x6e\x63\162\x79\x70\x74\x65\144\101\x73\x73\145\162\x74\151\157\x6e\x3e\56");
        WO:
        $Yy = new XMLSecurityKey($Sp, array("\164\x79\160\x65" => "\x70\162\x69\x76\x61\x74\x65"));
        $bX = plugin_dir_path(__FILE__) . "\162\x65\x73\157\x75\x72\143\145\x73" . DIRECTORY_SEPARATOR . "\163\x70\x2d\x6b\145\171\x2e\x6b\145\171";
        $Yy->loadKey($bX, TRUE);
        $AU = new XMLSecurityKey($Sp, array("\164\171\160\x65" => "\160\162\151\166\x61\164\145"));
        $XM = plugin_dir_path(__FILE__) . "\x72\x65\x73\x6f\x75\162\143\145\x73" . DIRECTORY_SEPARATOR . "\x6d\151\x6e\x69\157\x72\141\x6e\x67\145\137\x73\x70\137\x70\x72\151\166\137\x6b\145\x79\x2e\x6b\x65\171";
        $AU->loadKey($XM, TRUE);
        $NH = array();
        $mD = SAMLSPUtilities::decryptElement($ui[0], $Yy, $NH, $AU);
        DC:
        if ($mD->hasAttribute("\x49\x44")) {
            goto PK;
        }
        throw new Exception("\x4d\x69\x73\163\x69\x6e\147\x20\111\x44\40\x61\x74\164\162\x69\142\x75\164\145\x20\x6f\x6e\x20\123\x41\115\x4c\x20\x61\163\x73\145\x72\x74\x69\157\156\56");
        PK:
        $this->id = $mD->getAttribute("\x49\x44");
        if (!($mD->getAttribute("\126\145\x72\x73\151\157\x6e") !== "\x32\56\60")) {
            goto uF;
        }
        throw new Exception("\x55\x6e\163\165\160\160\x6f\162\x74\145\x64\x20\x76\145\162\163\151\x6f\156\72\x20" . $mD->getAttribute("\126\145\x72\163\x69\157\x6e"));
        uF:
        $this->issueInstant = SAMLSPUtilities::xsDateTimeToTimestamp($mD->getAttribute("\111\163\163\165\145\111\x6e\163\164\x61\156\164"));
        $TX = SAMLSPUtilities::xpQuery($mD, "\56\x2f\x73\141\155\154\137\141\163\x73\145\x72\164\151\x6f\156\72\x49\163\x73\165\145\x72");
        if (!empty($TX)) {
            goto gc;
        }
        throw new Exception("\x4d\151\x73\163\151\156\147\x20\x3c\163\141\155\154\x3a\111\163\163\x75\145\x72\76\40\151\156\40\141\x73\x73\145\162\164\x69\157\156\x2e");
        gc:
        $this->issuer = trim($TX[0]->textContent);
        $this->parseConditions($mD);
        $this->parseAuthnStatement($mD);
        $this->parseAttributes($mD);
        $this->parseEncryptedAttributes($mD);
        $this->parseSignature($mD);
        $this->parseSubject($mD);
    }
    private function parseSubject(DOMElement $mD)
    {
        $Y4 = SAMLSPUtilities::xpQuery($mD, "\x2e\57\x73\141\x6d\x6c\137\141\163\163\145\x72\164\x69\x6f\x6e\x3a\123\165\x62\152\x65\x63\164");
        if (empty($Y4)) {
            goto Rd;
        }
        if (count($Y4) > 1) {
            goto K3;
        }
        goto uI;
        Rd:
        return;
        goto uI;
        K3:
        throw new Exception("\x4d\157\162\145\40\164\x68\141\156\x20\157\x6e\x65\40\x3c\x73\x61\155\154\72\123\x75\x62\x6a\145\x63\x74\x3e\40\x69\x6e\x20\x3c\x73\x61\155\154\72\x41\163\x73\x65\162\x74\151\157\x6e\x3e\56");
        uI:
        $Y4 = $Y4[0];
        $am = SAMLSPUtilities::xpQuery($Y4, "\x2e\57\163\141\x6d\154\137\x61\x73\163\145\x72\x74\151\x6f\156\72\116\141\155\x65\x49\104\40\x7c\x20\x2e\x2f\x73\141\155\154\137\141\x73\163\x65\162\x74\x69\157\156\72\x45\x6e\x63\162\171\160\164\x65\144\x49\104\x2f\170\145\x6e\x63\x3a\x45\x6e\143\162\x79\x70\164\x65\x64\104\141\164\x61");
        if (empty($am)) {
            goto AE;
        }
        if (count($am) > 1) {
            goto ki;
        }
        goto oi;
        AE:
        if ($_POST["\x52\x65\154\141\171\123\x74\141\164\145"] == "\164\x65\163\164\126\x61\154\151\x64\141\164\x65") {
            goto e9;
        }
        wp_die("\x57\145\x20\143\157\x75\154\144\x20\156\157\164\40\x73\151\x67\156\40\x79\x6f\x75\x20\x69\x6e\56\40\120\154\x65\141\x73\145\x20\x63\x6f\x6e\164\141\x63\x74\x20\171\x6f\x75\x72\40\x61\x64\155\151\x6e\151\163\x74\162\141\x74\157\x72");
        goto at;
        e9:
        echo "\74\144\151\x76\x20\x73\164\x79\154\x65\75\42\x66\x6f\156\x74\x2d\146\x61\155\151\x6c\x79\72\x43\141\x6c\x69\x62\x72\x69\x3b\x70\141\x64\x64\151\x6e\x67\x3a\x30\40\x33\x25\73\42\76";
        echo "\74\x64\x69\166\x20\163\x74\x79\154\x65\x3d\42\143\157\154\x6f\162\x3a\40\x23\x61\x39\64\x34\x34\x32\x3b\x62\141\143\x6b\147\162\x6f\165\x6e\x64\55\x63\157\154\x6f\x72\x3a\x20\x23\x66\x32\x64\x65\144\145\x3b\x70\x61\x64\144\x69\156\x67\72\x20\61\65\x70\170\73\x6d\141\x72\x67\x69\x6e\55\142\157\x74\164\157\x6d\72\40\x32\x30\x70\x78\x3b\164\x65\x78\164\x2d\x61\x6c\x69\x67\156\72\x63\x65\x6e\x74\x65\x72\x3b\x62\x6f\162\x64\x65\x72\72\61\160\x78\x20\x73\x6f\154\151\x64\40\43\x45\66\102\63\102\x32\x3b\x66\157\x6e\164\x2d\163\x69\x7a\145\72\x31\x38\160\x74\x3b\x22\76\40\105\x52\122\117\122\x3c\x2f\144\x69\x76\x3e\12\x20\x20\40\40\40\40\x20\40\x20\x20\40\x3c\x64\x69\166\x20\x73\x74\x79\x6c\x65\x3d\42\143\x6f\154\157\162\72\40\x23\x61\x39\x34\x34\x34\62\x3b\x66\157\x6e\x74\x2d\x73\151\x7a\145\x3a\61\64\x70\x74\x3b\x20\x6d\141\162\147\151\x6e\55\x62\157\164\164\x6f\x6d\x3a\x32\x30\x70\x78\73\x22\x3e\74\x70\76\x3c\x73\164\162\157\x6e\147\76\105\162\x72\x6f\x72\x3a\40\x3c\57\163\164\162\x6f\156\x67\76\x4d\151\x73\163\151\156\147\40\40\x4e\x61\x6d\x65\111\x44\x20\157\x72\x20\105\156\143\x72\171\x70\164\145\144\x49\104\x20\151\156\40\123\101\115\x4c\40\122\x65\163\160\157\x6e\x73\145\56\74\x2f\160\x3e\12\x20\x20\40\40\40\x20\x20\x20\40\40\x20\40\40\40\x20\40\x3c\x70\76\x50\154\x65\x61\x73\145\40\143\x6f\156\164\x61\143\x74\x20\171\x6f\x75\x72\x20\141\x64\155\x69\156\151\163\164\162\141\164\157\x72\40\x61\x6e\x64\40\x72\145\x70\x6f\x72\164\x20\x74\150\145\x20\x66\157\154\154\157\x77\151\x6e\147\40\x65\162\x72\157\x72\72\74\57\160\x3e\12\x20\40\x20\40\40\x20\x20\40\40\x20\40\40\x20\x20\40\x20\74\160\76\74\163\164\x72\x6f\x6e\147\76\120\x6f\163\x73\151\x62\x6c\x65\x20\x43\141\165\x73\x65\x3a\74\57\163\164\x72\x6f\156\x67\76\40\116\141\155\145\x49\x44\40\156\157\164\x20\x66\157\x75\x6e\144\x20\151\156\x20\123\101\115\114\40\122\x65\163\160\157\156\x73\145\40\163\x75\142\x6a\x65\x63\x74\56\74\57\x70\x3e\xa\40\40\x20\x20\x20\40\40\x20\x20\40\40\x20\x20\40\x20\40\x3c\57\x64\151\x76\76\xa\40\40\40\x20\x20\40\x20\x20\x20\40\x20\x20\40\x20\40\x20\74\x64\x69\166\x20\x73\x74\x79\154\145\x3d\42\155\x61\162\x67\x69\156\72\63\45\x3b\x64\151\x73\x70\154\141\x79\x3a\142\154\157\143\x6b\x3b\164\x65\170\164\55\141\x6c\x69\x67\x6e\x3a\143\145\156\x74\145\162\73\x22\76\12\x20\x20\40\40\40\40\40\40\x20\x20\x20\x20\40\40\40\x3c\146\157\162\155\40\141\143\x74\x69\x6f\156\75\42\x69\156\144\x65\170\x2e\x70\x68\x70\x22\76\xa\x20\x20\40\x20\40\x20\40\x20\x20\40\40\x20\x20\x20\40\40\74\144\x69\166\x20\x73\164\x79\x6c\x65\x3d\42\155\x61\162\147\x69\x6e\x3a\x33\45\73\144\x69\x73\160\154\141\x79\x3a\142\154\157\143\153\73\x74\145\x78\164\x2d\141\154\x69\x67\x6e\72\143\145\x6e\164\145\x72\x3b\x22\76\x3c\x69\x6e\x70\x75\x74\40\x73\x74\x79\154\x65\75\42\160\141\144\x64\151\x6e\147\x3a\61\45\x3b\167\151\144\164\x68\72\x31\x30\60\160\x78\x3b\x62\141\x63\153\147\x72\157\165\x6e\x64\72\40\x23\60\60\71\x31\103\x44\40\156\157\156\x65\x20\x72\x65\160\x65\x61\x74\40\x73\143\162\157\x6c\x6c\x20\x30\x25\x20\60\45\73\143\165\162\x73\157\x72\x3a\x20\x70\157\x69\x6e\164\x65\162\x3b\146\x6f\x6e\164\x2d\163\x69\172\x65\x3a\61\x35\160\170\x3b\x62\x6f\x72\144\145\162\55\x77\x69\144\164\150\72\x20\x31\160\170\x3b\x62\x6f\162\x64\x65\x72\x2d\163\164\x79\x6c\x65\x3a\40\x73\157\x6c\x69\x64\x3b\x62\x6f\162\144\145\162\x2d\x72\141\144\x69\165\163\72\40\x33\x70\170\x3b\167\x68\x69\164\x65\x2d\163\160\141\x63\145\72\x20\x6e\157\x77\162\141\160\x3b\x62\x6f\x78\x2d\x73\151\172\x69\x6e\147\72\40\x62\x6f\x72\144\145\x72\55\142\157\x78\x3b\x62\157\162\144\145\x72\x2d\143\157\154\x6f\x72\x3a\40\43\60\x30\x37\63\x41\x41\73\142\x6f\x78\x2d\163\150\x61\144\x6f\167\x3a\x20\x30\160\170\40\x31\160\170\x20\60\x70\x78\40\x72\147\142\141\x28\61\x32\x30\54\40\62\x30\x30\54\x20\62\x33\60\x2c\40\x30\56\x36\x29\40\151\x6e\163\x65\x74\x3b\143\157\x6c\157\x72\72\40\43\106\x46\x46\x3b\x22\x74\x79\x70\x65\x3d\42\142\x75\x74\x74\157\x6e\x22\x20\166\141\x6c\165\x65\x3d\42\x44\x6f\156\x65\x22\x20\x6f\156\x43\154\x69\143\x6b\75\42\x73\x65\154\x66\x2e\143\154\x6f\163\145\x28\x29\x3b\42\x3e\x3c\57\144\151\x76\x3e";
        die;
        at:
        goto oi;
        ki:
        throw new Exception("\x4d\x6f\162\x65\x20\164\x68\x61\x6e\40\157\x6e\145\40\74\x73\x61\155\154\x3a\x4e\141\x6d\145\111\104\x3e\40\x6f\162\40\x3c\163\141\x6d\154\72\x45\x6e\143\162\171\x70\x74\x65\x64\x44\76\40\x69\156\x20\74\x73\x61\x6d\x6c\72\x53\165\x62\x6a\145\x63\164\x3e\56");
        oi:
        $am = $am[0];
        if ($am->localName === "\x45\x6e\143\162\171\160\x74\145\x64\x44\x61\164\x61") {
            goto He;
        }
        $this->nameId = SAMLSPUtilities::parseNameId($am);
        goto lt;
        He:
        $this->encryptedNameId = $am;
        lt:
    }
    private function parseConditions(DOMElement $mD)
    {
        $Qs = SAMLSPUtilities::xpQuery($mD, "\x2e\x2f\x73\x61\155\x6c\137\x61\163\163\145\162\164\x69\x6f\x6e\x3a\103\x6f\x6e\x64\x69\164\x69\x6f\156\163");
        if (empty($Qs)) {
            goto Tk;
        }
        if (count($Qs) > 1) {
            goto wk;
        }
        goto ic;
        Tk:
        return;
        goto ic;
        wk:
        throw new Exception("\x4d\157\162\145\x20\164\x68\x61\x6e\x20\157\x6e\145\40\74\x73\x61\x6d\x6c\x3a\x43\x6f\156\x64\x69\164\151\x6f\x6e\163\x3e\x20\x69\x6e\x20\74\163\141\x6d\154\x3a\101\163\163\145\162\164\x69\x6f\x6e\x3e\56");
        ic:
        $Qs = $Qs[0];
        if (!$Qs->hasAttribute("\116\157\x74\102\145\x66\157\x72\145")) {
            goto o6;
        }
        $GE = SAMLSPUtilities::xsDateTimeToTimestamp($Qs->getAttribute("\116\157\x74\102\145\146\x6f\x72\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $GE)) {
            goto RG;
        }
        $this->notBefore = $GE;
        RG:
        o6:
        if (!$Qs->hasAttribute("\116\x6f\164\117\x6e\x4f\x72\101\x66\164\x65\162")) {
            goto LE;
        }
        $OU = SAMLSPUtilities::xsDateTimeToTimestamp($Qs->getAttribute("\116\x6f\164\x4f\156\x4f\162\101\146\x74\145\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $OU)) {
            goto Ai;
        }
        $this->notOnOrAfter = $OU;
        Ai:
        LE:
        $Wl = $Qs->firstChild;
        Df:
        if (!($Wl !== NULL)) {
            goto re;
        }
        if (!$Wl instanceof DOMText) {
            goto Nq;
        }
        goto rl;
        Nq:
        if (!($Wl->namespaceURI !== "\165\162\156\72\x6f\x61\163\x69\163\72\156\x61\x6d\145\x73\x3a\x74\x63\72\123\x41\115\x4c\72\62\56\x30\72\141\163\x73\x65\162\x74\151\157\x6e")) {
            goto PV;
        }
        throw new Exception("\x55\156\153\x6e\157\167\156\40\x6e\141\x6d\x65\163\x70\141\143\145\40\x6f\146\40\143\157\x6e\x64\x69\x74\x69\x6f\156\72\40" . var_export($Wl->namespaceURI, TRUE));
        PV:
        switch ($Wl->localName) {
            case "\101\165\144\151\x65\156\x63\145\122\145\x73\x74\162\151\143\164\x69\x6f\x6e":
                $Nk = SAMLSPUtilities::extractStrings($Wl, "\165\162\156\72\157\x61\163\151\163\x3a\156\141\155\x65\163\72\x74\143\72\123\101\x4d\114\x3a\x32\x2e\x30\x3a\141\163\163\x65\162\164\151\x6f\156", "\101\x75\144\x69\x65\x6e\x63\145");
                if ($this->validAudiences === NULL) {
                    goto Yt;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $Nk);
                goto B2;
                Yt:
                $this->validAudiences = $Nk;
                B2:
                goto El;
            case "\117\156\145\x54\151\155\145\x55\x73\145":
                goto El;
            case "\120\x72\157\x78\x79\122\145\163\164\x72\x69\143\164\151\x6f\x6e":
                goto El;
            default:
                throw new Exception("\x55\156\153\x6e\x6f\x77\156\x20\x63\157\156\144\151\x74\151\x6f\156\72\40" . var_export($Wl->localName, TRUE));
        }
        V1:
        El:
        rl:
        $Wl = $Wl->nextSibling;
        goto Df;
        re:
    }
    private function parseAuthnStatement(DOMElement $mD)
    {
        $i1 = SAMLSPUtilities::xpQuery($mD, "\x2e\57\x73\141\x6d\154\x5f\x61\163\163\x65\x72\164\x69\x6f\156\x3a\101\165\x74\150\156\x53\164\x61\164\145\x6d\145\156\x74");
        if (empty($i1)) {
            goto c5;
        }
        if (count($i1) > 1) {
            goto PE;
        }
        goto c0;
        c5:
        $this->authnInstant = NULL;
        return;
        goto c0;
        PE:
        throw new Exception("\115\x6f\x72\145\x20\164\150\x61\x74\40\x6f\x6e\x65\x20\x3c\163\x61\155\154\x3a\101\x75\164\x68\x6e\x53\164\141\164\x65\x6d\145\156\164\x3e\x20\x69\156\40\74\x73\x61\155\x6c\x3a\101\163\x73\145\162\x74\151\x6f\x6e\76\x20\x6e\x6f\x74\x20\x73\x75\x70\x70\x6f\162\164\x65\x64\x2e");
        c0:
        $BT = $i1[0];
        if ($BT->hasAttribute("\x41\165\164\x68\x6e\x49\x6e\x73\164\x61\x6e\164")) {
            goto lh;
        }
        throw new Exception("\x4d\151\x73\163\151\x6e\147\40\x72\x65\x71\165\x69\162\145\x64\x20\101\x75\x74\x68\x6e\111\x6e\163\164\141\x6e\x74\x20\x61\164\164\x72\x69\142\x75\x74\145\x20\157\156\40\74\163\141\155\x6c\72\101\165\164\150\x6e\123\164\x61\164\145\155\145\x6e\x74\x3e\x2e");
        lh:
        $this->authnInstant = SAMLSPUtilities::xsDateTimeToTimestamp($BT->getAttribute("\101\x75\x74\x68\x6e\x49\x6e\x73\x74\x61\x6e\164"));
        if (!$BT->hasAttribute("\x53\145\x73\163\x69\x6f\156\x4e\157\x74\x4f\x6e\117\162\101\x66\164\x65\162")) {
            goto mP;
        }
        $this->sessionNotOnOrAfter = SAMLSPUtilities::xsDateTimeToTimestamp($BT->getAttribute("\123\x65\x73\x73\x69\157\156\x4e\157\x74\x4f\x6e\x4f\162\x41\146\x74\145\x72"));
        mP:
        if (!$BT->hasAttribute("\x53\x65\163\x73\x69\x6f\x6e\111\156\x64\145\170")) {
            goto aa;
        }
        $this->sessionIndex = $BT->getAttribute("\x53\145\163\163\x69\157\156\111\x6e\x64\x65\170");
        aa:
        $this->parseAuthnContext($BT);
    }
    private function parseAuthnContext(DOMElement $V4)
    {
        $MH = SAMLSPUtilities::xpQuery($V4, "\56\x2f\163\141\x6d\x6c\x5f\141\163\163\x65\x72\x74\x69\x6f\156\72\101\165\164\x68\x6e\103\x6f\x6e\x74\x65\x78\x74");
        if (count($MH) > 1) {
            goto Ke;
        }
        if (empty($MH)) {
            goto YO;
        }
        goto q4;
        Ke:
        throw new Exception("\115\x6f\162\x65\40\x74\150\x61\156\40\x6f\156\145\x20\74\163\x61\155\154\x3a\x41\x75\164\x68\x6e\x43\157\x6e\x74\x65\170\164\76\x20\151\x6e\x20\74\x73\x61\155\154\x3a\x41\165\164\x68\x6e\x53\x74\141\164\x65\x6d\145\x6e\x74\x3e\x2e");
        goto q4;
        YO:
        throw new Exception("\x4d\151\163\x73\x69\x6e\x67\40\162\145\x71\165\151\x72\145\x64\40\74\x73\x61\155\x6c\x3a\x41\x75\164\150\156\103\x6f\156\164\x65\170\x74\76\40\151\x6e\40\74\163\141\155\154\x3a\x41\165\164\x68\156\x53\164\x61\x74\x65\155\145\156\164\76\x2e");
        q4:
        $t0 = $MH[0];
        $DX = SAMLSPUtilities::xpQuery($t0, "\x2e\57\163\141\155\154\137\x61\x73\163\145\x72\x74\x69\157\x6e\x3a\101\x75\164\x68\x6e\103\x6f\x6e\164\145\170\164\104\145\143\x6c\122\145\146");
        if (count($DX) > 1) {
            goto h1;
        }
        if (count($DX) === 1) {
            goto Vo;
        }
        goto hy;
        h1:
        throw new Exception("\115\x6f\x72\145\40\x74\x68\141\x6e\40\x6f\156\x65\40\x3c\x73\141\155\x6c\72\x41\165\x74\x68\x6e\103\x6f\156\x74\145\170\x74\x44\x65\x63\154\x52\x65\146\x3e\x20\x66\x6f\165\156\144\x3f");
        goto hy;
        Vo:
        $this->setAuthnContextDeclRef(trim($DX[0]->textContent));
        hy:
        $DD = SAMLSPUtilities::xpQuery($t0, "\x2e\57\163\x61\x6d\x6c\137\x61\x73\163\145\x72\164\151\157\156\x3a\x41\165\x74\150\x6e\x43\157\156\x74\x65\x78\164\104\145\143\x6c");
        if (count($DD) > 1) {
            goto to;
        }
        if (count($DD) === 1) {
            goto DZ;
        }
        goto PA;
        to:
        throw new Exception("\115\x6f\x72\145\x20\164\150\141\x6e\x20\x6f\156\x65\x20\74\163\141\155\154\x3a\101\x75\x74\x68\156\x43\157\156\x74\x65\170\164\x44\x65\x63\154\x3e\40\x66\x6f\x75\x6e\x64\77");
        goto PA;
        DZ:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($DD[0]));
        PA:
        $xy = SAMLSPUtilities::xpQuery($t0, "\x2e\57\163\x61\x6d\154\137\x61\x73\x73\145\x72\x74\x69\157\156\72\x41\x75\x74\x68\x6e\103\157\156\164\145\x78\x74\x43\154\x61\163\x73\x52\x65\146");
        if (count($xy) > 1) {
            goto TA;
        }
        if (count($xy) === 1) {
            goto fz;
        }
        goto lQ;
        TA:
        throw new Exception("\115\157\x72\x65\40\164\150\x61\x6e\40\157\156\145\x20\x3c\x73\141\x6d\154\72\x41\165\x74\150\156\103\x6f\x6e\x74\145\170\x74\x43\154\x61\x73\163\x52\x65\x66\x3e\40\151\156\x20\74\163\x61\x6d\x6c\x3a\x41\165\164\150\156\x43\157\156\164\145\170\x74\76\56");
        goto lQ;
        fz:
        $this->setAuthnContextClassRef(trim($xy[0]->textContent));
        lQ:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto pq;
        }
        throw new Exception("\115\x69\x73\x73\x69\x6e\x67\40\x65\151\x74\150\145\162\x20\x3c\x73\141\155\x6c\72\x41\165\x74\150\x6e\x43\157\156\x74\145\x78\x74\x43\154\x61\x73\163\122\145\x66\x3e\40\157\x72\x20\x3c\x73\141\155\x6c\72\x41\165\164\x68\x6e\103\157\x6e\164\145\170\x74\x44\x65\143\154\122\145\x66\76\40\157\162\x20\x3c\x73\141\155\154\x3a\101\x75\164\x68\x6e\103\x6f\x6e\x74\x65\x78\x74\x44\145\x63\154\x3e");
        pq:
        $this->AuthenticatingAuthority = SAMLSPUtilities::extractStrings($t0, "\x75\x72\156\72\157\x61\x73\151\x73\72\x6e\x61\155\145\163\x3a\164\143\x3a\123\101\115\x4c\x3a\62\56\60\x3a\141\163\x73\145\162\164\151\x6f\x6e", "\101\165\x74\150\145\x6e\x74\151\x63\141\x74\x69\156\x67\101\x75\x74\150\x6f\162\151\x74\x79");
    }
    private function parseAttributes(DOMElement $mD)
    {
        $eb = TRUE;
        $wE = SAMLSPUtilities::xpQuery($mD, "\56\57\x73\141\155\x6c\137\x61\163\x73\x65\162\x74\151\157\x6e\x3a\x41\x74\164\x72\151\142\x75\164\x65\123\164\x61\x74\145\155\x65\156\x74\x2f\x73\141\x6d\154\x5f\141\163\163\x65\162\x74\151\157\x6e\x3a\101\x74\164\162\x69\x62\165\x74\145");
        foreach ($wE as $NU) {
            if ($NU->hasAttribute("\x4e\141\155\145")) {
                goto Uf;
            }
            throw new Exception("\x4d\151\163\x73\151\156\x67\x20\156\141\155\145\40\x6f\x6e\x20\x3c\163\141\155\x6c\x3a\101\164\x74\x72\151\x62\x75\164\145\76\40\x65\x6c\x65\155\x65\156\164\x2e");
            Uf:
            $yK = $NU->getAttribute("\116\141\155\145");
            if ($NU->hasAttribute("\116\141\x6d\x65\x46\x6f\162\155\141\164")) {
                goto iA;
            }
            $Nn = "\165\162\156\72\157\x61\x73\151\x73\72\x6e\141\155\x65\163\72\164\x63\72\123\101\115\x4c\72\x31\x2e\61\x3a\x6e\141\x6d\145\x69\144\x2d\x66\157\162\x6d\x61\x74\72\x75\156\163\160\x65\143\151\146\151\x65\x64";
            goto IU;
            iA:
            $Nn = $NU->getAttribute("\116\x61\155\x65\x46\157\162\155\141\x74");
            IU:
            if ($eb) {
                goto YX;
            }
            if (!($this->nameFormat !== $Nn)) {
                goto in;
            }
            $this->nameFormat = "\x75\162\156\72\x6f\x61\x73\x69\x73\72\156\x61\x6d\145\x73\x3a\x74\143\x3a\x53\x41\x4d\114\x3a\61\x2e\61\x3a\156\x61\x6d\145\151\144\55\146\157\162\x6d\141\164\x3a\165\156\163\160\145\143\x69\x66\x69\x65\x64";
            in:
            goto hz;
            YX:
            $this->nameFormat = $Nn;
            $eb = FALSE;
            hz:
            if (array_key_exists($yK, $this->attributes)) {
                goto WR;
            }
            $this->attributes[$yK] = array();
            WR:
            $lj = SAMLSPUtilities::xpQuery($NU, "\x2e\x2f\x73\x61\x6d\x6c\x5f\x61\163\163\145\162\x74\x69\157\156\x3a\101\164\164\162\x69\x62\x75\x74\x65\x56\x61\x6c\x75\145");
            foreach ($lj as $Xb) {
                $this->attributes[$yK][] = trim($Xb->textContent);
                qO:
            }
            E2:
            MT:
        }
        qC:
    }
    private function parseEncryptedAttributes(DOMElement $mD)
    {
        $this->encryptedAttribute = SAMLSPUtilities::xpQuery($mD, "\56\57\163\x61\x6d\x6c\137\x61\x73\x73\x65\162\164\x69\x6f\x6e\x3a\x41\x74\x74\x72\151\142\x75\x74\145\123\164\141\x74\145\155\x65\x6e\164\x2f\x73\x61\x6d\154\137\141\163\163\x65\x72\164\x69\x6f\156\72\x45\156\143\162\x79\160\x74\145\144\101\x74\x74\162\151\x62\x75\164\145");
    }
    private function parseSignature(DOMElement $mD)
    {
        $NO = SAMLSPUtilities::validateElement($mD);
        if (!($NO !== FALSE)) {
            goto ym;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $NO["\x43\x65\x72\x74\151\x66\151\x63\x61\x74\145\x73"];
        $this->signatureData = $NO;
        ym:
    }
    public function validate(XMLSecurityKey $Yy)
    {
        if (!($this->signatureData === NULL)) {
            goto UO;
        }
        return FALSE;
        UO:
        SAMLSPUtilities::validateSignature($this->signatureData, $Yy);
        return TRUE;
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
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($TX)
    {
        $this->issuer = $TX;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto dP;
        }
        throw new Exception("\x41\x74\x74\x65\155\x70\x74\x65\x64\x20\x74\157\x20\162\145\164\x72\151\145\x76\145\x20\x65\156\x63\x72\171\x70\x74\x65\144\40\x4e\x61\155\x65\x49\104\x20\x77\x69\x74\x68\157\165\x74\x20\x64\x65\143\162\x79\x70\x74\x69\156\x67\x20\x69\x74\x20\146\x69\162\x73\x74\x2e");
        dP:
        return $this->nameId;
    }
    public function setNameId($am)
    {
        $this->nameId = $am;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto sQ;
        }
        return TRUE;
        sQ:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $Yy)
    {
        $mZ = new DOMDocument();
        $W1 = $mZ->createElement("\162\x6f\x6f\x74");
        $mZ->appendChild($W1);
        SAMLSPUtilities::addNameId($W1, $this->nameId);
        $am = $W1->firstChild;
        SAMLSPUtilities::getContainer()->debugMessage($am, "\x65\156\x63\162\x79\160\x74");
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
            goto DO1;
        }
        return;
        DO1:
        $am = SAMLSPUtilities::decryptElement($this->encryptedNameId, $Yy, $NH);
        SAMLSPUtilities::getContainer()->debugMessage($am, "\144\x65\143\x72\x79\x70\164");
        $this->nameId = SAMLSPUtilities::parseNameId($am);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $Yy, array $NH = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto SO;
        }
        return;
        SO:
        $eb = TRUE;
        $wE = $this->encryptedAttribute;
        foreach ($wE as $T2) {
            $NU = SAMLSPUtilities::decryptElement($T2->getElementsByTagName("\105\x6e\143\x72\x79\160\x74\x65\144\x44\x61\x74\141")->item(0), $Yy, $NH);
            if ($NU->hasAttribute("\116\x61\x6d\x65")) {
                goto eL;
            }
            throw new Exception("\115\151\x73\163\151\x6e\147\40\x6e\141\x6d\145\x20\x6f\x6e\40\x3c\x73\141\155\154\x3a\x41\x74\164\162\x69\142\x75\164\x65\76\x20\145\154\145\155\145\x6e\164\56");
            eL:
            $yK = $NU->getAttribute("\x4e\x61\x6d\x65");
            if ($NU->hasAttribute("\x4e\141\155\145\106\157\162\x6d\141\x74")) {
                goto eR;
            }
            $Nn = "\x75\x72\156\72\157\141\163\x69\x73\72\156\x61\x6d\x65\x73\x3a\164\143\x3a\x53\101\115\x4c\x3a\x32\56\x30\72\141\x74\x74\162\x6e\141\155\x65\55\x66\157\162\x6d\141\x74\x3a\x75\156\163\160\145\143\151\146\151\145\144";
            goto YV;
            eR:
            $Nn = $NU->getAttribute("\116\x61\x6d\x65\106\157\162\x6d\x61\164");
            YV:
            if ($eb) {
                goto ei;
            }
            if (!($this->nameFormat !== $Nn)) {
                goto yU;
            }
            $this->nameFormat = "\165\162\156\72\157\x61\163\151\x73\x3a\x6e\x61\155\145\163\x3a\x74\x63\x3a\x53\101\x4d\x4c\72\x32\56\60\x3a\141\x74\164\x72\156\141\x6d\x65\x2d\146\157\x72\x6d\x61\164\x3a\x75\x6e\163\160\145\143\x69\146\151\x65\x64";
            yU:
            goto Sx;
            ei:
            $this->nameFormat = $Nn;
            $eb = FALSE;
            Sx:
            if (array_key_exists($yK, $this->attributes)) {
                goto s1;
            }
            $this->attributes[$yK] = array();
            s1:
            $lj = SAMLSPUtilities::xpQuery($NU, "\x2e\57\x73\141\155\x6c\x5f\141\163\163\x65\162\164\151\157\156\72\x41\x74\164\x72\151\x62\x75\164\145\126\x61\154\x75\x65");
            foreach ($lj as $Xb) {
                $this->attributes[$yK][] = trim($Xb->textContent);
                oj:
            }
            ex:
            JY:
        }
        Pr:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($GE)
    {
        $this->notBefore = $GE;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($OU)
    {
        $this->notOnOrAfter = $OU;
    }
    public function setEncryptedAttributes($mP)
    {
        $this->requiredEncAttributes = $mP;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $qa = NULL)
    {
        $this->validAudiences = $qa;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($aK)
    {
        $this->authnInstant = $aK;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($l1)
    {
        $this->sessionNotOnOrAfter = $l1;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($OF)
    {
        $this->sessionIndex = $OF;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto SS;
        }
        return $this->authnContextClassRef;
        SS:
        if (empty($this->authnContextDeclRef)) {
            goto DI;
        }
        return $this->authnContextDeclRef;
        DI:
        return NULL;
    }
    public function setAuthnContext($U0)
    {
        $this->setAuthnContextClassRef($U0);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($QX)
    {
        $this->authnContextClassRef = $QX;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $oS)
    {
        if (empty($this->authnContextDeclRef)) {
            goto Fs;
        }
        throw new Exception("\101\165\164\x68\156\x43\157\156\x74\145\x78\x74\x44\145\x63\x6c\x52\x65\146\40\x69\163\40\x61\154\162\145\141\x64\x79\40\x72\x65\147\151\163\x74\145\162\145\144\x21\x20\x4d\141\171\40\x6f\x6e\154\x79\40\150\x61\x76\145\40\145\x69\x74\x68\x65\x72\40\141\40\104\x65\x63\x6c\40\157\162\40\x61\40\x44\145\143\x6c\122\145\146\54\40\x6e\157\x74\x20\142\157\164\150\41");
        Fs:
        $this->authnContextDecl = $oS;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($Be)
    {
        if (empty($this->authnContextDecl)) {
            goto Qy;
        }
        throw new Exception("\x41\x75\x74\150\156\x43\157\156\164\145\170\164\104\x65\x63\x6c\40\151\163\x20\x61\154\162\x65\141\x64\171\x20\x72\145\147\x69\x73\164\x65\x72\x65\144\x21\40\115\x61\171\40\157\x6e\x6c\171\40\x68\x61\166\x65\x20\145\x69\164\150\x65\162\40\141\40\104\x65\x63\x6c\x20\x6f\162\x20\141\x20\x44\145\143\x6c\x52\145\146\54\x20\x6e\x6f\x74\x20\142\x6f\x74\x68\41");
        Qy:
        $this->authnContextDeclRef = $Be;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($vW)
    {
        $this->AuthenticatingAuthority = $vW;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $wE)
    {
        $this->attributes = $wE;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($Nn)
    {
        $this->nameFormat = $Nn;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $qA)
    {
        $this->SubjectConfirmation = $qA;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function setSignatureKey(XMLsecurityKey $J2 = NULL)
    {
        $this->signatureKey = $J2;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $Mo = NULL)
    {
        $this->encryptionKey = $Mo;
    }
    public function setCertificates(array $FL)
    {
        $this->certificates = $FL;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $ns = NULL)
    {
        if ($ns === NULL) {
            goto Sn;
        }
        $w3 = $ns->ownerDocument;
        goto YJ;
        Sn:
        $w3 = new DOMDocument();
        $ns = $w3;
        YJ:
        $W1 = $w3->createElementNS("\x75\x72\156\72\157\141\163\151\163\72\x6e\141\155\145\x73\72\164\143\x3a\x53\101\x4d\x4c\72\x32\56\60\x3a\141\163\x73\x65\x72\x74\151\x6f\156", "\163\x61\155\154\72" . "\101\163\x73\145\162\164\151\157\x6e");
        $ns->appendChild($W1);
        $W1->setAttributeNS("\x75\162\x6e\72\x6f\141\x73\x69\x73\72\156\141\155\145\163\x3a\164\143\x3a\123\101\x4d\114\x3a\62\x2e\x30\x3a\x70\x72\157\x74\x6f\x63\x6f\154", "\x73\x61\x6d\x6c\x70\x3a\x74\155\x70", "\x74\x6d\160");
        $W1->removeAttributeNS("\165\x72\x6e\72\x6f\141\163\151\x73\72\x6e\x61\x6d\x65\x73\x3a\x74\143\x3a\x53\101\x4d\x4c\72\x32\56\60\72\160\162\x6f\x74\157\x63\x6f\x6c", "\164\155\x70");
        $W1->setAttributeNS("\150\164\x74\160\x3a\57\x2f\x77\167\167\56\167\x33\x2e\157\x72\x67\57\62\60\x30\61\57\x58\x4d\114\123\x63\x68\145\x6d\x61\x2d\x69\x6e\163\x74\x61\x6e\143\x65", "\170\x73\151\x3a\x74\x6d\x70", "\164\155\x70");
        $W1->removeAttributeNS("\x68\x74\x74\160\72\57\57\167\167\167\56\167\x33\x2e\157\162\147\57\x32\60\60\x31\57\130\115\x4c\x53\143\150\145\155\141\x2d\151\156\x73\x74\x61\156\x63\x65", "\164\x6d\160");
        $W1->setAttributeNS("\x68\164\x74\x70\72\57\57\167\x77\x77\x2e\x77\x33\56\157\x72\x67\x2f\x32\60\60\x31\57\130\115\x4c\x53\143\150\x65\x6d\x61", "\170\163\x3a\x74\x6d\160", "\x74\x6d\x70");
        $W1->removeAttributeNS("\x68\x74\164\160\72\57\57\x77\167\167\56\x77\x33\x2e\157\x72\x67\x2f\62\x30\x30\x31\x2f\130\115\114\123\x63\x68\x65\155\141", "\164\155\x70");
        $W1->setAttribute("\x49\104", $this->id);
        $W1->setAttribute("\x56\145\162\163\151\x6f\156", "\62\56\x30");
        $W1->setAttribute("\x49\163\x73\x75\x65\x49\x6e\x73\x74\x61\156\x74", gmdate("\x59\55\x6d\x2d\144\134\x54\110\72\151\x3a\x73\134\132", $this->issueInstant));
        $TX = SAMLSPUtilities::addString($W1, "\x75\162\x6e\x3a\157\141\x73\151\163\72\x6e\141\x6d\x65\x73\x3a\x74\x63\72\x53\x41\x4d\x4c\72\62\56\x30\x3a\x61\163\163\145\162\164\x69\157\156", "\x73\141\x6d\154\x3a\111\163\163\165\145\162", $this->issuer);
        $this->addSubject($W1);
        $this->addConditions($W1);
        $this->addAuthnStatement($W1);
        if ($this->requiredEncAttributes == FALSE) {
            goto eH;
        }
        $this->addEncryptedAttributeStatement($W1);
        goto Ya;
        eH:
        $this->addAttributeStatement($W1);
        Ya:
        if (!($this->signatureKey !== NULL)) {
            goto nJ;
        }
        SAMLSPUtilities::insertSignature($this->signatureKey, $this->certificates, $W1, $TX->nextSibling);
        nJ:
        return $W1;
    }
    private function addSubject(DOMElement $W1)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto P_;
        }
        return;
        P_:
        $Y4 = $W1->ownerDocument->createElementNS("\165\x72\x6e\x3a\x6f\x61\x73\151\163\72\156\141\155\145\163\72\x74\143\x3a\123\x41\x4d\x4c\72\x32\56\60\72\141\x73\163\x65\x72\164\151\x6f\x6e", "\x73\141\x6d\x6c\72\123\165\x62\152\145\143\x74");
        $W1->appendChild($Y4);
        if ($this->encryptedNameId === NULL) {
            goto VF;
        }
        $al = $Y4->ownerDocument->createElementNS("\165\162\x6e\72\157\x61\163\151\x73\x3a\156\x61\155\x65\x73\x3a\x74\x63\72\123\x41\x4d\x4c\x3a\62\x2e\x30\x3a\x61\x73\163\x65\162\164\x69\157\x6e", "\x73\141\x6d\x6c\x3a" . "\x45\156\143\x72\171\160\164\145\x64\x49\x44");
        $Y4->appendChild($al);
        $al->appendChild($Y4->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto li;
        VF:
        SAMLSPUtilities::addNameId($Y4, $this->nameId);
        li:
        foreach ($this->SubjectConfirmation as $u2) {
            $u2->toXML($Y4);
            fO:
        }
        L8:
    }
    private function addConditions(DOMElement $W1)
    {
        $w3 = $W1->ownerDocument;
        $Qs = $w3->createElementNS("\165\x72\x6e\72\x6f\x61\x73\151\163\x3a\x6e\x61\x6d\x65\x73\72\x74\x63\x3a\x53\x41\115\114\72\62\x2e\60\72\141\163\x73\145\162\164\x69\x6f\156", "\163\x61\x6d\154\72\103\157\156\x64\x69\164\x69\x6f\x6e\163");
        $W1->appendChild($Qs);
        if (!($this->notBefore !== NULL)) {
            goto lC;
        }
        $Qs->setAttribute("\116\157\164\x42\x65\146\157\x72\x65", gmdate("\131\55\155\55\x64\x5c\124\x48\72\151\72\163\x5c\x5a", $this->notBefore));
        lC:
        if (!($this->notOnOrAfter !== NULL)) {
            goto Bv;
        }
        $Qs->setAttribute("\x4e\x6f\164\x4f\156\x4f\x72\101\x66\x74\x65\x72", gmdate("\131\x2d\x6d\55\144\134\124\x48\x3a\x69\x3a\163\134\x5a", $this->notOnOrAfter));
        Bv:
        if (!($this->validAudiences !== NULL)) {
            goto Bt;
        }
        $Lw = $w3->createElementNS("\x75\162\156\x3a\x6f\x61\x73\x69\163\72\156\141\x6d\145\x73\72\x74\x63\x3a\123\x41\x4d\114\x3a\x32\56\60\x3a\x61\x73\x73\145\162\x74\x69\x6f\x6e", "\x73\x61\x6d\x6c\72\101\x75\144\x69\145\x6e\x63\145\x52\x65\163\164\162\x69\143\164\151\x6f\x6e");
        $Qs->appendChild($Lw);
        SAMLSPUtilities::addStrings($Lw, "\165\162\156\72\157\141\x73\151\163\x3a\x6e\141\155\x65\163\x3a\164\143\x3a\x53\x41\115\x4c\x3a\62\56\60\72\x61\163\x73\x65\x72\x74\x69\x6f\x6e", "\163\x61\x6d\x6c\x3a\101\165\144\x69\x65\x6e\143\x65", FALSE, $this->validAudiences);
        Bt:
    }
    private function addAuthnStatement(DOMElement $W1)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto gd;
        }
        return;
        gd:
        $w3 = $W1->ownerDocument;
        $V4 = $w3->createElementNS("\165\x72\156\72\x6f\141\163\x69\163\72\x6e\141\155\x65\163\x3a\x74\x63\x3a\x53\x41\x4d\114\x3a\x32\x2e\x30\x3a\141\x73\163\x65\162\164\x69\157\x6e", "\163\x61\155\154\72\x41\x75\x74\150\156\123\x74\141\164\x65\x6d\145\x6e\164");
        $W1->appendChild($V4);
        $V4->setAttribute("\x41\x75\164\150\x6e\111\x6e\x73\164\141\x6e\164", gmdate("\131\x2d\x6d\x2d\144\134\124\110\x3a\151\72\163\x5c\x5a", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto LX;
        }
        $V4->setAttribute("\123\145\163\163\151\157\x6e\116\157\164\x4f\156\117\162\101\146\164\x65\x72", gmdate("\x59\x2d\155\x2d\144\x5c\124\x48\x3a\151\72\163\x5c\x5a", $this->sessionNotOnOrAfter));
        LX:
        if (!($this->sessionIndex !== NULL)) {
            goto Z7;
        }
        $V4->setAttribute("\x53\x65\x73\x73\x69\157\156\111\x6e\144\x65\x78", $this->sessionIndex);
        Z7:
        $t0 = $w3->createElementNS("\x75\162\156\72\x6f\x61\x73\x69\x73\x3a\x6e\141\x6d\145\x73\x3a\x74\x63\x3a\123\101\x4d\x4c\72\x32\x2e\60\x3a\141\163\x73\145\x72\164\151\x6f\156", "\x73\141\155\154\x3a\101\165\x74\150\156\x43\x6f\156\164\145\x78\164");
        $V4->appendChild($t0);
        if (empty($this->authnContextClassRef)) {
            goto ih;
        }
        SAMLSPUtilities::addString($t0, "\165\x72\156\x3a\x6f\141\163\151\x73\x3a\x6e\x61\155\145\163\x3a\164\143\72\x53\101\x4d\114\72\62\56\60\72\141\x73\163\x65\x72\x74\151\157\156", "\163\x61\x6d\154\x3a\101\x75\x74\150\x6e\x43\157\156\164\x65\170\x74\103\x6c\x61\x73\x73\x52\145\146", $this->authnContextClassRef);
        ih:
        if (empty($this->authnContextDecl)) {
            goto VI;
        }
        $this->authnContextDecl->toXML($t0);
        VI:
        if (empty($this->authnContextDeclRef)) {
            goto Xq;
        }
        SAMLSPUtilities::addString($t0, "\x75\162\156\72\x6f\x61\163\x69\x73\72\156\141\x6d\145\x73\72\x74\x63\x3a\x53\x41\x4d\114\x3a\x32\x2e\x30\x3a\141\x73\x73\145\x72\164\x69\157\x6e", "\163\x61\x6d\x6c\x3a\x41\165\164\x68\156\103\157\x6e\x74\145\x78\x74\104\x65\143\154\122\145\x66", $this->authnContextDeclRef);
        Xq:
        SAMLSPUtilities::addStrings($t0, "\x75\162\156\x3a\157\141\163\151\163\x3a\156\x61\x6d\145\x73\x3a\164\143\x3a\123\101\x4d\114\72\62\x2e\x30\x3a\x61\163\163\145\162\164\151\x6f\x6e", "\163\x61\155\x6c\72\x41\165\164\150\x65\x6e\x74\151\143\x61\x74\x69\x6e\x67\x41\x75\164\150\x6f\x72\x69\164\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $W1)
    {
        if (!empty($this->attributes)) {
            goto ld;
        }
        return;
        ld:
        $w3 = $W1->ownerDocument;
        $lz = $w3->createElementNS("\x75\162\x6e\72\x6f\141\x73\x69\163\x3a\156\141\155\145\x73\72\164\x63\72\123\101\115\x4c\x3a\x32\x2e\x30\x3a\141\163\163\145\162\x74\151\x6f\156", "\163\141\x6d\154\72\101\x74\x74\x72\151\142\x75\x74\145\x53\164\141\x74\145\155\x65\156\x74");
        $W1->appendChild($lz);
        foreach ($this->attributes as $yK => $lj) {
            $NU = $w3->createElementNS("\165\162\x6e\72\157\141\x73\x69\163\x3a\x6e\141\155\145\x73\x3a\164\x63\x3a\123\x41\115\x4c\x3a\x32\56\x30\72\141\x73\163\x65\162\x74\x69\157\x6e", "\x73\141\155\x6c\72\x41\x74\164\162\151\x62\x75\x74\145");
            $lz->appendChild($NU);
            $NU->setAttribute("\116\141\x6d\x65", $yK);
            if (!($this->nameFormat !== "\x75\162\156\x3a\157\x61\163\x69\163\x3a\x6e\141\155\145\x73\72\x74\143\72\x53\x41\x4d\x4c\x3a\62\x2e\60\72\x61\164\x74\x72\x6e\141\x6d\145\x2d\146\x6f\x72\x6d\x61\x74\72\165\x6e\x73\160\145\143\151\x66\x69\x65\x64")) {
                goto gy;
            }
            $NU->setAttribute("\x4e\141\x6d\x65\x46\x6f\x72\155\141\x74", $this->nameFormat);
            gy:
            foreach ($lj as $Xb) {
                if (is_string($Xb)) {
                    goto Ls;
                }
                if (is_int($Xb)) {
                    goto sr;
                }
                $J1 = NULL;
                goto Rw;
                Ls:
                $J1 = "\x78\x73\x3a\163\x74\x72\151\x6e\x67";
                goto Rw;
                sr:
                $J1 = "\x78\163\x3a\x69\x6e\164\x65\x67\x65\x72";
                Rw:
                $Uo = $w3->createElementNS("\x75\162\156\72\x6f\141\163\151\163\x3a\156\x61\x6d\145\x73\x3a\164\143\72\x53\101\115\114\x3a\x32\56\x30\72\x61\163\163\x65\x72\164\x69\157\x6e", "\163\141\155\154\72\x41\164\x74\162\x69\x62\165\164\x65\x56\141\x6c\165\x65");
                $NU->appendChild($Uo);
                if (!($J1 !== NULL)) {
                    goto rA;
                }
                $Uo->setAttributeNS("\150\x74\x74\160\x3a\x2f\57\167\167\x77\56\167\63\x2e\157\162\x67\x2f\x32\60\x30\61\x2f\x58\115\114\x53\x63\150\145\x6d\141\55\x69\156\x73\x74\x61\x6e\143\145", "\x78\x73\x69\72\x74\171\160\145", $J1);
                rA:
                if (!is_null($Xb)) {
                    goto sS;
                }
                $Uo->setAttributeNS("\x68\x74\164\160\72\x2f\x2f\x77\167\x77\56\x77\63\x2e\157\x72\147\x2f\62\60\x30\x31\57\x58\115\x4c\x53\x63\150\145\x6d\x61\55\151\156\x73\164\141\x6e\x63\x65", "\x78\163\151\72\156\151\154", "\164\x72\165\x65");
                sS:
                if ($Xb instanceof DOMNodeList) {
                    goto nW;
                }
                $Uo->appendChild($w3->createTextNode($Xb));
                goto mL;
                nW:
                $r7 = 0;
                dn:
                if (!($r7 < $Xb->length)) {
                    goto lM;
                }
                $Wl = $w3->importNode($Xb->item($r7), TRUE);
                $Uo->appendChild($Wl);
                Qm:
                $r7++;
                goto dn;
                lM:
                mL:
                M0:
            }
            HA:
            B1:
        }
        RC:
    }
    private function addEncryptedAttributeStatement(DOMElement $W1)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto cx;
        }
        return;
        cx:
        $w3 = $W1->ownerDocument;
        $lz = $w3->createElementNS("\x75\162\156\x3a\x6f\x61\163\x69\x73\72\156\141\155\x65\163\72\164\x63\x3a\123\x41\x4d\x4c\x3a\62\56\x30\72\x61\x73\x73\x65\x72\164\x69\157\156", "\x73\x61\155\154\x3a\x41\x74\164\162\x69\x62\x75\x74\x65\123\x74\x61\x74\x65\155\x65\156\x74");
        $W1->appendChild($lz);
        foreach ($this->attributes as $yK => $lj) {
            $l_ = new DOMDocument();
            $NU = $l_->createElementNS("\x75\162\156\72\157\141\163\151\x73\72\156\141\155\x65\163\72\x74\x63\72\123\x41\115\x4c\72\62\x2e\x30\72\x61\163\x73\x65\162\164\151\157\x6e", "\x73\x61\x6d\154\72\101\164\164\x72\x69\x62\165\x74\145");
            $NU->setAttribute("\116\141\x6d\x65", $yK);
            $l_->appendChild($NU);
            if (!($this->nameFormat !== "\165\162\156\72\x6f\x61\163\x69\163\72\156\141\x6d\145\163\x3a\x74\143\72\123\101\115\x4c\x3a\x32\56\x30\x3a\x61\x74\x74\x72\156\x61\155\145\x2d\x66\157\x72\155\x61\164\72\165\x6e\x73\x70\x65\x63\x69\x66\x69\x65\144")) {
                goto L6;
            }
            $NU->setAttribute("\116\x61\x6d\145\x46\x6f\x72\155\141\x74", $this->nameFormat);
            L6:
            foreach ($lj as $Xb) {
                if (is_string($Xb)) {
                    goto nL;
                }
                if (is_int($Xb)) {
                    goto h3;
                }
                $J1 = NULL;
                goto Ez;
                nL:
                $J1 = "\170\163\72\x73\x74\x72\151\156\x67";
                goto Ez;
                h3:
                $J1 = "\170\x73\72\x69\x6e\x74\x65\147\145\x72";
                Ez:
                $Uo = $l_->createElementNS("\165\162\156\72\x6f\x61\x73\151\x73\72\x6e\141\155\x65\x73\x3a\x74\143\72\123\x41\x4d\x4c\x3a\62\56\60\x3a\x61\x73\163\145\162\x74\x69\157\x6e", "\x73\141\155\x6c\72\x41\x74\164\162\151\142\165\x74\145\x56\x61\x6c\165\145");
                $NU->appendChild($Uo);
                if (!($J1 !== NULL)) {
                    goto ir;
                }
                $Uo->setAttributeNS("\x68\164\x74\x70\72\x2f\x2f\167\x77\167\56\167\x33\56\157\162\147\57\62\x30\60\61\x2f\130\x4d\114\123\x63\x68\145\x6d\141\55\x69\156\163\x74\x61\x6e\143\x65", "\x78\163\x69\72\164\171\160\145", $J1);
                ir:
                if ($Xb instanceof DOMNodeList) {
                    goto dv;
                }
                $Uo->appendChild($l_->createTextNode($Xb));
                goto tc;
                dv:
                $r7 = 0;
                cF:
                if (!($r7 < $Xb->length)) {
                    goto EC;
                }
                $Wl = $l_->importNode($Xb->item($r7), TRUE);
                $Uo->appendChild($Wl);
                H9:
                $r7++;
                goto cF;
                EC:
                tc:
                QA:
            }
            WI:
            $FA = new XMLSecEnc();
            $FA->setNode($l_->documentElement);
            $FA->type = "\x68\x74\x74\x70\72\57\57\167\x77\x77\x2e\x77\63\x2e\157\x72\x67\57\62\60\x30\61\57\60\64\57\170\x6d\x6c\145\x6e\143\43\105\x6c\x65\x6d\145\x6e\x74";
            $tu = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $tu->generateSessionKey();
            $FA->encryptKey($this->encryptionKey, $tu);
            $dZ = $FA->encryptNode($tu);
            $hv = $w3->createElementNS("\x75\x72\156\72\157\141\x73\151\x73\x3a\156\141\x6d\x65\x73\72\x74\x63\x3a\x53\101\x4d\114\72\x32\56\x30\72\x61\163\x73\145\x72\x74\151\157\156", "\x73\x61\155\154\72\105\x6e\143\162\171\160\164\145\144\101\x74\x74\162\151\142\x75\x74\x65");
            $lz->appendChild($hv);
            $pE = $w3->importNode($dZ, TRUE);
            $hv->appendChild($pE);
            eg:
        }
        jF:
    }
}
