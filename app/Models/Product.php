<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\StringFilter;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, StringFilter, InteractsWithMedia;

    protected $guarded =[];
    protected $appends = ['excerpt'];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function getExcerptAttribute(){
        return $this->excerpText($this->description, 75);
    }
    
    public function registeredMediaConversion(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->width(368)
        ->height(232)
        ->sharpen(10)
        ->sanitizingFileName(str_replace(['#', '\\']));
    }

}
