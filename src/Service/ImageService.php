<?php

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

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

    public function checkRateLimit()
    {
        try {
            $response = $this->client->request('GET', 'https://api.imgur.com/3/credits', [
                'headers' => [
                    'Authorization' => 'Client-ID ' . $this->clientId,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $this->logger->info('Imgur rate limit status', [
                'data' => $data,
            ]);

            return $data['data'];
        } catch (\Exception $e) {
            $this->logger->error('Failed to check Imgur rate limit', [
                'exception' => $e,
            ]);

            return null;
        }
    }

    public function uploadImageStream($stream, $retryCount = 3)
    {
        $attempts = 0;
        $backoff = 1; // Initial backoff in seconds

        while ($attempts < $retryCount) {
            try {
                $rateLimit = $this->checkRateLimit();

                if ($rateLimit && $rateLimit['ClientRemaining'] <= 0) {
                    $this->logger->warning('Rate limit exceeded', [
                        'rateLimit' => $rateLimit,
                    ]);

                    return [
                        'success' => false,
                        'message' => 'Rate limit exceeded. Try again later.',
                    ];
                }

                $this->logger->info('Attempting to upload image to Imgur', ['attempt' => $attempts]);

                $response = $this->client->request('POST', 'https://api.imgur.com/3/image', [
                    'headers' => [
                        'Authorization' => 'Client-ID ' . $this->clientId,
                    ],
                    'form_params' => [
                        'image' => base64_encode(stream_get_contents($stream)),
                        'type' => 'base64',
                    ],
                    'timeout' => 30, // Timeout after 30 seconds
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
            } catch (RequestException $e) {
                $this->logger->error('Request error during Imgur upload', [
                    'exception' => $e,
                ]);

                if ($e->hasResponse()) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $this->logger->warning('Received HTTP status code', [
                        'statusCode' => $statusCode,
                    ]);

                    if ($statusCode == 429) { // Too many requests
                        $this->logger->warning('Rate limit exceeded, backing off', [
                            'attempt' => $attempts,
                            'backoff' => $backoff,
                        ]);
                        sleep($backoff);
                        $backoff *= 2;
                    } elseif ($statusCode >= 500 && $statusCode < 600) { // Server errors
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
                    } else {
                        return [
                            'success' => false,
                            'message' => 'Request error: ' . $e->getMessage(),
                        ];
                    }
                } else {
                    return [
                        'success' => false,
                        'message' => 'Request error: ' . $e->getMessage(),
                    ];
                }
            } catch (ServerException $e) {
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
