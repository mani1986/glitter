<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Glitter\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        if (User::count() == 0) {
            $this->generate();
        }
    }
    private function generate()
    {
        $users = [
            [
                'username' => 'andrew',
                'email' => 'andrew@aaaa.nl',
                'password' => Hash::make('secret'),
                'name' => 'Andrewm Bollock',
                'avatar' => 'image/jpeg;base64,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'
            ],
            [
                'username' => 'brickweets',
                'email' => 'brick@bdd.nl',
                'password' => Hash::make('secret'),
                'name' => 'Brick Sanders',
                'avatar' => 'image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wAARCABkAGQDAREAAhEBAxEB/8QAHAAAAgMAAwEAAAAAAAAAAAAABAUDBgcBAggA/8QAOBAAAQMCBAMFBgUEAwEAAAAAAQIDEQAEBQYSITFBURMiYXGxBzKBkaHBFCNS0fAVM0LhJCVicv/EABoBAAIDAQEAAAAAAAAAAAAAAAIDAQQFAAb/xAAmEQACAgEFAAICAgMAAAAAAAAAAQIRAwQSITFBEyJRYQUyFCMz/9oADAMBAAIRAxEAPwDy8DRiWdgKk4MtrcukTIT4c6hujoxsf2GGHRPdaRzJMUFjUkg9DVgwR210g7HZBmfkDU7ZPw5zivQ+yThl2Sli5cKhxAQrb6VyxzfSIeWEe2c3uGMuflIuGXFkx2S9lH+eVQ1KHaolShNcOyu4jhCmAooStK07qbV06g86ZGd8MTkxUriKik02ivuIymuomyNQrqCsiUkVFBJglyIKaXMdAlQK4FsIZb1Hfhzrm6BS3OixYdbrkhlCFOpEnUYCOg8T4V0MbycvoLJlWOkux7Y4Bd3rem4QC9Mp1HuqSeg5cOdNx5MUVwLyYM83b6LRhGQLg26HXWg8nkI4A/zfyqP8mIa0bLpgfs9/BvJfaTLSkI1TxB2k+tRj1W1uzsmjU0kR5qybbXgdS3bkEhKZSACD1+dWFqYSX2K70WRNbTPcYy/e4EQziHbP2pHddiVNnz6cyOlV5KE03DtD08mJpZOmUnE7QsPqTECZEcPh4UWOW5CM0Nkv0LyijoCyBaagJMHWIqGMQFdcU0nIWMYW2jfeiSEykFNLCVpCY1Ewnz6/ChrfKhi+kbZo+SsKacQ04tmXgCoFXMEbH5zS9fk2QUEM/j8e+cskjWMEtrRnQXW23FjYlY2jwP7VmRkari/C52T7WiAlCUg7JQpXDy001ZEDsYw/FhDqSNkDckJUJHyPrTPkA+MlTfWSge2dSlJ/XCOfiBXLKvyC8UvEVXPlrb4hhzpYQA6nvokbKUPp9a6Oo2TTR0tP8kHGR50xe37gbUkhbY2T+lM+6fI+taNpTTj0zIknLG4y7iIVN8oqxRSsFfZI3ioaDjICcT1oGh0WL70QU/Gk5PC1i9Dl93nHMnoKmbrgXijuds64aVLug4nYyEoHpXYlXJOd2qNjy+6lIdfZkstnskgDjp5fzpVP+SdzVFz+LjtxOy84S4k3SVABKXG9SU/5QeexB9fOs9I074LzhzTT7LaXba5UUykq7VYn5yaaufBbddMlaZQgAty23q2AfXueB3IFdRNk9w6lpMWynErB1LAUsgjhuOE+JFS3XTASvsr166hV02hprQXJIKFakkc99uokeO1Jl3wOjdcmM+1VSLDNLCEwEvFQWBymtTFJywr9GTmio5n+0U11ACzWnB7opmJmTxzcSF1KYqaATAHmQZoWh0Z0JMSTpWgedVcyqi/gdpkdy8VSngSd/wBqU3bsdGKiqQ9wK1V+IZcTuGpUCRAnb/Qq1CPRTyyu0ahlm2cYywy4I3SXZUOZB3+v1rFzSc5uzdwxUIRSHjubMGy/a27TaS6sL1XKkp3VsfeJ51EcbkqDlNR5LDlPP7eYMQDWE4UlphIguOJSCT4bGilDa6fYtTbV+GhrtW1tuLZUEXBTphZ9yAdwOXGg4vkO5UZfce0JWWsUusGxphq9bWqUujgJ4ggnamxjujcfAG6f2XZa2MWw++/Brs+y7Rah2jQMmCdzPX1pNWOfCMM9vDxRmtTCVKUUoSQeEGJq9g5hRQ1H97K4FdtbtvAf3EhR8+dXNPk2vYzO1eHdH5F4CuqVVpmfFAylkHehsakKMX3U2fP7VXz+F3TdMCYR2jyE9TFJirZYk6Vlww4uFLDA7iFGQP1kftVlN8FLanbNMyqQ+0LJyS0E6SJ22Bg9axMq25Gegx/bGhtf5Au3Gjcsi3SSnYt24f0q8QrYn+CrGBxTt8isicuFwMxlW8aVaqw964NzKZ126WQQPe7oP0osyhJ2lRONuMak7Zp7+G3N3gL5sHkMqfbDYU0jeSOM9dqrrFxYfyJOmZxc+zd28uLQvC9uAFy+kcHB0nUnTwjgeNXMUo4ouO2/2KzweZqW/avwWPAcjHLiJS82tCFFSGyNSm//ADO0x141TnGpbhyla2o85e169bfzNdOL3d1FEzPDatDHUcUfyZmVylml+BBlu8K7NbCjPZqkT0P+6B8O0GuVTG62E6NXI1pQluimYeWDxzcQJ9CNyKJpAxbK9jGy2/j9qqZ/DT0vTJMusJfxFAUJSncnoKHCrYeolUQ1WJkYgl1R2BAQP0jpTHLkVGFKzVclXyLlLK2QAXSY3225cP5BrF1Lqbs3tKrgjecvkMWaHrl0J1iezG/8mphOMY8hzg26QgxTPNmzjirFlptxTRQHXUqCQ2Cod0dTFWYQc4vJ4ipkmoTWN9suuXR2eVm3HdStJ7T3pJ3G4HlUriIU19+Aiyu8PxIdomVPMfluIWIUDse8Ovh40O9PhnbJLoFzNeKtcP2QnTE9w8P5FIzzpUh+LHzbPD2b8VRfZhv3A3qbLywDO5E8auxvakzOnW5tAmEYiGb0dzSHZQog9RA+1cyEWft1PNL1CNJiOlWtLLuJn6+HUxbcSDVloqQEeL8Wvj9qq5/DQ03oXlpwNXw8RHpU4+Cc6tCy6VLqo5mY6UufYyC4NH9nr7rbIbZMOtEOIngZiRWbrF9jU0jpUaZi+YcdRg3/AArNxK40l1EEpB6VUxxt8l2eSo8CPCLW6tHkvXODLuYMgKVJkmSfE+HXer0YycaiypScraNaaz4oYQjscJv1uwO6pBQJHKTsaKsjROxXZQLDMeZFZwfv7bDrkuXIHb28QkaQBqG/SPOq+RNu/Q8clHh9BHtTz+9aZVc0NOsXL47NvXsZPEjy/agwQeWfPQWpyrFDj08wqlapVuTWxVmN0dN0qBHI0DVEpl2tlpetwvh2jYO3Whxy2STOyw+SDQK6oad+Nad2YqTTEWLnvN/H7VUz+GjpvTi1m3WXFbFIMVy4Dk93ALOtwq6mgXLsZ0qL7l0qt2XH0LKdCkEgfpgA+tZ+ZKWXa/wW4tqVr8I1/LeIMXDBbcQlLqRKp/zAGx9N6rKKi7LzluVFztMPUWlDUT2kgAc+XCnKwbG+G5bdbPbuXbjvBXupTtwIG0jbx9aY4P8AIv5BDnfE7TKgXfa20KbRoOr/AD32Hn/ukyi5vZHsOMlBb5dHmTP+Y7nM2NOP3BhtAhtE7AfvWlp8CxRr0zM+d5pX4VNI79NXYt9Hy0SSByrmrOTLHl57tcPKD7zKoP8A8mq01THxfB2uRpWQeFXsUt0UZWeGzI0JMYiWo8ftSs/hY03oG4oxBoZPgekSsNzE8BuaJKkDJmhZPDbztvbLMJuWlJAPWs7Iv9smXYP7JP1F7wexWqw0mQ4ySgkHcRSZqnZahyi44HmlWHNg4iFJbQdIcPA0Kk10MpPsc4h7T8MYsluB7uITvAnfkKNTnJ0BJQgtzZ509o+ZbjHsS7W6UdLh1JQT7ieXxq5pYV9inqclxS/JTbgwRI3A41eM9AqB+YVHgN6FLmxj6olYT+SVq4qNTHqwZd0E4G9+HxDQow28NBn6UjLH0djfg1vjB34jY0eB8NFfVR5TEOKcW/j9q7N4dp/QRAK10K+zse+EF+6NI4c6aKHjV05bYdh91bq0usOyKpbbztP1FmbqMZI1rI+PN4xdvBGlLjzYWpB/UNjSc+NxRbwZFIfYgi5LiLcBCWzuRNVlHgfKXKM7zjft3GIN4e2R2FuNbukQCRVjHBxjfrK2aayTWPwzrFLk3Lrjh5nby5VpxjtjRRyT3zbB0Ht2dJ99PDxHSiXKFtUyIiWyBz2rn0cuyRR2Q2OFT+jv2fLTrQYMEHY10luVHJ0xr2huLZC1e/G/nSMa2yaJz/aCYpxUEdlPj9qLL4Bp/QUHQP8A16VC4HPkkQujTBaDWLjXh79vBKkkOp+9KlxNSHxW/G4+rkNytj7uB4vbXje4QrvJ6g8RTJwWSNCscnjlaNqzRmXCv6AjFbJ0KuXkQhOrdJ5yKpQg29jLk5xS3oxe7xD/AK+5e1an7henxApjV5kvIoqQk+X6KGwp5KEISVLUQlKQJJPSrl2hdcnCGbhpRKmnU8wSkjxoUwmia7adSlK0srGo94aTsYrpSpERXJEht46ldk4Tw907bT6VKfpzXhOhh/SEhlwqPLSaJMFhmHtvrBShpxUGYCSeMD1I+dLf97Jn/wA2gHHAoFnUkiZ4jyqMvgGnXYt1bzS9xYo51+FTvOonsrs2rxcCNUpKYnrS8i3omDcWmiFbgKlFKdKSdhMxTFOjpJN2gk4g8bYMlR0jxovkA2HS4ug602gN6QgdZmkx4bb9CSpURtPqaIKZCgZBBgg01ZKVEOJMMSupVL7p1EFUq4kcKjfyTRwMQu0tFpFy8lsggpCzBBidvgPlUOVnUSf1a+KipV0+SVaySsyTtuT8B8qncdR9/VbruQ673Nk9893hw+Qovk/QO0lZxq8bP954gRH5h2iI9B8qhzvw5wtVYLfXjl4pBdKiUiBKp2gAfQChlLcdCG0//9k='
            ],
            [
                'username' => 'charlie',
                'email' => 'charles@dbdd.nl',
                'password' => Hash::make('secret'),
                'name' => 'Charles Nock',
                'avatar' => 'image/jpeg;base64,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'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
