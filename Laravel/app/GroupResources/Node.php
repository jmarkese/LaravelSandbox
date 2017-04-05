<?php

namespace App\GroupResources;
use Illuminate\Database\Eloquent\Model;


class Node extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tree_id', 'parent_id', 'name', 'numer', 'denom', 'interval_l', 'interval_r'
    ];

    public function parent()
    {
        return $this->belongsTo('App\GroupResources\Node', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\GroupResources\Node', 'parent_id');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function subtree()
    {
        return $this->hasOne('App\GroupResources\Node', 'id', 'id')->with('descendants');
    }

    public function subset()
    {
        return $this->hasMany('App\GroupResources\Node', 'tree_id', 'tree_id')
            ->where('interval_l', '>=', $this->interval_l)
            ->where('interval_r', '<=', $this->interval_r);
    }

    public function insertChild(string $name)
    {
        $right = $this->right();
        $left = $this->left();

        do {
            $insert = $left->mediant($right);
            $right = $insert;
            $node = Node::where('numer', $insert->num)->where('denom', $insert->den)->first();
        } while ($node);

        $right = $this->right($insert);

        $node = new Node([
            'parent_id' => $this->id,
            'tree_id' => $this->tree_id,
            'name' => $name,
            'numer' => $insert->num,
            'denom' => $insert->den,
            'interval_l' => (int) (PHP_INT_MAX / $insert->den) * $insert->num,
            'interval_r' => (int) (PHP_INT_MAX / $right->den) * $right->num
        ]);

        $node->save();
        return $node;
    }

    public function depth()
    {
        if($this->numer == 0 && $this->denom == 1){
            return 0;
        } else {
            return $this->parent->depth() + 1;
        }
    }

    private function left()
    {
        return new Rational($this->numer, $this->denom);
    }

    private function right(Rational $left=null)
    {
        $left = $left ?: $this->left();
        for($i = 1; $i <= $left->den; $i++){
            if(($left->num * $i + 1) % $left->den === 0) {
                return new Rational(($left->num * $i + 1) / $left->den, $i);
            }
        }
    }
}

