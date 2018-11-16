<?php

namespace AvisoNavAPI\Exports;

use AvisoNavAPI\Aid;
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

class AidExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $aid = Aid::with([
            'symbol',
            'symbol.symbolLang',
            'lightClass',
            'aidColorLight',
            'period' => function($query){
                $query->where('state', '=', 'C');
            },
            'period.sequenceFlashes',
            'height' => function($query){
                $query->where('state', '=', 'C');
            },
            'nominalScope' => function($query){
                $query->where('state', '=', 'C');
            },
            'aidTypeForm.aidTypeFormLang' => function($query){
                $query->whereHas('language', function($query){
                    $query->where('code', '=', 'es');
                });
            },
            'colorStructurePattern.colorStructureLang' => function($query){
                $query->whereHas('language', function($query){
                    $query->where('code', '=', 'es');
                });
            },
            'topMark.topMarkLang' => function($query){
                $query->whereHas('language', function($query){
                    $query->where('code', '=', 'es');
                });
            },
            'symbol.location.zone.zoneLang' => function($query){
                $query->whereHas('language', function($query){
                    $query->where('code', '=', 'es');
                });
            }
        ])
        ->get();

        return $aid;
    }

    public function map($aid): array
    {
        $name = ($aid->symbol->symbolLang) ? $aid->symbol->symbolLang->name : null;
        $aidObservation = ($aid->symbol->symbolLang) ? $aid->symbol->symbolLang->observation : null;
        $position = null;
        $lightClass = $aid->lightClass->alias;
        $period = null;
        $flashGroup = null;
        $colorLight = null;
        $elevation = null;
        $height = null;
        $scope = null;
        $form = null;
        $colorStructure = null;
        $topMark = null;
        $sequenceFlashes = null;
        $zone = null;
        
        if($aid->symbol->position)
        {
            $position = $this->dd2dmStringFormat([0, $aid->symbol->position->getLat()])[1]."\n".$this->dd2dmStringFormat([$aid->symbol->position->getLng(), 0])[0];
        }
        
        if($aid->period)
        {
            $period = $aid->period->time;
            $flashGroup = $aid->period->flash_group;

            if($aid->period->sequenceFlashes)
            {
                $sequenceFlashes = $aid->period->sequenceFlashes->map(function($item){
                    return "FI ".$item->on." s, OC ".$item->off." s\n";
                });

                $sequenceFlashes = $sequenceFlashes->implode("");
            }
        }
        
        if($aid->height)
        {
            $elevation = $aid->height->elevation;
            $height = $aid->height->structure_height;
        }
       
        if($aid->nominalScope)
        {
            $scope = $aid->nominalScope->scope;
        }
        
        if($aid->aidColorLight)
        {
            $colorLight = $aid->aidColorLight->map(function($item){
                return $item->alias;
            });

            $colorLight = $colorLight->implode("");
        }

        if($aid->aidTypeForm && $aid->aidTypeForm->aidTypeFormLang)
        {
            $form = $aid->aidTypeForm->aidTypeFormLang->description;
        }
        
        if($aid->colorStructurePattern && $aid->colorStructurePattern->colorStructureLang)
        {
            $colorStructure = $aid->colorStructurePattern->colorStructureLang->name;
        }

        if($aid->topMark && $aid->topMark->topMarkLang)
        {
            $topMark = $aid->topMark->topMarkLang->description;
        }

        if($aid->symbol->location && $aid->symbol->location->zone && $aid->symbol->location->zone->zoneLang)
        {
            $zone = $aid->symbol->location->zone->zoneLang->name;
        }

        $features = "$lightClass ($flashGroup) $colorLight $period s";

        $description = "$form\n$colorStructure\n$height";
        $description .= ($topMark) ? "\n$topMark" : null;

        $observation = "$sequenceFlashes\n$aidObservation";

        return [
            $name,
            $position,
            $features,
            $elevation,
            $scope,
            $description,
            $observation,
            $zone
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre',
            "Latitud (N)\nLongitud (W)",
            'Características',
            'Altitud (m)',
            'Alcance (Mn)',
            'Descripción',
            'Observación',
            'Zona'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->styleCells(
                    'A1:G1',
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
                    'A2:G'.$maxRow,
                    [
                        'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        )
                    ]
                );

                $event->sheet->getStyle('B1:B'.$maxRow)->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('F2:F'.$maxRow)->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('G2:G'.$maxRow)->getAlignment()->setWrapText(true);
            },
        ];
    }

    protected function dd2dm($xy)
    {
        $coords = [];
    
        for ($i=0; $i<count($xy); $i++) {
          $arr = [1,0,1];
          $spl = explode('.', $xy[$i]);
          $arr[0] = abs(explode('.', $xy[$i])[0]);
          $arr[1] = count($spl) === 2 ? abs(floatval('.'.explode('.', $xy[$i])[1])*60.0) : 0;
          $arr[2] = $xy[$i] >= 0 ? 1 : -1;
    
          $coords[$i] = $arr;
        }
    
        return $coords;
    }

    protected function dd2dmStringFormat($xy)
    {
        $coord = $this->dd2dm($xy);
    
        $lon_deg = round($coord[0][0], 0);
        $lon_min = round($coord[0][1], 4);
        $lon_dir = ($coord[0][2] > 0) ? 'E' : 'W';
        $longitude = $lon_deg.'°'.$lon_min.'’'.$lon_dir;
        
        $lat_deg = round($coord[1][0], 0);
        $lat_min = round($coord[1][1], 4);
        $lat_dir = ($coord[1][2] > 0) ? 'N' : 'S';
        $latitude = $lat_deg.'°'.$lat_min.'’'.$lat_dir;
                    
        return [$longitude, $latitude];
    }
}