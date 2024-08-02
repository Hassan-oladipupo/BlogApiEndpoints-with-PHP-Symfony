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
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => getenv('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => getenv('CLOUDINARY_API_KEY'),
                'api_secret' => getenv('CLOUDINARY_API_SECRET'),
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
