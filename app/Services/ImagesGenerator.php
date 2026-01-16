<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class ImagesGenerator implements BasePathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param Media $media
     * @return string
     */
    public function getPath(Media $media): string
    {
        $modelName = class_basename($media->model_type);

        return 'images/' . strtolower($modelName) . '/';
    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param Media $media
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {

        return $this->getPath($media) . 'conversions/';
    }

    /**
     * Get the path for responsive images of the given media, relative to the root storage path.
     *
     * @param Media $media
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {

        return $this->getPath($media) . 'responsive/';
    }
}
