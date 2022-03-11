<?php

namespace App\Services\MediaLibrary;

use Illuminate\Support\Facades\Config;
use \Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;


class CustomPathGenerator implements BasePathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        return 'uploads/'.extensionRemover($media->file_name) . '/';

    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return 'uploads/'.extensionRemover($media->file_name) . '/conversions/';

    }

    /**
     * Get the path for responsive images of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return 'uploads/'.extensionRemover($media->file_name) . '/responsive-images/';

    }


    /*
 * Get a unique base path for the given media.
 */
    protected function getBasePath(): string
    {
        return Config::get('constants.EXTRACT_TO');
    }



}
