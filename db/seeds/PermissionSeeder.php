<?php

use Phinx\Seed\AbstractSeed;

class PermissionSeeder extends AbstractSeed
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
        $permissions = $this->table('permissions');
        $data = array(
            array(
                'name' => 'read_users',
                'description' => 'Read data on users'
            ),
            array(
                'name' => "manage_users",
                'description' => 'Add update and delete users'
            ),
            array(
                'name' => "read_clans",
                'description' => "Read clans data"
            ),
            array(
                'name' => "read_members",
                "description" => "Read member data"
            )
        );

        $permissions->insert($data)->save();
    }
}
