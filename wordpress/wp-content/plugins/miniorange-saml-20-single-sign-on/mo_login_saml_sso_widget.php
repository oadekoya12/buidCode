<?php


include_once dirname(__FILE__) . "\x2f\x55\164\x69\x6c\151\x74\151\145\163\x2e\x70\150\x70";
include_once dirname(__FILE__) . "\57\x52\x65\163\x70\x6f\x6e\163\145\56\x70\x68\x70";
include_once dirname(__FILE__) . "\57\114\x6f\147\x6f\x75\x74\122\x65\161\x75\145\163\164\56\x70\150\x70";
if (class_exists("\x41\x45\123\105\156\x63\x72\x79\160\164\x69\157\156")) {
    goto XO;
}
require_once dirname(__FILE__) . "\57\151\156\x63\154\165\144\145\x73\57\154\x69\x62\57\x65\x6e\x63\162\171\x70\164\151\x6f\x6e\56\x70\150\160";
XO:
class mo_login_wid extends WP_Widget
{
    public function __construct()
    {
        $x0 = get_option("\x73\x61\x6d\x6c\x5f\151\144\x65\x6e\x74\151\164\171\137\x6e\141\x6d\145");
        parent::__construct("\123\x61\155\x6c\x5f\114\x6f\147\x69\x6e\x5f\x57\x69\x64\147\145\164", "\114\157\x67\x69\156\40\167\x69\164\150\x20" . $x0, array("\x64\145\163\143\x72\x69\160\x74\151\x6f\156" => __("\x54\x68\151\163\40\151\163\x20\x61\40\155\151\156\151\117\162\x61\x6e\147\x65\x20\123\x41\x4d\114\x20\154\157\x67\151\x6e\40\167\x69\x64\x67\145\164\56", "\x6d\x6f\163\141\155\154")));
    }
    public function widget($ua, $YM)
    {
        extract($ua);
        $Gz = apply_filters("\x77\x69\144\147\145\164\137\x74\151\164\154\x65", $YM["\167\x69\144\x5f\x74\151\164\x6c\x65"]);
        echo $ua["\142\x65\146\157\x72\145\x5f\x77\x69\x64\x67\145\164"];
        if (empty($Gz)) {
            goto Bl;
        }
        echo $ua["\x62\x65\146\x6f\x72\x65\x5f\164\151\164\x6c\x65"] . $Gz . $ua["\x61\x66\164\x65\x72\137\x74\x69\x74\154\x65"];
        Bl:
        $this->loginForm();
        echo $ua["\141\146\164\x65\x72\x5f\x77\151\144\x67\145\164"];
    }
    public function update($nO, $GK)
    {
        $YM = array();
        $YM["\167\x69\144\x5f\164\x69\164\154\x65"] = strip_tags($nO["\167\151\x64\x5f\x74\x69\x74\x6c\145"]);
        return $YM;
    }
    public function form($YM)
    {
        $Gz = '';
        if (!array_key_exists("\x77\151\x64\137\164\151\164\x6c\145", $YM)) {
            goto rx;
        }
        $Gz = $YM["\167\x69\x64\x5f\164\151\164\154\x65"];
        rx:
        echo "\12\x9\11\x3c\160\76\x3c\x6c\x61\142\x65\154\40\x66\157\162\x3d\x22" . $this->get_field_id("\x77\x69\x64\x5f\x74\151\164\x6c\145") . "\40\42\76" . _e("\124\x69\164\154\x65\x3a") . "\40\x3c\57\x6c\x61\x62\145\x6c\76\12\11\11\74\x69\x6e\x70\165\164\x20\143\x6c\141\163\x73\x3d\42\x77\x69\x64\x65\x66\x61\x74\x22\x20\151\x64\75\42" . $this->get_field_id("\167\x69\x64\137\x74\x69\164\154\x65") . "\42\40\156\x61\x6d\x65\x3d\x22" . $this->get_field_name("\x77\151\x64\137\164\x69\x74\154\x65") . "\42\x20\x74\x79\x70\x65\75\42\x74\145\x78\164\x22\40\166\x61\x6c\x75\x65\75\42" . $Gz . "\42\x20\x2f\x3e\12\x9\x9\74\x2f\x70\x3e";
    }
    public function loginForm()
    {
        global $nh;
        if (!is_user_logged_in()) {
            goto hQ;
        }
        $current_user = wp_get_current_user();
        $uV = "\110\145\154\x6c\157\x2c\x20" . $current_user->display_name;
        echo $uV . "\x20\x7c\x20\x3c\x61\x20\150\162\145\146\x3d\x22" . wp_logout_url(home_url()) . "\x22\40\x74\151\x74\154\145\75\x22\154\x6f\147\157\x75\x74\x22\40\76\114\x6f\147\157\x75\x74\x3c\x2f\x61\x3e\x3c\57\154\x69\x3e";
        goto D0;
        hQ:
        $xR = saml_get_current_page_url();
        echo "\12\11\11\74\163\143\x72\x69\x70\x74\76\12\x9\x9\146\165\156\143\164\x69\x6f\156\40\x73\165\x62\x6d\x69\164\x53\141\155\x6c\x46\x6f\x72\155\50\51\173\40\144\157\x63\x75\x6d\x65\x6e\x74\56\147\x65\164\x45\154\145\x6d\145\x6e\x74\102\x79\111\x64\50\x22\155\x69\156\x69\157\162\x61\156\147\145\55\x73\141\x6d\x6c\x2d\163\160\55\x73\163\157\55\x6c\x6f\x67\x69\156\55\146\157\162\155\x22\x29\x2e\x73\165\x62\x6d\151\164\x28\51\x3b\x20\x7d\12\x9\x9\x3c\x2f\x73\x63\x72\151\160\x74\76\xa\x9\x9\x3c\x66\157\x72\155\x20\156\141\x6d\x65\x3d\x22\x6d\151\x6e\x69\x6f\162\141\x6e\x67\145\55\163\141\x6d\x6c\x2d\163\x70\55\163\x73\x6f\55\154\157\147\x69\x6e\x2d\146\157\x72\x6d\x22\40\151\144\75\42\155\151\x6e\151\x6f\x72\x61\156\x67\145\x2d\163\x61\x6d\x6c\55\163\160\x2d\163\x73\x6f\x2d\x6c\x6f\x67\x69\156\x2d\x66\x6f\162\155\42\x20\x6d\x65\164\150\x6f\x64\75\x22\160\x6f\x73\164\x22\x20\141\143\164\151\x6f\x6e\x3d\x22\x22\x3e\12\x9\x9\74\x69\156\x70\x75\164\x20\x74\171\160\x65\75\x22\150\151\144\x64\145\x6e\x22\x20\x6e\x61\x6d\x65\x3d\42\x6f\160\164\x69\157\x6e\x22\40\166\x61\x6c\x75\x65\75\42\x73\x61\155\154\137\x75\x73\145\x72\137\154\x6f\147\x69\x6e\42\40\x2f\x3e\xa\11\x9\x3c\x69\x6e\x70\165\164\40\x74\x79\160\145\75\42\150\151\x64\144\145\156\42\40\x6e\141\155\x65\x3d\x22\162\x65\x64\x69\x72\x65\143\x74\x5f\164\157\42\x20\166\141\154\165\145\75\x22" . $xR . "\42\40\x2f\76\12\xa\11\x9\x3c\x66\157\x6e\164\x20\x73\151\x7a\145\x3d\x22\x2b\x31\x22\40\163\x74\x79\154\x65\x3d\x22\x76\x65\162\164\151\x63\x61\x6c\55\x61\x6c\x69\x67\x6e\x3a\164\157\160\x3b\x22\76\x20\x3c\x2f\146\157\156\164\x3e";
        $BH = get_option("\x73\x61\x6d\154\x5f\x69\x64\x65\x6e\164\151\x74\x79\137\156\141\155\145");
        if (!empty($BH)) {
            goto wJ;
        }
        echo "\x50\154\x65\141\x73\145\40\x63\x6f\x6e\146\151\x67\x75\x72\145\x20\164\150\x65\x20\x6d\151\x6e\x69\x4f\162\x61\x6e\147\145\40\x53\101\115\114\40\x50\x6c\165\147\151\156\40\146\151\162\163\164\56";
        goto E_;
        wJ:
        if (get_option("\155\157\x5f\163\x61\155\x6c\x5f\145\x6e\141\x62\x6c\x65\137\x63\154\x6f\x75\x64\x5f\x62\162\157\153\x65\162") == "\146\141\154\x73\x65") {
            goto ap;
        }
        echo "\x3c\x61\40\x68\x72\x65\146\75\42" . get_option("\155\x6f\137\x73\141\155\154\137\150\x6f\163\164\x5f\x6e\x61\155\145") . "\57\155\157\x61\163\x2f\x72\145\x73\164\x2f\163\141\x6d\x6c\x2f\x72\x65\x71\165\145\x73\164\77\x69\144\x3d" . get_option("\155\x6f\x5f\163\x61\x6d\x6c\137\x61\144\155\x69\156\137\143\165\163\x74\x6f\x6d\145\x72\x5f\153\145\x79") . "\46\x72\x65\164\165\x72\156\165\162\x6c\x3d\x20" . urlencode(home_url() . "\57\77\x6f\160\x74\x69\157\156\75\162\145\x61\x64\163\141\155\154\154\x6f\x67\x69\x6e") . "\x22\x3e\114\x6f\147\151\x6e\x20\167\151\x74\150\x20" . $BH . "\74\x2f\141\76";
        goto bu;
        ap:
        echo "\74\x61\40\150\162\145\146\75\42\43\42\x20\157\x6e\x43\x6c\x69\143\153\x3d\x22\163\165\x62\155\151\164\x53\x61\155\154\106\157\162\155\x28\x29\42\76\114\157\x67\151\x6e\x20\167\x69\x74\x68\40" . $BH . "\74\57\x61\76\74\57\146\157\x72\155\76";
        bu:
        E_:
        if ($this->mo_saml_check_empty_or_null_val(get_option("\155\x6f\x5f\x73\x61\x6d\x6c\137\162\145\x64\x69\162\x65\143\x74\137\x65\162\162\157\x72\137\143\157\x64\x65"))) {
            goto ou;
        }
        echo "\x3c\144\x69\x76\76\74\x2f\144\151\x76\76\74\x64\x69\166\40\x74\x69\164\154\145\x3d\x22\x4c\x6f\x67\151\x6e\x20\105\162\162\x6f\x72\42\x3e\74\x66\x6f\156\164\x20\143\157\x6c\x6f\162\x3d\x22\162\145\x64\x22\76\x57\x65\40\143\157\x75\154\x64\x20\156\157\164\x20\163\151\147\156\x20\171\157\165\x20\x69\x6e\56\40\x50\154\x65\x61\163\x65\40\x63\x6f\156\164\x61\143\x74\40\171\x6f\x75\x72\x20\x41\144\x6d\x69\156\x69\163\164\x72\141\164\157\162\56\x3c\57\x66\157\x6e\164\x3e\x3c\x2f\x64\x69\x76\x3e";
        delete_option("\155\157\x5f\163\x61\155\x6c\x5f\162\145\x64\151\x72\x65\x63\164\137\145\x72\x72\157\162\137\x63\157\144\145");
        delete_option("\155\x6f\x5f\163\141\155\x6c\x5f\162\x65\x64\x69\x72\x65\x63\x74\137\x65\x72\x72\157\x72\x5f\162\145\141\x73\x6f\x6e");
        ou:
        echo "\x3c\141\40\150\162\x65\146\75\x22\150\164\x74\x70\x3a\x2f\57\155\151\156\x69\x6f\x72\x61\156\147\145\56\x63\x6f\155\57\x77\157\x72\144\x70\162\145\163\x73\55\x6c\x64\x61\160\55\x6c\157\147\x69\156\x22\x20\x73\x74\171\154\x65\x3d\42\144\151\x73\x70\x6c\x61\x79\x3a\156\x6f\x6e\145\42\x3e\x4c\157\x67\x69\x6e\x20\164\x6f\40\x57\x6f\162\x64\x50\162\145\x73\x73\40\x75\163\x69\x6e\147\40\114\x44\101\120\x3c\x2f\141\x3e\xa\x9\11\x3c\141\x20\x68\x72\145\x66\x3d\42\150\x74\164\x70\x3a\57\57\155\151\156\151\x6f\x72\x61\156\x67\x65\x2e\x63\x6f\155\57\x63\x6c\x6f\x75\144\x2d\x69\144\x65\156\164\151\164\x79\55\x62\162\x6f\x6b\x65\162\55\163\x65\x72\x76\151\143\145\42\40\163\x74\x79\x6c\145\75\42\x64\x69\163\160\154\141\x79\72\x6e\157\156\x65\42\76\x43\x6c\157\165\144\x20\111\x64\145\x6e\x74\x69\x74\x79\40\x62\x72\157\x6b\x65\x72\x20\x73\x65\162\166\x69\143\145\74\x2f\x61\76\xa\x9\x9\74\x61\40\x68\x72\145\146\x3d\42\x68\164\164\x70\72\x2f\x2f\155\151\156\151\157\x72\x61\156\147\x65\x2e\143\x6f\155\x2f\x73\164\x72\157\x6e\x67\137\x61\165\x74\150\42\40\x73\164\171\x6c\x65\x3d\x22\144\151\x73\x70\x6c\x61\171\72\156\x6f\x6e\145\73\42\x3e\74\x2f\x61\x3e\12\11\x9\x3c\x61\x20\x68\x72\x65\x66\75\x22\150\164\x74\160\72\x2f\57\x6d\151\156\151\x6f\162\x61\x6e\147\x65\56\143\x6f\x6d\x2f\x73\x69\156\x67\x6c\x65\x2d\163\151\x67\156\55\157\156\55\163\163\x6f\42\x20\x73\164\171\154\x65\x3d\42\144\151\x73\160\x6c\x61\x79\x3a\156\157\156\145\73\42\x3e\x3c\x2f\x61\x3e\12\x9\11\74\x61\40\x68\162\x65\x66\x3d\42\x68\164\x74\x70\x3a\x2f\57\155\x69\156\x69\x6f\x72\x61\156\x67\145\x2e\x63\157\x6d\x2f\x66\x72\x61\165\x64\42\x20\x73\x74\x79\154\x65\75\x22\x64\x69\x73\160\x6c\141\171\72\x6e\x6f\x6e\x65\73\x22\76\x3c\57\141\76\xa\12\x9\11\11\x3c\57\165\154\76\xa\x9\11\x3c\x2f\146\x6f\162\x6d\76";
        D0:
    }
    public function mo_saml_check_empty_or_null_val($Xb)
    {
        if (!(!isset($Xb) || empty($Xb))) {
            goto KK;
        }
        return true;
        KK:
        return false;
    }
    function mo_saml_logout()
    {
        if (!is_user_logged_in()) {
            goto aN;
        }
        $qM = get_option("\x73\141\155\x6c\137\154\157\147\157\x75\x74\x5f\x75\x72\x6c");
        $Rc = get_option("\163\x61\x6d\x6c\x5f\154\x6f\147\157\165\164\137\x62\151\156\x64\x69\x6e\x67\x5f\x74\171\x70\x65");
        if (empty($qM)) {
            goto tQ;
        }
        if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
            goto PR;
        }
        session_start();
        PR:
        if (isset($_SESSION["\155\157\137\163\x61\155\154\137\154\x6f\x67\157\165\x74\137\162\x65\x71\x75\145\x73\164"])) {
            goto sT;
        }
        if (isset($_SESSION["\155\157\x5f\163\x61\155\x6c"]["\154\157\147\147\145\144\137\151\x6e\x5f\x77\151\x74\x68\137\151\144\160"])) {
            goto pP;
        }
        goto CV;
        sT:
        self::createLogoutResponseAndRedirect($qM, $Rc);
        die;
        goto CV;
        pP:
        unset($_SESSION["\155\x6f\x5f\163\141\x6d\x6c"]);
        $current_user = wp_get_current_user();
        $am = get_user_meta($current_user->ID, "\x6d\157\137\163\x61\155\154\x5f\156\141\155\x65\137\151\144");
        $OF = get_user_meta($current_user->ID, "\155\x6f\137\x73\141\x6d\x6c\x5f\163\x65\163\x73\151\x6f\x6e\137\151\x6e\144\145\x78");
        $Qm = get_option("\155\x6f\137\x73\x61\x6d\x6c\x5f\x73\160\x5f\142\141\163\x65\x5f\x75\x72\154");
        if (!empty($Qm)) {
            goto H5;
        }
        $Qm = home_url();
        H5:
        $Wo = get_option("\155\157\137\163\x61\155\x6c\137\163\x70\x5f\x65\x6e\x74\151\164\x79\137\x69\x64");
        if (!empty($Wo)) {
            goto GQ;
        }
        $Wo = $Qm . "\x2f\x77\x70\55\x63\x6f\156\164\x65\156\x74\x2f\x70\x6c\x75\147\151\156\x73\57\155\151\x6e\x69\157\x72\x61\156\147\145\x2d\163\x61\155\x6c\x2d\62\x30\x2d\x73\151\x6e\x67\x6c\145\x2d\163\151\x67\156\x2d\x6f\156\x2f";
        GQ:
        $C_ = $qM;
        $tj = $Qm;
        $jN = SAMLSPUtilities::createLogoutRequest($am, $OF, $Wo, $C_, $Rc);
        if (empty($Rc) || $Rc == "\x48\164\x74\x70\x52\x65\144\151\x72\x65\x63\x74") {
            goto X8;
        }
        if (!(get_option("\x73\141\155\x6c\137\162\x65\161\x75\x65\x73\164\137\x73\x69\x67\x6e\x65\144") == "\165\156\143\x68\145\x63\x6b\145\144")) {
            goto wZ;
        }
        $jx = base64_encode($jN);
        SAMLSPUtilities::postSAMLRequest($qM, $jx, $tj);
        die;
        wZ:
        $R7 = plugin_dir_path(__FILE__) . "\x72\x65\163\157\165\x72\143\145\x73" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\x6b\145\x79\x2e\x6b\145\171";
        $kG = plugin_dir_path(__FILE__) . "\x72\145\x73\x6f\x75\x72\143\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\55\143\x65\x72\164\151\x66\151\143\141\164\145\x2e\x63\162\164";
        $jx = SAMLSPUtilities::signXML($jN, $kG, $R7, "\x4e\141\x6d\x65\x49\x44");
        SAMLSPUtilities::postSAMLRequest($qM, $jx, $tj);
        goto kF;
        X8:
        $SV = $qM;
        if (strpos($qM, "\x3f") !== false) {
            goto wb;
        }
        $SV .= "\x3f";
        goto mf;
        wb:
        $SV .= "\46";
        mf:
        if (!(get_option("\x73\141\155\154\137\x72\x65\x71\x75\x65\x73\164\x5f\x73\x69\x67\x6e\145\144") == "\x75\x6e\x63\x68\x65\x63\x6b\x65\x64")) {
            goto PZ;
        }
        $SV .= "\x53\x41\115\x4c\122\145\x71\x75\145\x73\x74\75" . $jN . "\x26\122\x65\154\141\171\x53\x74\x61\164\145\75" . urlencode($tj);
        header("\x4c\157\x63\x61\x74\x69\x6f\156\x3a\40" . $SV);
        die;
        PZ:
        $jN = "\x53\101\x4d\x4c\122\x65\161\x75\145\x73\164\x3d" . $jN . "\x26\122\145\154\141\x79\123\x74\141\x74\x65\75" . urlencode($tj) . "\46\123\x69\x67\x41\x6c\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA256);
        $OM = array("\164\171\x70\145" => "\160\162\151\166\x61\x74\145");
        $Yy = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $OM);
        $Mg = plugin_dir_path(__FILE__) . "\162\145\163\157\x75\162\143\145\163" . DIRECTORY_SEPARATOR . "\x73\x70\55\153\x65\x79\x2e\153\x65\171";
        $Yy->loadKey($Mg, TRUE);
        $qS = new XMLSecurityDSig();
        $om = $Yy->signData($jN);
        $om = base64_encode($om);
        $SV .= $jN . "\46\123\151\x67\156\141\164\165\162\145\75" . urlencode($om);
        header("\114\x6f\x63\x61\x74\x69\x6f\156\x3a\40" . $SV);
        die;
        kF:
        CV:
        tQ:
        aN:
    }
    function createLogoutResponseAndRedirect($qM, $Rc)
    {
        $Qm = get_option("\x6d\157\x5f\x73\x61\x6d\154\137\163\160\137\142\141\x73\145\x5f\x75\x72\154");
        if (!empty($Qm)) {
            goto Nl;
        }
        $Qm = home_url();
        Nl:
        $rv = $_SESSION["\x6d\x6f\137\x73\141\x6d\x6c\x5f\154\157\147\157\x75\x74\137\162\145\161\x75\x65\163\164"];
        $KP = $_SESSION["\x6d\157\137\x73\x61\155\154\x5f\x6c\157\147\x6f\x75\164\137\162\x65\x6c\141\171\x5f\x73\164\141\x74\x65"];
        unset($_SESSION["\x6d\157\x5f\163\x61\x6d\x6c\137\154\x6f\x67\157\165\x74\137\x72\x65\x71\165\x65\x73\164"]);
        unset($_SESSION["\x6d\x6f\x5f\x73\141\155\154\137\x6c\157\x67\157\165\164\x5f\162\x65\x6c\x61\171\137\163\164\x61\164\x65"]);
        $w3 = new DOMDocument();
        $w3->loadXML($rv);
        $rv = $w3->firstChild;
        if (!($rv->localName == "\x4c\157\147\x6f\x75\x74\x52\x65\x71\x75\x65\163\164")) {
            goto tM;
        }
        $s0 = new SAML2SPLogoutRequest($rv);
        $Wo = get_option("\155\157\x5f\163\141\x6d\154\137\163\160\137\x65\156\x74\x69\x74\171\x5f\x69\144");
        if (!empty($Wo)) {
            goto Fd;
        }
        $Wo = $Qm . "\x2f\x77\160\x2d\x63\x6f\156\x74\x65\156\164\57\160\154\x75\147\151\x6e\x73\57\x6d\x69\156\x69\157\162\x61\156\147\x65\55\x73\141\x6d\x6c\x2d\x32\60\x2d\163\151\156\147\154\145\55\163\x69\x67\156\55\x6f\x6e\x2f";
        Fd:
        $C_ = $qM;
        $HX = SAMLSPUtilities::createLogoutResponse($s0->getId(), $Wo, $C_, $Rc);
        if (empty($Rc) || $Rc == "\x48\x74\x74\160\x52\145\144\151\162\145\143\164") {
            goto bV;
        }
        if (!(get_option("\163\x61\155\154\x5f\x72\x65\x71\x75\145\163\x74\137\x73\x69\147\x6e\x65\144") == "\x75\x6e\143\x68\145\143\x6b\145\144")) {
            goto e3;
        }
        $jx = base64_encode($HX);
        SAMLSPUtilities::postSAMLResponse($qM, $jx, $KP);
        die;
        e3:
        $R7 = plugin_dir_path(__FILE__) . "\x72\x65\x73\157\165\162\x63\x65\x73" . DIRECTORY_SEPARATOR . "\163\160\x2d\x6b\145\171\x2e\x6b\145\x79";
        $kG = plugin_dir_path(__FILE__) . "\162\145\x73\157\165\x72\143\x65\x73" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\143\x65\162\164\x69\146\x69\143\141\x74\145\56\143\162\x74";
        $jx = SAMLSPUtilities::signXML($HX, $kG, $R7, "\x53\164\x61\x74\165\x73");
        SAMLSPUtilities::postSAMLResponse($qM, $jx, $KP);
        goto Ij;
        bV:
        $SV = $qM;
        if (strpos($qM, "\x3f") !== false) {
            goto NI;
        }
        $SV .= "\x3f";
        goto xd;
        NI:
        $SV .= "\46";
        xd:
        if (!(get_option("\x73\x61\x6d\x6c\137\x72\145\x71\165\145\x73\x74\x5f\x73\x69\x67\156\145\x64") == "\x75\x6e\x63\x68\145\x63\x6b\x65\x64")) {
            goto CH;
        }
        $SV .= "\123\101\x4d\x4c\x52\x65\x73\x70\x6f\x6e\x73\145\x3d" . $HX . "\46\122\145\154\141\171\x53\x74\x61\x74\145\x3d" . urlencode($KP);
        header("\114\x6f\x63\141\164\x69\x6f\156\72\x20" . $SV);
        die;
        CH:
        $jN = "\123\101\x4d\x4c\122\145\x73\x70\x6f\x6e\163\x65\75" . $HX . "\x26\122\145\154\141\x79\x53\x74\x61\x74\x65\75" . urlencode($KP) . "\46\x53\151\x67\101\154\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA256);
        $OM = array("\x74\171\160\x65" => "\160\x72\x69\166\141\164\x65");
        $Yy = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $OM);
        $Mg = plugin_dir_path(__FILE__) . "\162\145\163\157\x75\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\x2d\x6b\x65\171\56\x6b\x65\x79";
        $Yy->loadKey($Mg, TRUE);
        $qS = new XMLSecurityDSig();
        $om = $Yy->signData($jN);
        $om = base64_encode($om);
        $SV .= $jN . "\x26\x53\151\147\156\x61\164\165\162\x65\75" . urlencode($om);
        header("\x4c\x6f\x63\x61\x74\x69\x6f\x6e\x3a\x20" . $SV);
        die;
        Ij:
        tM:
    }
}
function mo_login_validate()
{
    if (!(isset($_REQUEST["\x6f\x70\x74\151\x6f\x6e"]) && $_REQUEST["\157\160\x74\x69\157\x6e"] == "\155\157\163\141\155\154\137\x6d\145\x74\141\144\x61\x74\141")) {
        goto yf;
    }
    miniorange_generate_metadata();
    yf:
    if (!mo_saml_is_customer_license_verified()) {
        goto GF;
    }
    if (!(isset($_REQUEST["\157\160\164\x69\157\x6e"]) && $_REQUEST["\157\x70\x74\151\x6f\156"] == "\x73\x61\x6d\x6c\137\165\x73\145\x72\x5f\x6c\x6f\x67\151\156" || isset($_REQUEST["\157\160\x74\151\157\x6e"]) && $_REQUEST["\157\160\x74\151\x6f\156"] == "\164\x65\163\x74\151\x64\160\143\x6f\x6e\x66\x69\147")) {
        goto Ip;
    }
    if (!(is_user_logged_in() && $_REQUEST["\157\160\164\151\x6f\156"] != "\x74\x65\163\164\x69\x64\160\x63\157\x6e\146\151\x67")) {
        goto e4;
    }
    return;
    e4:
    if (!mo_saml_is_sp_configured()) {
        goto Yg;
    }
    $Qm = get_option("\x6d\x6f\x5f\163\x61\155\x6c\137\163\160\x5f\x62\141\x73\x65\137\x75\162\154");
    if (!empty($Qm)) {
        goto Aq;
    }
    $Qm = home_url();
    Aq:
    if ($_REQUEST["\x6f\160\164\151\157\156"] == "\x74\x65\x73\x74\x69\144\160\x63\x6f\x6e\x66\x69\147") {
        goto GY;
    }
    if (get_option("\x6d\157\137\163\141\155\x6c\137\x72\145\154\141\x79\x5f\x73\x74\x61\x74\145") && get_option("\x6d\x6f\137\163\x61\x6d\x6c\137\x72\145\154\x61\x79\x5f\x73\164\141\164\x65") != '') {
        goto BW;
    }
    if (isset($_REQUEST["\x72\x65\x64\x69\x72\145\x63\x74\x5f\164\157"])) {
        goto aF;
    }
    $tj = $Qm;
    goto hn;
    aF:
    $tj = $_REQUEST["\162\x65\x64\151\162\145\x63\x74\137\x74\157"];
    hn:
    goto xS;
    BW:
    $tj = get_option("\155\157\x5f\163\x61\155\154\x5f\162\x65\154\x61\x79\x5f\163\164\141\164\x65");
    xS:
    goto kQ;
    GY:
    $tj = "\x74\145\163\x74\126\x61\154\x69\144\x61\x74\x65";
    kQ:
    if (get_option("\x6d\157\137\163\x61\155\154\137\145\x6e\x61\x62\x6c\145\137\x63\154\x6f\x75\x64\x5f\x62\x72\157\153\x65\x72") == "\146\141\x6c\x73\145") {
        goto rk;
    }
    $JV = get_option("\x6d\157\137\163\141\x6d\x6c\x5f\150\x6f\163\164\x5f\x6e\141\155\145") . "\x2f\x6d\157\141\x73\57\162\145\x73\164\x2f\163\x61\155\154\57\x72\145\x71\x75\x65\x73\164\x3f\151\144\x3d" . get_option("\155\x6f\137\x73\x61\155\154\137\x61\144\x6d\x69\156\137\143\x75\163\x74\x6f\x6d\145\x72\x5f\x6b\145\x79") . "\x26\x72\x65\164\x75\x72\x6e\165\162\x6c\x3d" . urlencode(home_url() . "\57\77\x6f\160\164\x69\157\156\75\x72\145\141\x64\x73\141\155\154\154\x6f\x67\151\156\x26\x72\x65\144\151\162\145\143\x74\x5f\164\157\x3d" . urlencode($tj));
    header("\x4c\x6f\x63\x61\x74\x69\x6f\x6e\72\x20" . $JV);
    die;
    goto A9;
    rk:
    $rA = get_option("\x73\141\155\154\x5f\x6c\157\x67\x69\156\x5f\165\x72\x6c");
    $N8 = get_option("\x73\x61\x6d\154\137\x6c\157\147\x69\x6e\137\x62\x69\156\144\151\x6e\x67\137\164\171\160\145");
    $bW = get_option("\155\x6f\x5f\x73\x61\155\x6c\x5f\x66\157\x72\x63\x65\137\x61\165\x74\150\x65\156\x74\x69\x63\141\164\151\x6f\x6e");
    $th = $Qm . "\57";
    $Wo = get_option("\x6d\157\137\x73\141\x6d\154\137\x73\160\137\145\x6e\x74\x69\164\171\x5f\151\144");
    if (!empty($Wo)) {
        goto gn;
    }
    $Wo = $Qm . "\x2f\167\x70\55\143\x6f\x6e\x74\x65\x6e\x74\57\x70\x6c\x75\147\151\x6e\163\x2f\155\151\x6e\151\x6f\162\141\156\x67\145\x2d\x73\x61\155\x6c\55\62\60\x2d\163\151\156\x67\x6c\145\55\163\x69\147\x6e\x2d\157\x6e\x2f";
    gn:
    $jN = SAMLSPUtilities::createAuthnRequest($th, $Wo, $rA, $bW, $N8);
    $SV = $rA;
    if (strpos($rA, "\77") !== false) {
        goto FH;
    }
    $SV .= "\77";
    goto I2;
    FH:
    $SV .= "\x26";
    I2:
    if (empty($N8) || $N8 == "\110\x74\164\x70\122\x65\x64\x69\162\145\143\x74") {
        goto Wi;
    }
    if (!(get_option("\x73\141\x6d\x6c\137\x72\145\161\165\x65\163\164\x5f\x73\151\147\156\x65\x64") == "\165\x6e\x63\x68\x65\x63\153\x65\144")) {
        goto xq;
    }
    $jx = base64_encode($jN);
    SAMLSPUtilities::postSAMLRequest($rA, $jx, $tj);
    die;
    xq:
    $R7 = plugin_dir_path(__FILE__) . "\x72\x65\163\157\165\162\x63\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\x2d\x6b\x65\x79\56\153\145\171";
    $kG = plugin_dir_path(__FILE__) . "\162\x65\x73\157\165\x72\x63\145\x73" . DIRECTORY_SEPARATOR . "\x73\160\x2d\x63\x65\x72\164\x69\x66\151\x63\141\x74\x65\x2e\x63\162\x74";
    $jx = SAMLSPUtilities::signXML($jN, $kG, $R7, "\x4e\141\x6d\145\111\x44\x50\x6f\x6c\151\x63\x79");
    SAMLSPUtilities::postSAMLRequest($rA, $jx, $tj);
    goto nG;
    Wi:
    if (!(get_option("\x73\141\155\x6c\137\162\x65\x71\165\x65\163\x74\137\x73\x69\147\156\x65\144") == "\165\x6e\143\x68\x65\x63\x6b\145\144")) {
        goto dd;
    }
    $SV .= "\x53\101\115\x4c\x52\x65\161\165\145\163\x74\x3d" . $jN . "\x26\x52\145\x6c\141\x79\123\164\x61\x74\145\x3d" . urlencode($tj);
    header("\114\x6f\x63\x61\x74\x69\157\156\x3a\x20" . $SV);
    die;
    dd:
    $jN = "\123\x41\x4d\x4c\x52\x65\161\x75\145\163\164\75" . $jN . "\46\122\145\x6c\141\x79\123\x74\141\x74\145\75" . urlencode($tj) . "\46\x53\x69\147\101\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA256);
    $OM = array("\x74\x79\160\x65" => "\160\162\151\x76\x61\164\x65");
    $Yy = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $OM);
    $Mg = plugin_dir_path(__FILE__) . "\x72\145\x73\157\x75\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\55\x6b\145\x79\56\x6b\145\171";
    $Yy->loadKey($Mg, TRUE);
    $qS = new XMLSecurityDSig();
    $om = $Yy->signData($jN);
    $om = base64_encode($om);
    $SV .= $jN . "\x26\123\151\147\x6e\x61\164\165\162\x65\75" . urlencode($om);
    if (!(get_option("\x6d\x6f\137\163\141\x6d\x6c\137\145\x6e\x61\142\x6c\145\137\143\x6c\x6f\165\144\x5f\x62\x72\x6f\153\x65\x72") == "\164\x72\x75\x65")) {
        goto B8;
    }
    $SV = get_option("\155\x6f\137\x73\141\x6d\x6c\137\150\x6f\163\164\x5f\156\141\155\145") . "\57\155\x6f\141\163\57\x72\x65\163\x74\57\163\141\155\x6c\57\x72\x65\x71\165\145\x73\164\x3f\x69\144\75" . get_option("\155\x6f\137\163\141\155\154\x5f\x61\144\x6d\x69\156\137\143\165\x73\164\x6f\x6d\145\x72\137\x6b\x65\x79") . "\x26\x72\145\x74\x75\162\x6e\165\x72\x6c\x3d" . urlencode(site_url() . "\x2f\77\157\160\x74\x69\x6f\x6e\75\162\x65\141\144\163\x61\x6d\154\154\x6f\147\x69\x6e\46\162\x65\144\x69\162\x65\143\164\137\x74\157\x3d" . urlencode($tj));
    B8:
    header("\114\157\x63\x61\x74\151\157\x6e\x3a\x20" . $SV);
    die;
    nG:
    A9:
    Yg:
    Ip:
    if (!(array_key_exists("\123\101\x4d\114\x52\145\163\x70\x6f\156\163\x65", $_REQUEST) && !empty($_REQUEST["\123\101\x4d\x4c\x52\145\x73\x70\x6f\156\x73\x65"]))) {
        goto sD;
    }
    $Qm = get_option("\155\x6f\x5f\x73\x61\155\154\x5f\163\160\137\142\141\163\x65\x5f\x75\162\154");
    if (!empty($Qm)) {
        goto AO;
    }
    $Qm = home_url();
    AO:
    $X3 = $_REQUEST["\123\x41\115\114\122\x65\x73\160\157\x6e\163\145"];
    $X3 = base64_decode($X3);
    if (!(array_key_exists("\123\101\115\114\122\145\x73\160\x6f\156\163\145", $_GET) && !empty($_GET["\x53\x41\115\x4c\122\145\163\160\x6f\x6e\x73\145"]))) {
        goto gG;
    }
    $X3 = gzinflate($X3);
    gG:
    $w3 = new DOMDocument();
    $w3->loadXML($X3);
    $DJ = $w3->firstChild;
    $mZ = $w3->documentElement;
    $yg = new DOMXpath($w3);
    $yg->registerNamespace("\x73\141\155\x6c\160", "\x75\x72\x6e\72\x6f\141\163\151\163\72\156\x61\x6d\x65\x73\x3a\x74\143\x3a\123\101\115\x4c\72\x32\56\60\x3a\x70\x72\157\164\157\143\x6f\154");
    $yg->registerNamespace("\x73\141\x6d\x6c", "\165\162\156\x3a\157\x61\x73\x69\x73\x3a\x6e\141\155\145\163\72\164\x63\x3a\x53\101\x4d\x4c\72\62\x2e\x30\72\141\x73\163\x65\162\x74\x69\157\156");
    if ($DJ->localName == "\114\157\x67\x6f\165\164\x52\x65\x73\160\x6f\x6e\x73\145") {
        goto Dn;
    }
    $E7 = $yg->query("\x2f\163\x61\155\x6c\160\x3a\x52\x65\x73\x70\157\x6e\x73\145\x2f\x73\x61\x6d\154\x70\x3a\123\x74\141\164\x75\163\57\163\141\155\x6c\160\72\x53\x74\141\164\165\163\x43\x6f\144\x65", $mZ);
    $Bu = $E7->item(0)->getAttribute("\126\x61\x6c\165\x65");
    $h_ = explode("\72", $Bu);
    $E7 = $h_[7];
    if (array_key_exists("\x52\145\154\141\x79\x53\x74\141\x74\x65", $_POST) && !empty($_POST["\x52\145\154\x61\171\x53\164\x61\x74\145"]) && $_POST["\122\x65\154\141\x79\123\164\141\x74\x65"] != "\x2f") {
        goto dm;
    }
    $zQ = '';
    goto n3;
    dm:
    $zQ = $_POST["\122\145\x6c\x61\x79\x53\x74\141\164\145"];
    n3:
    if (!($E7 != "\123\x75\x63\x63\x65\163\x73")) {
        goto ar;
    }
    show_status_error($E7, $zQ);
    ar:
    $l7 = maybe_unserialize(get_option("\x73\141\155\x6c\137\x78\65\60\71\137\143\145\162\164\x69\x66\151\143\x61\x74\x65"));
    $th = $Qm . "\57";
    $X3 = new SAML2SPResponse($DJ);
    $d9 = $X3->getSignatureData();
    $Sm = current($X3->getAssertions())->getSignatureData();
    if (!(empty($Sm) && empty($d9))) {
        goto k9;
    }
    echo "\x4e\157\40\x73\x69\x67\x6e\141\x74\165\x72\x65\x20\146\x6f\x75\156\144\x20\x69\x6e\40\123\x41\x4d\x4c\x20\122\145\x73\x70\157\x6e\x73\145\x20\x6f\162\40\x41\x73\163\x65\x72\164\x69\157\x6e\56\40\120\154\x65\x61\163\x65\x20\x73\x69\x67\x6e\x20\x61\164\40\154\145\141\x73\x74\40\x6f\156\x65\40\x6f\x66\x20\164\x68\x65\155\56";
    die;
    k9:
    if (is_array($l7)) {
        goto OW;
    }
    $Xe = XMLSecurityKey::getRawThumbprint($l7);
    $Xe = iconv("\125\x54\106\55\x38", "\103\x50\61\62\x35\x32\x2f\57\x49\x47\x4e\117\122\x45", $Xe);
    $Xe = preg_replace("\57\134\x73\x2b\57", '', $Xe);
    if (empty($d9)) {
        goto Y0;
    }
    $Gt = SAMLSPUtilities::processResponse($th, $Xe, $d9, $X3, 0, $zQ);
    Y0:
    if (empty($Sm)) {
        goto hw;
    }
    $Gt = SAMLSPUtilities::processResponse($th, $Xe, $Sm, $X3, 0, $zQ);
    hw:
    goto xg;
    OW:
    foreach ($l7 as $Yy => $Xb) {
        $Xe = XMLSecurityKey::getRawThumbprint($Xb);
        $Xe = iconv("\125\x54\106\55\x38", "\103\x50\61\62\65\62\57\57\111\107\x4e\117\122\105", $Xe);
        $Xe = preg_replace("\57\134\163\53\57", '', $Xe);
        if (empty($d9)) {
            goto bh;
        }
        $Gt = SAMLSPUtilities::processResponse($th, $Xe, $d9, $X3, $Yy, $zQ);
        bh:
        if (empty($Sm)) {
            goto xb;
        }
        $Gt = SAMLSPUtilities::processResponse($th, $Xe, $Sm, $X3, $Yy, $zQ);
        xb:
        if (!$Gt) {
            goto m5;
        }
        goto Lq;
        m5:
        Dy:
    }
    Lq:
    xg:
    if ($d9) {
        goto AC;
    }
    if ($Sm) {
        goto zG;
    }
    goto of;
    AC:
    $nz = $d9["\x43\x65\x72\x74\x69\146\151\x63\141\164\145\x73"][0];
    goto of;
    zG:
    $nz = $Sm["\x43\145\162\164\x69\146\x69\143\x61\164\145\x73"][0];
    of:
    if ($Gt) {
        goto SD;
    }
    if ($zQ == "\164\145\x73\x74\x56\141\x6c\x69\144\x61\164\145") {
        goto QE;
    }
    wp_die("\x57\x65\40\143\157\x75\154\144\x20\156\x6f\164\x20\x73\151\x67\x6e\40\171\x6f\165\x20\x69\156\x2e\40\x50\x6c\x65\x61\163\x65\40\143\157\x6e\164\x61\143\164\40\x61\144\155\x69\156\x69\x73\x74\x72\x61\164\x6f\x72", "\x45\162\162\x6f\162\72\x20\x49\x6e\x76\141\x6c\x69\144\40\123\101\115\x4c\x20\122\x65\x73\x70\157\x6e\163\x65");
    goto WA;
    QE:
    $EM = "\x2d\55\x2d\55\x2d\102\105\107\111\116\x20\x43\105\122\x54\x49\106\111\103\x41\x54\x45\x2d\x2d\55\x2d\55\x3c\142\162\76" . chunk_split($nz, 64) . "\74\x62\162\76\55\x2d\x2d\55\55\x45\116\104\40\103\x45\x52\x54\x49\106\111\x43\x41\x54\105\55\x2d\55\x2d\55";
    echo "\74\x64\151\166\40\163\x74\171\154\145\75\x22\x66\x6f\x6e\164\x2d\x66\141\155\x69\x6c\x79\72\x43\141\154\151\142\x72\151\x3b\x70\x61\x64\x64\151\156\147\72\x30\x20\63\x25\x3b\42\x3e";
    echo "\x3c\144\x69\x76\40\x73\164\171\154\145\x3d\42\x63\157\154\x6f\162\72\40\x23\141\71\64\64\x34\x32\73\142\141\x63\x6b\147\162\157\x75\x6e\144\x2d\x63\x6f\154\x6f\x72\72\40\43\146\62\144\145\144\145\x3b\x70\x61\144\144\151\156\147\x3a\40\x31\x35\x70\x78\x3b\x6d\x61\x72\x67\151\156\55\142\157\164\x74\x6f\155\x3a\x20\62\60\160\170\73\x74\145\170\x74\55\141\154\x69\x67\156\x3a\x63\145\156\164\145\162\x3b\142\x6f\162\x64\x65\162\x3a\61\160\170\40\163\157\x6c\x69\144\40\43\x45\66\x42\x33\x42\x32\73\x66\x6f\x6e\164\x2d\x73\x69\x7a\145\72\x31\x38\160\x74\x3b\42\76\40\x45\x52\122\x4f\122\x3c\57\x64\x69\x76\x3e\12\x9\11\11\74\x64\151\166\x20\x73\164\171\x6c\x65\75\42\143\x6f\154\x6f\x72\72\40\43\141\x39\x34\64\64\62\x3b\146\x6f\156\164\x2d\x73\151\x7a\145\x3a\x31\64\160\x74\x3b\x20\x6d\x61\x72\147\x69\156\x2d\x62\157\x74\164\157\155\x3a\62\60\x70\x78\73\42\x3e\74\160\x3e\x3c\163\164\x72\157\156\147\x3e\105\x72\x72\157\x72\x3a\x20\x3c\57\163\x74\162\x6f\x6e\x67\76\x55\156\141\142\x6c\145\x20\164\x6f\40\x66\x69\x6e\144\x20\141\40\143\x65\162\x74\x69\146\x69\x63\141\x74\145\x20\x6d\x61\164\143\x68\151\x6e\x67\40\164\x68\x65\x20\143\157\x6e\x66\151\147\165\x72\x65\144\x20\x66\x69\x6e\147\145\x72\160\x72\x69\x6e\x74\56\x3c\57\160\x3e\xa\11\x9\x9\x3c\x70\76\120\x6c\145\x61\163\x65\40\143\157\156\164\x61\x63\x74\x20\171\157\x75\162\x20\141\144\x6d\x69\x6e\x69\x73\164\x72\x61\164\157\162\40\141\x6e\144\x20\162\145\160\x6f\162\164\x20\164\x68\145\x20\x66\157\x6c\x6c\x6f\167\151\156\147\40\145\162\162\x6f\162\72\74\x2f\160\x3e\12\x9\11\11\x3c\x70\x3e\74\x73\x74\x72\x6f\x6e\147\76\x50\x6f\163\163\151\x62\x6c\145\40\x43\x61\165\163\x65\72\x20\74\57\x73\164\x72\x6f\x6e\x67\76\47\x58\x2e\65\x30\71\x20\x43\x65\162\x74\151\146\151\x63\141\x74\145\x27\x20\146\151\145\x6c\x64\40\x69\x6e\x20\160\x6c\165\147\x69\x6e\x20\x64\x6f\145\x73\40\x6e\x6f\x74\40\155\141\x74\x63\150\x20\x74\x68\145\x20\143\145\x72\x74\x69\146\151\x63\x61\164\145\40\x66\x6f\165\156\x64\40\x69\156\40\x53\101\115\x4c\x20\x52\145\x73\160\157\x6e\163\145\56\74\x2f\x70\x3e\xa\11\x9\11\x3c\x70\76\x3c\163\x74\162\157\x6e\147\x3e\103\x65\162\x74\x69\x66\x69\143\x61\164\x65\x20\x66\x6f\165\156\x64\40\151\156\40\123\x41\115\x4c\40\122\x65\x73\160\157\156\163\145\72\40\x3c\57\x73\164\x72\x6f\156\x67\76\x3c\146\x6f\x6e\164\x20\x66\x61\x63\x65\x3d\x22\x43\157\x75\x72\x69\145\x72\x20\116\x65\167\42\x3b\146\157\x6e\164\x2d\163\151\172\145\72\61\60\x70\x74\76\x3c\x62\x72\76\x3c\x62\x72\76" . $EM . "\74\x2f\160\76\x3c\x2f\146\157\x6e\x74\x3e\xa\11\11\11\11\x9\74\57\144\151\166\76\12\11\11\11\11\11\74\144\x69\166\40\x73\164\171\154\x65\75\42\155\141\x72\147\x69\156\72\63\x25\x3b\x64\x69\x73\x70\154\x61\x79\72\142\154\x6f\x63\x6b\x3b\x74\x65\170\x74\55\x61\154\151\x67\156\x3a\x63\145\156\164\x65\162\73\42\76\12\11\11\11\11\11\74\146\x6f\162\x6d\40\x61\143\x74\151\x6f\156\x3d\x22\151\156\x64\x65\170\56\160\150\160\42\x3e\xa\x9\11\11\x9\x9\x3c\144\151\x76\40\163\x74\171\154\x65\x3d\x22\155\x61\x72\147\151\156\72\x33\x25\x3b\144\151\163\x70\154\141\171\72\x62\154\157\143\x6b\73\164\x65\x78\x74\55\141\x6c\x69\x67\156\72\x63\x65\156\x74\145\x72\x3b\42\76\x3c\x69\156\x70\x75\x74\40\x73\164\x79\154\145\75\42\160\x61\144\x64\151\156\147\x3a\x31\45\x3b\167\151\144\x74\x68\72\61\60\x30\160\170\x3b\142\141\x63\153\x67\162\x6f\165\156\x64\72\40\43\x30\x30\x39\x31\x43\x44\40\x6e\x6f\x6e\x65\40\x72\x65\160\145\x61\x74\40\x73\x63\x72\x6f\x6c\x6c\40\60\x25\x20\x30\45\x3b\143\x75\162\163\x6f\x72\x3a\40\x70\x6f\x69\156\x74\x65\162\73\146\157\156\x74\x2d\x73\151\172\145\72\61\65\160\x78\73\x62\x6f\162\x64\145\162\x2d\167\151\144\x74\x68\x3a\x20\x31\x70\170\73\142\x6f\x72\x64\x65\x72\55\163\x74\x79\x6c\145\x3a\x20\163\157\154\151\x64\x3b\142\157\162\x64\x65\162\55\x72\x61\144\x69\x75\x73\x3a\40\63\x70\170\73\167\150\x69\164\145\x2d\163\160\x61\143\x65\72\40\156\157\x77\162\x61\x70\73\x62\157\x78\x2d\x73\x69\x7a\151\x6e\147\x3a\x20\x62\157\162\x64\145\162\x2d\142\157\x78\x3b\x62\157\162\144\145\x72\55\143\157\x6c\157\x72\72\x20\43\x30\60\x37\63\101\101\x3b\x62\157\x78\x2d\x73\150\x61\x64\157\167\72\x20\60\x70\170\40\61\160\170\x20\x30\160\x78\x20\x72\147\142\141\50\61\62\60\54\40\x32\60\x30\x2c\40\62\x33\60\54\40\60\x2e\66\51\40\x69\x6e\x73\145\164\73\143\x6f\154\x6f\162\72\40\43\x46\x46\106\x3b\x22\164\x79\160\x65\75\x22\x62\165\164\x74\157\x6e\42\40\166\x61\x6c\x75\145\x3d\x22\104\x6f\x6e\x65\42\x20\x6f\x6e\103\x6c\151\x63\153\75\x22\x73\145\154\146\56\x63\154\x6f\x73\145\50\51\x3b\42\x3e\74\57\144\x69\x76\76";
    die;
    WA:
    SD:
    $TX = get_option("\163\x61\155\x6c\x5f\151\x73\x73\x75\x65\162");
    $Wo = get_option("\155\x6f\x5f\163\x61\155\x6c\x5f\163\160\137\x65\156\x74\x69\x74\x79\137\x69\x64");
    if (!empty($Wo)) {
        goto xt;
    }
    $Wo = $Qm . "\57\x77\160\x2d\x63\x6f\x6e\x74\x65\x6e\164\x2f\160\154\165\147\x69\x6e\x73\x2f\155\x69\156\151\x6f\x72\141\x6e\147\145\55\x73\x61\x6d\x6c\55\62\x30\x2d\163\x69\x6e\x67\x6c\145\55\163\151\147\x6e\x2d\157\156\x2f";
    xt:
    SAMLSPUtilities::validateIssuerAndAudience($X3, $Wo, $TX, $zQ);
    $a0 = current(current($X3->getAssertions())->getNameId());
    $Lp = current($X3->getAssertions())->getAttributes();
    $Lp["\x4e\141\155\145\111\104"] = array("\x30" => $a0);
    $OF = current($X3->getAssertions())->getSessionIndex();
    mo_saml_checkMapping($Lp, $zQ, $OF);
    goto u8;
    Dn:
    wp_logout();
    header("\x4c\157\143\141\164\x69\x6f\x6e\72\x20" . home_url());
    die;
    u8:
    sD:
    if (!(array_key_exists("\123\x41\115\x4c\122\x65\x71\165\145\x73\x74", $_REQUEST) && !empty($_REQUEST["\x53\101\x4d\114\x52\x65\161\x75\x65\x73\x74"]))) {
        goto ck;
    }
    $jN = $_REQUEST["\x53\101\115\x4c\x52\x65\x71\x75\145\163\164"];
    $zQ = "\x2f";
    if (!array_key_exists("\122\145\x6c\141\x79\x53\x74\141\164\145", $_REQUEST)) {
        goto Of;
    }
    $zQ = $_REQUEST["\122\145\154\x61\x79\123\164\141\164\145"];
    Of:
    $jN = base64_decode($jN);
    if (!(array_key_exists("\x53\101\x4d\x4c\x52\x65\161\165\x65\x73\x74", $_GET) && !empty($_GET["\x53\x41\x4d\114\x52\145\x71\x75\145\163\164"]))) {
        goto Z3;
    }
    $jN = gzinflate($jN);
    Z3:
    $w3 = new DOMDocument();
    $w3->loadXML($jN);
    $M1 = $w3->firstChild;
    if (!($M1->localName == "\x4c\157\x67\x6f\165\164\x52\x65\x71\x75\145\x73\164")) {
        goto nb;
    }
    $s0 = new SAML2SPLogoutRequest($M1);
    if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
        goto cU;
    }
    session_start();
    cU:
    $_SESSION["\x6d\x6f\137\163\141\155\154\x5f\154\157\x67\157\165\164\x5f\x72\145\161\x75\145\x73\164"] = $jN;
    $_SESSION["\155\x6f\137\x73\x61\155\x6c\x5f\154\157\x67\x6f\165\164\137\162\x65\x6c\x61\x79\137\x73\164\x61\164\145"] = $zQ;
    wp_logout();
    nb:
    ck:
    if (!(isset($_REQUEST["\x6f\x70\x74\151\x6f\156"]) and strpos($_REQUEST["\157\x70\164\151\x6f\156"], "\162\x65\141\x64\x73\x61\x6d\x6c\154\x6f\x67\151\x6e") !== false)) {
        goto yj;
    }
    require_once dirname(__FILE__) . "\57\x69\156\x63\x6c\x75\x64\145\x73\57\154\151\142\x2f\145\x6e\143\x72\171\160\x74\x69\157\x6e\56\160\150\160";
    if (isset($_POST["\123\x54\101\124\x55\123"]) && $_POST["\x53\124\101\124\125\123"] == "\105\122\x52\x4f\x52") {
        goto Wj;
    }
    if (!(isset($_POST["\x53\124\101\124\x55\123"]) && $_POST["\x53\124\101\124\x55\x53"] == "\123\125\x43\x43\105\x53\123")) {
        goto Bo;
    }
    $xR = '';
    if (!(isset($_REQUEST["\x72\145\144\151\x72\x65\143\x74\x5f\x74\x6f"]) && !empty($_REQUEST["\x72\145\144\151\x72\x65\143\164\137\164\157"]) && $_REQUEST["\x72\145\144\x69\162\145\143\164\137\x74\157"] != "\57")) {
        goto c4;
    }
    $xR = $_REQUEST["\162\145\x64\x69\162\x65\x63\x74\x5f\164\157"];
    c4:
    delete_option("\x6d\x6f\x5f\x73\141\155\x6c\137\x72\145\144\151\162\x65\143\x74\x5f\145\x72\162\157\162\x5f\x63\x6f\x64\x65");
    delete_option("\x6d\x6f\137\x73\141\155\x6c\137\x72\x65\144\x69\162\x65\143\x74\137\145\162\162\x6f\x72\x5f\162\x65\x61\x73\x6f\156");
    try {
        $vJ = get_option("\163\141\x6d\154\x5f\141\155\137\x65\x6d\x61\x69\154");
        $Mz = get_option("\163\x61\x6d\154\x5f\x61\x6d\137\165\x73\145\x72\156\141\155\x65");
        $Jq = get_option("\163\x61\155\154\x5f\x61\155\x5f\146\151\x72\x73\164\x5f\x6e\x61\155\x65");
        $b0 = get_option("\x73\141\x6d\x6c\137\x61\155\x5f\154\x61\163\164\x5f\156\x61\x6d\x65");
        $br = get_option("\x73\141\155\x6c\x5f\x61\x6d\x5f\147\x72\x6f\x75\160\137\x6e\x61\155\x65");
        $Vm = get_option("\163\x61\155\154\x5f\x61\x6d\137\x64\145\x66\x61\165\x6c\x74\x5f\165\163\145\162\x5f\162\157\x6c\x65");
        $o8 = get_option("\163\x61\x6d\x6c\137\x61\x6d\137\x64\157\x6e\x74\137\141\154\x6c\157\167\137\x75\156\154\x69\x73\164\145\144\137\x75\163\x65\x72\137\162\x6f\x6c\145");
        $g3 = get_option("\x73\x61\155\154\x5f\141\155\137\x61\143\x63\157\x75\x6e\164\x5f\x6d\x61\x74\143\150\x65\x72");
        $uj = '';
        $kV = '';
        $Jq = str_replace("\x2e", "\x5f", $Jq);
        $Jq = str_replace("\40", "\137", $Jq);
        if (!(!empty($Jq) && array_key_exists($Jq, $_POST))) {
            goto Qe;
        }
        $Jq = $_POST[$Jq];
        Qe:
        $b0 = str_replace("\56", "\x5f", $b0);
        $b0 = str_replace("\x20", "\x5f", $b0);
        if (!(!empty($b0) && array_key_exists($b0, $_POST))) {
            goto p2;
        }
        $b0 = $_POST[$b0];
        p2:
        $Mz = str_replace("\x2e", "\137", $Mz);
        $Mz = str_replace("\40", "\137", $Mz);
        if (!empty($Mz) && array_key_exists($Mz, $_POST)) {
            goto Kz;
        }
        $kV = $_POST["\x4e\141\x6d\x65\x49\104"];
        goto nP;
        Kz:
        $kV = $_POST[$Mz];
        nP:
        $uj = str_replace("\56", "\x5f", $vJ);
        $uj = str_replace("\x20", "\x5f", $vJ);
        if (!empty($vJ) && array_key_exists($vJ, $_POST)) {
            goto lN;
        }
        $uj = $_POST["\x4e\x61\155\145\x49\x44"];
        goto kT;
        lN:
        $uj = $_POST[$vJ];
        kT:
        $br = str_replace("\56", "\x5f", $br);
        $br = str_replace("\40", "\x5f", $br);
        if (!(!empty($br) && array_key_exists($br, $_POST))) {
            goto WS;
        }
        $br = $_POST[$br];
        WS:
        if (!empty($g3)) {
            goto QL;
        }
        $g3 = "\145\x6d\141\x69\154";
        QL:
        $Yy = get_option("\x6d\x6f\137\163\141\155\154\x5f\143\165\x73\x74\x6f\x6d\x65\162\137\164\157\x6b\145\156");
        if (!(isset($Yy) || trim($Yy) != '')) {
            goto kV;
        }
        $wb = AESEncryption::decrypt_data($uj, $Yy);
        $uj = $wb;
        kV:
        if (!(!empty($Jq) && !empty($Yy))) {
            goto fm;
        }
        $o_ = AESEncryption::decrypt_data($Jq, $Yy);
        $Jq = $o_;
        fm:
        if (!(!empty($b0) && !empty($Yy))) {
            goto np;
        }
        $l2 = AESEncryption::decrypt_data($b0, $Yy);
        $b0 = $l2;
        np:
        if (!(!empty($kV) && !empty($Yy))) {
            goto CY;
        }
        $cB = AESEncryption::decrypt_data($kV, $Yy);
        $kV = $cB;
        CY:
        if (!(!empty($br) && !empty($Yy))) {
            goto Et;
        }
        $iB = AESEncryption::decrypt_data($br, $Yy);
        $br = $iB;
        Et:
    } catch (Exception $sK) {
        echo sprintf("\101\x6e\x20\x65\162\x72\x6f\x72\40\x6f\x63\143\165\x72\x72\x65\x64\40\167\150\151\154\145\40\x70\x72\157\143\145\163\x73\151\156\147\x20\164\150\145\40\123\x41\x4d\114\40\x52\x65\163\160\157\x6e\x73\x65\56");
        die;
    }
    $lG = array($br);
    mo_saml_login_user($uj, $Jq, $b0, $kV, $lG, $o8, $Vm, $xR, $g3);
    Bo:
    goto n2;
    Wj:
    update_option("\155\x6f\x5f\x73\141\x6d\x6c\137\162\145\144\151\162\145\143\164\x5f\x65\x72\162\x6f\x72\x5f\143\x6f\144\x65", $_POST["\x45\x52\x52\x4f\x52\x5f\122\x45\101\x53\x4f\116"]);
    update_option("\155\x6f\x5f\163\x61\155\x6c\x5f\x72\145\144\x69\162\x65\143\164\137\145\162\162\157\162\137\162\145\141\163\157\x6e", $_POST["\105\122\x52\117\122\x5f\115\x45\123\x53\101\107\105"]);
    n2:
    yj:
    GF:
}
function mo_saml_checkMapping($Lp, $zQ, $OF)
{
    try {
        $vJ = get_option("\x73\141\155\x6c\137\x61\x6d\x5f\x65\155\141\x69\154");
        $Mz = get_option("\163\x61\155\x6c\x5f\x61\155\137\165\163\x65\162\156\141\x6d\145");
        $Jq = get_option("\163\141\x6d\x6c\137\141\155\x5f\146\151\x72\x73\x74\x5f\156\x61\x6d\x65");
        $b0 = get_option("\163\x61\155\x6c\137\x61\155\137\154\x61\x73\164\x5f\x6e\x61\x6d\145");
        $br = get_option("\163\x61\x6d\x6c\137\141\155\x5f\147\162\157\165\x70\137\156\141\x6d\145");
        $Vm = get_option("\x73\141\x6d\x6c\137\141\x6d\137\144\x65\x66\x61\x75\154\x74\x5f\x75\x73\145\162\137\x72\157\x6c\145");
        $o8 = get_option("\x73\141\155\154\137\x61\155\x5f\x64\x6f\x6e\164\x5f\x61\x6c\154\x6f\x77\137\x75\x6e\x6c\x69\163\x74\x65\x64\x5f\165\163\x65\x72\137\162\x6f\x6c\145");
        $g3 = get_option("\163\x61\x6d\x6c\x5f\x61\x6d\137\141\143\x63\x6f\165\156\164\x5f\x6d\141\x74\x63\150\145\162");
        $uj = '';
        $kV = '';
        if (empty($Lp)) {
            goto YL;
        }
        if (!empty($Jq) && array_key_exists($Jq, $Lp)) {
            goto KM;
        }
        $Jq = '';
        goto lR;
        KM:
        $Jq = $Lp[$Jq][0];
        lR:
        if (!empty($b0) && array_key_exists($b0, $Lp)) {
            goto vI;
        }
        $b0 = '';
        goto OV;
        vI:
        $b0 = $Lp[$b0][0];
        OV:
        if (!empty($Mz) && array_key_exists($Mz, $Lp)) {
            goto UJ;
        }
        $kV = $Lp["\116\141\155\x65\111\104"][0];
        goto Wb;
        UJ:
        $kV = $Lp[$Mz][0];
        Wb:
        if (!empty($vJ) && array_key_exists($vJ, $Lp)) {
            goto D5;
        }
        $uj = $Lp["\x4e\141\x6d\145\111\x44"][0];
        goto jE;
        D5:
        $uj = $Lp[$vJ][0];
        jE:
        if (!empty($br) && array_key_exists($br, $Lp)) {
            goto s5;
        }
        $br = array();
        goto mk;
        s5:
        $br = $Lp[$br];
        mk:
        if (!empty($g3)) {
            goto Ut;
        }
        $g3 = "\145\155\x61\x69\154";
        Ut:
        YL:
        if ($zQ == "\x74\x65\x73\164\x56\x61\154\151\x64\x61\x74\x65") {
            goto ri;
        }
        mo_saml_login_user($uj, $Jq, $b0, $kV, $br, $o8, $Vm, $zQ, $g3, $OF, $Lp["\116\x61\155\x65\x49\x44"][0], $Lp);
        goto QD;
        ri:
        mo_saml_show_test_result($Jq, $b0, $uj, $br, $Lp);
        QD:
    } catch (Exception $sK) {
        echo sprintf("\101\156\x20\145\x72\162\x6f\x72\40\x6f\143\143\x75\x72\x72\145\144\x20\167\x68\151\x6c\145\40\160\162\x6f\x63\x65\163\x73\151\156\147\x20\x74\x68\x65\40\123\x41\115\x4c\x20\122\x65\x73\x70\x6f\156\x73\x65\x2e");
        die;
    }
}
function mo_saml_show_test_result($Jq, $b0, $uj, $br, $Lp)
{
    echo "\74\144\x69\166\40\163\x74\x79\154\x65\75\x22\146\x6f\x6e\x74\55\146\x61\x6d\x69\x6c\x79\72\103\141\x6c\151\x62\x72\151\x3b\x70\x61\144\144\151\x6e\147\x3a\60\40\63\45\x3b\x22\76";
    if (!empty($uj)) {
        goto t_;
    }
    echo "\x3c\144\151\x76\x20\163\x74\x79\154\145\75\x22\x63\157\x6c\x6f\162\x3a\40\43\141\x39\64\64\x34\62\73\x62\x61\x63\x6b\147\x72\x6f\x75\156\x64\x2d\x63\157\x6c\157\162\72\40\x23\x66\62\x64\145\x64\145\x3b\x70\x61\x64\144\x69\156\x67\x3a\40\x31\65\160\170\73\x6d\x61\x72\147\x69\x6e\55\142\157\x74\x74\x6f\155\72\x20\62\x30\160\170\73\164\x65\170\164\x2d\x61\x6c\x69\x67\x6e\72\x63\145\156\x74\x65\162\x3b\x62\157\162\x64\145\162\72\x31\160\x78\40\163\157\x6c\x69\x64\40\43\105\x36\102\63\102\62\73\146\x6f\x6e\x74\55\163\151\x7a\x65\x3a\x31\x38\x70\164\73\42\76\124\105\x53\124\x20\x46\101\111\x4c\x45\104\x3c\57\144\x69\x76\76\12\x9\x9\11\11\74\x64\x69\166\40\163\164\x79\x6c\x65\75\x22\143\157\x6c\157\162\72\40\43\x61\x39\64\x34\x34\62\73\x66\x6f\156\164\55\163\x69\x7a\145\x3a\x31\64\160\x74\x3b\x20\x6d\141\162\x67\151\x6e\55\x62\157\164\x74\x6f\x6d\x3a\62\x30\x70\170\73\42\x3e\127\101\x52\x4e\111\116\107\72\x20\123\x6f\155\x65\x20\x41\x74\x74\162\151\142\x75\x74\x65\x73\40\x44\x69\x64\40\x4e\x6f\164\x20\x4d\x61\164\143\x68\56\x3c\x2f\144\x69\166\x3e\xa\11\x9\x9\x9\74\x64\151\166\40\x73\164\171\154\145\75\x22\x64\151\x73\x70\x6c\141\x79\72\x62\154\x6f\143\x6b\x3b\164\145\170\164\55\141\154\151\x67\x6e\72\x63\x65\156\x74\x65\162\73\x6d\141\162\147\151\x6e\55\x62\x6f\x74\164\157\155\72\x34\x25\x3b\x22\76\74\x69\155\147\40\163\x74\x79\154\145\x3d\x22\x77\x69\144\164\x68\x3a\61\65\45\x3b\42\x73\x72\x63\75\42" . plugin_dir_url(__FILE__) . "\x69\x6d\141\147\x65\163\x2f\167\x72\x6f\x6e\x67\56\x70\x6e\147\42\x3e\x3c\x2f\144\x69\166\x3e";
    goto iG;
    t_:
    echo "\74\x64\x69\166\x20\x73\x74\171\x6c\x65\75\42\x63\x6f\154\x6f\x72\72\40\43\x33\143\67\x36\63\144\73\12\x9\x9\x9\x9\142\x61\x63\153\147\162\x6f\165\x6e\144\55\143\x6f\154\157\x72\72\x20\43\x64\146\x66\60\144\x38\73\x20\x70\x61\x64\144\151\156\x67\72\62\x25\x3b\x6d\x61\x72\147\151\x6e\55\x62\x6f\x74\164\x6f\155\72\62\x30\160\170\73\x74\x65\170\164\x2d\141\154\151\147\x6e\x3a\143\x65\156\164\x65\x72\x3b\x20\x62\157\162\x64\x65\162\x3a\61\160\170\40\163\x6f\154\x69\x64\40\x23\101\105\x44\102\x39\101\x3b\40\146\x6f\x6e\164\55\163\151\172\x65\72\x31\70\160\x74\73\42\x3e\x54\x45\123\x54\40\123\x55\103\103\105\x53\x53\x46\125\114\x3c\57\x64\x69\x76\x3e\xa\11\11\11\11\x3c\x64\x69\166\40\x73\164\171\154\x65\75\x22\x64\151\x73\160\154\141\171\x3a\142\x6c\x6f\x63\x6b\x3b\164\x65\x78\164\x2d\x61\x6c\x69\x67\x6e\72\x63\145\x6e\x74\x65\x72\x3b\x6d\141\x72\x67\151\156\x2d\142\157\164\x74\157\155\x3a\64\45\73\x22\76\74\151\x6d\x67\x20\x73\x74\x79\154\x65\x3d\42\x77\x69\x64\164\x68\72\61\x35\x25\73\x22\x73\x72\143\75\x22" . plugin_dir_url(__FILE__) . "\x69\155\x61\147\145\163\x2f\147\162\x65\x65\156\x5f\143\150\x65\143\x6b\56\160\x6e\147\42\76\x3c\57\x64\x69\x76\76";
    iG:
    $pG = get_option("\x73\141\155\154\x5f\x61\x6d\x5f\x61\143\x63\x6f\x75\x6e\164\137\155\141\x74\x63\150\145\162") ? get_option("\163\141\155\x6c\137\141\x6d\137\x61\143\143\x6f\x75\x6e\x74\x5f\155\x61\x74\143\150\x65\162") : "\x65\155\141\151\x6c";
    if (!($pG == "\145\x6d\141\151\154" && !filter_var($uj, FILTER_VALIDATE_EMAIL))) {
        goto OE;
    }
    echo "\x3c\160\x3e\74\x66\157\156\x74\x20\143\157\154\157\x72\75\42\43\106\x46\x30\x30\x30\60\42\x20\x73\x74\171\x6c\145\x3d\42\146\x6f\156\x74\55\163\151\x7a\145\x3a\61\64\160\164\42\x3e\50\x57\141\x72\156\151\x6e\147\x3a\40\124\150\x65\x20\101\x74\164\162\151\x62\165\x74\145\x20\42";
    echo get_option("\163\141\155\x6c\x5f\x61\155\137\145\155\141\x69\x6c") ? get_option("\x73\x61\x6d\x6c\137\x61\155\137\145\x6d\x61\x69\154") : "\x4e\141\x6d\145\x49\104";
    echo "\x22\x20\x64\157\x65\163\x20\x6e\157\164\x20\x63\157\x6e\x74\141\151\x6e\40\166\141\x6c\x69\x64\40\105\x6d\141\151\x6c\x20\111\x44\x29\x3c\x2f\146\157\156\x74\x3e\74\x2f\x70\76";
    OE:
    echo "\x3c\x73\x70\141\156\40\163\x74\x79\x6c\145\x3d\x22\x66\x6f\x6e\164\55\x73\x69\172\145\x3a\x31\x34\x70\x74\73\x22\x3e\74\x62\76\110\145\154\x6c\x6f\x3c\57\142\76\54\40" . $uj . "\x3c\x2f\163\160\x61\x6e\76\74\x62\x72\57\76\x3c\x70\40\163\x74\171\154\145\x3d\x22\146\157\156\164\55\167\x65\151\147\x68\164\x3a\x62\157\154\144\73\x66\x6f\156\x74\x2d\163\x69\x7a\x65\x3a\x31\x34\160\x74\x3b\x6d\x61\x72\x67\x69\x6e\55\x6c\x65\x66\x74\72\61\x25\x3b\x22\x3e\101\x54\x54\x52\111\x42\125\124\x45\123\40\x52\105\103\x45\111\x56\105\x44\72\74\57\160\76\xa\x9\x9\11\x9\74\x74\x61\x62\x6c\145\x20\x73\x74\x79\154\145\x3d\x22\x62\x6f\x72\144\x65\x72\55\x63\x6f\154\154\x61\x70\x73\145\72\x63\157\154\154\x61\160\x73\145\x3b\142\157\162\x64\145\162\x2d\163\x70\141\x63\151\156\x67\72\60\73\40\144\151\163\x70\154\141\171\72\164\x61\x62\x6c\145\73\167\x69\x64\164\x68\x3a\61\60\60\45\73\40\146\157\x6e\164\x2d\x73\x69\x7a\x65\72\x31\x34\x70\164\x3b\142\x61\x63\x6b\x67\162\x6f\x75\x6e\x64\x2d\x63\157\154\157\x72\72\43\105\104\x45\x44\105\x44\x3b\42\x3e\12\11\11\11\x9\x3c\x74\x72\x20\163\164\x79\154\x65\x3d\x22\164\145\170\164\55\x61\154\x69\x67\156\x3a\x63\145\156\x74\145\x72\x3b\42\76\74\164\144\x20\x73\164\x79\154\145\x3d\42\x66\x6f\156\164\55\167\x65\151\147\x68\164\x3a\142\x6f\x6c\x64\x3b\x62\x6f\162\144\x65\162\72\x32\160\x78\x20\x73\x6f\x6c\x69\144\40\x23\x39\x34\x39\x30\71\x30\73\x70\x61\x64\x64\151\156\147\72\x32\x25\x3b\x22\x3e\x41\124\x54\122\x49\x42\125\x54\x45\x20\x4e\x41\115\105\x3c\x2f\164\144\x3e\x3c\164\144\x20\163\x74\x79\x6c\145\x3d\x22\x66\x6f\x6e\x74\x2d\x77\145\x69\147\x68\x74\72\x62\x6f\154\144\x3b\x70\141\144\x64\151\156\x67\72\62\x25\x3b\142\x6f\x72\144\x65\162\x3a\x32\160\x78\x20\163\157\154\151\144\x20\x23\x39\64\71\x30\x39\x30\73\x20\x77\157\162\144\x2d\167\x72\141\x70\x3a\x62\162\x65\x61\x6b\55\167\157\x72\144\73\x22\x3e\x41\124\x54\122\x49\x42\x55\124\105\x20\126\101\114\125\x45\74\x2f\164\x64\76\74\57\x74\162\76";
    if (!empty($Lp)) {
        goto BU;
    }
    echo "\116\157\40\x41\164\x74\x72\151\142\x75\x74\x65\x73\x20\x52\145\x63\145\x69\x76\145\x64\x2e";
    goto z_;
    BU:
    foreach ($Lp as $Yy => $Xb) {
        echo "\74\164\162\x3e\x3c\x74\x64\40\163\164\x79\154\x65\x3d\47\146\157\x6e\x74\55\167\145\x69\147\x68\164\72\x62\157\x6c\144\73\x62\x6f\162\x64\145\x72\72\62\160\170\x20\x73\x6f\x6c\x69\x64\x20\43\71\64\x39\60\x39\60\x3b\x70\141\x64\144\151\x6e\x67\x3a\x32\x25\x3b\x27\x3e" . $Yy . "\x3c\57\164\144\76\x3c\x74\x64\x20\x73\x74\x79\154\145\x3d\47\x70\141\144\144\151\x6e\147\72\x32\x25\73\x62\x6f\x72\144\145\x72\x3a\x32\x70\170\40\163\x6f\x6c\151\144\40\x23\71\x34\x39\60\x39\x30\73\x20\167\x6f\162\x64\x2d\x77\x72\x61\x70\72\x62\x72\x65\x61\153\x2d\167\157\x72\144\x3b\47\76" . implode("\74\150\x72\x2f\76", $Xb) . "\74\x2f\164\x64\x3e\x3c\x2f\x74\162\76";
        t3:
    }
    wt:
    z_:
    echo "\74\57\x74\141\x62\x6c\145\76\x3c\x2f\144\151\x76\x3e";
    echo "\74\x64\x69\x76\x20\x73\164\x79\x6c\x65\75\x22\155\141\162\147\151\156\x3a\63\x25\x3b\x64\x69\x73\160\154\x61\171\x3a\x62\154\157\x63\153\x3b\x74\x65\x78\164\x2d\x61\154\151\147\156\x3a\x63\145\x6e\x74\145\162\73\42\76\74\x69\156\x70\x75\164\40\x73\x74\171\x6c\145\x3d\x22\x70\x61\144\x64\151\x6e\x67\x3a\61\45\x3b\167\x69\144\164\x68\72\x31\x30\x30\160\x78\x3b\142\x61\x63\153\147\x72\157\x75\156\x64\72\40\43\x30\60\x39\x31\x43\104\40\x6e\157\156\x65\40\162\145\160\145\141\x74\40\163\143\x72\157\x6c\154\40\x30\x25\40\60\45\x3b\x63\x75\x72\163\x6f\x72\72\x20\160\157\151\x6e\x74\145\162\73\146\x6f\x6e\x74\55\x73\x69\172\x65\x3a\x31\x35\160\170\73\x62\x6f\162\144\145\162\55\167\151\144\164\150\72\40\61\160\170\73\x62\157\162\144\145\x72\x2d\x73\x74\x79\x6c\x65\72\x20\163\x6f\x6c\151\x64\73\x62\157\162\144\x65\x72\x2d\162\x61\144\151\165\163\x3a\40\x33\x70\170\73\x77\150\151\164\x65\55\x73\160\141\143\145\72\40\156\x6f\x77\162\x61\x70\73\142\157\170\x2d\163\151\172\x69\156\x67\x3a\40\142\157\162\144\x65\162\x2d\x62\157\x78\73\x62\157\162\144\145\162\x2d\143\157\154\157\162\72\40\43\x30\60\67\x33\101\101\73\x62\x6f\170\x2d\163\x68\x61\144\157\x77\x3a\x20\x30\x70\x78\x20\61\x70\170\40\x30\160\x78\40\x72\147\142\141\x28\x31\62\x30\x2c\40\62\60\x30\54\x20\x32\63\60\54\x20\60\56\x36\x29\x20\151\x6e\x73\x65\164\73\x63\x6f\154\x6f\x72\72\40\43\106\x46\106\x3b\x22\x74\x79\x70\145\75\42\x62\165\164\x74\x6f\156\42\40\166\x61\x6c\165\145\75\42\104\157\156\x65\42\40\x6f\156\103\x6c\151\x63\x6b\75\x22\x73\x65\154\x66\x2e\143\154\x6f\163\x65\x28\51\73\x22\76\74\x2f\x64\x69\x76\76";
    die;
}
function mo_saml_login_user($uj, $Jq, $b0, $kV, $br, $o8, $Vm, $zQ, $g3, $OF = '', $am = '', $Lp = null)
{
    $Qm = get_option("\155\x6f\x5f\163\141\x6d\154\x5f\163\160\137\x62\x61\163\145\137\165\162\154");
    if (!empty($Qm)) {
        goto NW;
    }
    $Qm = home_url();
    NW:
    if ($g3 == "\165\163\145\x72\156\x61\155\145" && username_exists($kV)) {
        goto Hb;
    }
    if (email_exists($uj)) {
        goto vY;
    }
    if (!username_exists($kV) && !email_exists($uj)) {
        goto U9;
    }
    if (username_exists($kV) && !email_exists($uj)) {
        goto RA;
    }
    goto jj;
    Hb:
    $user = get_user_by("\154\x6f\x67\151\x6e", $kV);
    $Bj = $user->ID;
    if (empty($Jq)) {
        goto zP;
    }
    $Mj = wp_update_user(array("\111\x44" => $Bj, "\x66\x69\162\x73\164\137\156\141\155\x65" => $Jq));
    zP:
    if (empty($b0)) {
        goto pn;
    }
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\x6c\141\163\x74\x5f\x6e\x61\x6d\145" => $b0));
    pn:
    if (empty($uj)) {
        goto fN;
    }
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\165\x73\145\162\x5f\x65\155\141\x69\x6c" => $uj));
    fN:
    if (!get_option("\x6d\157\137\x73\x61\155\154\137\143\x75\x73\x74\157\155\137\141\164\x74\x72\163\137\x6d\x61\160\160\151\x6e\x67")) {
        goto Xh;
    }
    $pX = get_option("\x6d\x6f\137\163\141\x6d\154\x5f\x63\165\x73\164\x6f\155\x5f\x61\164\x74\x72\163\137\x6d\x61\x70\160\151\x6e\147");
    foreach ($pX as $Yy => $Xb) {
        if (!array_key_exists($Xb, $Lp)) {
            goto FC;
        }
        $co = $Lp[$Xb][0];
        update_user_meta($Bj, $Yy, $co);
        FC:
        UT:
    }
    P4:
    Xh:
    $W7 = get_option("\163\x61\x6d\x6c\x5f\141\x6d\137\x64\x6f\x6e\x74\137\165\160\144\141\164\x65\x5f\145\170\x69\x73\x74\x69\x6e\147\137\165\163\x65\x72\x5f\x72\157\x6c\x65");
    if (!(empty($W7) || $W7 != "\143\x68\145\143\153\x65\144")) {
        goto QW;
    }
    $FT = get_option("\x73\x61\155\154\x5f\x61\x6d\137\x72\157\154\x65\x5f\x6d\141\160\160\x69\156\147");
    $RX = assign_roles_to_user($user, $FT, $br);
    if ($RX !== true && !is_administrator_user($user) && !empty($o8) && $o8 == "\143\150\145\143\153\145\x64") {
        goto Zr;
    }
    if ($RX !== true && !is_administrator_user($user) && !empty($Vm)) {
        goto og;
    }
    goto qi;
    Zr:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\x72\157\x6c\145" => false));
    goto qi;
    og:
    $Mj = wp_update_user(array("\111\x44" => $Bj, "\162\157\x6c\145" => $Vm));
    qi:
    QW:
    if (is_null($Lp)) {
        goto Pj;
    }
    update_user_meta($Bj, "\x6d\157\x5f\163\x61\x6d\154\x5f\165\x73\x65\x72\137\x61\x74\164\162\151\142\x75\164\x65\163", $Lp);
    $a8 = get_option("\163\141\x6d\154\x5f\141\155\137\x64\151\x73\x70\x6c\x61\x79\x5f\x6e\x61\x6d\145");
    if (empty($a8)) {
        goto PQ;
    }
    if (strcmp($a8, "\x55\123\105\122\x4e\101\x4d\x45") == 0) {
        goto qg;
    }
    if (strcmp($a8, "\106\116\101\115\x45") == 0 && !empty($Jq)) {
        goto m8;
    }
    if (strcmp($a8, "\x4c\x4e\101\115\105") == 0 && !empty($b0)) {
        goto n1;
    }
    if (strcmp($a8, "\106\116\101\115\x45\137\114\116\x41\115\x45") == 0 && !empty($b0) && !empty($Jq)) {
        goto i7;
    }
    if (!(strcmp($a8, "\x4c\x4e\101\x4d\x45\x5f\x46\116\101\x4d\x45") == 0 && !empty($b0) && !empty($Jq))) {
        goto L4;
    }
    $Mj = wp_update_user(array("\x49\x44" => $Bj, "\144\x69\x73\x70\154\x61\x79\x5f\156\141\x6d\x65" => $b0 . "\x20" . $Jq));
    L4:
    goto jJ;
    i7:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\144\151\163\160\x6c\141\171\x5f\156\141\x6d\145" => $Jq . "\40" . $b0));
    jJ:
    goto mI;
    n1:
    $Mj = wp_update_user(array("\111\104" => $Bj, "\x64\x69\163\160\154\x61\x79\x5f\156\x61\155\145" => $b0));
    mI:
    goto O0;
    m8:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\x64\151\163\160\154\141\171\x5f\156\x61\155\x65" => $Jq));
    O0:
    goto Kx;
    qg:
    $Mj = wp_update_user(array("\111\x44" => $Bj, "\144\151\163\160\154\141\x79\x5f\x6e\141\x6d\x65" => $user->user_login));
    Kx:
    PQ:
    Pj:
    wp_set_current_user($Bj);
    wp_set_auth_cookie($Bj);
    $user = get_user_by("\151\x64", $Bj);
    do_action("\167\x70\x5f\x6c\x6f\147\x69\156", $user->user_login, $user);
    if (empty($OF)) {
        goto st;
    }
    update_user_meta($Bj, "\x6d\x6f\x5f\163\141\155\154\137\163\145\163\x73\x69\x6f\156\137\x69\156\144\x65\170", $OF);
    st:
    if (empty($am)) {
        goto Jq;
    }
    update_user_meta($Bj, "\x6d\x6f\137\x73\x61\x6d\154\x5f\x6e\141\x6d\x65\137\x69\144", $am);
    Jq:
    if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
        goto kD;
    }
    session_start();
    kD:
    $_SESSION["\x6d\157\x5f\x73\x61\x6d\x6c"]["\154\x6f\147\x67\x65\x64\137\151\156\137\x77\151\x74\x68\x5f\x69\144\160"] = TRUE;
    $Ew = get_option("\155\x6f\137\163\141\x6d\154\137\x72\x65\154\141\171\137\163\164\x61\164\145");
    if (!empty($Ew)) {
        goto TN;
    }
    if (!empty($zQ)) {
        goto ol;
    }
    wp_redirect($Qm);
    goto yN;
    ol:
    wp_redirect($zQ);
    yN:
    goto Ji;
    TN:
    wp_redirect($Ew);
    Ji:
    die;
    goto jj;
    vY:
    $user = get_user_by("\145\x6d\x61\151\x6c", $uj);
    $Bj = $user->ID;
    if (empty($Jq)) {
        goto ID;
    }
    $Mj = wp_update_user(array("\x49\x44" => $Bj, "\x66\x69\162\x73\164\137\156\141\x6d\x65" => $Jq));
    ID:
    if (empty($b0)) {
        goto pd;
    }
    $Mj = wp_update_user(array("\111\x44" => $Bj, "\154\x61\x73\164\x5f\x6e\141\155\145" => $b0));
    pd:
    if (!get_option("\155\157\137\x73\x61\155\154\x5f\x63\x75\163\x74\157\x6d\137\x61\x74\x74\x72\163\x5f\x6d\141\160\x70\151\x6e\x67")) {
        goto IV;
    }
    $pX = get_option("\155\x6f\x5f\163\141\155\154\137\143\165\163\x74\x6f\155\x5f\x61\x74\164\x72\163\x5f\x6d\141\160\x70\x69\x6e\147");
    foreach ($pX as $Yy => $Xb) {
        if (!array_key_exists($Xb, $Lp)) {
            goto HE;
        }
        $co = $Lp[$Xb][0];
        update_user_meta($Bj, $Yy, $co);
        HE:
        QH:
    }
    jC:
    IV:
    $FT = get_option("\x73\x61\x6d\154\137\141\x6d\x5f\x72\x6f\154\x65\137\155\x61\x70\x70\151\x6e\x67");
    $W7 = get_option("\163\x61\x6d\154\137\141\155\x5f\x64\157\x6e\164\137\165\160\x64\141\164\145\137\x65\x78\151\x73\x74\151\156\147\137\x75\x73\145\162\137\162\157\154\x65");
    if (!(empty($W7) || $W7 != "\x63\150\145\x63\153\145\x64")) {
        goto KW;
    }
    $RX = assign_roles_to_user($user, $FT, $br);
    if ($RX !== true && !is_administrator_user($user) && !empty($o8) && $o8 == "\x63\150\x65\x63\153\145\x64") {
        goto Hp;
    }
    if ($RX !== true && !is_administrator_user($user) && !empty($Vm)) {
        goto Jw;
    }
    goto oo;
    Hp:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\162\157\154\145" => false));
    goto oo;
    Jw:
    $Mj = wp_update_user(array("\x49\x44" => $Bj, "\162\157\154\x65" => $Vm));
    oo:
    KW:
    if (is_null($Lp)) {
        goto zd;
    }
    update_user_meta($Bj, "\155\157\x5f\x73\x61\x6d\x6c\137\x75\163\x65\162\x5f\x61\164\164\x72\151\x62\x75\x74\x65\163", $Lp);
    $a8 = get_option("\163\141\x6d\154\x5f\141\155\137\x64\151\163\160\x6c\x61\171\137\156\141\x6d\145");
    if (empty($a8)) {
        goto KQ;
    }
    if (strcmp($a8, "\x55\123\105\x52\x4e\x41\115\105") == 0) {
        goto Ss;
    }
    if (strcmp($a8, "\x46\116\x41\115\105") == 0 && !empty($Jq)) {
        goto f8;
    }
    if (strcmp($a8, "\x4c\x4e\x41\x4d\105") == 0 && !empty($b0)) {
        goto Ng;
    }
    if (strcmp($a8, "\x46\116\x41\115\x45\137\114\116\x41\115\105") == 0 && !empty($b0) && !empty($Jq)) {
        goto YF;
    }
    if (!(strcmp($a8, "\x4c\116\x41\115\x45\137\106\x4e\101\x4d\x45") == 0 && !empty($b0) && !empty($Jq))) {
        goto Nk;
    }
    $Mj = wp_update_user(array("\111\104" => $Bj, "\x64\x69\163\x70\154\141\x79\137\x6e\x61\155\x65" => $b0 . "\x20" . $Jq));
    Nk:
    goto SM;
    YF:
    $Mj = wp_update_user(array("\111\104" => $Bj, "\144\151\x73\160\x6c\141\x79\137\156\141\155\145" => $Jq . "\40" . $b0));
    SM:
    goto dx;
    Ng:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\144\x69\163\160\x6c\141\171\x5f\156\141\x6d\x65" => $b0));
    dx:
    goto a5;
    f8:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\144\151\163\x70\x6c\x61\x79\x5f\x6e\x61\x6d\x65" => $Jq));
    a5:
    goto RL;
    Ss:
    $Mj = wp_update_user(array("\x49\x44" => $Bj, "\x64\151\x73\x70\x6c\141\x79\137\156\141\x6d\145" => $user->user_login));
    RL:
    KQ:
    zd:
    wp_set_current_user($Bj);
    wp_set_auth_cookie($Bj);
    $user = get_user_by("\151\144", $Bj);
    do_action("\167\x70\137\154\157\x67\x69\x6e", $user->user_login, $user);
    if (empty($OF)) {
        goto MD;
    }
    update_user_meta($Bj, "\x6d\x6f\x5f\163\141\x6d\154\x5f\x73\x65\x73\x73\x69\157\156\x5f\x69\x6e\x64\145\x78", $OF);
    MD:
    if (empty($am)) {
        goto Fi;
    }
    update_user_meta($Bj, "\155\x6f\x5f\x73\141\155\154\137\x6e\141\155\x65\137\151\x64", $am);
    Fi:
    if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
        goto Gq;
    }
    session_start();
    Gq:
    $_SESSION["\155\x6f\137\x73\141\x6d\154"]["\x6c\x6f\147\147\x65\x64\137\151\156\137\167\x69\x74\x68\x5f\x69\x64\x70"] = TRUE;
    $Ew = get_option("\155\157\137\163\141\155\154\137\x72\x65\x6c\141\171\137\x73\164\x61\x74\145");
    if (!empty($Ew)) {
        goto rS;
    }
    if (!empty($zQ)) {
        goto xc;
    }
    wp_redirect($Qm);
    goto zL;
    xc:
    wp_redirect($zQ);
    zL:
    goto ES;
    rS:
    wp_redirect($Ew);
    ES:
    die;
    goto jj;
    U9:
    $FT = get_option("\163\x61\x6d\154\137\141\155\x5f\x72\157\x6c\x65\x5f\x6d\141\x70\160\151\x6e\x67");
    $wr = true;
    $g1 = get_option("\155\157\x5f\163\141\155\x6c\137\144\157\156\x74\x5f\143\162\x65\x61\x74\x65\x5f\x75\x73\x65\162\137\x69\146\137\162\x6f\x6c\x65\x5f\156\x6f\164\x5f\155\x61\x70\160\x65\144");
    if (!(!empty($g1) && strcmp($g1, "\143\150\x65\143\x6b\x65\x64") == 0)) {
        goto mu;
    }
    $GA = is_role_mapping_configured_for_user($FT, $br);
    $wr = $GA;
    mu:
    if ($wr === true) {
        goto sK;
    }
    $le = "\127\x65\40\x63\x6f\165\x6c\x64\40\156\157\x74\x20\163\151\147\156\x20\x79\x6f\x75\x20\151\x6e\56\x20\120\154\145\x61\x73\x65\x20\143\157\x6e\164\x61\x63\x74\40\x79\157\165\x72\40\x41\144\155\151\x6e\151\163\x74\x72\x61\x74\x6f\162\56";
    wp_die($le, "\105\x72\162\157\x72\72\40\116\x6f\164\x20\x61\40\x57\x6f\162\x64\x50\x72\145\163\x73\x20\x4d\x65\x6d\x62\x65\162");
    die;
    goto YG;
    sK:
    $jB = wp_generate_password(10, false);
    if (!empty($kV)) {
        goto Sh;
    }
    $Bj = wp_create_user($uj, $jB, $uj);
    goto sd;
    Sh:
    $Bj = wp_create_user($kV, $jB, $uj);
    sd:
    $user = get_user_by("\151\144", $Bj);
    $RX = assign_roles_to_user($user, $FT, $br);
    if ($RX !== true && !empty($o8) && $o8 == "\x63\150\x65\143\x6b\x65\144") {
        goto mv;
    }
    if ($RX !== true && !empty($Vm)) {
        goto ss;
    }
    if ($RX !== true) {
        goto Yk;
    }
    goto bE;
    mv:
    $Mj = wp_update_user(array("\111\104" => $Bj, "\162\x6f\x6c\145" => false));
    goto bE;
    ss:
    $Mj = wp_update_user(array("\111\104" => $Bj, "\162\x6f\154\x65" => $Vm));
    goto bE;
    Yk:
    $Vm = get_option("\144\145\146\x61\x75\154\164\137\162\157\x6c\145");
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\162\157\x6c\145" => $Vm));
    bE:
    if (empty($Jq)) {
        goto WZ;
    }
    $Mj = wp_update_user(array("\x49\x44" => $Bj, "\146\x69\162\x73\164\x5f\156\141\155\145" => $Jq));
    WZ:
    if (empty($b0)) {
        goto P6;
    }
    $Mj = wp_update_user(array("\111\104" => $Bj, "\154\x61\x73\x74\137\156\141\x6d\x65" => $b0));
    P6:
    if (is_null($Lp)) {
        goto dJ;
    }
    update_user_meta($Bj, "\155\x6f\x5f\163\x61\155\154\x5f\165\x73\145\x72\137\x61\164\164\162\x69\x62\165\x74\x65\x73", $Lp);
    $a8 = get_option("\163\x61\x6d\154\x5f\141\x6d\x5f\x64\x69\163\x70\154\141\171\x5f\x6e\x61\155\x65");
    if (empty($a8)) {
        goto kP;
    }
    if (strcmp($a8, "\125\123\x45\x52\116\x41\115\x45") == 0) {
        goto yh;
    }
    if (strcmp($a8, "\x46\x4e\101\115\105") == 0 && !empty($Jq)) {
        goto P1;
    }
    if (strcmp($a8, "\x4c\x4e\101\115\105") == 0 && !empty($b0)) {
        goto jK;
    }
    if (strcmp($a8, "\106\x4e\x41\x4d\105\x5f\x4c\116\x41\115\105") == 0 && !empty($b0) && !empty($Jq)) {
        goto IE;
    }
    if (!(strcmp($a8, "\114\x4e\101\x4d\x45\137\106\116\101\115\x45") == 0 && !empty($b0) && !empty($Jq))) {
        goto BT;
    }
    $Mj = wp_update_user(array("\111\x44" => $Bj, "\144\151\163\160\154\141\x79\x5f\x6e\141\155\x65" => $b0 . "\x20" . $Jq));
    BT:
    goto ui;
    IE:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\x64\151\x73\160\154\141\171\137\x6e\x61\x6d\145" => $Jq . "\x20" . $b0));
    ui:
    goto ac;
    jK:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\144\x69\x73\160\154\x61\171\137\156\141\155\x65" => $b0));
    ac:
    goto NT;
    P1:
    $Mj = wp_update_user(array("\x49\x44" => $Bj, "\144\x69\x73\160\x6c\x61\171\137\x6e\x61\155\x65" => $Jq));
    NT:
    goto Gv;
    yh:
    $Mj = wp_update_user(array("\x49\104" => $Bj, "\x64\x69\163\x70\154\141\171\137\156\141\155\145" => $user->user_login));
    Gv:
    kP:
    dJ:
    wp_set_current_user($Bj);
    wp_set_auth_cookie($Bj);
    $user = get_user_by("\x69\x64", $Bj);
    do_action("\167\160\137\154\157\147\x69\156", $user->user_login, $user);
    if (empty($OF)) {
        goto Ua;
    }
    update_user_meta($Bj, "\x6d\157\x5f\x73\141\155\x6c\x5f\x73\x65\x73\x73\x69\157\x6e\137\151\x6e\144\x65\x78", $OF);
    Ua:
    if (empty($am)) {
        goto ie;
    }
    update_user_meta($Bj, "\x6d\157\x5f\163\141\x6d\154\137\156\x61\155\x65\x5f\151\x64", $am);
    ie:
    if (!get_option("\x6d\x6f\x5f\163\141\x6d\154\137\143\x75\163\x74\x6f\x6d\137\x61\x74\164\x72\x73\x5f\155\141\160\x70\151\x6e\147")) {
        goto Ty;
    }
    $pX = get_option("\155\157\137\163\x61\x6d\x6c\137\143\165\163\x74\157\155\x5f\141\164\164\x72\x73\x5f\x6d\141\x70\x70\151\x6e\147");
    foreach ($pX as $Yy => $Xb) {
        if (!array_key_exists($Xb, $Lp)) {
            goto lA;
        }
        $co = $Lp[$Xb][0];
        update_user_meta($Bj, $Yy, $co);
        lA:
        AD:
    }
    qn:
    Ty:
    if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
        goto xz;
    }
    session_start();
    xz:
    $_SESSION["\x6d\157\137\x73\x61\x6d\154"]["\x6c\157\147\x67\x65\144\137\151\x6e\x5f\x77\x69\164\x68\137\x69\x64\x70"] = TRUE;
    YG:
    $Ew = get_option("\155\x6f\x5f\163\141\x6d\154\137\162\x65\154\141\171\x5f\x73\164\141\x74\x65");
    if (!empty($Ew)) {
        goto Hy;
    }
    if (!empty($zQ)) {
        goto gZ;
    }
    wp_redirect($Qm);
    goto Wv;
    gZ:
    wp_redirect($zQ);
    Wv:
    goto q9;
    Hy:
    wp_redirect($Ew);
    q9:
    die;
    goto jj;
    RA:
    wp_die("\x52\145\x67\151\x73\x74\x72\x61\164\151\157\x6e\x20\x68\141\x73\x20\146\x61\x69\154\145\144\40\x61\x73\x20\x61\40\165\x73\145\162\40\167\151\x74\150\x20\x74\x68\145\x20\x73\141\x6d\x65\40\165\163\145\162\156\141\x6d\x65\x20\x61\x6c\x72\145\141\144\x79\x20\145\x78\x69\x73\x74\163\x20\x69\156\40\x57\x6f\162\144\120\x72\145\163\163\56\x20\x50\x6c\x65\x61\163\145\x20\141\x73\x6b\40\171\x6f\x75\x72\x20\x61\x64\x6d\151\156\151\x73\x74\x72\141\x74\x6f\x72\x20\x74\x6f\40\x63\162\145\141\x74\x65\x20\141\x6e\x20\141\143\x63\157\x75\156\x74\x20\x66\x6f\162\x20\171\157\x75\x20\167\x69\164\x68\40\141\x20\x75\156\x69\161\x75\x65\x20\x75\x73\145\162\156\x61\155\145\56", "\x45\x72\162\157\162");
    jj:
}
function check_if_user_allowed_to_login($user, $Qm)
{
    $Bj = $user->ID;
    global $wpdb;
    if (get_user_meta($Bj, "\x6d\157\x5f\163\x61\x6d\154\x5f\x75\x73\x65\x72\x5f\164\171\x70\x65", true)) {
        goto bW;
    }
    if (get_option("\155\157\x5f\163\x61\155\x6c\137\x75\163\162\x5f\x6c\155\x74")) {
        goto wd;
    }
    update_user_meta($Bj, "\x6d\x6f\x5f\163\141\155\154\x5f\x75\163\x65\162\x5f\164\x79\160\x65", "\x73\x73\157\x5f\x75\163\x65\x72");
    goto tK;
    wd:
    $Yy = get_option("\155\157\137\163\x61\x6d\154\137\x63\165\163\x74\x6f\155\x65\x72\x5f\164\x6f\x6b\x65\x6e");
    $ue = AESEncryption::decrypt_data(get_option("\155\x6f\x5f\163\x61\x6d\154\x5f\165\163\162\137\154\155\164"), $Yy);
    $h6 = "\123\x45\x4c\105\103\x54\x20\x43\117\125\x4e\124\50\52\51\x20\106\122\x4f\x4d\x20" . $wpdb->prefix . "\x75\x73\145\162\155\145\164\141\x20\127\110\105\x52\105\40\155\145\164\x61\x5f\153\145\x79\x3d\x27\x6d\157\x5f\163\141\x6d\154\137\x75\x73\x65\x72\137\x74\x79\160\145\x27";
    $f3 = $wpdb->get_var($h6);
    if ($f3 >= $ue) {
        goto m6;
    }
    update_user_meta($Bj, "\x6d\x6f\137\x73\x61\x6d\x6c\x5f\165\163\145\162\137\164\x79\x70\145", "\x73\163\x6f\137\165\163\145\162");
    goto cG;
    m6:
    if (get_option("\165\163\x65\x72\x5f\x61\154\x65\x72\x74\137\145\x6d\141\x69\x6c\x5f\163\x65\x6e\164")) {
        goto EZ;
    }
    $rd = new Customersaml();
    $rd->mo_saml_send_user_exceeded_alert_email($ue);
    EZ:
    if (is_administrator_user($user)) {
        goto J3;
    }
    wp_redirect($Qm);
    die;
    goto We;
    J3:
    update_user_meta($Bj, "\155\157\137\163\x61\155\x6c\x5f\x75\163\x65\x72\x5f\x74\171\x70\x65", "\163\x73\157\x5f\x75\x73\x65\162");
    We:
    cG:
    tK:
    bW:
}
function assign_roles_to_user($user, $FT, $br)
{
    $RX = false;
    if (!(!empty($br) && !empty($FT) && !is_administrator_user($user))) {
        goto Xr;
    }
    $user->set_role(false);
    $A8 = '';
    $l0 = false;
    foreach ($FT as $Ap => $YT) {
        $tX = explode("\x3b", $YT);
        foreach ($tX as $lf) {
            foreach ($br as $Ab) {
                $Ab = trim($Ab);
                if (!(!empty($Ab) && $Ab == $lf)) {
                    goto fK;
                }
                $RX = true;
                $user->add_role($Ap);
                fK:
                Wf:
            }
            dV:
            Gu:
        }
        PS:
        RH:
    }
    sV:
    Xr:
    return $RX;
}
function is_role_mapping_configured_for_user($FT, $br)
{
    if (!(!empty($br) && !empty($FT))) {
        goto uB;
    }
    foreach ($FT as $Ap => $YT) {
        $tX = explode("\x3b", $YT);
        foreach ($tX as $lf) {
            foreach ($br as $Ab) {
                $Ab = trim($Ab);
                if (!(!empty($Ab) && $Ab == $lf)) {
                    goto xi;
                }
                return true;
                xi:
                Vq:
            }
            Ch:
            MV:
        }
        C0:
        yn:
    }
    k0:
    uB:
    return false;
}
function is_administrator_user($user)
{
    $T_ = $user->roles;
    if (!is_null($T_) && in_array("\141\x64\x6d\x69\x6e\151\163\164\x72\141\x74\x6f\x72", $T_, TRUE)) {
        goto nN;
    }
    return false;
    goto DA;
    nN:
    return true;
    DA:
}
function mo_saml_is_customer_registered()
{
    $Ke = get_option("\155\x6f\x5f\163\x61\x6d\x6c\x5f\x61\144\155\x69\156\x5f\x65\155\x61\151\x6c");
    $xh = get_option("\155\157\137\163\x61\x6d\x6c\137\141\144\155\151\156\x5f\x63\165\163\x74\157\155\145\162\x5f\153\x65\171");
    if (!$Ke || !$xh || !is_numeric(trim($xh))) {
        goto Yw;
    }
    return 1;
    goto KS;
    Yw:
    return 0;
    KS:
}
function mo_saml_is_customer_license_verified()
{
    $Yy = get_option("\155\x6f\137\x73\141\155\154\137\x63\x75\163\x74\x6f\155\x65\162\137\164\157\x6b\145\156");
    $lX = AESEncryption::decrypt_data(get_option("\x74\137\163\x69\x74\145\137\x73\x74\x61\x74\165\x73"), $Yy);
    $O0 = get_option("\163\155\154\x5f\x6c\x6b");
    $Ke = get_option("\155\157\x5f\163\141\155\154\137\x61\x64\x6d\151\x6e\x5f\x65\x6d\141\x69\x6c");
    $xh = get_option("\x6d\x6f\x5f\163\141\x6d\x6c\x5f\141\144\155\151\x6e\137\x63\165\x73\x74\x6f\155\145\162\137\x6b\x65\x79");
    if (!$lX && !$O0 || !$Ke || !$xh || !is_numeric(trim($xh))) {
        goto vF;
    }
    return 1;
    goto Bq;
    vF:
    return 0;
    Bq:
}
function saml_get_current_page_url()
{
    $GG = $_SERVER["\x48\124\124\x50\x5f\110\x4f\123\x54"];
    if (!(substr($GG, -1) == "\x2f")) {
        goto e2;
    }
    $GG = substr($GG, 0, -1);
    e2:
    $zI = $_SERVER["\x52\x45\x51\x55\x45\123\x54\137\125\x52\x49"];
    if (!(substr($zI, 0, 1) == "\57")) {
        goto U6;
    }
    $zI = substr($zI, 1);
    U6:
    $wW = isset($_SERVER["\110\124\124\120\123"]) && strcasecmp($_SERVER["\x48\124\124\120\x53"], "\x6f\x6e") == 0;
    $KP = "\x68\x74\164\160" . ($wW ? "\x73" : '') . "\72\57\57" . $GG . "\x2f" . $zI;
    return $KP;
}
function show_status_error($WM, $zQ)
{
    if ($zQ == "\164\x65\163\x74\x56\141\x6c\151\144\141\164\145") {
        goto xC;
    }
    wp_die("\127\x65\40\143\157\165\x6c\x64\x20\156\x6f\x74\x20\163\151\147\x6e\40\171\x6f\165\x20\x69\156\x2e\40\x50\154\x65\141\163\x65\40\143\157\156\x74\141\x63\x74\40\171\157\165\162\40\101\x64\155\151\x6e\x69\163\164\x72\x61\164\x6f\x72\56", "\x45\162\x72\157\162\72\x20\111\156\x76\x61\154\151\144\40\123\101\x4d\114\x20\122\x65\x73\x70\x6f\156\x73\x65\x20\x53\164\141\164\165\x73");
    goto H4;
    xC:
    echo "\x3c\144\151\x76\40\x73\164\171\154\x65\75\42\146\157\x6e\164\55\146\x61\155\151\154\x79\x3a\103\141\154\151\x62\x72\x69\73\160\x61\144\x64\151\156\147\x3a\x30\x20\63\45\x3b\42\76";
    echo "\x3c\144\x69\166\40\163\x74\171\154\145\75\42\143\x6f\154\157\162\72\40\43\x61\71\x34\64\x34\x32\x3b\142\x61\x63\x6b\147\162\x6f\x75\156\144\x2d\x63\157\x6c\x6f\162\x3a\x20\43\x66\x32\x64\145\x64\145\73\160\x61\x64\144\x69\156\147\x3a\x20\61\65\x70\170\x3b\x6d\141\162\x67\x69\156\55\x62\157\x74\x74\x6f\155\72\40\x32\x30\160\170\x3b\x74\x65\170\164\55\141\x6c\x69\x67\x6e\x3a\x63\145\156\x74\x65\x72\x3b\142\x6f\162\x64\145\162\72\61\160\x78\x20\163\157\154\x69\x64\40\43\x45\x36\102\x33\x42\x32\73\146\157\x6e\164\55\163\x69\x7a\x65\72\x31\x38\x70\164\x3b\x22\76\40\x45\x52\x52\117\x52\x3c\57\144\x69\166\x3e\12\x20\x20\x20\x20\x20\x20\40\x20\40\x20\40\40\x20\40\x20\x20\x3c\x64\151\x76\40\x73\x74\171\154\x65\x3d\x22\143\x6f\154\x6f\162\72\x20\x23\141\x39\x34\x34\64\x32\73\x66\157\156\x74\x2d\x73\151\172\x65\x3a\x31\x34\x70\x74\x3b\40\155\141\162\147\x69\x6e\55\x62\x6f\164\164\x6f\x6d\x3a\x32\x30\x70\x78\73\42\76\x3c\160\76\74\163\164\x72\x6f\156\147\x3e\x45\x72\162\x6f\162\x3a\x20\x3c\57\163\x74\x72\x6f\156\x67\76\40\111\156\166\x61\154\151\144\x20\x53\x41\x4d\x4c\40\x52\x65\x73\x70\x6f\x6e\163\x65\x20\x53\164\x61\164\165\x73\x2e\x3c\x2f\x70\x3e\xa\x20\40\x20\40\40\40\40\x20\40\x20\x20\x20\40\40\x20\x20\74\160\x3e\x3c\x73\164\162\157\x6e\x67\76\103\x61\165\x73\145\163\x3c\x2f\x73\x74\x72\157\156\x67\x3e\72\40\111\144\145\156\164\151\x74\171\x20\x50\162\x6f\166\151\144\x65\162\40\150\141\163\40\163\x65\x6e\164\x20\47" . $WM . "\x27\40\x73\x74\x61\x74\165\163\40\143\x6f\x64\145\x20\151\156\x20\123\x41\115\x4c\x20\x52\x65\x73\160\157\x6e\163\x65\56\40\74\x2f\x70\76\xa\x9\x9\11\11\x9\11\11\11\74\x70\x3e\74\x73\164\162\x6f\156\x67\76\x52\x65\x61\x73\x6f\156\x3c\x2f\x73\164\162\157\156\147\76\72\40" . get_status_message($WM) . "\x3c\x2f\x70\76\74\x62\162\76\xa\x20\40\40\40\40\40\x20\x20\40\x20\40\x20\40\x20\x20\x20\74\57\x64\x69\x76\x3e\xa\12\40\x20\40\40\40\40\40\40\40\40\x20\40\40\x20\x20\x20\x3c\144\x69\x76\40\x73\164\x79\154\x65\75\x22\x6d\141\162\x67\151\156\72\x33\x25\x3b\144\x69\163\160\154\x61\171\72\x62\154\157\143\x6b\x3b\164\x65\x78\x74\55\141\x6c\151\x67\x6e\72\x63\x65\156\x74\145\x72\73\x22\76\xa\x20\x20\x20\40\x20\x20\x20\40\40\40\40\x20\x20\x20\40\40\x3c\x64\x69\166\40\163\x74\171\x6c\145\x3d\x22\x6d\141\x72\x67\151\156\72\x33\45\73\x64\x69\x73\160\154\x61\x79\x3a\x62\154\x6f\143\x6b\x3b\164\145\x78\x74\55\x61\154\x69\147\x6e\x3a\143\145\156\x74\x65\x72\73\x22\76\74\x69\x6e\x70\165\164\40\163\164\x79\154\145\75\x22\x70\141\144\x64\x69\156\147\x3a\61\x25\x3b\x77\x69\x64\164\150\x3a\x31\60\x30\x70\x78\x3b\142\x61\x63\x6b\x67\162\157\x75\x6e\x64\x3a\40\43\60\60\71\x31\103\104\x20\156\x6f\156\145\x20\162\145\160\x65\141\164\40\x73\143\x72\157\154\154\40\x30\x25\x20\60\45\x3b\x63\165\x72\x73\157\x72\72\40\x70\157\151\x6e\x74\145\162\x3b\146\x6f\156\x74\x2d\163\151\172\145\x3a\x31\x35\160\170\x3b\x62\157\x72\144\145\x72\55\x77\151\144\164\150\x3a\40\61\x70\170\x3b\x62\157\x72\144\x65\162\x2d\163\164\x79\154\145\x3a\x20\163\x6f\x6c\x69\x64\x3b\x62\x6f\162\x64\x65\162\55\x72\x61\144\x69\x75\x73\72\x20\x33\160\x78\73\167\x68\x69\164\145\x2d\163\160\x61\143\x65\x3a\x20\x6e\157\x77\x72\141\x70\73\x62\x6f\170\x2d\x73\151\x7a\151\156\147\72\40\x62\157\162\x64\145\x72\x2d\142\x6f\170\x3b\x62\157\x72\144\145\162\55\143\157\x6c\x6f\x72\72\40\x23\x30\60\67\63\x41\x41\73\x62\157\x78\55\x73\x68\141\x64\x6f\167\72\40\60\x70\x78\x20\61\160\170\40\60\x70\x78\x20\x72\147\x62\141\x28\61\62\60\54\x20\62\60\60\x2c\40\62\x33\x30\54\40\60\x2e\x36\x29\x20\x69\156\163\145\x74\73\x63\157\x6c\x6f\162\x3a\40\43\x46\106\106\x3b\42\164\x79\x70\145\75\x22\x62\x75\164\164\x6f\156\x22\x20\166\141\x6c\x75\145\x3d\x22\104\x6f\x6e\145\x22\40\x6f\156\x43\154\x69\x63\x6b\75\x22\163\145\154\x66\56\x63\154\157\x73\x65\50\51\x3b\42\76\x3c\x2f\144\x69\166\76";
    die;
    H4:
}
function get_status_message($WM)
{
    switch ($WM) {
        case "\x52\x65\161\165\x65\163\164\x65\x72":
            return "\124\150\145\x20\x72\x65\x71\x75\145\163\164\40\x63\157\165\154\x64\40\x6e\157\x74\40\x62\x65\x20\x70\x65\162\x66\x6f\162\x6d\x65\144\40\x64\165\x65\x20\164\157\40\141\x6e\x20\x65\x72\x72\157\162\40\x6f\x6e\x20\164\150\x65\40\x70\141\x72\164\x20\x6f\146\40\x74\x68\x65\x20\162\x65\161\x75\145\x73\164\x65\x72\56";
            goto XI;
        case "\122\145\163\x70\157\156\144\x65\162":
            return "\x54\x68\145\x20\162\145\161\x75\145\x73\164\x20\143\x6f\x75\154\144\x20\156\x6f\164\40\142\145\40\x70\145\x72\x66\x6f\162\155\145\144\x20\x64\165\145\x20\164\157\x20\141\x6e\x20\145\162\x72\157\x72\40\157\156\40\164\x68\x65\x20\x70\141\x72\164\x20\x6f\x66\40\164\150\145\40\123\x41\x4d\114\40\x72\145\163\x70\x6f\156\x64\x65\x72\x20\x6f\162\x20\123\101\x4d\114\x20\x61\165\x74\x68\157\162\151\164\171\56";
            goto XI;
        case "\x56\x65\x72\163\x69\157\156\x4d\151\x73\x6d\x61\164\x63\x68":
            return "\x54\x68\145\40\123\x41\x4d\114\40\162\145\163\160\x6f\x6e\x64\x65\x72\x20\x63\x6f\165\154\144\x20\156\157\x74\40\x70\x72\157\143\145\163\x73\40\164\x68\x65\40\x72\145\x71\x75\x65\x73\164\x20\142\145\143\141\165\x73\x65\x20\x74\150\x65\40\x76\145\x72\x73\151\x6f\x6e\40\157\x66\40\x74\x68\x65\x20\x72\x65\x71\165\145\x73\x74\40\155\x65\163\x73\141\x67\x65\x20\x77\141\x73\x20\x69\x6e\x63\157\x72\x72\145\x63\164\x2e";
            goto XI;
        default:
            return "\125\x6e\153\x6e\x6f\167\x6e";
    }
    o3:
    XI:
}
function addLink($aB, $cj)
{
    ?>
	<a href="<?php 
    echo $cj;
    ?>
"><?php 
    echo $aB;
    ?>
</a>
<?php 
}
add_action("\x77\x69\144\x67\x65\164\x73\137\x69\x6e\x69\x74", function () {
    register_widget("\155\157\137\154\x6f\147\151\x6e\137\x77\151\144");
});
add_action("\x69\x6e\151\x74", "\155\x6f\x5f\154\x6f\147\151\x6e\x5f\x76\x61\154\x69\x64\x61\x74\145");
?>
