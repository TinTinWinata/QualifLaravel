<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];

    public function forum()
    {
        return $this->belongsTo(Forum::class, "forum_id", "forum_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    use HasFactory;
}
