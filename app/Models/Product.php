<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\StringFilter;

class Product extends Model
{
    use HasFactory, StringFilter;

    protected $guarded =[];

    protected $appends = ['excerpt'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getExcerptAttribute(){
        return $this->excerpText($this->description, 75);
    }
}
