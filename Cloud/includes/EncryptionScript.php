<?php
function encrypt_file($file, $destination, $passphrase){
	$ALGORITHM = 'AES-128-CBC';
	$IV = '12dasdq3g5b2434b';
	$contenuto = file_get_contents($file);
	$contenuto = openssl_encrypt($contenuto, $ALGORITHM, $passphrase, 0, $IV);
    $fp = fopen($destination,'wb') or die("Could not opn file for writing");
    fwrite($fp, $contenuto) or die('Could not write to file');
    fclose($fp);
}

function decrypt_file($file,$destination, $passphrase){
	$ALGORITHM = 'AES-128-CBC';
	$IV = '12dasdq3g5b2434b';
	$contenuto = file_get_contents($file);
	$contenuto = openssl_decrypt($contenuto, $ALGORITHM, $passphrase, 0, $IV);
	$fp = fopen($destination,'wb') or die("Could not opn file for writing");
    fwrite($fp, $contenuto) or die('Could not write to file');
    fclose($fp);
    return $contenuto;
}