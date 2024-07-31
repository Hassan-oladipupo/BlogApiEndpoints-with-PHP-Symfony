<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Psr\Log\LoggerInterface;

class ImgurService
{
    private $client;
    private $clientId;
    private $logger;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->clientId = "07112fd0bcea221";
        $this->logger = $logger;
    }

    public function uploadImageStream($stream)
    {
        try {
            $response = $this->client->request('POST', 'https://api.imgur.com/3/image', [
                'headers' => [
                    'Authorization' => 'Client-ID ' . $this->clientId,
                ],
                'body' => [
                    'image' => base64_encode(stream_get_contents($stream)),
                    'type' => 'base64',
                ],
            ]);

            $content = $response->getContent();
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
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Network error occurred during Imgur upload', [
                'exception' => $e,
            ]);

            return [
                'success' => false,
                'message' => 'Network error: ' . $e->getMessage(),
            ];
        } catch (\Exception $e) {
            $this->logger->error('An error occurred during Imgur upload', [
                'exception' => $e,
            ]);

            return [
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ];
        }
    }
}
