<?php

namespace App\Models;
use App\Models\User;
use App\Models\Recipe;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id','recipe_id'];
  

    public function user()   { return $this->belongsTo(User::class); }
    public function recipe() { return $this->belongsTo(Recipe::class); }
}
