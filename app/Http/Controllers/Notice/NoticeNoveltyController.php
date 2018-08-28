<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\Novelty;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Notice\StoreNovelty;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ModelFilters\Basic\NoveltyFilter;
use AvisoNavAPI\CharacterType;

class NoticeNoveltyController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Notice\NoveltyResource
     */
    public function index(Notice $notice)
    {
       $collection = $notice->novelty()->filter(request()->all(), NoveltyFilter::class)
                                       ->with([
                                            'characterType.characterTypeLang' => $this->withLanguageQuery(),
                                            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
                                       ])
                                       ->paginateFilter($this->perPage());

        return NoveltyResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNovelty  $request
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function store(StoreNovelty $request, Notice $notice)
    {
        $noveltyType = $request->input('noveltyType');
        $characterType = CharacterType::find($request->input('characterType'));
        $symbol = $request->input('symbol');

        //Novedad a cancelar
        $parent = Novelty::find($request->input('parent'));

        $novelty = new Novelty();
        $novelty->novelty_type_id = $noveltyType;
        $novelty->character_type_id = $characterType->id;

        if($parent)
        {
            $novelty->parent_id = $parent->id;
            
            //Validamos que la novedad a cancelar no a sido Canecelada anteriormente

            $novelty->state = 'A';
        }
        
        // if($symbol)
        // {
        //     //Buscamos si el simbolo se encuentra en otra novedad
        //     //con caracter Temporal y estado Abierta
        //     $noveltyTemp = Novelty::whereHas('characterType', function($query) {
        //                             $query->where('alias', 'T');
        //                         })
        //                         ->where('state', 'A')
        //                         ->where('symbol_id', $symbol)
        //                         ->first();

        //     //Validamos si se encontro una novedad temporal con el simbolo y el usuario no envio
        //     //la novedad que la cancele
        //     if($noveltyTemp && !$parent)
        //     {
        //         return $this->errorResponse('La ayuda o peligro esta pendiente por cancelar en otro aviso', 409);
        //     }

        //     //Validamos si la novedad es de caracter permanente
        //     if($characterType->alias === 'P')

        //     $novelty->symbol_id = $symbol;
        // }

        $notice->novelty()->save($novelty);

        return new NoveltyResource($novelty);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @param  int  $novelty
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function show(Notice $notice, $noveltyId)
    {
        $novelty = $notice->findOrFail($noveltyId);

        $novelty->load([
            'characterType.characterTypeLang' => $this->withLanguageQuery(),
            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
        ]);

        return new NoveltyResource($novelty);
    }

    /**
     * Update the specified resource in storage.
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNovelty  $request
     * @param  \AvisoNavAPI\Notice $notice
     * @param  int $novelty
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function update(StoreNovelty $request, Notice $notice, $noveltyId)
    {
        $novelty = $notice->findOrFail($noveltyId);
        $novelty->novelty_type = $request->input('noveltyType');
        $novelty->character_type = $request->input('characterType');

        if($novelty->isClean()){
            return $this->errorResponse('Debe especificar por lo menos un valor diferente para actualizar', 409);
        }

        return new NoveltyResource($novelty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @param  int  $novelty
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function destroy(Notice $notice, $noveltyId)
    {
        $novelty = $notice->findOrFail($noveltyId);
        $novelty->delete();

        return new NoveltyResource($novelty);
    }
}