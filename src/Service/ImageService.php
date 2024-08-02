<?php

namespace App\Service;

use Cloudinary\Cloudinary;
use Psr\Log\LoggerInterface;

class ImageService
{
    private $cloudinary;
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $cloudName = "dapgqa7ao";
        $apiKey = "685653132369916";
        $apiSecret = "YoVuMZjV-CEZRBK7ecPi46_j_HA";

        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $cloudName,
                'api_key'    => $apiKey,
                'api_secret' => $apiSecret,
            ],
        ]);
        $this->logger = $logger;
    }

    public function uploadImageStream($stream)
    {
        try {
            $result = $this->cloudinary->uploadApi()->upload($stream, [
                'resource_type' => 'image',
            ]);

            return [
                'success' => true,
                'data' => $result,
            ];
        } catch (\Exception $e) {
            $this->logger->error('Cloudinary upload failed', [
                'exception' => $e,
            ]);
            return [
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ];
        }
    }
}
