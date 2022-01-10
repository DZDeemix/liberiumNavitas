<?php

namespace App\Services;

use App\Services\WorksheetCreator;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ParseHeadData
{
    private static $instance;

    public string $startCol = 'C';
    public array $fields;
    private $worksheet;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->worksheet = WorksheetCreator::getWorksheet();
            self::$instance->parseHeading();
        }
        return self::$instance;
    }

    private function parseHeading()
    {
        for ($col=$this->startCol; $col != $this->worksheet->getHighestColumn(); $col++) {
            $cell = $this->worksheet->getCell($col . 1);
            if ($cell->isMergeRangeValueCell()) {
                $range = Coordinate::getRangeBoundaries($cell->getMergeRange());
                $entity = $cell->getValue();
                $range[1][0]++;
                for ($col1 = $range[0][0]; $col1 != $range[1][0]; $col1++) {
                    $cell = $this->worksheet->getCell($col1 . 2);
                    if ($cell->isMergeRangeValueCell()) {
                        $range1 = Coordinate::getRangeBoundaries($cell->getMergeRange());
                        $field = $cell->getValue();
                        $range1[1][0]++;
                        for ($col2 = $range1[0][0]; $col2 != $range1[1][0]; $col2++) {
                            $cell = $this->worksheet->getCell($col2 . 3);
                            $this->fields[$entity][$cell->getValue()][$col2] = $field;
                        }
                    }
                }
            }
        }
    }

    public function getFields()
    {
        return $this->fields;
    }
}
