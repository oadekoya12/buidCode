<?php
function addspantofirstletter($sentence = 'SURFACE TRANSPORTATION BOARD', $classname = 'stb-title-firstc'){
  $words = explode(' ', $sentence);

  foreach ($words as $w) {
    $str = substr($w, 1);
    $arrcm[] = ' <span class = '. $classname .'>' . $w[0] . '</span>' . $str;
  }
  $combinwords = implode(" ", $arrcm);
  echo $combinwords;
}
