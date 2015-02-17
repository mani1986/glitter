<?php
use Illuminate\Database\Seeder;
use Glitter\Hashtag;

class HashtagTableSeeder extends Seeder
{
    public function run()
    {
        if (Hashtag::count() == 0) {
            $this->generate();
        }
    }
    private function generate()
    {
        $hashtags = [
            [
                'name' => 'yolo',
                'glitter' => 1
            ],
            [
                'name' => 'lol',
                'glitter' => 1
            ],
            [
                'name' => 'glitter',
                'glitter' => 2
            ],
            [
                'name' => 'awesome',
                'glitter' => 2
            ],
            [
                'name' => 'party',
                'glitter' => 3
            ],
            [
                'name' => 'summer',
                'glitter' => 4
            ],
            [
                'name' => 'fun',
                'glitter' => 4
            ],
            [
                'name' => 'nothing',
                'glitter' => 4
            ],
            [
                'name' => 'nothingtosay',
                'glitter' => 5
            ],
            [
                'name' => 'lol',
                'glitter' => 6
            ],
            [
                'name' => 'lol',
                'glitter' => 7
            ]
        ];

        foreach ($hashtags as $hashtag) {
            Hashtag::create($hashtag);
        }
    }
} 