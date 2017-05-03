<?php

namespace app\GroupResources;


interface TreeNode
{
    public function children();
    public function parent();
    public function descendants();
    public function ancestors();
    public function subsets();
    public function supersets();
    public function subtree();
    public function insertChild(string $name);
    public function depth();
}