<?php

$sendto = '+6282214054214';
$sendto1 = '+6289611256783';
$ch = curl_init();
$url = "https://smsgateway24.com/getdata/addsms";
 # add your city to set local time zone
$now = date('Y-m-d H:i:s');

$postarray = [
    'token' => '056b4067e1c0c9d954e412d98b8408cb',
    'sendto' => $sendto,
    'body'   => 'Halo Kopet! Layanan telah selesai ! Segera ambil anjing \n Salam, \n hangat ',
    'timetosend'   => $now,
    'device_id'   => 1845,
    'sim' => 0
];

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postarray);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$output = curl_exec($ch);
curl_close($ch);
echo $output;