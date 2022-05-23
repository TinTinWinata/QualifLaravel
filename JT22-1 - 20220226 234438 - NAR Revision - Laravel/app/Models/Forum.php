<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'forum_id';
    public function allocation()
    {
        return $this->belongsTo(Allocation::class, "allocation_id", "id");
    }
    public function reply()
    {
        return $this->hasMany(Reply::class, 'forum_id', 'forum_id');
    }
}
