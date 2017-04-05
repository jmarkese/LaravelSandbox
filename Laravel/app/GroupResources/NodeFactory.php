<?php
/**
 * Created by PhpStorm.
 * User: johnmarkese
 * Date: 4/5/17
 * Time: 2:09 PM
 */

namespace App\GroupResources;


class NodeFactory
{
    public static function make($name, $tree_id, $parent_id, $numer, $denom, $interval_l, $interval_r): TreeNode
    {
        return new Group(['name' => $name, 'tree_id' => $tree_id, 'parent_id' => $parent_id, 'numer' => $numer, 'denom' => $denom,'interval_l' => $interval_l,'interval_r' => $interval_r]);
    }
}