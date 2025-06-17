<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Comment extends Model
    {
        // fillables 
        protected $fillable = [
            'creator_id', 
            'post_id', 
            'content'
        ];

        // post relashionship
        public function post() {
            return $this->belongsTo(Post::class);
        }

        // creator relashionship
        public function creator() {
            return $this->belongsTo(Creator::class);
        }
    }
