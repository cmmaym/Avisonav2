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
                            IFNULL(nvp.total, 0) as permanent_novelty,
                            IFNULL(a.total, 0) as total_MCC,
                            IFNULL(b.total, 0) as total_OPC,
                            IFNULL(c.total, 0) as total_General,
                            IFNULL(d.total, 0) as total_AMJC
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
                        WHERE year = ? and state='P'
                        GROUP BY MONTH(created_at)
                    ) as n on n.month = MONTH(m.merge_date)
                    LEFT JOIN (
                        SELECT MONTH(novelty.created_at) as month, count(novelty.id) as total
                        FROM novelty
                        INNER JOIN notice n on n.id = novelty.notice_id
                        INNER JOIN character_type on character_type.id = novelty.character_type_id
                        WHERE character_type.alias = 'G' AND n.state='P' and YEAR(novelty.created_at) = ?
                        GROUP BY MONTH(novelty.created_at)
                    ) as nvg on nvg.month = MONTH(m.merge_date)
                    LEFT JOIN (
                        SELECT MONTH(novelty.created_at) as month, count(novelty.id) as total
                        FROM novelty
                        INNER JOIN notice n on n.id = novelty.notice_id
                        INNER JOIN character_type on character_type.id = novelty.character_type_id
                        WHERE character_type.alias = 'T' AND n.state='P' AND YEAR(novelty.created_at) = ?
                        GROUP BY MONTH(novelty.created_at)
                    ) as nvt on nvt.month = MONTH(m.merge_date)
                    LEFT JOIN (
                        SELECT MONTH(novelty.created_at) as month, count(novelty.id) as total
                        FROM novelty
                        INNER JOIN notice n on n.id = novelty.notice_id
                        INNER JOIN character_type on character_type.id = novelty.character_type_id
                        WHERE character_type.alias = 'P' AND n.state='P' AND YEAR(novelty.created_at) = ?
                        GROUP BY MONTH(novelty.created_at)
                    ) as nvp on nvp.month = MONTH(m.merge_date)
                    left join (
                        select MONTH(n.created_at) as month, count(n.id) as total, zl.alias zone
                        from notice n
                        inner join location l on l.id = n.location_id
                        inner join zone z on z.id = l.zone_id
                        inner join zone_lang zl on zl.zone_id = z.id and zl.language_id=1
                        where year = ? and state = 'P' and zl.alias='MCC'
                        GROUP BY MONTH(n.created_at), zl.alias
                    ) a on a.month = MONTH(m.merge_date)
                    left join (
                        select MONTH(n.created_at) as month, count(n.id) as total, zl.alias zone
                        from notice n
                        inner join location l on l.id = n.location_id
                        inner join zone z on z.id = l.zone_id
                        inner join zone_lang zl on zl.zone_id = z.id and zl.language_id=1
                        where year = ? and state = 'P' and zl.alias='OPC'
                        GROUP BY MONTH(n.created_at), zl.alias
                    ) b on b.month = MONTH(m.merge_date)
                    left join (
                        select MONTH(n.created_at) as month, count(n.id) as total, zl.alias zone
                        from notice n
                        inner join location l on l.id = n.location_id
                        inner join zone z on z.id = l.zone_id
                        inner join zone_lang zl on zl.zone_id = z.id and zl.language_id=1
                        where year = ? and state = 'P' and zl.alias='G'
                        GROUP BY MONTH(n.created_at), zl.alias
                    ) c on c.month = MONTH(m.merge_date)
                    left join (
                        select MONTH(n.created_at) as month, count(n.id) as total, zl.alias zone
                        from notice n
                        inner join location l on l.id = n.location_id
                        inner join zone z on z.id = l.zone_id
                        inner join zone_lang zl on zl.zone_id = z.id and zl.language_id=1
                        where year = ? and state = 'P' and zl.alias='AMJC'
                        GROUP BY MONTH(n.created_at), zl.alias
                    ) d on d.month = MONTH(m.merge_date)
                    ORDER BY m.merge_date ASC
                ",
                [$this->year, $this->year, $this->year, $this->year, $this->year, $this->year, $this->year, $this->year]
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
            $data->permanent_novelty,
            $data->total_MCC,
            $data->total_OPC,
            $data->total_General,
            $data->total_AMJC
        ];
    }

    public function headings(): array
    {
        return [
            'Mes',
            'Avisos',
            'Novedades Generales',
            'Novedades Temporales',
            'Novedades Permanentes',
            'Total MCC',
            'Total OPC',
            'Total General',
            'Total AMJC'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->styleCells(
                    'A1:I1',
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
                    'A2:I'.$maxRow,
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