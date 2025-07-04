<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Category extends Model
    {
        use HasFactory;

        // fillable
        protected $fillable = [
            'name',
            'slug',
            'image',
        ];

        // posts related 
        public function posts() {
            return $this->hasMany(Post::class);
        }
    }
