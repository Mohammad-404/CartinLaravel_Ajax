<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\category;

class product extends Model
{
    use Notifiable;

    protected $table = "product";

    protected $fillable=[
        'id','name','details','qty','price','category_id','created_at','updated_at'
    ];

    public function category() {
        return $this->belongsTo(category::class, 'category_id','id'); // Assumes the column is category_id
    }
}
