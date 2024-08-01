<?php

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

class ImgurService
{
    private $client;
    private $clientId;
    private $logger;

    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->clientId = "07112fd0bcea221";
        $this->logger = $logger;
    }

    public function uploadImageStream($stream, $retryCount = 3)
    {
        $attempts = 0;
        $backoff = 1;

        while ($attempts < $retryCount) {
            try {
                $response = $this->client->request('POST', 'https://api.imgur.com/3/image', [
                    'headers' => [
                        'Authorization' => 'Client-ID ' . $this->clientId,
                    ],
                    'form_params' => [
                        'image' => base64_encode(stream_get_contents($stream)),
                        'type' => 'base64',
                    ],
                ]);

                $headers = $response->getHeaders();
                $clientRemaining = $headers['X-RateLimit-ClientRemaining'][0] ?? 'Unknown';
                $userRemaining = $headers['X-RateLimit-UserRemaining'][0] ?? 'Unknown';

                $content = $response->getBody()->getContents();
                $data = json_decode($content, true);

                if (isset($data['success']) && $data['success']) {
                    return [
                        'success' => true,
                        'data' => $data['data'],
                    ];
                }

                $this->logger->error('Imgur upload failed', [
                    'response' => $data,
                    'clientRemaining' => $clientRemaining,
                    'userRemaining' => $userRemaining,
                ]);

                return [
                    'success' => false,
                    'message' => $data['data']['error'] ?? 'Unknown error',
                ];
            } catch (\Exception $e) {
                $this->logger->error('An error occurred during Imgur upload', [
                    'exception' => $e,
                ]);

                if (++$attempts >= $retryCount) {
                    return [
                        'success' => false,
                        'message' => 'An unexpected error occurred: ' . $e->getMessage(),
                    ];
                }

                if ($e->getCode() == 429) {
                    $this->logger->warning('Too many requests, backing off', [
                        'attempt' => $attempts,
                        'backoff' => $backoff,
                        'clientRemaining' => $clientRemaining,
                        'userRemaining' => $userRemaining,
                    ]);
                    sleep($backoff);
                    $backoff *= 2;
                } else {
                    return [
                        'success' => false,
                        'message' => 'An unexpected error occurred: ' . $e->getMessage(),
                    ];
                }
            }
        }
    }
}
