<?php

namespace AvisoNavAPI\Exports;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use \Maatwebsite\Excel\Sheet;

Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
});

class NoticeNoveltyGTPExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{

    public function __construct($year)
    {
        $this->year = $year;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        DB::statement("SET lc_time_names = 'es_CO';");

        $collection = DB::select("
                    SELECT MONTHNAME(m.merge_date) as mes,
                            IFNULL(n.total, 0) as notice,
                            IFNULL(nvg.total, 0) as general_novelty,
                            IFNULL(nvt.total, 0) as temporary_novelty,
                            IFNULL(nvp.total, 0) as permanent_novelty
                    FROM (
                        SELECT '2000-01-01' AS merge_date, 0 as total
                        UNION SELECT '2000-02-01' AS merge_date, 0 as total
                        UNION SELECT '2000-03-01' AS merge_date, 0 as total
                        UNION SELECT '2000-04-01' AS merge_date, 0 as total
                        UNION SELECT '2000-05-01' AS merge_date, 0 as total
                        UNION SELECT '2000-06-01' AS merge_date, 0 as total
                        UNION SELECT '2000-07-01' AS merge_date, 0 as total
                        UNION SELECT '2000-08-01' AS merge_date, 0 as total
                        UNION SELECT '2000-09-01' AS merge_date, 0 as total
                        UNION SELECT '2000-10-01' AS merge_date, 0 as total
                        UNION SELECT '2000-11-01' AS merge_date, 0 as total
                        UNION SELECT '2000-12-01' AS merge_date, 0 as total
                    ) as m
                    LEFT JOIN (
                        SELECT MONTH(created_at) as month, count(id) as total
                        FROM notice
                        WHERE YEAR(created_at) = ?
                        GROUP BY MONTH(created_at)
                    ) as n on n.month = MONTH(m.merge_date)
                    LEFT JOIN (
                        SELECT MONTH(novelty.created_at) as month, count(novelty.id) as total
                        FROM novelty
                        INNER JOIN character_type on character_type.id = novelty.character_type_id
                        WHERE character_type.alias = 'G' AND YEAR(novelty.created_at) = ?
                    ) as nvg on nvg.month = MONTH(m.merge_date)
                    LEFT JOIN (
                        SELECT MONTH(novelty.created_at) as month, count(novelty.id) as total
                        FROM novelty
                        INNER JOIN character_type on character_type.id = novelty.character_type_id
                        WHERE character_type.alias = 'T' AND YEAR(novelty.created_at) = ?
                    ) as nvt on nvt.month = MONTH(m.merge_date)
                    LEFT JOIN (
                        SELECT MONTH(novelty.created_at) as month, count(novelty.id) as total
                        FROM novelty
                        INNER JOIN character_type on character_type.id = novelty.character_type_id
                        WHERE character_type.alias = 'P' AND YEAR(novelty.created_at) = ?
                    ) as nvp on nvp.month = MONTH(m.merge_date)
                    ORDER BY m.merge_date ASC
                ",
                [$this->year, $this->year, $this->year, $this->year]
            );

        return collect($collection);
    }

    public function map($data): array
    {
        return [
            $data->mes,
            $data->notice,
            $data->general_novelty,
            $data->temporary_novelty,
            $data->permanent_novelty
        ];
    }

    public function headings(): array
    {
        return [
            'Mes',
            'Avisos',
            'Novedades Generales',
            'Novedades Temporales',
            'Novedades Permanentes'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->styleCells(
                    'A1:E1',
                    [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => array('rgb' => '3B8AC7' )
                        ],
                        'font'  => array(
                            'color' =>   array('rgb' => 'FFFFFF'),
                            'bold'  => true
                        ),
                        'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        )
                    ]
                );
                
                $maxRow = $event->sheet->getHighestRow();

                $event->sheet->styleCells(
                    'A2:E'.$maxRow,
                    [
                        'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        )
                    ]
                );
            },
        ];
    }
}