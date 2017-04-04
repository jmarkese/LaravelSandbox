<?php

use App\GroupResources\Node;
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
            ['name'=>'root', 'numer'=>0, 'denom'=>1, 'interval_l'=>0, 'interval_r'=>PHP_INT_MAX],
        ];

        foreach ($nodes as $node)
        {
            if('root' == $node['name']) {
                $node = new Node($node);
                $node->save();
            } else {
                $parent = Node::where('name', $node['parent'])->firstOrFail();
                $parent->insertNode($node['name']);
            }
        }

        $root = Node::where('name', 'root')->firstOrFail();

        for($i = 0; $i < 10; $i++) {
            $node = $root->insertNode('group' . $i);
            for ($j = 0; $j < 10; $j++) {
                $node2 = $node->insertNode('group' . $i . '_' . $j);
                for ($k = 0; $k < 2; $k++) {
                    $node3 = $node2->insertNode('group' . $i . '_' . $j . '_' . $k);
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
            $groupId = (1 === $i % 2) ? 3 : 4;
            $user->groups()->attach($groupId);
        }

    }
}
