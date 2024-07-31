<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ImgurService
{
    private $client;
    private $clientId;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->clientId = "07112fd0bcea221";
    }

    public function uploadImageStream($stream)
    {
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

        if ($data['success']) {
            return [
                'success' => true,
                'data' => $data['data'],
            ];
        }

        return [
            'success' => false,
            'message' => $data['data']['error'],
        ];
    }
}
