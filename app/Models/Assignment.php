<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

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
        'user_id',
        'class_transaction_id',
        'title',
        'attachment',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    public function assignmentSubmission()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function classTransaction()
    {
        return $this->belongsTo(ClassTransaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
