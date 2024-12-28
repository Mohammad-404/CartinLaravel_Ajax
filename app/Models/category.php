<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\product;

class category extends Model
{
    use Notifiable;

    protected $table = "category";

    protected $fillable = [
        'id','name','created_at','updated_at'
    ];

    public function product(){
        return $this->hasMany(product::class,'category_id','id');
    }
}
