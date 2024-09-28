<?php

namespace App\Repositories\Classes;

interface ClassRepository
{
    public function addClass(array $attributes);

    public function getAllClass();

    public function deleteClass($classId);

    public function getSingleClass($classId);

    public function updateClass(array $attributes,$classId);
}
