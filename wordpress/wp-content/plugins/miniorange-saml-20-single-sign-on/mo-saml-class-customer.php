<?php


class Customersaml
{
    public $email;
    public $phone;
    private $defaultCustomerKey = "\61\66\65\x35\65";
    private $defaultApiKey = "\x66\106\x64\62\x58\x63\x76\x54\107\x44\145\x6d\x5a\166\142\x77\61\x62\143\x55\x65\x73\x4e\x4a\127\105\x71\113\142\x62\125\161";
    function create_customer()
    {
        $bX = get_option("\155\157\137\163\x61\155\154\x5f\150\157\163\164\x5f\x6e\141\155\x65") . "\57\x6d\157\141\163\x2f\x72\x65\163\x74\57\x63\x75\x73\164\x6f\155\x65\162\57\x61\x64\x64";
        $ZR = curl_init($bX);
        $current_user = wp_get_current_user();
        $this->email = get_option("\x6d\157\x5f\x73\x61\155\154\137\x61\x64\155\151\156\x5f\x65\x6d\141\x69\154");
        $this->phone = get_option("\155\157\x5f\163\141\155\x6c\x5f\x61\x64\x6d\x69\156\x5f\x70\x68\x6f\156\x65");
        $cv = get_option("\155\x6f\x5f\x73\x61\x6d\154\x5f\x61\x64\155\x69\x6e\x5f\160\141\163\163\x77\x6f\162\144");
        $NS = array("\x63\157\155\160\141\x6e\x79\x4e\x61\155\x65" => $_SERVER["\123\x45\122\126\x45\122\137\x4e\x41\x4d\105"], "\141\x72\x65\x61\117\146\x49\x6e\x74\x65\x72\x65\x73\164" => "\x57\120\x20\x6d\x69\x6e\x69\x4f\x72\x61\x6e\147\145\40\x53\101\115\114\40\x32\x2e\x30\x20\x53\123\117\x20\x50\154\x75\147\x69\x6e", "\146\x69\x72\x73\164\x6e\x61\155\145" => $current_user->user_firstname, "\154\141\x73\x74\x6e\x61\x6d\x65" => $current_user->user_lastname, "\145\155\x61\x69\154" => $this->email, "\160\150\157\156\145" => $this->phone, "\x70\141\163\x73\167\157\x72\x64" => $cv);
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\157\156\x74\x65\156\x74\x2d\124\171\x70\x65\x3a\x20\141\x70\x70\154\x69\x63\141\x74\151\x6f\156\57\152\163\x6f\x6e", "\x63\150\x61\162\163\x65\x74\72\x20\x55\x54\106\x20\x2d\40\x38", "\101\165\164\x68\x6f\x72\x69\x7a\141\164\151\157\156\x3a\x20\102\141\163\x69\143"));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        $Gk = get_option("\x6d\157\x5f\160\162\x6f\x78\x79\x5f\x68\157\x73\x74");
        if (empty($Gk)) {
            goto NB;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\x6f\137\160\162\x6f\170\171\x5f\150\x6f\163\164"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\157\137\160\x72\157\x78\171\137\160\157\162\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\x6d\x6f\x5f\160\x72\x6f\170\x79\137\x75\163\x65\x72\x6e\x61\x6d\145") . "\x3a" . get_option("\x6d\157\137\x70\x72\157\170\171\x5f\x70\x61\x73\163\167\157\x72\144"));
        NB:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto UK;
        }
        echo "\122\145\x71\x75\x65\x73\164\40\105\x72\162\157\162\x3a" . curl_error($ZR);
        die;
        UK:
        curl_close($ZR);
        return $Rv;
    }
    function get_customer_key()
    {
        $bX = get_option("\x6d\157\x5f\163\141\155\154\x5f\x68\157\x73\164\137\x6e\x61\x6d\x65") . "\57\155\x6f\141\163\57\162\145\x73\x74\57\x63\x75\163\x74\157\x6d\x65\162\x2f\153\145\171";
        $ZR = curl_init($bX);
        $Ke = get_option("\x6d\157\137\x73\x61\x6d\x6c\x5f\x61\144\155\151\156\137\145\x6d\141\x69\x6c");
        $cv = get_option("\155\157\137\163\141\155\154\x5f\141\x64\155\x69\x6e\137\x70\x61\163\x73\x77\157\162\144");
        $NS = array("\145\155\x61\x69\x6c" => $Ke, "\160\141\163\163\167\x6f\162\x64" => $cv);
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\x43\x6f\156\x74\145\156\164\x2d\x54\171\x70\x65\x3a\40\x61\160\160\154\x69\143\x61\x74\151\x6f\156\57\152\163\157\x6e", "\x63\150\x61\x72\x73\145\164\x3a\x20\125\124\x46\x20\55\x20\x38", "\x41\x75\x74\150\x6f\x72\151\x7a\141\x74\x69\157\x6e\72\40\102\141\163\151\x63"));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        $Gk = get_option("\155\157\x5f\160\x72\x6f\170\x79\137\150\x6f\163\x74");
        if (empty($Gk)) {
            goto Rh;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\x6d\x6f\137\160\162\x6f\170\171\x5f\x68\x6f\163\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\155\x6f\x5f\x70\x72\157\170\171\137\x70\157\162\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\x6d\x6f\x5f\x70\x72\157\170\x79\x5f\x75\163\x65\x72\156\x61\155\x65") . "\72" . get_option("\x6d\x6f\x5f\160\x72\157\x78\x79\137\160\141\163\163\x77\x6f\162\144"));
        Rh:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto B5;
        }
        echo "\122\x65\161\165\145\163\164\40\105\x72\x72\157\x72\x3a" . curl_error($ZR);
        die;
        B5:
        curl_close($ZR);
        return $Rv;
    }
    function check_customer()
    {
        $bX = get_option("\x6d\x6f\x5f\x73\141\x6d\154\x5f\150\x6f\x73\164\x5f\156\x61\x6d\145") . "\x2f\155\157\x61\163\x2f\x72\145\163\164\57\143\165\x73\164\157\155\x65\x72\x2f\x63\x68\145\143\153\x2d\151\146\x2d\145\x78\151\x73\164\x73";
        $ZR = curl_init($bX);
        $Ke = get_option("\x6d\157\x5f\163\x61\155\154\137\141\x64\155\x69\156\x5f\x65\155\x61\x69\x6c");
        $NS = array("\x65\155\141\151\154" => $Ke);
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\x65\156\164\x2d\124\x79\160\x65\72\40\141\160\160\x6c\151\143\141\x74\151\157\x6e\57\x6a\163\157\156", "\x63\x68\141\162\163\x65\x74\72\40\x55\124\106\40\x2d\x20\x38", "\x41\165\x74\150\x6f\162\x69\x7a\141\164\151\157\x6e\72\40\102\x61\x73\x69\x63"));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        $Gk = get_option("\155\157\137\160\162\157\x78\x79\137\150\157\x73\164");
        if (empty($Gk)) {
            goto Me;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\x6d\157\137\160\x72\x6f\170\x79\137\x68\x6f\163\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\157\137\160\x72\x6f\170\x79\x5f\160\x6f\x72\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\x6d\157\x5f\160\162\157\170\171\x5f\x75\x73\x65\162\x6e\141\x6d\x65") . "\x3a" . get_option("\155\x6f\137\160\x72\x6f\x78\171\137\160\x61\163\163\167\x6f\162\144"));
        Me:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto kL;
        }
        echo "\122\x65\161\x75\145\163\164\x20\x45\162\162\x6f\162\x3a" . curl_error($ZR);
        die;
        kL:
        curl_close($ZR);
        return $Rv;
    }
    function send_otp_token($Ke, $Px, $v6 = TRUE, $ae = FALSE)
    {
        $bX = get_option("\155\157\137\x73\141\155\x6c\137\150\x6f\x73\x74\137\156\141\155\145") . "\x2f\x6d\157\x61\163\57\x61\x70\x69\57\x61\165\164\x68\57\x63\x68\141\x6c\x6c\x65\156\x67\x65";
        $ZR = curl_init($bX);
        $xh = $this->defaultCustomerKey;
        $Rl = $this->defaultApiKey;
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\x73\x68\141\x35\x31\62", $W8);
        $Ld = "\x43\x75\x73\164\157\x6d\x65\x72\55\x4b\145\171\72\x20" . $xh;
        $NY = "\124\151\x6d\x65\x73\x74\x61\155\160\72\40" . number_format($JG, 0, '', '');
        $PQ = "\101\165\164\x68\x6f\x72\151\172\x61\164\x69\157\156\72\40" . $Nv;
        if ($v6) {
            goto I4;
        }
        $NS = array("\x63\165\163\x74\157\x6d\145\x72\113\x65\x79" => $xh, "\x70\x68\157\156\x65" => $Px, "\x61\x75\164\150\124\171\x70\x65" => "\x53\115\x53", "\164\162\141\x6e\x73\141\143\164\151\157\156\116\x61\155\x65" => "\127\x50\x20\x6d\151\x6e\x69\117\x72\141\156\x67\145\40\123\101\115\x4c\x20\x32\x2e\x30\40\123\123\x4f\x20\120\x6c\165\x67\151\156");
        goto hu;
        I4:
        $NS = array("\143\165\x73\164\x6f\155\x65\162\x4b\x65\x79" => $xh, "\145\x6d\141\151\154" => $Ke, "\141\165\x74\150\x54\x79\x70\145" => "\x45\115\101\111\x4c", "\x74\162\x61\156\163\x61\143\x74\x69\157\x6e\116\x61\155\145" => "\127\120\x20\155\x69\x6e\x69\117\162\x61\156\147\x65\x20\x53\101\115\114\40\62\x2e\60\x20\123\123\117\x20\120\154\x75\147\151\x6e");
        hu:
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\145\x6e\164\55\124\171\x70\x65\72\40\x61\160\x70\154\x69\143\141\164\x69\x6f\156\x2f\152\163\157\156", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        $Gk = get_option("\155\157\137\160\x72\x6f\170\x79\137\150\157\x73\x74");
        if (empty($Gk)) {
            goto SH;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\157\137\x70\x72\157\x78\x79\x5f\150\x6f\163\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\155\x6f\137\160\x72\x6f\170\171\x5f\160\157\x72\164"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\155\157\x5f\x70\162\157\170\x79\137\x75\x73\x65\x72\x6e\141\155\x65") . "\72" . get_option("\x6d\x6f\137\160\162\x6f\x78\171\x5f\x70\x61\x73\163\x77\157\162\144"));
        SH:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto DP;
        }
        echo "\122\x65\161\165\145\x73\x74\x20\x45\x72\162\x6f\x72\x3a" . curl_error($ZR);
        die;
        DP:
        curl_close($ZR);
        return $Rv;
    }
    function validate_otp_token($D6, $XC)
    {
        $bX = get_option("\155\x6f\x5f\163\x61\155\x6c\137\150\x6f\x73\x74\137\x6e\141\155\145") . "\x2f\x6d\157\x61\x73\57\141\x70\151\x2f\x61\x75\x74\x68\x2f\166\141\x6c\x69\x64\141\164\145";
        $ZR = curl_init($bX);
        $xh = $this->defaultCustomerKey;
        $Rl = $this->defaultApiKey;
        $Id = get_option("\155\x6f\137\163\141\155\x6c\137\x61\x64\155\151\156\137\145\x6d\141\x69\154");
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\163\150\x61\x35\x31\62", $W8);
        $Ld = "\103\x75\x73\x74\157\x6d\145\x72\x2d\113\x65\x79\72\x20" . $xh;
        $NY = "\x54\151\155\x65\163\164\x61\155\160\72\x20" . number_format($JG, 0, '', '');
        $PQ = "\x41\165\x74\150\157\x72\x69\172\141\x74\x69\157\156\72\x20" . $Nv;
        $NS = '';
        $NS = array("\164\x78\x49\x64" => $D6, "\164\x6f\x6b\x65\156" => $XC);
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\145\156\x74\x2d\124\171\x70\x65\72\40\141\x70\x70\154\151\143\x61\x74\151\157\156\x2f\152\x73\157\x6e", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        $Gk = get_option("\155\157\137\x70\x72\x6f\x78\171\x5f\150\157\163\x74");
        if (empty($Gk)) {
            goto aB;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\157\137\160\162\x6f\x78\171\x5f\x68\x6f\163\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\157\137\160\x72\x6f\x78\x79\137\x70\x6f\162\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\x6d\x6f\137\x70\x72\157\x78\x79\137\x75\163\x65\162\156\x61\155\145") . "\x3a" . get_option("\155\x6f\x5f\x70\162\x6f\x78\x79\137\x70\141\163\163\167\x6f\162\144"));
        aB:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto nn;
        }
        echo "\x52\x65\x71\165\145\163\x74\x20\x45\x72\162\x6f\162\72" . curl_error($ZR);
        die;
        nn:
        curl_close($ZR);
        return $Rv;
    }
    function submit_contact_us($Ke, $Px, $h6)
    {
        $current_user = wp_get_current_user();
        $h6 = "\133\127\x50\40\x53\101\115\x4c\x20\x32\x2e\60\x20\123\120\40\123\x53\117\x20\120\x72\145\x6d\x69\x75\x6d\x20\x50\x6c\x75\x67\151\x6e\135\x20" . $h6;
        $NS = array("\x66\151\x72\163\x74\x4e\x61\x6d\x65" => $current_user->user_firstname, "\154\141\163\164\x4e\141\x6d\145" => $current_user->user_lastname, "\x63\x6f\155\x70\x61\156\171" => $_SERVER["\123\105\x52\x56\x45\122\137\116\101\115\x45"], "\x65\x6d\141\151\154" => $Ke, "\x70\150\x6f\156\145" => $Px, "\x71\x75\145\162\x79" => $h6);
        $k5 = json_encode($NS);
        $bX = get_option("\x6d\x6f\137\163\141\x6d\x6c\137\150\x6f\x73\164\137\156\141\x6d\x65") . "\x2f\155\157\x61\163\57\x72\x65\x73\x74\x2f\x63\x75\x73\164\157\x6d\145\x72\57\143\x6f\x6e\x74\141\143\x74\x2d\x75\163";
        $ZR = curl_init($bX);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\145\156\x74\55\124\x79\x70\x65\72\x20\141\x70\160\x6c\x69\x63\141\164\151\x6f\156\57\x6a\163\x6f\x6e", "\143\x68\x61\162\163\145\164\72\x20\x55\124\x46\55\x38", "\101\165\164\x68\x6f\x72\151\x7a\x61\164\x69\157\156\72\x20\x42\x61\163\151\143"));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        $Gk = get_option("\x6d\157\137\x70\162\x6f\170\171\x5f\x68\157\163\164");
        if (empty($Gk)) {
            goto oS;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\x6f\x5f\160\162\x6f\x78\171\x5f\150\x6f\x73\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\155\157\x5f\160\162\x6f\x78\x79\x5f\160\157\162\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\155\157\137\x70\x72\157\x78\171\137\x75\x73\145\x72\156\141\x6d\145") . "\x3a" . get_option("\x6d\x6f\x5f\x70\162\x6f\170\x79\137\160\141\163\163\167\157\x72\144"));
        oS:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto Zo;
        }
        echo "\x52\145\x71\165\x65\x73\164\x20\105\162\x72\x6f\162\x3a" . curl_error($ZR);
        return false;
        Zo:
        curl_close($ZR);
        return true;
    }
    function save_external_idp_config()
    {
        $bX = get_option("\x6d\x6f\x5f\x73\141\x6d\x6c\x5f\150\x6f\x73\x74\x5f\156\x61\x6d\145") . "\57\155\157\x61\x73\x2f\x72\x65\x73\164\57\x73\141\x6d\154\57\x73\141\166\x65\55\143\x6f\156\146\x69\147\165\x72\141\164\151\x6f\x6e";
        $ZR = curl_init($bX);
        $current_user = wp_get_current_user();
        $this->email = get_option("\x6d\157\137\x73\141\x6d\x6c\137\x61\x64\155\151\156\137\145\x6d\x61\x69\154");
        $this->phone = get_option("\155\157\137\x73\x61\155\154\x5f\x61\x64\155\151\156\x5f\160\150\x6f\156\x65");
        $wi = "\163\x61\x6d\154";
        $X4 = get_option("\x73\x61\x6d\154\x5f\151\x64\x65\x6e\x74\151\x74\171\x5f\x6e\x61\155\145");
        $th = $bX;
        $cv = get_option("\x6d\157\x5f\163\141\x6d\154\x5f\141\x64\155\x69\156\137\x70\141\x73\163\167\157\x72\x64");
        $OD = get_option("\x6d\x6f\137\x73\x61\155\x6c\137\141\144\155\x69\x6e\137\x63\165\x73\164\157\155\x65\x72\137\x6b\145\171");
        $Jf = get_option("\163\x61\x6d\154\137\x6c\x6f\x67\151\156\137\x75\162\x6c");
        $tz = get_option("\x73\141\x6d\154\x5f\151\x73\163\x75\145\162");
        $aI = maybe_unserialize(get_option("\x73\x61\155\x6c\x5f\x78\x35\x30\x39\137\143\145\x72\x74\151\146\151\143\x61\x74\x65"));
        $aI = is_array($aI) ? $aI[0] : $aI;
        $e3 = get_option("\x73\x61\155\154\137\151\144\160\137\143\x6f\x6e\146\151\147\x5f\151\x64");
        $xg = get_option("\163\141\155\x6c\137\141\x73\x73\145\162\164\151\157\156\137\163\x69\147\156\145\144") == "\x63\x68\145\143\153\145\x64" ? "\x74\x72\x75\x65" : "\x66\141\x6c\163\145";
        $uA = get_option("\163\141\155\x6c\137\162\x65\163\x70\x6f\156\x73\145\x5f\x73\x69\x67\x6e\145\x64") == "\x63\150\x65\143\153\145\x64" ? "\x74\162\x75\145" : "\x66\141\154\163\x65";
        $NS = array("\x63\165\x73\x74\157\x6d\145\x72\x49\x64" => $OD, "\151\x64\160\x54\x79\x70\145" => $wi, "\x69\x64\x65\156\164\x69\146\151\x65\x72" => $X4, "\x73\x61\155\x6c\x4c\x6f\147\x69\x6e\x55\162\x6c" => $Jf, "\x73\141\x6d\154\x4c\x6f\x67\157\x75\164\125\162\154" => $Jf, "\x69\144\x70\x45\x6e\x74\x69\164\171\111\144" => $tz, "\163\141\x6d\x6c\x58\65\60\71\103\145\x72\x74\151\146\151\143\141\x74\x65" => $aI, "\141\163\163\145\x72\x74\151\x6f\156\x53\x69\147\x6e\145\x64" => $xg, "\x72\x65\x73\x70\157\156\x73\x65\x53\151\147\x6e\x65\144" => $uA, "\157\x76\x65\162\x72\151\144\145\122\x65\164\x75\162\156\125\162\154" => "\x74\162\x75\145", "\162\x65\164\165\x72\156\125\162\154" => home_url() . "\57\x3f\157\160\x74\x69\157\156\x3d\162\145\x61\x64\163\x61\155\154\x6c\157\x67\151\x6e");
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\x6f\156\164\x65\x6e\x74\55\x54\x79\x70\x65\72\40\x61\160\160\154\151\143\x61\x74\x69\x6f\x6e\x2f\152\163\157\x6e", "\143\x68\141\162\163\x65\164\x3a\40\x55\124\x46\x20\x2d\x20\70", "\101\x75\164\150\157\162\x69\x7a\x61\164\151\x6f\156\x3a\x20\x42\141\x73\151\143"));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        $Gk = get_option("\155\x6f\137\160\x72\x6f\170\x79\137\x68\157\x73\164");
        if (empty($Gk)) {
            goto Zi;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\x6f\x5f\x70\162\157\x78\x79\x5f\150\x6f\x73\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\157\x5f\160\x72\157\x78\171\x5f\160\x6f\162\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\x6d\157\137\x70\x72\157\170\x79\137\x75\163\145\x72\156\x61\x6d\x65") . "\72" . get_option("\x6d\x6f\137\160\162\157\x78\x79\137\x70\x61\163\163\x77\157\x72\144"));
        Zi:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto th;
        }
        echo "\x52\145\x71\x75\x65\x73\x74\40\x45\162\x72\157\162\72" . curl_error($ZR);
        die;
        th:
        curl_close($ZR);
        return $Rv;
    }
    function mo_saml_send_alert_email($j1)
    {
        $bX = get_option("\155\157\137\x73\x61\155\x6c\137\x68\x6f\x73\164\137\x6e\x61\x6d\x65") . "\x2f\155\x6f\x61\x73\x2f\141\160\x69\57\156\x6f\x74\151\x66\x79\57\x73\x65\156\x64";
        $ZR = curl_init($bX);
        $xh = get_option("\x6d\157\137\163\141\155\x6c\137\x61\144\155\x69\x6e\x5f\x63\165\163\164\157\155\145\162\137\x6b\145\171");
        $Rl = get_option("\155\x6f\x5f\x73\141\155\154\x5f\x61\144\155\x69\156\x5f\x61\160\151\x5f\x6b\x65\171");
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\x73\150\x61\x35\x31\62", $W8);
        $Ld = "\x43\165\x73\x74\157\x6d\145\x72\55\x4b\x65\x79\72\x20" . $xh;
        $NY = "\124\x69\x6d\145\163\x74\x61\155\x70\72\40" . number_format($JG, 0, '', '');
        $PQ = "\x41\165\x74\150\157\x72\151\172\141\x74\x69\x6f\156\x3a\40" . $Nv;
        $qE = get_option("\x6d\157\x5f\x73\x61\x6d\x6c\137\x61\144\155\x69\156\x5f\145\155\141\151\x6c");
        $Rv = "\110\x65\x6c\x6c\x6f\x2c\x3c\142\162\x3e\74\142\x72\76\131\157\x75\162\x20\74\142\76\x46\x52\x45\105\40\x54\x72\x69\141\x6c\74\57\x62\x3e\x20\x77\x69\154\x6c\40\145\170\160\151\162\x65\x20\x69\x6e\40" . $j1 . "\x20\144\141\171\163\x20\x66\157\x72\40\155\151\156\x69\117\x72\x61\156\147\145\x20\123\x41\115\x4c\x20\160\154\x75\147\x69\156\x20\157\156\40\171\157\165\x72\40\x77\145\142\163\151\x74\145\40\x3c\142\x3e" . get_bloginfo() . "\x3c\57\142\x3e\56\74\142\x72\76\x3c\x62\162\x3e" . addLink("\103\x6c\151\x63\x6b\x20\x68\x65\x72\145", "\150\x74\164\160\x73\x3a\57\x2f\141\x75\164\150\x2e\155\151\x6e\x69\157\x72\x61\156\147\x65\56\143\x6f\155\x2f\155\157\141\163\57\x6c\x6f\147\x69\x6e\77\x72\145\x64\x69\162\145\x63\x74\x55\x72\x6c\x3d\150\x74\x74\160\163\72\x2f\57\x61\165\x74\150\56\x6d\x69\x6e\x69\x6f\162\141\156\147\x65\56\143\x6f\x6d\x2f\x6d\x6f\x61\163\x2f\151\156\151\x74\x69\x61\x6c\x69\x7a\145\160\x61\171\x6d\145\x6e\x74\x26\162\145\161\165\145\x73\x74\x4f\x72\151\147\x69\x6e\75\167\x70\x5f\163\x61\155\154\137\x73\x73\157\x5f\142\x61\x73\151\143\x5f\x70\154\141\x6e") . "\x20\164\157\40\165\160\147\162\x61\x64\x65\40\x74\157\x20\157\x75\162\x20\x70\162\145\x6d\x69\x75\x6d\x20\x70\154\x61\x6e\40\x73\x6f\x6f\x6e\x20\x69\146\x20\171\157\x75\x20\167\x61\156\164\x20\164\157\40\x63\157\x6e\164\151\x6e\x75\x65\x20\x75\x73\x69\156\x67\x20\157\165\162\x20\160\x6c\165\x67\151\156\56\x20\x59\x6f\165\x20\x63\x61\156\x20\162\x65\x66\x65\x72\40\114\151\143\145\x6e\x73\151\x6e\147\40\164\141\142\x20\146\157\162\40\x6f\x75\162\40\160\162\145\x6d\x69\165\x6d\x20\160\x6c\x61\x6e\x73\x2e\x3c\x62\x72\x3e\74\142\162\76\x54\150\x61\156\153\x73\x2c\74\142\x72\x3e\x6d\x69\x6e\151\x4f\x72\141\156\x67\145";
        $Y4 = "\124\162\151\x61\154\40\166\x65\162\x73\x69\x6f\156\40\145\170\160\x69\x72\151\x6e\x67\40\151\156\x20" . $j1 . "\40\x64\x61\171\163\x20\146\157\x72\x20\x6d\x69\x6e\151\x4f\162\x61\x6e\x67\x65\40\x53\101\x4d\114\x20\x70\x6c\x75\147\151\156\40\174\40" . get_bloginfo();
        if (!($j1 == 1)) {
            goto X1;
        }
        $Rv = str_replace("\x64\141\x79\163", "\x64\141\x79", $Rv);
        $Y4 = str_replace("\144\141\x79\163", "\x64\x61\x79", $Y4);
        X1:
        $NS = array("\143\x75\x73\x74\157\x6d\x65\x72\x4b\145\171" => $xh, "\x73\145\x6e\x64\105\155\x61\151\154" => true, "\x65\x6d\x61\x69\x6c" => array("\143\165\x73\164\157\155\145\162\x4b\x65\171" => $xh, "\x66\x72\x6f\x6d\x45\x6d\141\151\x6c" => "\151\156\x66\x6f\x40\155\x69\x6e\151\x6f\x72\x61\x6e\147\x65\56\143\x6f\155", "\142\x63\143\x45\x6d\141\x69\154" => "\141\x6e\x69\162\142\x61\x6e\100\x6d\151\x6e\151\x6f\162\x61\x6e\147\x65\56\143\157\155", "\146\162\157\155\x4e\141\x6d\x65" => "\155\151\x6e\x69\117\162\x61\x6e\147\x65", "\164\x6f\105\x6d\141\x69\154" => $qE, "\x74\157\116\x61\x6d\x65" => $qE, "\x73\165\x62\152\x65\x63\x74" => $Y4, "\x63\x6f\156\x74\145\156\164" => $Rv));
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\x65\156\164\x2d\124\171\160\x65\x3a\40\141\x70\160\154\x69\143\141\x74\x69\x6f\x6e\57\x6a\163\x6f\x6e", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        curl_setopt($ZR, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ZR, CURLOPT_TIMEOUT, 20);
        $Gk = get_option("\155\x6f\x5f\160\162\157\x78\x79\137\x68\x6f\163\x74");
        if (empty($Gk)) {
            goto uy;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\157\137\160\x72\x6f\x78\171\x5f\150\157\x73\164"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\x6f\137\x70\x72\157\x78\171\x5f\x70\157\162\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\155\157\137\x70\162\157\170\171\137\x75\x73\x65\x72\156\x61\x6d\x65") . "\72" . get_option("\x6d\x6f\137\x70\x72\157\x78\x79\x5f\x70\x61\163\x73\x77\x6f\162\x64"));
        uy:
        $Rv = curl_exec($ZR);
        curl_close($ZR);
    }
    function mo_saml_forgot_password($Ke)
    {
        $bX = get_option("\155\x6f\x5f\163\141\x6d\154\137\150\157\163\x74\137\156\141\155\145") . "\x2f\155\157\141\163\x2f\x72\145\x73\x74\57\x63\165\163\164\157\155\145\x72\57\160\x61\x73\x73\x77\157\162\x64\55\162\145\x73\145\x74";
        $ZR = curl_init($bX);
        $xh = get_option("\155\157\137\163\x61\x6d\154\x5f\141\x64\x6d\x69\156\137\143\x75\163\x74\157\155\145\162\137\x6b\145\x79");
        $Rl = get_option("\155\x6f\137\x73\141\155\154\x5f\x61\144\x6d\151\156\137\x61\x70\x69\137\x6b\145\x79");
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\x73\150\141\65\61\x32", $W8);
        $Ld = "\103\165\x73\164\x6f\x6d\x65\162\55\113\x65\x79\x3a\x20" . $xh;
        $NY = "\x54\151\155\x65\163\164\141\155\160\72\x20" . number_format($JG, 0, '', '');
        $PQ = "\x41\165\164\150\x6f\x72\x69\x7a\x61\164\x69\157\156\x3a\40" . $Nv;
        $NS = '';
        $NS = array("\145\155\141\151\154" => $Ke);
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\157\156\164\x65\156\x74\x2d\124\171\160\x65\72\x20\x61\160\160\x6c\151\143\x61\x74\151\157\x6e\x2f\x6a\x73\157\x6e", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        curl_setopt($ZR, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ZR, CURLOPT_TIMEOUT, 20);
        $Gk = get_option("\x6d\157\x5f\160\162\157\170\171\137\x68\157\x73\164");
        if (empty($Gk)) {
            goto a3;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\157\x5f\160\x72\x6f\x78\171\137\x68\157\x73\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\157\137\160\x72\x6f\170\x79\137\x70\x6f\162\164"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\155\157\137\160\162\x6f\x78\171\x5f\165\163\145\162\x6e\141\155\145") . "\x3a" . get_option("\x6d\157\x5f\x70\x72\157\x78\x79\137\160\141\163\163\x77\157\x72\x64"));
        a3:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto f4;
        }
        echo "\x52\x65\161\x75\145\163\164\x20\x45\x72\x72\157\x72\72" . curl_error($ZR);
        die;
        f4:
        curl_close($ZR);
        return $Rv;
    }
    function mo_saml_vl($og, $bC)
    {
        $bX = '';
        if ($bC) {
            goto JR;
        }
        $bX = get_option("\x6d\157\137\x73\141\155\x6c\x5f\150\x6f\163\164\x5f\x6e\141\155\145") . "\x2f\x6d\x6f\141\163\x2f\x61\x70\x69\x2f\x62\x61\x63\153\x75\160\143\x6f\144\145\57\x76\145\x72\x69\x66\x79";
        goto Dr;
        JR:
        $bX = get_option("\x6d\x6f\x5f\x73\x61\x6d\154\137\x68\x6f\x73\164\137\156\141\155\145") . "\57\x6d\157\x61\163\x2f\141\x70\x69\57\142\x61\x63\x6b\x75\x70\143\157\144\x65\x2f\x63\150\145\143\153";
        Dr:
        $ZR = curl_init($bX);
        $xh = get_option("\155\x6f\137\163\141\x6d\x6c\137\x61\144\155\151\156\x5f\x63\165\x73\164\x6f\155\x65\x72\x5f\x6b\x65\x79");
        $Rl = get_option("\155\x6f\x5f\x73\x61\x6d\x6c\137\x61\144\155\151\156\137\x61\160\x69\x5f\x6b\x65\x79");
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\163\x68\x61\x35\61\62", $W8);
        $Ld = "\103\165\x73\x74\x6f\x6d\145\x72\55\113\x65\x79\72\x20" . $xh;
        $NY = "\x54\x69\155\145\x73\164\141\155\x70\72\x20" . number_format($JG, 0, '', '');
        $PQ = "\101\x75\x74\x68\x6f\x72\151\172\x61\164\151\157\156\x3a\40" . $Nv;
        $NS = '';
        $NS = array("\x63\157\x64\145" => $og, "\x63\x75\163\164\x6f\x6d\145\162\x4b\145\x79" => $xh, "\141\144\x64\151\x74\151\x6f\x6e\141\154\x46\151\145\154\x64\x73" => array("\x66\x69\145\x6c\x64\61" => home_url()));
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\x65\x6e\164\x2d\124\171\160\145\72\40\x61\x70\x70\154\x69\143\x61\164\151\x6f\x6e\x2f\152\163\157\x6e", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        curl_setopt($ZR, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ZR, CURLOPT_TIMEOUT, 20);
        $Gk = get_option("\x6d\157\x5f\x70\162\x6f\170\171\x5f\x68\x6f\x73\x74");
        if (empty($Gk)) {
            goto pf;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\x6d\157\x5f\x70\162\157\170\x79\137\x68\x6f\163\164"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\157\x5f\160\162\157\x78\171\x5f\160\x6f\x72\164"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\x6d\x6f\137\x70\x72\x6f\x78\x79\x5f\165\x73\145\x72\x6e\x61\155\x65") . "\72" . get_option("\x6d\157\x5f\x70\x72\x6f\x78\171\137\x70\x61\x73\x73\167\x6f\x72\144"));
        pf:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto II;
        }
        echo "\x52\x65\161\x75\x65\x73\164\x20\105\162\162\157\x72\72" . curl_error($ZR);
        die;
        II:
        curl_close($ZR);
        return $Rv;
    }
    function check_customer_ln()
    {
        $bX = get_option("\155\157\137\x73\x61\155\154\x5f\150\157\x73\164\x5f\156\x61\x6d\145") . "\x2f\x6d\157\x61\x73\x2f\x72\145\x73\164\x2f\143\165\x73\x74\x6f\155\x65\x72\57\154\x69\x63\x65\x6e\x73\x65";
        $ZR = curl_init($bX);
        $xh = get_option("\155\x6f\137\163\141\x6d\x6c\x5f\x61\x64\155\x69\x6e\137\143\165\163\x74\x6f\155\x65\162\137\153\145\x79");
        $Rl = get_option("\x6d\x6f\137\x73\141\155\154\x5f\x61\144\x6d\x69\x6e\137\141\x70\151\x5f\153\x65\x79");
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\x73\x68\x61\x35\x31\x32", $W8);
        $Ld = "\103\x75\x73\x74\x6f\155\145\x72\x2d\x4b\145\x79\x3a\40" . $xh;
        $NY = "\x54\x69\155\145\163\164\x61\x6d\160\72\40" . $JG;
        $PQ = "\x41\x75\164\150\157\162\151\x7a\141\x74\x69\x6f\156\72\40" . $Nv;
        $NS = '';
        $NS = array("\143\165\163\x74\157\155\x65\x72\111\144" => $xh, "\x61\160\x70\x6c\x69\x63\141\164\151\157\x6e\116\x61\155\145" => "\167\x70\x5f\163\141\x6d\x6c\137\163\x73\x6f\x5f\x73\164\x61\x6e\144\x61\162\144\137\160\x6c\x61\156");
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\157\156\x74\145\156\164\55\x54\171\x70\145\72\40\x61\160\160\154\x69\143\141\x74\x69\x6f\x6e\57\x6a\x73\157\x6e", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        curl_setopt($ZR, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ZR, CURLOPT_TIMEOUT, 20);
        $Gk = get_option("\155\x6f\x5f\160\162\x6f\x78\x79\137\x68\157\163\164");
        if (empty($Gk)) {
            goto U3;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\157\137\x70\162\x6f\170\171\137\150\x6f\163\164"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\155\157\137\160\x72\157\170\171\x5f\160\157\x72\164"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\155\x6f\x5f\x70\162\157\x78\x79\x5f\x75\x73\145\162\x6e\x61\155\x65") . "\72" . get_option("\x6d\x6f\x5f\x70\162\157\x78\171\137\x70\141\163\x73\x77\157\x72\144"));
        U3:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto up;
        }
        return false;
        up:
        curl_close($ZR);
        return $Rv;
    }
    function mo_saml_update_status()
    {
        $bX = get_option("\155\157\137\x73\141\x6d\x6c\x5f\x68\157\x73\164\x5f\156\x61\155\x65") . "\57\x6d\157\141\163\57\141\x70\x69\57\x62\141\x63\x6b\x75\160\143\x6f\x64\145\57\x75\160\144\x61\164\x65\163\x74\141\164\165\x73";
        $ZR = curl_init($bX);
        $xh = get_option("\x6d\157\137\163\141\155\154\x5f\141\x64\155\151\156\x5f\x63\x75\163\x74\157\155\145\162\137\x6b\145\171");
        $Rl = get_option("\x6d\x6f\137\163\x61\155\x6c\x5f\x61\x64\x6d\151\156\137\x61\160\x69\x5f\x6b\x65\x79");
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\x73\150\x61\x35\x31\x32", $W8);
        $Ld = "\x43\x75\x73\164\157\155\x65\x72\x2d\113\x65\x79\72\40" . $xh;
        $NY = "\x54\x69\x6d\x65\x73\x74\141\x6d\x70\x3a\40" . number_format($JG, 0, '', '');
        $PQ = "\101\x75\164\150\157\x72\151\172\x61\x74\x69\157\x6e\72\x20" . $Nv;
        $Yy = get_option("\x6d\x6f\137\x73\x61\x6d\154\137\x63\165\x73\x74\157\155\x65\x72\x5f\x74\x6f\153\145\156");
        $og = AESEncryption::decrypt_data(get_option("\x73\x6d\154\x5f\x6c\x6b"), $Yy);
        $NS = array("\x63\x6f\x64\x65" => $og, "\x63\165\x73\164\x6f\x6d\145\162\113\x65\x79" => $xh, "\141\x64\x64\151\164\151\157\x6e\x61\154\x46\151\x65\x6c\x64\163" => array("\x66\151\x65\154\144\61" => home_url()));
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\x65\156\164\55\124\x79\x70\x65\x3a\x20\141\160\160\x6c\x69\x63\x61\164\x69\157\x6e\x2f\x6a\x73\157\156", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        curl_setopt($ZR, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ZR, CURLOPT_TIMEOUT, 20);
        $Gk = get_option("\155\x6f\137\x70\162\x6f\x78\x79\x5f\150\x6f\163\164");
        if (empty($Gk)) {
            goto ru;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\157\x5f\x70\162\x6f\x78\171\x5f\x68\x6f\163\x74"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\x6d\157\x5f\160\x72\157\170\x79\137\160\x6f\x72\164"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\155\157\x5f\x70\162\x6f\x78\x79\137\165\163\x65\x72\156\x61\155\145") . "\x3a" . get_option("\x6d\x6f\137\x70\x72\157\170\171\x5f\x70\141\x73\163\167\x6f\162\144"));
        ru:
        $Rv = curl_exec($ZR);
        if (!curl_errno($ZR)) {
            goto j5;
        }
        echo "\x52\145\x71\165\x65\163\164\40\x45\x72\162\157\x72\72" . curl_error($ZR);
        die;
        j5:
        curl_close($ZR);
        return $Rv;
    }
    function mo_saml_send_user_exceeded_alert_email($ue)
    {
        $bX = get_option("\155\x6f\x5f\x73\141\155\154\x5f\150\x6f\x73\x74\x5f\x6e\141\155\x65") . "\x2f\x6d\x6f\141\163\x2f\141\160\x69\x2f\x6e\x6f\x74\151\x66\171\x2f\163\x65\156\x64";
        $ZR = curl_init($bX);
        $xh = get_option("\155\157\137\163\141\155\154\x5f\141\x64\x6d\151\x6e\137\x63\165\163\x74\x6f\x6d\x65\x72\x5f\153\145\x79");
        $Rl = get_option("\155\x6f\x5f\163\x61\155\x6c\x5f\x61\x64\x6d\151\156\x5f\141\x70\151\137\153\x65\171");
        $JG = round(microtime(true) * 1000);
        $W8 = $xh . number_format($JG, 0, '', '') . $Rl;
        $Nv = hash("\163\150\141\65\x31\62", $W8);
        $Ld = "\103\165\x73\164\157\x6d\x65\x72\x2d\113\145\x79\x3a\40" . $xh;
        $NY = "\124\x69\x6d\x65\163\164\141\x6d\160\72\x20" . number_format($JG, 0, '', '');
        $PQ = "\101\165\164\x68\x6f\162\x69\172\x61\164\151\157\x6e\x3a\x20" . $Nv;
        $qE = get_option("\155\157\137\x73\141\x6d\x6c\137\x61\144\155\x69\156\137\145\155\x61\x69\154");
        $Rv = "\x48\145\154\154\x6f\x2c\x3c\142\x72\x3e\74\142\162\x3e\x59\x6f\x75\x20\150\141\x76\145\40\160\x75\162\x63\x68\141\x73\145\144\x20\154\x69\x63\x65\156\163\145\40\x66\x6f\x72\x20\123\101\115\x4c\40\x53\x69\156\x67\x6c\x65\x20\123\151\x67\156\55\x4f\156\x20\120\154\165\x67\x69\156\x20\x66\157\162\x20\74\142\x3e" . $ue . "\40\165\x73\x65\x72\x73\x3c\57\142\76\56\40\x41\163\x20\x6e\x75\155\142\x65\162\40\157\x66\40\165\163\145\x72\163\x20\x6f\156\40\171\x6f\165\162\x20\x73\151\164\x65\40\x68\141\166\145\x20\147\x72\157\x77\x6e\x20\x74\157\x20\155\157\162\x65\x20\164\150\x61\156\x20" . $ue . "\x20\x75\x73\x65\162\x73\x20\x6e\x6f\x77\x2e\40\131\157\x75\40\163\150\x6f\165\154\x64\x20\x75\160\147\x72\141\144\145\40\x79\157\x75\162\x20\154\x69\x63\145\x6e\x73\x65\x20\146\x6f\x72\x20\155\x69\156\x69\x4f\x72\x61\x6e\x67\145\40\x53\101\115\114\40\x70\x6c\165\x67\x69\156\40\157\156\x20\x79\x6f\165\x72\x20\x77\145\142\x73\151\x74\145\40\74\x62\x3e" . get_bloginfo() . "\x3c\57\142\76\x2e\74\142\162\x3e\x3c\x62\x72\x3e" . addLink("\x43\154\x69\143\153\x20\x68\x65\162\145", get_option("\155\157\137\x73\141\x6d\154\137\150\x6f\163\164\x5f\x6e\141\x6d\x65") . "\57\x6d\157\141\x73\57\154\157\x67\x69\x6e\x3f\x72\145\144\x69\x72\145\143\x74\x55\x72\154\x3d" . get_option("\155\157\x5f\x73\141\155\154\x5f\150\157\x73\x74\x5f\x6e\x61\x6d\145") . "\57\151\156\x69\x74\x69\141\x6c\151\172\145\x70\x61\171\155\145\x6e\x74\46\162\x65\161\165\145\x73\164\x4f\x72\151\147\x69\156\75\167\x70\x5f\x73\x61\x6d\154\137\x73\x73\157\x5f\x73\x74\x61\x6e\144\x61\x72\x64\x5f\165\160\147\x72\141\x64\145\137\x70\x6c\141\x6e") . "\x20\x74\x6f\40\x75\160\x67\x72\141\144\145\40\x74\x68\145\40\154\151\143\145\x6e\163\145\x20\164\x6f\x20\143\157\156\x74\x69\x6e\165\x65\40\x75\x73\x69\156\x67\40\157\x75\x72\40\160\154\x75\147\151\x6e\56\74\x62\162\76\x3c\142\162\76\124\150\x61\x6e\x6b\x73\54\x3c\x62\x72\76\x6d\151\156\151\x4f\x72\x61\x6e\147\145";
        $Y4 = "\105\170\x63\x65\145\x64\x65\x64\x20\x4c\x69\x63\145\x6e\163\145\x20\114\x69\x6d\x69\x74\x20\x46\157\162\x20\116\x6f\40\x4f\146\40\x55\163\x65\162\163\x20\x2d\40\127\157\x72\144\120\162\145\x73\163\40\x53\101\115\114\x20\123\x69\156\147\154\145\x20\x53\x69\x67\156\x2d\117\x6e\40\120\x6c\165\147\151\156\x20\x7c\40" . get_bloginfo();
        update_option("\165\x73\x65\x72\x5f\x61\154\145\162\x74\137\145\155\141\151\x6c\x5f\x73\x65\x6e\x74", 1);
        $NS = array("\143\x75\x73\164\x6f\155\x65\162\x4b\x65\171" => $xh, "\163\145\x6e\144\105\155\141\x69\154" => true, "\145\x6d\x61\x69\154" => array("\143\165\x73\x74\x6f\x6d\x65\x72\113\145\x79" => $xh, "\x66\x72\x6f\155\105\x6d\141\x69\x6c" => "\x69\x6e\146\x6f\x40\155\151\156\x69\157\x72\141\156\x67\x65\56\143\157\x6d", "\x62\x63\x63\x45\x6d\141\151\x6c" => "\x69\x6e\146\x6f\100\x6d\x69\x6e\x69\x6f\162\x61\x6e\x67\145\56\143\157\155", "\146\162\157\x6d\116\141\155\145" => "\x6d\151\x6e\x69\117\162\141\x6e\x67\x65", "\164\157\x45\x6d\x61\151\x6c" => $qE, "\x74\157\x4e\x61\155\x65" => $qE, "\x73\165\x62\152\145\143\164" => $Y4, "\x63\x6f\156\164\145\x6e\164" => $Rv));
        $k5 = json_encode($NS);
        curl_setopt($ZR, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ZR, CURLOPT_ENCODING, '');
        curl_setopt($ZR, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ZR, CURLOPT_AUTOREFERER, true);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ZR, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ZR, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ZR, CURLOPT_HTTPHEADER, array("\103\157\156\164\145\x6e\164\x2d\124\171\x70\x65\x3a\40\x61\x70\x70\x6c\x69\x63\x61\x74\151\x6f\156\x2f\x6a\163\157\156", $Ld, $NY, $PQ));
        curl_setopt($ZR, CURLOPT_POST, true);
        curl_setopt($ZR, CURLOPT_POSTFIELDS, $k5);
        curl_setopt($ZR, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ZR, CURLOPT_TIMEOUT, 20);
        $Gk = get_option("\155\x6f\x5f\160\162\x6f\x78\171\x5f\150\x6f\x73\164");
        if (empty($Gk)) {
            goto q2;
        }
        curl_setopt($ZR, CURLOPT_PROXY, get_option("\155\x6f\137\160\x72\x6f\170\171\x5f\x68\157\163\164"));
        curl_setopt($ZR, CURLOPT_PROXYPORT, get_option("\155\157\137\160\x72\157\x78\171\137\x70\157\162\x74"));
        curl_setopt($ZR, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ZR, CURLOPT_PROXYUSERPWD, get_option("\155\x6f\x5f\x70\x72\x6f\x78\171\137\x75\x73\145\162\x6e\x61\x6d\x65") . "\72" . get_option("\155\x6f\137\160\x72\x6f\170\x79\137\160\141\163\163\x77\157\162\144"));
        q2:
        $Rv = curl_exec($ZR);
        curl_close($ZR);
    }
}
?>
