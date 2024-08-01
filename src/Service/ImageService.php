<?php

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Exception\RequestException;

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
        $backoff = 1; // Initial backoff in seconds

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
                ]);

                return [
                    'success' => false,
                    'message' => $data['data']['error'] ?? 'Unknown error',
                ];
            } catch (RequestException $e) {
                $this->logger->error('An error occurred during Imgur upload', [
                    'exception' => $e,
                ]);

                if (++$attempts >= $retryCount) {
                    return [
                        'success' => false,
                        'message' => 'An unexpected error occurred: ' . $e->getMessage(),
                    ];
                }

                sleep($backoff); // Exponential backoff
                $backoff *= 2; // Double the backoff time
            }
        }
    }
}
