<?php

// api endpoint
$endPoint = 'https://webapp.usmsgh.com/api/sms/send';

// api key
$apiToken = '309|57D6wfBwUEPtd2MdSOkJkRA0wR0kHJpanM4Y6yBS';

// sender id
$senderId = 'MatrixMe';

// receiver number
$recipients = ['233279284896'];

// message
$message = 'Hello world, this is a test message';



foreach ($recipients as $key => $value) {
    $ch = curl_init();
    $data = [
        'recipient' => $value,
        'sender_id' => $senderId,
        'message'   => $message
    ];

    curl_setopt_array($ch, [
        CURLOPT_URL            => $endPoint,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            "accept: application/json",
            "authorization: Bearer " . $apiToken,
        ],
    ]);

    $resp = curl_exec($ch);

    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        $decoded = json_decode($resp, true);
        print_r($decoded);
    }
    curl_close($ch);
}
