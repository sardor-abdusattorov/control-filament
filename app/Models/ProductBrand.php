<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductBrand extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'image',
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
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_INACTIVE => __('Inactive'),
        ];
    }

    /**
     * Relationship with products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
