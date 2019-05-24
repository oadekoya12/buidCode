<?php


class AESEncryption
{
    public static function encrypt_data($ui, $Yy)
    {
        $Yy = openssl_digest($Yy, "\x73\150\x61\62\65\x36");
        $kb = "\x41\105\x53\55\61\x32\x38\x2d\x45\103\x42";
        $P7 = openssl_cipher_iv_length($kb);
        $Br = openssl_random_pseudo_bytes($P7);
        $Yd = openssl_encrypt($ui, $kb, $Yy, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Br);
        return base64_encode($Br . $Yd);
    }
    public static function decrypt_data($ui, $Yy)
    {
        $fm = base64_decode($ui);
        $Yy = openssl_digest($Yy, "\163\150\141\x32\65\x36");
        $kb = "\101\x45\x53\x2d\x31\x32\x38\x2d\x45\x43\102";
        $P7 = openssl_cipher_iv_length($kb);
        $Br = substr($fm, 0, $P7);
        $ui = substr($fm, $P7);
        $dm = openssl_decrypt($ui, $kb, $Yy, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Br);
        return $dm;
    }
}
?>
