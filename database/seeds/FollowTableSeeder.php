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
        $follows = [
            [
                'user_from' => 1,
                'user_to' => 2
            ],
            [
                'user_from' => 1,
                'user_to' => 3
            ],
            [
                'user_from' => 2,
                'user_to' => 1
            ],
            [
                'user_from' => 3,
                'user_to' => 1
            ]
        ];

        foreach ($follows as $follow) {
            Follow::create($follow);
        }
    }
} 