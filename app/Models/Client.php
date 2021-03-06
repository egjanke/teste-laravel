<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'state',
        'category_id',
        'start',
        'telephones'
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
