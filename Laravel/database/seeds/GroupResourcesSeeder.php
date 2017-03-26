<?php

use App\GroupResources\Group;
use App\User;
use Illuminate\Database\Seeder;

class GroupResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = 10;
        $groups = [
            ['id'=>1, 'name'=>'root', 'parent_id'=>null],
            ['id'=>2, 'name'=>'group0', 'parent_id'=>1],
            ['id'=>3, 'name'=>'group0_0', 'parent_id'=>2],
            ['id'=>4, 'name'=>'group0_1', 'parent_id'=>2],
            ['id'=>5, 'name'=>'group1', 'parent_id'=>1],
        ];

        foreach ($groups as $group)
        {
            $group = new Group($group);
            $group->save();
        }

        for ($i = 0; $i < $users; $i++)
        {
            $user = User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->word
            ]);
            $groupId = (1 === $i % 2) ? 3 : 4;
            $user->groups()->attach($groupId);
        }

    }
}
