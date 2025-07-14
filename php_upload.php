<?php

// Custom error handler to suppress Cloudinary deprecation warnings
set_error_handler(function($severity, $message, $file, $line) {
    // Suppress deprecation warnings from Cloudinary SDK
    if ($severity === E_DEPRECATED && strpos($file, 'cloudinary') !== false) {
        return true; // Don't display the error
    }
    return false; // Let other errors through
});

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Cloudinary;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Resize;
use Cloudinary\Api\Upload\UploadApi;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Initialize Configuration
$config = new Configuration($_ENV['CLOUDINARY_URL']);

$cld = new Cloudinary($config);

// Upload the image
$upload = new UploadApi($config);

try {
    // Upload the first image
    $response = $upload->upload('images/people-walking.jpg');
    
    // Print the response as a pretty JSON
    echo "<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "</pre>";

    // Array of image paths
    $imagePaths = [
        'images/dress.jpg',
        'images/drinks.jpg',
        'images/fruit.jpg',
        'images/shoes.jpg'
    ];

    foreach ($imagePaths as $imagePath) {
        // Upload the image
        $response = $upload->upload($imagePath);
        // Print the secure URL from the response
        echo "<pre>***** Uploaded $imagePath: " . $response['secure_url'] . "</pre>";
    }

    $response = $upload->upload("https://raw.githubusercontent.com/cloudinary-devs/cld-docs-assets/refs/heads/main/assets/images/people-walking.jpg");
    // Print the secure URL from the response
    echo "<pre>***** Uploaded remote image: " . $response['secure_url'] . "</pre>";
    
} catch (Exception $e) {
    echo "<pre>Error: " . $e->getMessage() . "</pre>";
}
?>