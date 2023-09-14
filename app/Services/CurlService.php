<?php

namespace Reminder\App\Services;

class CurlService
{
    public function sendPostRequest(string $url, array $data, array $headers = []): void
    {
        $curl = curl_init();

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
        ];

        if (!empty($headers)) {
            $options[CURLOPT_HTTPHEADER] = $headers;
        }

        curl_setopt_array($curl, $options);
        curl_exec($curl);
        curl_close($curl);
    }
}
