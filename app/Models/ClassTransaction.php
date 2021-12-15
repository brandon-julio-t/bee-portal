<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperClassTransaction
 */
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
        'subject_id',
        'semester_id',
        'lecturer_id',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'classroom_id' => 'string',
        'subject_id' => 'string',
        'semester_id' => 'string',
        'lecturer_id' => 'string',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class);
    }

    public function classTransactionDetails()
    {
        return $this->hasMany(ClassTransactionDetail::class);
    }

    public function classTransactionStudents()
    {
        return $this->hasMany(ClassTransactionStudent::class);
    }

    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }
}
