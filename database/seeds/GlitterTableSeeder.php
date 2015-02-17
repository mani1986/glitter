<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Glitter\Glitter;

class GlitterTableSeeder extends Seeder
{
    public function run()
    {
        if (Glitter::count() == 0) {
            $this->generate();
        }
    }
    private function generate()
    {
        $users = \Glitter\User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < rand(4, 50); $i++) {
                Glitter::create([
                    'user' => $user->id,
                    'content' => MockUserData::getRandomSentence()
                ]);
            }
        }
    }
} 