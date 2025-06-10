<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Str;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
     */
    class CategoryFactory extends Factory
    {
        /**
         * Define the model's default state.
         */
        public function definition(): array
        {
            $name = fake()->unique()->words(2, true);
            
            return [
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => null, 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    }