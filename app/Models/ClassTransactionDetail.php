<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperClassTransactionDetail
 */
class ClassTransactionDetail extends Model
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
        'class_transaction_id',
        'shift_id',
        'note',
        'session',
        'transaction_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'class_transaction_id' => 'string',
        'shift_id' => 'string',
        'transaction_date' => 'datetime',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function classTransaction()
    {
        return $this->belongsTo(ClassTransaction::class);
    }

    public function forumThreads()
    {
        return $this->hasMany(ForumThread::class);
    }
}
