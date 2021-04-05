<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function suggests(){
        return $this->belongsToMany(Suggest::class, 'suggest_categories', 'category_id', 'suggest_id')
            ->withPivot('id')
            ->using(SuggestCategory::class);
    }

}
