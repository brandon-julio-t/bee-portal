<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperForumThread
 */
class ForumThread extends Model
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
        'user_id',
        'class_transaction_detail_id',
        'title',
        'content',
        'attachment',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    public function forumReplies()
    {
        return $this->hasMany(ForumReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classTransactionDetail()
    {
        return $this->belongsTo(ClassTransactionDetail::class);
    }
}
