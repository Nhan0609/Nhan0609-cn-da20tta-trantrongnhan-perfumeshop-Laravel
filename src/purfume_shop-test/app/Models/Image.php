<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $table= 'multiple_images';
    protected $fillable = [
      'id',
      'prod_id',
      'image_path',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'prod_id', 'id');
    }
}
