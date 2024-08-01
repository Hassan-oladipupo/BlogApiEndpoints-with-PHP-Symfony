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
                $imageData = base64_encode(stream_get_contents($stream));
                $this->logger->info('Uploading image to Imgur', ['image_data_length' => strlen($imageData)]);

                $response = $this->client->request('POST', 'https://api.imgur.com/3/image', [
                    'headers' => [
                        'Authorization' => 'Client-ID ' . $this->clientId,
                    ],
                    'form_params' => [
                        'image' => $imageData,
                        'type' => 'base64',
                    ],
                ]);

                $content = $response->getBody()->getContents();
                $this->logger->info('Imgur API response content', ['content' => $content]);

                $data = json_decode($content, true);

                if (is_null($data)) {
                    $this->logger->error('Failed to decode JSON response', ['response' => $content]);
                    return [
                        'success' => false,
                        'message' => 'Failed to decode JSON response from Imgur API',
                    ];
                }

                if (isset($data['success']) && $data['success']) {
                    return [
                        'success' => true,
                        'data' => $data['data'],
                    ];
                }

                $errorMessage = isset($data['data']) && is_array($data['data'])
                    ? ($data['data']['error'] ?? 'Unknown error')
                    : 'Unknown error';

                $this->logger->error('Imgur upload failed', [
                    'response' => $data,
                    'status_code' => $response->getStatusCode(),
                    'response_body' => $content,
                ]);

                return [
                    'success' => false,
                    'message' => $errorMessage,
                ];
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                if ($e->getCode() === 429) {
                    $this->logger->info('Rate limit exceeded, retrying after backoff', [
                        'attempt' => $attempts,
                        'backoff' => $backoff,
                    ]);

                    sleep($backoff);
                    $backoff *= 2;
                    $attempts++;
                    continue;
                }

                $this->logger->error('ClientException during Imgur upload', [
                    'exception' => $e,
                    'response_body' => $e->getResponse()->getBody()->getContents() ?? 'No response body',
                ]);

                return [
                    'success' => false,
                    'message' => 'ClientException occurred: ' . $e->getMessage(),
                ];
            } catch (\Exception $e) {
                $this->logger->error('Exception during Imgur upload', [
                    'exception' => $e,
                ]);

                return [
                    'success' => false,
                    'message' => 'Exception occurred: ' . $e->getMessage(),
                ];
            }
        }
    }
}
