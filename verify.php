<?php
$access_token = 'Byn9e9F5Rc0g8qLCu4r3TXOCtNzBiWSAo6g6pTFr+YoU4+Ammyv2RqRSJqLxENJhff1q4YW/3Er36lUm5Ce1Gubj/rOpkSiXGnGKCTUJ+lZtyJQZLa5QYdo1eKLmIfkev+OcNRW+fq4tGNGf+xgd+wdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>