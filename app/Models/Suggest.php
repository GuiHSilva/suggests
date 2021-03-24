<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsToMany(Category::class, 'sugestcategory', 'category_id', 'suggest_id')
            ->withPivot('id')
            ->using(SugestCategory::class);
    }

}
