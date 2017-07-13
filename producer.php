<?php

require 'vendor/autoload.php';

use Stomp\Client;
use Stomp\StatefulStomp;
use Stomp\Transport\Message;

$stomp = new StatefulStomp(new Client('tcp://localhost:61613'));

while (true) {
    $siteId = rand(1, 3);
    $siteAdId = rand(1, 2);
    $message = new Message(
        json_encode(
            [
                'site_ad_id' => $siteAdId,
                'site_id' => $siteId,
            ]
        ),
        [
            'JMSXGroupID' => sprintf('%s-%s', $siteId, $siteAdId),
        ]
    );
    $stomp->send('/ads', $message);
    sleep(1);
}


