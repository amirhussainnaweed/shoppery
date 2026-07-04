<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductTag extends Model
{
        use HasFactory;
    protected $fillable =[
        "product_id",
        "tag_id",
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
