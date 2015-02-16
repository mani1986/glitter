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
        $glitters = [
            [
                'user' => 1,
                'content' => 'Went to the gym today #yolo#lol'
            ],
            [
                'user' => 1,
                'content' => 'I love glittering on the internet #glitter#awesome'
            ],
            [
                'user' => 1,
                'content' => 'Going out tonight yeah #party'
            ],
            [
                'user' => 1,
                'content' => 'Best day ever, seeya #summer#fun#nothing'
            ],
            [
                'user' => 1,
                'content' => 'I have nothing to say #nothingtosay'
            ],
            [
                'user' => 2,
                'content' => 'Never going home #lol'
            ],
            [
                'user' => 3,
                'content' => 'Never going home #lol',
                'reglitter' => 7
            ]
        ];

        foreach ($glitters as $glitter) {
            Glitter::create($glitter);
        }
    }
} 