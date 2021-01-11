<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Table for this Model.
     * 
     * @var string
     */
    protected $table = "categories";

    protected $fillable = [
        'name',
        'description'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'categories_id');
    }
}
