<?php

namespace App\Services\Entity;

interface EntityInterface
{
    public function save();
    
    public function parse(int $row);
}
