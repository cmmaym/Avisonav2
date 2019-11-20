<?php

if (!function_exists('dd2dm')) {
    function dd2dm($xy) {
        $coords = [];

        for($i=0; $i<count($xy); $i++){
            $arr = [1,0,1];
            $spl = explode('.', strval($xy[$i]));
            $arr[0] = abs(explode('.', strval($xy[$i]))[0]);
            $arr[1] = count($spl) === 2 ? abs(floatval('.'.explode('.', strval($xy[$i]))[1])*60.0) : 0;
            $arr[2] = $xy[$i] >= 0 ? 1 : -1;

            $coords[$i] = $arr;
        }

        return $coords;
    }
}

if(!function_exists('dd2dmStringFormat')){
    function dd2dmStringFormat($xy){
        $coords = dd2dm($xy);

        $lon_deg = number_format($coords[0][0], 0, '.', '');
        $lon_min = number_format($coords[0][1], 4, '.', '');
        $lon_dir = $coords[0][2] > 0 ? 'E': 'W';
        $longitude = $lon_deg.'°'.$lon_min.'’'.$lon_dir;

        $lat_deg = number_format($coords[1][0], 0, '.', '');
        $lat_min = number_format($coords[1][1], 4, '.', '');
        $lat_dir = $coords[1][2] > 0 ? 'N': 'S';
        $latitude = $lat_deg.'°'.$lat_min.'’'.$lat_dir;

        return [$longitude, $latitude];
    }
}