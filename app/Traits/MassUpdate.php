<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait MassUpdate
{

    public function caseQuery($resource, $column)
    {
        $str = '';

        foreach ($resource as $key => $value) {
            $str = $str . " WHEN id = $key THEN $column + $value ";
        }

        return $str;
    }


    public function updateMass($resource, $column)
    {
        $table = $this->getTable();

        $caseQuery = $this->caseQuery($resource, $column);

        $ids = implode(',', array_keys($resource));

        return DB::select("UPDATE $table SET $column = CASE $caseQuery END WHERE id IN ($ids)");
    }

}