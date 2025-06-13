<?php

    namespace App\Policies;

    use App\Models\Creator;
    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Auth\Access\Response;

    class PostPolicy
    {
        /**
         * Determine whether the user can view any models.
         */
        public function viewAny(User $user): bool
        {
            return false;
        }

        /**
         * Determine whether the user can view the model.
         */
        public function view(User $user, Post $post): bool
        {
            return false;
        }

        /**
         * Determine whether the user can create models.
         */
        public function create(Creator $creator): bool
        {
            if(auth('creator')->check()) {
                return true;
            }

            return false;
        }

        /**
         * Determine whether the user can update the model.
         */
        public function update(Creator $creator, Post $post): bool
        {
            return $creator->id === $post->creator_id;
        }

        /**
         * Determine whether the user can delete the model.
         */
        public function delete(Creator $creator, Post $post): bool
        {
            return $creator->id === $post->creator_id;
        }

        /**
         * Determine whether the user can restore the model.
         */
        public function restore(User $user, Post $post): bool
        {
            return false;
        }

        /**
         * Determine whether the user can permanently delete the model.
         */
        public function forceDelete(User $user, Post $post): bool
        {
            return false;
        }
    }
