<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Eric',
            'email' => 'eblount@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(10),
        ]);

        factory(App\User::class, 5)->create()->each(function ($u) {
            foreach (range(1, 10) as $i) {
                $u->posts()->save($post = factory(App\Post::class)->make());
                foreach (range(1, 5) as $j) {
                    $post->comments()->save(factory(App\Comment::class)->make());
                }
            }
        });
    }
}
