<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilePhotoService
{
    /**
     * The disk where profile photos are stored.
     */
    protected string $disk = 'public';

    /**
     * The directory where profile photos are stored.
     */
    protected string $directory = 'profile-photos';

    /**
     * Upload and process a profile photo.
     *
     * @param UploadedFile $photo
     * @param int|string $userId
     * @return string The path to the stored photo
     */
    public function upload(UploadedFile $photo, int|string $userId): string
    {
        // Validate the file
        $this->validatePhoto($photo);

        // Generate a unique filename
        $filename = $this->generateFilename($userId, $photo->getClientOriginalExtension());

        // Get the full path
        $path = $this->directory . '/' . $filename;

        // Ensure the directory exists
        if (!Storage::disk($this->disk)->exists($this->directory)) {
            Storage::disk($this->disk)->makeDirectory($this->directory, 0755, true);
        }

        // Process the image
        $processedImage = $this->processImage($photo);

        // Store the image and check if it succeeded
        $stored = Storage::disk($this->disk)->put($path, $processedImage);

        if (!$stored) {
            throw new \RuntimeException("Failed to store profile photo at: {$path}");
        }

        return $path;
    }


    /**
     * Update an existing profile photo (deletes old one).
     *
     * @param UploadedFile $photo
     * @param int|string $userId
     * @param string|null $oldPhotoPath
     * @return string
     */
    public function update(UploadedFile $photo, int|string $userId, ?string $oldPhotoPath = null): string
    {
        // Delete old photo if exists
        if ($oldPhotoPath) {
            $this->delete($oldPhotoPath);
        }

        // Upload new photo
        return $this->upload($photo, $userId);
    }

    /**
     * Delete a profile photo.
     *
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool
    {
        if (Storage::disk($this->disk)->exists($path)) {
            return Storage::disk($this->disk)->delete($path);
        }

        return false;
    }

    /**
     * Get the full URL of a profile photo.
     *
     * @param string|null $path
     * @return string|null
     */
    public function getUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return Storage::disk($this->disk)->url($path);
    }

    /**
     * Validate the uploaded photo.
     *
     * @param UploadedFile $photo
     * @throws \InvalidArgumentException
     */
    protected function validatePhoto(UploadedFile $photo): void
    {
        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($photo->getMimeType(), $allowedMimeTypes)) {
            throw new \InvalidArgumentException('Invalid file type. Only JPEG, PNG, WebP and GIF are allowed.');
        }

        if ($photo->getSize() > $maxFileSize) {
            throw new \InvalidArgumentException('File size exceeds the maximum limit of 5MB.');
        }
    }

    /**
     * Generate a unique filename for the photo.
     * Format: user_{userId}_{timestamp}_{random}.{extension}
     *
     * @param int|string $userId
     * @param string $extension
     * @return string
     */
    protected function generateFilename(int|string $userId, string $extension): string
    {
        $timestamp = now()->timestamp;
        $random = Str::random(8);
        $extension = strtolower($extension);

        return "user_{$userId}_{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Process the image - just return the file contents as-is.
     * No processing needed, keeps it simple and always works.
     *
     * @param UploadedFile $photo
     * @return string The image file data
     */
    protected function processImage(UploadedFile $photo): string
    {
        // Simply return the file contents without any processing
        return file_get_contents($photo->getRealPath());
    }

    /**
     * Get default avatar URL (for users without photos).
     *
     * @param string|null $name
     * @return string
     */
    public function getDefaultAvatar(?string $name = null): string
    {
        // Using UI Avatars as default
        $name = $name ? urlencode($name) : 'User';
        return "https://ui-avatars.com/api/?name={$name}&size=500&background=6366f1&color=ffffff&bold=true";
    }
}
