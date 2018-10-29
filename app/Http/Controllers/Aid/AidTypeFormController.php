<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Language;
use AvisoNavAPI\AidTypeForm;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\AidTypeFormLang;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Aid\StoreAidTypeForm;
use AvisoNavAPI\ModelFilters\Basic\AidTypeFormFilter;
use AvisoNavAPI\Http\Resources\Aid\AidTypeFormResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class AidTypeFormController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormResource
     */
    public function index()
    {
        $collection = AidTypeForm::filter(request()->all(), AidTypeFormFilter::class)
                             ->with([
                                 'aidTypeFormLang' => $this->withLanguageQuery()
                             ])
                             ->paginateFilter($this->perPage());

        return AidTypeFormResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidTypeForm  $request
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormResource
     */
    public function store(StoreAidTypeForm $request)
    {
        $language = Language::where('code','es')->firstOrFail();
        
        $aidTypeForm = new AidTypeForm();
        $aidTypeForm->save();

        $aidTypeFormLang = new AidTypeFormLang($request->only(['description']));
        $aidTypeFormLang->language_id = $language->id;

        $aidTypeForm->aidTypeFormLang()->save($aidTypeFormLang);

        return new AidTypeFormResource($aidTypeForm);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\AidTypeForm  $aidTypeForm
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormResource
     */
    public function show(AidTypeForm $aidTypeForm)
    {
        $aidTypeForm->load([
            'AidTypeFormLang' => $this->withLanguageQuery()
        ]);

        return new AidTypeFormResource($aidTypeForm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\AidTypeform\StoreAidTypeform  $request
     * @param  \AvisoNavAPI\AidTypeform $aidTypeform
     * @return \AvisoNavAPI\Http\Resources\aidTypeformResource
     */
    public function update(StoreAidTypeform $request, AidTypeform $aidTypeform)
    {
        // $aidTypeform->illustration = $request->input('illustration');
        
        // if($aidTypeform->isClean()){
        //     return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        // }

        // $aidTypeform->save();

        // return new AidTypeformResource($aidTypeform);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\AidTypeForm $aidTypeform
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeformResource
     */
    public function destroy(AidTypeForm $aidTypeForm)
    {
        $aidTypeForm->delete();

        return new AidTypeFormResource($aidTypeForm);
    }
}
