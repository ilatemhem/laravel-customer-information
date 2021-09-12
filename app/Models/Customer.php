<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'gsm_no', 'department_id', 'birthday'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
