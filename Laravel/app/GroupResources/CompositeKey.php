<?php

namespace App\GroupResources;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CompositeKey extends Relation
{
    /**
     * @var QueryBuilder
     */
    protected $query;

    /**
     * @var Model
     */
    protected $parent;

    protected $relationConstraints = [];

    public static function hasMany($related, Model $model, array $relationConstraints)
    {
        $builder = $model->newRelatedInstance($related)->newQuery();
        return new CompositeKey($builder, $model, $relationConstraints);
    }

    /**
     * DescendantsRelation constructor.
     *
     * @param QueryBuilder $builder
     * @param Model $model
     */
    public function __construct(EloquentBuilder $builder, Model $model, array $relationConstraints)
    {
        $this->relationConstraints = $relationConstraints;
        parent::__construct($builder, $model);
    }

    /**
     * @param EloquentBuilder $query
     * @param EloquentBuilder $parent
     * @param array $columns
     *
     * @return mixed
     */
    public function getRelationExistenceQuery(EloquentBuilder $query, EloquentBuilder $parent, $columns = [ '*' ])
    {
        $query->select($columns);
        $table = $query->getModel()->getTable();
        $query->from($table.' as '.$hash = $this->getRelationCountHash());
        $grammar = $query->getQuery()->getGrammar();

        $table = $grammar->wrapTable($table);
        $hash = $grammar->wrapTable($hash);

        foreach($this->relationConstraints as $r){
            $lft = $grammar->wrap($r['foreign_key']);
            $rgt = $grammar->wrap($r['local_key']);
            $query->whereRaw("{$hash}.{$lft} {$r['operator']} {$table}.{$rgt}");
        }

        return $query;
    }

    /**
     * @param EloquentBuilder $query
     * @param EloquentBuilder $parent
     * @param array $columns
     *
     * @return mixed
     */
    public function getRelationQuery(
        EloquentBuilder $query, EloquentBuilder $parent,
        $columns = [ '*' ]
    ) {
        return $this->getRelationExistenceQuery($query, $parent, $columns);
    }

    /**
     * Get a relationship join table hash.
     *
     * @return string
     */
    public function getRelationCountHash()
    {
        return 'self_'.md5(microtime(true));
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        if ( !static::$constraints ) return;
        foreach($this->relationConstraints as $r){
            $this->query->where($r['foreign_key'], $r['operator'], $this->parent->{$r['local_key']});
        }
    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param  array $models
     *
     * @return void
     */

    public function addEagerConstraints(array $models)
    {
        $model = $this->query->getModel();
        $table = $model->getTable();
        $key = $model->getKeyName();
        $grammar = $this->query->getQuery()->getGrammar();
        $table = $grammar->wrapTable($table);
        $hash = $grammar->wrap($this->getRelationCountHash());
        $key = $grammar->wrap($key);

        $relations = [];
        $selects = [];
        foreach($this->relationConstraints as $rc) {
            $local = $grammar->wrap($rc['local_key']);
            $foreign = $grammar->wrap($rc['foreign_key']);
            $selects[] = $local;
            $relations[] = " {$table}.{$local} {$rc['operator']} {$hash}.{$foreign} ";
        }
        $relations = implode(" AND ", $relations);
        $selects = implode(" , ", $selects);

        $sql = "{$key} IN (SELECT DISTINCT($key) FROM {$table} INNER JOIN "
            . "(SELECT {$selects} FROM {$table} WHERE {$key} IN (" . implode(',', $this->getKeys($models))
            . ")) AS {$hash} ON {$relations})";

        $this->query->whereNested(function (QueryBuilder $inner) use ($sql) {
            $inner->whereRaw($sql);
        });
    }

    /**
     * Initialize the relation on a set of models.
     *
     * @param  array $models
     * @param  string $relation
     *
     * @return array
     */
    public function initRelation(array $models, $relation)
    {
        return $models;
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param  array $models
     * @param  EloquentCollection $results
     * @param  string $relation
     *
     * @return array
     */
    public function match(array $models, EloquentCollection $results, $relation)
    {
        foreach ($models as $model) {
            $related = $this->getRelatedForModel($model, $results);
            $model->setRelation($relation, $related);
        }

        return $models;
    }

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return $this->query->get();
    }

    /**
     * @param Model $model
     * @param EloquentCollection $results
     *
     * @return Collection
     */
    protected function getRelatedForModel(Model $model, EloquentCollection $results)
    {
        $related = $this->related->newCollection();

        $results->each(function ($r) use ($model, $related){
            foreach($this->relationConstraints as $rc){
                if( !version_compare($r->{$rc['foreign_key']}, $model->{$rc['local_key']}, $rc['operator']) ){
                    return;
                }
            }
            $related->push($r);
        });

        return $related;
    }

}