<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Glitter\Follow;

class FollowTableSeeder extends Seeder
{
    public function run()
    {
        if (Follow::count() == 0) {
            $this->generate();
        }
    }
    private function generate()
    {
        $users = \Glitter\User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < rand(1, count($users) / 5); $i++) {
                Follow::create([
                    'user_from' => $user->id,
                    'user_to' => rand(1, count($users))
                ]);
            }
        }
    }
} 