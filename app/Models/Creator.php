<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Creator extends Model
    {
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
        ];
    }
