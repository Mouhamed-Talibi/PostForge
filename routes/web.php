<?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AppController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\CommentController;
    use App\Http\Controllers\CreatorController;
    use App\Http\Controllers\PostController;
    use GuzzleHttp\Middleware;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;

    // home page
    Route::get('/', [AppController::class, 'index'])
        ->name('home');

    // authentification routes 
    Route::prefix('auth')->name('auth.')->group( function () {
        // login routes
        Route::get('login', [AuthController::class, 'showLoginForm'])
            ->name('loginForm');
        Route::post('login', [AuthController::class, 'login'])
            ->name('login');
        // regsiter routes
        Route::get('register', [AuthController::class, 'showRegistrationForm'])
            ->name('regsitrationForm');
        Route::post('register', [AuthController::class, 'register'])
            ->name('register');
        // logout
        Route::post('logout', [AuthController::class, 'logout'])
            ->name('logout');
        // verify email
        Route::get('verify_email', [AuthController::class, 'verifyEmail'])
            ->name('verifyEmail');
        // confirm email
        Route::get('confirm_email/{hash}', [AuthController::class, 'confirmEmail'])
            ->name('confirmEmail');
    });

    // posts routes
    Route::resource('posts', PostController::class)
        ->names('posts')
        ->middleware(['auth:creator', 'verified']);

    // my posts routes 
    Route::get('myposts', [PostController::class, 'myPosts'])
        ->name('posts.myposts')
        ->middleware('auth:creator');

    // creators route
    Route::resource('creators', CreatorController::class)
        ->names('creators')
        ->middleware('auth:creator');

    // creator personal data ( update )
    Route::middleware(['auth:creator', 'verified'])->name('creator.')->group(function () {
        // email update
        Route::post('creator/{creator}/email/update', [CreatorController::class, 'updateEmail'])
            ->name('update_email');
        // update bio
        Route::post('creator/{creator}/bio/update', [CreatorController::class, 'updateBio'])
            ->name('update_bio');
        // update name
        Route::post('creator/{creator}/name/update', [CreatorController::class, 'updateName'])
            ->name('update_name');
        // update age
        Route::post('creator/{creator}/age/update', [CreatorController::class, 'updateAge'])
            ->name('update_age');
    });

    // search posts route
    Route::post('/posts/search', [PostController::class, 'search'])
        ->name('posts.search')
        ->middleware(['auth:creator', 'verified']);

    // posts likes routes 
    Route::middleware(['auth:creator', 'verified'])->name('posts.')->group(function(){
        // like post
        Route::post('/posts/{post}/like', [PostController::class, 'like'])
            ->name('like');
        // unlike post
        Route::delete('/posts/{post}/unlike', [PostController::class, 'unlike'])
            ->name('unlike');
    });

    // comments routes
    Route::middleware(['auth:creator', 'verified'])->name('comments.')->group(function() {
        // comment view page
        Route::get('/posts/{post}/comments', [PostController::class, 'commentsView'])
            ->name('view');
        // store comment
        Route::post('/posts/{post}/comment', [CommentController::class, 'store'])
            ->name('store');
    });

    // admin routes 
    Route::middleware(['auth:creator', 'verified', 'admin'])->name('admin.')->prefix('admin')->group( function() {
        // dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');
        // new Creator
        Route::get('newCreator', [AdminController::class, 'newCreator'])
            ->name('new_creator');
        // new Creator store
        Route::post('newCreator', [AdminController::class, 'newCreatorStore'])
            ->name('new_creator.store');
        // creators list
        Route::get('creators', [AdminController::class, 'creatorsList'])
            ->name('creators_list');
        // delete creator
        Route::delete('creators/{creator}', [AdminController::class, 'deleteCreator'])
            ->name('delete_creator');
        // edit creator 
        Route::get('creators/{creator}/edit', [AdminController::class, 'editCreator'])
            ->name('edit_creator');
        // update creator
        Route::put('creators/{creator}', [AdminController::class, 'updateCreator'])
            ->name('update_creator');
        // new category
        Route::get('newCatgeory', [AdminController::class, 'newCategory'])
            ->name('new_category');
        // store category
        Route::post('newCategory', [AdminController::class, 'newCategoryStore'])
            ->name('new_category.store');
        // delete category
        Route::delete('categories/{category}', [AdminController::class, 'deleteCategory'])
            ->name('delete_category');
        // categories List
        Route::get('categories', [AdminController::class, 'categoriesList'])
            ->name('categories_list');
        // edit category 
        Route::get('categories/{category}/edit', [AdminController::class, 'editCategory'])
            ->name('edit_category');
        // update category
        Route::put('categories/{category}', [AdminController::class, 'updateCategory'])
            ->name('update_category');
        // posts list
        Route::get('posts', [AdminController::class, 'postsList'])
            ->name('posts_list');
        // delete post
        Route::delete('posts/{post}', [AdminController::class, 'deletePost'])
            ->name('delete_post');
        // new post 
        Route::get('newPost', [AdminController::class, 'newPost'])
            ->name('new_post');
        // store post 
        Route::post('newPost', [AdminController::class, 'newPostStore'])
            ->name('store_post');
        // edit post 
        Route::get('posts/{post}/edit', [AdminController::class, 'editPost'])
            ->name('edit_post');
        // update post
        Route::put('posts/{post}', [AdminController::class, 'updatePost'])
            ->name('update_post');
        // find post 
        Route::get('findPost', [AdminController::class, 'findPost'])
            ->name('find_post');
        // query post 
        Route::post('findPost', [AdminController::class, 'queryPost'])
            ->name('query_post');
        // admin profile
        Route::get('profile', [AdminController::class, 'profile'])
            ->name('profile');
        // admin edit profile 
        Route::get('{id}/edit', [AdminController::class, 'editProfile'])
            ->name('edit_profile');
        // admin update profile
        Route::put('{id}', [AdminController::class, 'updateProfile'])
            ->name('update_profile');
        // admin edit email 
        Route::get('{id}/edit/email', [AdminController::class, 'editEmail'])
            ->name('edit_email');
        // admin update email 
        Route::put('{id}/email', [AdminController::class, 'updateEmail'])
            ->name('update_email');
    }); 