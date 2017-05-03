<?php

use App\GroupResources\Node;
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
        $nodes = [
            ['tree_id'=>1, 'name'=>'root', 'numer'=>0, 'denom'=>1, 'interval_l'=>0, 'interval_r'=>PHP_INT_MAX],
        ];

        foreach ($nodes as $node)
        {
            if('root' == $node['name']) {
                $node = new Group($node);
                $node->save();
            } else {
                $parent = Group::where('name', $node['parent'])->firstOrFail();
                $parent->insertChild($node['name']);
            }
        }

        $root = Group::where('name', 'root')->firstOrFail();

        for($i = 0; $i < 2; $i++) {
            $node = $root->insertChild('group' . $i);
            for ($j = 0; $j < 2; $j++) {
                $node2 = $node->insertChild('group' . $i . '_' . $j);
                for ($k = 0; $k < 2; $k++) {
                    $node3 = $node2->insertChild('group' . $i . '_' . $j . '_' . $k);
                }
            }
            echo $i . PHP_EOL;
        }


        for ($i = 0; $i < $users; $i++)
        {
            $user = User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->word
            ]);
            $groupId = (0 === $i % 5) ? 2 : ((1 === $i % 2) ? 3 : 4);
            $user->groups()->attach($groupId);
        }

    }
}
