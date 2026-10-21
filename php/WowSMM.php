<?php

class WowSMM
{
    private string $url = 'https://wowsmm.com/api/v2';
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function services(): array
    {
        return $this->call(['action' => 'services']);
    }

    public function order(int $service, string $link, int $quantity, array $extra = []): array
    {
        return $this->call(array_merge(['action' => 'add', 'service' => $service, 'link' => $link, 'quantity' => $quantity], $extra));
    }

    public function status(int $order): array
    {
        return $this->call(['action' => 'status', 'order' => $order]);
    }

    public function multiStatus(array $orders): array
    {
        return $this->call(['action' => 'status', 'orders' => implode(',', $orders)]);
    }

    public function refill(int $order): array
    {
        return $this->call(['action' => 'refill', 'order' => $order]);
    }

    public function cancel(array $orders): array
    {
        return $this->call(['action' => 'cancel', 'orders' => implode(',', $orders)]);
    }

    public function balance(): array
    {
        return $this->call(['action' => 'balance']);
    }

    private function call(array $data): array
    {
        $data['key'] = $this->key;
        $ch = curl_init($this->url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => 'WowSMM-PHP/1.0',
        ]);
        $body = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($body === false) {
            throw new RuntimeException('Request failed: ' . $error);
        }
        $json = json_decode($body, true);
        if (!is_array($json)) {
            throw new RuntimeException('Invalid response: ' . $body);
        }
        return $json;
    }
}
