<?php

namespace App\GroupResources;

trait NodeTrait
{
    /**
     * Boot the scope.
     *
     * @return void
     */
    public static function bootNodeTrait()
    {
        Node::$principal = self::class;
    }

    public function node()
    {
        return $this->hasOne(Node::class, 'id', 'id');
    }

    public function children()
    {
        return $this->node->children();
    }

    public function parent()
    {
        return $this->node->parent();
    }

    public function descendants()
    {
        return $this->node->descendants();
    }

    public function ancestors()
    {
        return $this->node->ancestors();
    }

    public function testSubset()
    {
        return $this->node->testSubset();
    }

    public function subsets()
    {
        return $this->node->subsets();
    }

    public function supersets()
    {
        return $this->node->supersets();
    }

    public function subtree()
    {
        return $this->node->subtree();
    }

    public function nodeself()
    {
        return $this->node->nodeself();
    }

    public function insertChild(string $name)
    {
        return $this->node->insertChild($name);
    }

    public function depth()
    {
        return $this->node->depth();
    }
}