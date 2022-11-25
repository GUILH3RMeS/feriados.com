<?php
function sanitizeString($convert) {
    $convert = preg_replace('/[áàãâä]/ui', 'a', $convert);
    $convert = preg_replace('/[éèêë]/ui', 'e', $convert);
    $convert = preg_replace('/[íìîï]/ui', 'i', $convert);
    $convert = preg_replace('/[óòõôö]/ui', 'o', $convert);
    $convert = preg_replace('/[úùûü]/ui', 'u', $convert);
    $convert = preg_replace('/[ç]/ui', 'c', $convert);
    // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '-', $str);
    return $convert;
}
?>