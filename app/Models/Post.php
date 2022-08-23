<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body'];

    public function isEdited()
    {
        return $this->created_at != $this->updated_at;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ownedBy(User $user)
    {
        return $user->id == $this->user_id;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user)
    {
        if ($user == null) {
            return false;
        }
        return $this->likes->contains('user_id', $user->id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
