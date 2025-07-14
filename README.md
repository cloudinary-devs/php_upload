# PHP Cloudinary Upload Script

This script uploads images to Cloudinary using the PHP SDK.

## Setup Instructions

### 1. Install Dependencies
```bash
composer install
```

### 2. Configure Cloudinary

1. Edit `.env` and replace the placeholder with your actual Cloudinary URL:
   ```
   CLOUDINARY_URL=cloudinary://your_api_key:your_api_secret@your_cloud_name
   ```

   You can find your credentials in the **API Keys** page of the Console Settings.

## Features
- Uploads multiple local images to Cloudinary
- Uploads a remote image from GitHub
- Displays secure URLs for uploaded images
- Error handling for failed uploads
- Pretty JSON output for debugging

## Requirements
- PHP 7.4 or higher
- Composer
- Cloudinary account
- Internet connection 