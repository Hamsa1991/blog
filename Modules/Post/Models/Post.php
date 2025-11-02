<?php

namespace Modules\Post\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Comment\Models\Comment;
use Modules\Like\Models\Like;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


// use Modules\Post\Database\Factories\PostFactory;

class Post extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'content', 'featured_image', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
    }
    // protected static function newFactory(): PostFactory
    // {
    //     // return PostFactory::new();
    // }
}
