<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allocation extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];

    public function classroom()
    {
        return $this->hasOne(Classroom::class, "classroom", "classroom");
    }
    public function lecturer()
    {
        return $this->hasOne(Lecturer::class, 'lecturer_code', 'lecturer_code');
    }
    public function subject()
    {
        return $this->hasOne(Subject::class, 'subject_code', 'subject_code');
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'allocation_id', 'id');
    }
    public function allocation_detail()
    {
        return $this->hasOne(AllocationDetail::class, 'allocation_id', 'id');
    }
    public function forum()
    {
        return $this->hasMany(Forum::class, 'allocation_id', 'id');
    }
    public function assignment()
    {
        return $this->hasMany(Assignment::class, 'allocation_id', 'id');
    }
}
