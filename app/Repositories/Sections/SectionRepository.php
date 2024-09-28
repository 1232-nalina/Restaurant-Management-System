<?php

namespace App\Repositories\Sections;

interface SectionRepository
{
    public function addSection(array $attributes);

    public function getAllSection();

    public function deleteSection($sectionId);

    public function getSingleSection($sectionId);

    public function updateSection(array $attributes, $sectionId);
}
