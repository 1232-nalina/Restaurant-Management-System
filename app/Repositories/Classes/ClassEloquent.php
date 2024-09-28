<?php

namespace App\Repositories\Classes;

use App\Models\Classes;

class ClassEloquent implements ClassRepository
{

    public function addClass(array $attributes)
    {
        $class = new Classes();
        $class->name = $attributes['name'];
        $class->started_year = $attributes['started_year'];

        $uniqueClassId = $class->createUniqueClassId();
        $class->unique_id = $uniqueClassId;
        $class->save();
        $sections = $attributes['sections'];
        $class->sections()->attach($sections);
        return $class;
    }

    public function getAllClass(){

        return Classes::orderBy('created_at','ASC')->get();
    }

    public function deleteClass($classId)
    {
        $class = Classes::findOrFail($classId);
        $class->delete();
        return $class;
    }

    public function getSingleClass($classId)
    {
        $class = Classes::findOrFail($classId);
        return $class;
    }

    public function updateClass(array $attributes, $classId)
    {
        $class = Classes::findOrFail($classId);
        $class->name = $attributes['name'];
        $class->started_year = $attributes['started_year'];
        $class->save();
        $sections = $attributes['sections'];
        $class->sections()->sync($sections);
        return $class;
    }
}
