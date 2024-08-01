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
                $this->logger->info('Attempting to upload image to Imgur', ['attempt' => $attempts]);

                $response = $this->client->request('POST', 'https://api.imgur.com/3/image', [
                    'headers' => [
                        'Authorization' => 'Client-ID ' . $this->clientId,
                    ],
                    'form_params' => [
                        'image' => base64_encode(stream_get_contents($stream)),
                        'type' => 'base64',
                    ],
                    'timeout' => 30,
                ]);

                $this->logger->info('Received response from Imgur');

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
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->logger->error('Request error during Imgur upload', [
                    'exception' => $e,
                ]);

                if ($e->getResponse() && $e->getResponse()->getStatusCode() === 429) {
                    $this->logger->warning('Rate limit exceeded, backing off', [
                        'attempt' => $attempts,
                        'backoff' => $backoff,
                    ]);
                    sleep($backoff);
                    $backoff *= 2;
                } else {
                    return [
                        'success' => false,
                        'message' => 'Request error: ' . $e->getMessage(),
                    ];
                }
            } catch (\GuzzleHttp\Exception\ServerException $e) {
                $this->logger->error('Server error during Imgur upload', [
                    'exception' => $e,
                ]);

                // Handle server errors with retry logic
                if (++$attempts >= $retryCount) {
                    return [
                        'success' => false,
                        'message' => 'Server error: ' . $e->getMessage(),
                    ];
                }

                $this->logger->warning('Server error, retrying', [
                    'attempt' => $attempts,
                    'backoff' => $backoff,
                ]);
                sleep($backoff);
                $backoff *= 2;
            } catch (\Exception $e) {
                $this->logger->error('An unexpected error occurred during Imgur upload', [
                    'exception' => $e,
                ]);

                return [
                    'success' => false,
                    'message' => 'An unexpected error occurred: ' . $e->getMessage(),
                ];
            }
        }
    }
}
