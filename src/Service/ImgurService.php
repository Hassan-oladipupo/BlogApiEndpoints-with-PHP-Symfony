<?php

namespace App\Service;

use GuzzleHttp\Client;

class ImgurService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.imgur.com/3/',
            'headers' => [
                'Authorization' => 'Client-ID ' . $_ENV['IMGUR_CLIENT_ID'],
            ],
        ]);
    }

    public function uploadImage($imagePath)
    {
        $response = $this->client->request('POST', 'image', [
            'multipart' => [
                [
                    'name'     => 'image',
                    'contents' => fopen($imagePath, 'r'),
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
