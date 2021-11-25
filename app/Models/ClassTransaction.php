<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassTransaction extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'classroom_id',
        'shift_id',
        'subject_id',
        'semester_id',
        'user_id',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'classroom_id' => 'string',
        'shift_id' => 'string',
        'subject_id' => 'string',
        'semester_id' => 'string',
        'user_id' => 'string',
    ];

    public function classTransactionDetails()
    {
        return $this->hasMany(ClassTransactionDetail::class);
    }

    public function classTransactionStudents()
    {
        return $this->hasMany(ClassTransactionStudent::class);
    }
}
