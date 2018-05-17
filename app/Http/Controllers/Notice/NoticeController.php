<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\NoticeLang;
use Illuminate\Http\Request;
use AvisoNavAPI\AvisoDetalle;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\AyudaResource;
use AvisoNavAPI\ModelFilters\Basic\NoticeFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNotice;
use AvisoNavAPI\Http\Resources\Notice\NoticeResource;
use AvisoNavAPI\Http\Resources\Notice\NoticeSimpleResource;

class NoticeController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language = request()->input('language');
        $collection = Notice::filter(request()->all(), NoticeFilter::class)
                            ->with([
                                'entity',
                                'characterType.characterTypeLang' => function ($query) use ($language){
                                    $query->where('language_id', $language);
                                },
                                'noveltyType.noveltyTypeLang' => function ($query) use ($language){
                                    $query->where('language_id', $language);
                                },
                                'noticeLang' => function ($query) use ($language){
                                    $query->where('language_id', $language);
                                }
                            ])
                            ->paginateFilter($this->perPage());

        return NoticeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNotice  $request
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function store(StoreNotice $request)
    {
        $notice = new Notice($request->only(['number', 'date']));
        
        $periodo = (new \DateTime("now"))->format('Ym');
        $notice->periodo = $periodo;
        $notice->user = 'JMARDZ';
        $notice->entity_id = $request->input('entity_id');
        $notice->characterType_id = $request->input('character_type_id');

        $notice->parent_id = ($request->has('parent_id')) ? $request->input('parent_id') : null;
        
        // $notice->file_info = null;

        $notice->save();

        return new NoticeSimpleResource($notice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function show(Notice $notice)
    {
        $language = request()->input('language');
        $notice->load([
            'entity',
            'characterType.characterTypeLang' => function ($query) use ($language){
                $query->where('language_id', $language);
            },
            'noveltyType.noveltyTypeLang' => function ($query) use ($language){
                $query->where('language_id', $language);
            },
            'noticeLang' => function ($query) use ($language){
                $query->where('language_id', $language);
            }]
        );
        return new NoticeResource($notice);
    }

    /**
     * Muestra un notice resource sin ningun noticeLang embebido.
     * El notieLang dentro del resource ira en forma de link que espesifica la relacion.
     * Este metodo solo es conveniente para buscar un notice cuando se le quiere realizar una actualizacion.
     * Los datos que el notice tiene relacionado iran embebidos en el notice resource en el idioma por defecto.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    // public function showSimple($id)
    // {
    //     $language = request()->input('language');
    //     $notice = Notice::with([
    //                         'entity',
    //                         'characterType.characterTypeLang' => function ($query) use ($language){
    //                             $query->where('language_id', $language);
    //                         }]
    //                     )->findOrFail($id);

    //     return new NoticeSimpleResource($notice);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNotice  $request
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function update(StoreNotice $request, Notice $notice)
    {
        $notice->fill($request->only(['number', 'date', 'state']));
        $notice->user = 'JMARDZ';
        $notice->entity_id = $request->input('entity_id');
        $notice->characterType_id = $request->input('character_type_id');

        $notice->parent_id = ($request->has('parent_id')) ? $request->input('parent_id') : null;

        if($notice->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }
        
        $notice->save();

        return new NoticeResource($notice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();

        return new NoticeResource($notice);
    }
}
