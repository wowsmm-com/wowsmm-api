<?php

require __DIR__ . '/WowSMM.php';

$api = new WowSMM(getenv('WOWSMM_API_KEY') ?: 'YOUR_API_KEY');

print_r($api->balance());

$services = $api->services();
print_r(array_slice($services, 0, 5));

$order = $api->order(1, 'https://www.instagram.com/your_profile/', 100);
print_r($order);

if (isset($order['order'])) {
    print_r($api->status((int) $order['order']));
}
