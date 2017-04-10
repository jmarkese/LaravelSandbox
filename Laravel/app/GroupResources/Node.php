<?php

namespace App\GroupResources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Node extends Model implements TreeNode
{

    public static $principal = self::class;
    protected $table = 'nodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tree_id', 'parent_id', 'numer', 'denom', 'interval_l', 'interval_r'
    ];

    public function children()
    {
        return $this->hasMany(self::$principal, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::$principal, 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    public function scopeTestSubset($query, $int_l, $int_r)
    {
        return $query
            ->where('interval_l', '>=', $int_l)
            ->where('interval_r', '<=', $int_r);
    }

    public function subsets()
    {   //return $this->testSubset($this->interval_l, $this->interval_r);
        return $this->hasMany(self::$principal, 'tree_id', 'tree_id')
            ->where('interval_l', '>=', $this->interval_l)
            ->where('interval_r', '<=', $this->interval_r);
    }

    public function supersets()
    {
        return $this->belongsToMany(self::$principal, 'tree_id', 'tree_id')
            ->where('interval_l', '<=', $this->interval_l)
            ->where('interval_r', '>=', $this->interval_r);
    }

    public function subtree()
    {
        return $this->hasOne(self::$principal, 'id', 'id')->with('descendants');
    }

    public function insertChild(string $name)
    {
        $right = $this->right();
        $left = $this->left();

        do {
            $insert = $left->mediant($right);
            $right = $insert;
            $node = (self::$principal)::where('numer', $insert->num)->where('denom', $insert->den)->first();
        } while ($node);

        $right = $this->right($insert);

        $node = new self::$principal([
            'name' => $name,
            'tree_id' => $this->tree_id,
            'parent_id' => $this->id,
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
