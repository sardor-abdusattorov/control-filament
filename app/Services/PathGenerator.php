<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PathGenerator implements \Spatie\MediaLibrary\Support\PathGenerator\PathGenerator
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

        return 'files/' . strtolower($modelName) . '/';
    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param Media $media
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        // Директория для конверсий
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
        // Директория для адаптивных изображений
        return $this->getPath($media) . 'responsive/';
    }
}
