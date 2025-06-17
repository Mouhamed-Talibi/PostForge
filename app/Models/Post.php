<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Post extends Model
    {
        use SoftDeletes, HasFactory;

        // fillables
        protected $fillable = [
            'title',
            'slug',
            'description',
            'creator_id',
            'category_id',
            'image',
        ];

        // category method
        public function category() {
            return $this->belongsTo(Category::class);
        }

        // creator posts
        public function creator() {
            return $this->belongsTo(Creator::class);
        }

        // likers 
        public function likers() {
            return $this->belongsToMany(Creator::class, 'likes', 'post_id', 'creator_id');
        }

        // get likers
        public function getLikersCount() {
            return $this->likers()->count();
        }

        // comments 
        public function comments() {
            return $this->hasMany(Comment::class)
                ->latest();
        }
    }
