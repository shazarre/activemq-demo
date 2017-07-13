<?php

require 'vendor/autoload.php';

use Stomp\Client;
use Stomp\StatefulStomp;

$stomp = new StatefulStomp(new Client('tcp://localhost:61613'));

$stomp->subscribe('/ads', null, 'client-individual');

while ($message = $stomp->read()) {
    $adToAnalyze = json_decode($message->getBody(), true);
    echo sprintf("Processing ad %s-%s\n", $adToAnalyze['site_id'], $adToAnalyze['site_ad_id']);
    $stomp->ack($message);
    sleep(2);
}