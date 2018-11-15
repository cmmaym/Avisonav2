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

class AidExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
            'aidColorLight'
        ])
        ->get();

        return $aid;
    }

    public function map($aid): array
    {
        $name = ($aid->symbol->symbolLang) ? $aid->symbol->symbolLang->name : null;
        $position = null;
        
        if($aid->symbol->position)
        {
            $position = $this->dd2dmStringFormat([0, $aid->symbol->position->getLat()])[1].' '.$this->dd2dmStringFormat([$aid->symbol->position->getLng(), 0])[0];
        }

        return [
            $name,
            $position
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Latitud (N) Longitud (W)',
            'Características'
        ];
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //         'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
    //     ];
    // }

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
