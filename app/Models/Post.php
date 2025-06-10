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
    }
