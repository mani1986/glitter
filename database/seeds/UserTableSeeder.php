<?php
use Glitter\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        for ($i = 0; $i < 20; $i++) {
            $name = MockFirstName::getRandom();
            $username = strtolower(MockUserData::getUsername($name));

            User::create([
                'username' => $username,
                'email' => $name . '@' . MockUserData::getRandomDomain(),
                'password' => Hash::make('secret'),
                'name' => $name . ' ' . MockLastName::getRandom(),
                'avatar' => MockUserData::getRandomAvatar()
            ]);

            \Illuminate\Support\Facades\Redis::set($username . ':exists', true);
        }
    }
}
