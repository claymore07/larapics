<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Social;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $images = Storage::allFiles('images');
        foreach ($images as $image) {
            Image::factory()->create(
                    [
                        'file' => $image,
                        'dimension' => Image::getDimension($image),
                    ]
                );
        }
        User::find([2, 4, 6])->each(function ($user) {
            $user->social()->save(Social::factory()->make());
        });

        Image::find([1, 2])->each(function ($image) {
            User::all()->each(function ($user) use ($image) {
                $image->comments()->save(Comment::factory()->make([
                    'user_id' => $user->id,
                    'approved' => rand(0, 1),
                ]));
            });
        });

        $tags = Tag::factory(10)->create();

        Image::all()->each(function ($image) use ($tags) {
            $image->tags()->attach(
                    $tags->pluck('id')->random(rand(2, 5)),
                    [
                        // 'approved' => rand(0,1),
                        // 'priority' => rand(0,5),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
        });
        $users = User::all();
        Image::all()->each(function ($image) use ($users) {
            $num_likes = rand(2, 7);
            $image->likes()->attach(
                    $users->pluck('id')->random($num_likes),
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                    );
            $image->favorites()->attach(
                    $users->pluck('id')->random($num_likes),
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                    );
            $image->increment('likes_count', $num_likes);
        });

        // Image::factory(10)->create();
    }

    // protected function getDimension($image){
    //    [$width, $height] = getimagesize(Storage::path($image));
    //    return $width . "x" . $height; // 1920x1280
    // }
}
