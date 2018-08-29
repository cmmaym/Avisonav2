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

        if($parent && !$symbol)
        {
            if($parent->characterType->alias === 'P')
            {
                return $this->errorResponse('Una novedad Permanente no puede ser cancelada', 409);
            }
            
            if($parent->characterType->alias === 'T' && $characterType->alias === 'G')
            {
                return $this->errorResponse('Una novedad Temporal no puede ser cancelada por una novedad General', 409);
            }
            
            $novelty->parent_id = $parent->id;
            $parent->state = 'C';
            $novelty->state = 'A';

            $parent->save();
        }else if($symbol && !$parent)
        {
            //Buscamos si el simbolo se encuentra en otra novedad Temporal y estado Abierta asociada al symbolo
            $noveltyTemp = Novelty::whereHas('characterType', function($query) {
                                        $query->where('alias', 'T');
                                    })
                                    ->where('state', 'A')
                                    ->where('symbol_id', $symbol)
                                    ->first();
            
            if($noveltyTemp)
            {
                //Numero del aviso donde se encuentra la novedad temporal que no ha sido candelada
                $noticeNumber = $noveltyTemp->notice->number;
                return $this->errorResponse("La ayuda o peligro se encuentra en una novedad pendiente por cancelar en el aviso $noticeNumber", 409);
            }

            $novelty->state = 'A';
            $novelty->symbol_id = $symbol;
        }else if($symbol && $parent)
        {
            if($parent->characterType->alias === 'P')
            {
                return $this->errorResponse('Una novedad Permanente no puede ser cancelada', 409);
            }
            
            if($parent->characterType->alias === 'T' && $characterType->alias === 'G')
            {
                return $this->errorResponse('Una novedad Temporal no puede ser cancelada por una novedad General', 409);
            }

            //Buscamos la ultima novedad temporal y estado Abierta asociada al symbolo
            $noveltyTemp = Novelty::whereHas('characterType', function($query) {
                                        $query->where('alias', 'T');
                                    })
                                    ->where('state', 'A')
                                    ->where('symbol_id', $symbol)
                                    ->first();
            
            if(!is_null($noveltyTemp) && $noveltyTemp->symbol->id !== $symbol)
            {
                return $this->errorResponse('La novedad a cancelar no corresponde con la ultima novedad Temporal pendiente por cancelar relacionada a la Ayuda o Peligro seleccionado', 409);
            }

            $novelty->state = 'A';
            $novelty->parent_id = $parent->id;
            $novelty->symbol_id = $symbol;
            $parent->state = 'C';

            $parent->save();
        }
        
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