<?php

namespace Modules\Like\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Post\Models\Post;

// use Modules\Like\Database\Factories\LikeFactory;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'post_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }


    // protected static function newFactory(): LikeFactory
    // {
    //     // return LikeFactory::new();
    // }
}
