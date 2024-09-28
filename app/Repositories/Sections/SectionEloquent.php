<?php

namespace App\Repositories\Sections;

use App\Models\Sections;

class SectionEloquent implements SectionRepository
{
    public function addSection(array $attributes)
    {
        $section = new Sections();
        $section->name = $attributes['name'];
        $uniqueSectionId = $section->createUniqueSectionId();
        $section->unique_id = $uniqueSectionId;
        $section->save();
        return $section;
    }

    public function getAllSection()
    {
        return Sections::orderBy('created_at', 'ASC')->get();
    }
    public function deleteSection($sectionId)
    {
        $class = Sections::findOrFail($sectionId);
        $class->delete();
        return $class;
    }
    public function getSingleSection($sectionId)
    {
        $section = Sections::findOrFail($sectionId);
        return $section;
    }
    public function updateSection(array $attributes, $sectionId)
    {
        $section = Sections::findOrFail($sectionId);
        $section->name = $attributes['name'];
        $section->save();
        return $section;
    }
}
