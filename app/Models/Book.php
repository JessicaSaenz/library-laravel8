<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Table for this Model.
     * 
     * @var string
     */
    protected $table = "book";

    protected $fillable = [
        'name',
        'cover',
        'author',
        'publication',
        'status',
        'borrow_user',
        'categories_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'publication' => 'date'
    ];
}
