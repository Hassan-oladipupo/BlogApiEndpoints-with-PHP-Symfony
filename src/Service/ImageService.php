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

                $this->logRateLimitHeaders($response);

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

                if ($e->getCode() == 429 && $attempts < $retryCount) {
                    $this->logger->info('Rate limit hit, retrying after backoff', [
                        'attempts' => $attempts,
                        'backoff' => $backoff,
                    ]);

                    sleep($backoff); // Exponential backoff
                    $backoff *= 2; // Double the backoff time
                    $attempts++;
                    continue;
                }

                if (++$attempts >= $retryCount) {
                    return [
                        'success' => false,
                        'message' => 'An unexpected error occurred: ' . $e->getMessage(),
                    ];
                }
            }
        }
    }

    private function logRateLimitHeaders($response)
    {
        $headers = $response->getHeaders();
        $this->logger->info('Imgur Rate Limits', [
            'ClientLimit' => $headers['X-RateLimit-ClientLimit'][0] ?? 'N/A',
            'ClientRemaining' => $headers['X-RateLimit-ClientRemaining'][0] ?? 'N/A',
            'UserLimit' => $headers['X-RateLimit-UserLimit'][0] ?? 'N/A',
            'UserRemaining' => $headers['X-RateLimit-UserRemaining'][0] ?? 'N/A',
            'UserReset' => $headers['X-RateLimit-UserReset'][0] ?? 'N/A',
        ]);
    }
}
