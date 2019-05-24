<?php


class CertificateUtility
{
    public static function generate_certificate($ao, $zM, $fn)
    {
        $Ix = openssl_pkey_new();
        $vp = openssl_csr_new($ao, $Ix, $zM);
        $Vb = openssl_csr_sign($vp, null, $Ix, $fn, $zM, time());
        openssl_csr_export($vp, $BO);
        openssl_x509_export($Vb, $JM);
        openssl_pkey_export($Ix, $fM);
        E3:
        if (!(($sK = openssl_error_string()) !== false)) {
            goto k4;
        }
        error_log("\x43\145\x72\x74\151\x66\x69\143\x61\x74\145\x55\x74\151\154\151\164\171\72\40\105\x72\x72\157\x72\x20\x67\145\x6e\x65\x72\x61\164\x69\x6e\x67\40\143\x65\x72\164\151\146\x69\143\141\x74\x65\x2e\40" . $sK);
        goto E3;
        k4:
        $FL = array("\x70\x75\x62\154\151\x63\137\153\x65\171" => $JM, "\x70\162\x69\166\141\164\145\137\153\145\171" => $fM);
        return $FL;
    }
}
