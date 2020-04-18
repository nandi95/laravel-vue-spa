<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

/**
 * Trait CanSearch
 *
 * @package App\Traits
 */
trait CanSearch
{
    /**
     * @param Builder $query
     * @param string  $keyword
     * @param array   $columns
     * @param array   $relativeTables
     *
     * @return mixed
     */
    public function scopeSearch($query, $keyword, $columns = [], $relativeTables = [])
    {
        if (empty($columns)) {
            $columns = Arr::except(
                Schema::getColumnListing($this->table), $this->guarded
            );
        }

        $query->where(function ($query) use ($keyword, $columns) {
            foreach ($columns as $key => $column) {
                $clause = $key == 0 ? 'where' : 'orWhere';
                $query->$clause($column, "LIKE", "%$keyword%");

                if (!empty($relativeTables)) {
                    $this->filterByRelationship($query, $keyword, $relativeTables);
                }
            }
        });

        return $query;
    }


    /**
     * @param Builder $query
     * @param string  $keyword
     * @param array   $relativeTables
     *
     * @return mixed
     */
    private function filterByRelationship($query, $keyword, $relativeTables)
    {
        foreach ($relativeTables as $relationship => $relativeColumns) {
            $query->orWhereHas($relationship, function ($relationQuery) use ($keyword, $relativeColumns) {
                foreach ($relativeColumns as $key => $column) {
                    $clause = $key == 0 ? 'where' : 'orWhere';
                    $relationQuery->$clause($column, "LIKE", "%$keyword%");
                }
            });
        }

        return $query;
    }
}
