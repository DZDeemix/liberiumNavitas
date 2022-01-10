<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WorksheetCreator
{
    private static Spreadsheet $spreadsheet;
    private static Worksheet $worksheet;

    public function __construct(string $path)
    {
        self::$spreadsheet = IOFactory::load($path);
        self::$worksheet = self::$spreadsheet->getActiveSheet();
    }

    public static function getWorksheet(): Worksheet
    {
        return self::$worksheet;
    }
}
