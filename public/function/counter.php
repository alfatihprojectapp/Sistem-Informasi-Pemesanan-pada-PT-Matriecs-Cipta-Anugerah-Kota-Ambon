<?php
//proses
$filecounter = 'function/counter.txt';
$kunjungan = file($filecounter);
$kunjungan[0]++;
$file = fopen($filecounter, 'w');
fputs($file, "$kunjungan[0]");
fclose($file);
