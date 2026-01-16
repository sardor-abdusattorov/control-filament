<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ProductBrand extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'status',
        'sort',
    ];

    protected $casts = [
        'sort' => 'integer',
        'status' => 'boolean',
    ];

    protected $appends = ['image_url'];


    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * Get available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_INACTIVE => __('Inactive'),
        ];
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_brand')->singleFile();
    }

    /**
     * Get image URL attribute
     */
    public function getImageUrlAttribute(): string
    {
        $media = $this->getFirstMedia('product_brand');

        if ($media && Storage::disk($media->disk)->exists($media->getPathRelativeToRoot())) {
            return $media->getUrl();
        }

        return asset('images/no_image.png');
    }

    /**
     * Relationship with products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
