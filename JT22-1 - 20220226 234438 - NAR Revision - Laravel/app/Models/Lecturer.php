<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function allocation()
    {
        return $this->belongsTo(Allocation::class, 'lecturer_code', 'lecturer_code');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'lecturer_code', 'lecturer_code');
    }
}
