<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\ReportParameter;
use Illuminate\Support\Facades\Storage;
use AvisoNavAPI\Http\Requests\Notice\StoreReportParameter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\Notice\ReportParameterResource;

class ReportParameterController extends Controller
{

    public function getReportParameter(){
        $reportParameter = ReportParameter::firstOrFail();

        return new ReportParameterResource($reportParameter);
    }

    public function update(StoreReportParameter $storeReportParameter){

        $reportParameter = ReportParameter::firstOrFail();

        $reportParameter->name_person1 = $storeReportParameter->input('namePerson1');
        $reportParameter->name_person2 = $storeReportParameter->input('namePerson2');

        $firmPerson1Upload = $storeReportParameter->file('firmPerson1');
        $firmPerson2Upload = $storeReportParameter->file('firmPerson2');

        if($reportParameter->firm_person1)
        {
            Storage::disk('public')->delete($reportParameter->firm_person1);
        }

        if($reportParameter->firm_person2)
        {
            Storage::disk('public')->delete($reportParameter->firm_person2);
        }

        $path1 = $firmPerson1Upload->storeAs('firmas', uniqid().'.'.$firmPerson1Upload->getClientOriginalExtension(), 'public');
        $path2 = $firmPerson2Upload->storeAs('firmas', uniqid().'.'.$firmPerson2Upload->getClientOriginalExtension(), 'public');

        $reportParameter->firm_person1 = $path1;
        $reportParameter->firm_person2 = $path2;
        
        $reportParameter->save();

        return new ReportParameterResource($reportParameter);
    }
}