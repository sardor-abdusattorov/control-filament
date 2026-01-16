<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductBrand extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'status',
        'sort',
    ];

    protected $casts = [
        'sort' => 'integer',
        'status' => 'boolean',
    ];

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * Get available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => __('app.status.active'),
            self::STATUS_INACTIVE => __('app.status.inactive'),
        ];
    }

    /**
     * Relationship with products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_brand')->singleFile();
    }
}
