<?php
/**
 * User: Manson
 * Date: 6/27/2018
 * Time: 2:54 PM
 * Update: 3/14/2019
 */

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait FileUploader
{
    public $filePath = 'files';

    /**
     * Stores image in storage/app/public/img
     * and returns hashed file name
     *
     * @param UploadedFile $file
     *
     * @return string
     */
    public function uploadFile(UploadedFile $file): string
    {
        return $file->store('files');
    }

    /**
     * Delete image from storage/app/public/img
     *
     * @param string $fileName
     *
     * @return bool
     */
    public function deleteFile(string $fileName): bool
    {
        if (Storage::disk(config('filesystems.default'))->exists($fileName)) {
            return Storage::delete($fileName);
        }

        return false;
    }

    /**
     * Return an http response with the raw file
     *
     * @param string $fileName
     *
     * @return mixed
     */
    public function downloadFile(string $fileName)
    {
        return Storage::download($fileName);
    }

    /**
     * Get the full image url
     *
     * @param string $fileName
     *
     * @return string
     */
    public function getFileUrl(?string $fileName): string
    {
        return $fileName ? Storage::url($fileName) : '';
    }
}