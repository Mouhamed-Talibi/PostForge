<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Creator extends Authenticatable implements MustVerifyEmail
    {
        protected $guard = 'creator';

        // soft deletes
        use SoftDeletes;

        // fillables
        protected $fillable = [
            'creator_name',
            'gender',
            'age',
            'email',
            'email_verified_at',
            'password',
            'role',
            'image',
            'status',
            'bio',
        ];

        // posts relashioships 
        public function posts()
        {
            return $this->hasMany(Post::class);
        }

        // likes relashioships
        public function likedPosts() {
            return $this->belongsToMany(Post::class, 'likes');
        }

        // comments 
        public function comments() {
            return $this->hasMany(Comment::class);
        }
    }
