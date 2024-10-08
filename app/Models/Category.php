<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model {
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = ['title', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
