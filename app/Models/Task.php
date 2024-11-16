<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected  $fillable=['title','description','type_id'];
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_completed');
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
