<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = array(
            array(
                'email' => 'admin@admin.com',
                'password' => '$2y$10$3Tv.Nu2na9rvBcOWfHzLHengKBK6xLp2sVlHfzFZl/D4IntIm831W',
                'username' => "Administrator"
            )
        );
        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
