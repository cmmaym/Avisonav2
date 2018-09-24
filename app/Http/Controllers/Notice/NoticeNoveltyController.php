<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\Symbol;
use AvisoNavAPI\Novelty;
use AvisoNavAPI\Language;
use AvisoNavAPI\NoveltyLang;
use Illuminate\Http\Request;
use AvisoNavAPI\ChartEdition;
use AvisoNavAPI\CharacterType;
use AvisoNavAPI\SymbolNovelty;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\ModelFilters\Basic\NoveltyFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNovelty;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

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
                                            'parent'
                                       ])
                                       ->orderBy('num_item', 'asc')
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
        $name = $request->input('name');
        $noveltyType = $request->input('noveltyType');
        $characterType = CharacterType::find($request->input('characterType'));
        $symbol = Symbol::find($request->input('symbol'));
        $description = $request->input('description');

        $language = Language::where('code','es')->firstOrFail();

        //Novedad a cancelar
        $parent = Novelty::find($request->input('parent'));

        $novelty = new Novelty();
        $novelty->novelty_type_id = $noveltyType;
        $novelty->character_type_id = $characterType->id;
        $novelty->state = 'A';

        $hasSymbol = false;

        $user = Auth::user();

        if($parent)
        {
            if($parent->characterType->alias === 'P')
            {
                return $this->errorResponse('Una novedad Permanente no puede ser cancelada', 409);
            }
            
            if($parent->characterType->alias === 'T' && $characterType->alias === 'G')
            {
                return $this->errorResponse('Una novedad Temporal no puede ser cancelada por una novedad General', 409);
            }

            if($symbol)
            {
                $symbolId = $symbol->id;
                //Buscamos la ultima novedad temporal y estado Abierta asociada al symbolo
                $noveltyTemp = Novelty::whereHas('characterType', function($query) {
                                    $query->where('alias', 'T');
                                })
                                ->whereHas('symbol', function($query) use ($symbolId){
                                    $query->where('symbol_id', $symbolId);
                                })
                                ->where('state', 'A')
                                ->first();

                if($noveltyTemp && ($noveltyTemp->id !== $parent->id))
                {
                    return $this->errorResponse('La novedad a cancelar no corresponde con la ultima novedad Temporal pendiente por cancelar relacionada a la Ayuda o Peligro seleccionado', 409);
                }else if($parent->symbol && ($parent->symbol->symbol->id !== $symbol->id))
                {
                    return $this->errorResponse('La ayuda o peligro seleccionado no corresponde con la ayuda o peligro asociado a la novedad a cancelar', 409);
                }

                $hasSymbol = true;
            }

            $novelty->parent_id = $parent->id;
            $novelty->state = 'A';

            $parent->state = 'C';
            $parent->save();
        }else if($symbol)
        {
            $symbolId = $symbol->id;
            //Buscamos la ultima novedad temporal y estado Abierta asociada al symbolo
            $noveltyTemp = Novelty::whereHas('characterType', function($query) {
                                $query->where('alias', 'T');
                            })
                            ->whereHas('symbol', function($query) use ($symbolId){
                                $query->where('symbol_id', $symbolId);
                            })
                            ->where('state', 'A')
                            ->first();

            if($noveltyTemp)
            {
                $noticeNumber = $noveltyTemp->notice->number;
                $noveltyNum = $noveltyTemp->num_item; 

                return $this->errorResponse("La ayuda o peligro se encuentra en la novedad #$noveltyNum del aviso $noticeNumber pendiente por cancelar", 409);
            }

            $hasSymbol = true;
            $novelty->state = 'A';
        }
        
        $notice->novelty()->save($novelty);

        if($hasSymbol)
        {
            $symbolNovelty = new SymbolNovelty();
            $symbolNovelty->symbol_id = $symbol->id;

            if($symbol->aid)
            {
                $symbolNovelty->height_id = $symbol->aid->height->id;
                $symbolNovelty->nominal_scope_id = $symbol->aid->nominalScope->id;
                $symbolNovelty->period_id = $symbol->aid->period->id;
            }
            
            $novelty->symbol()->save($symbolNovelty);
        }

        if($symbol)
        {
            $coordinate = $symbol->coordinate()->orderBy('created_at', 'desc')->first();

            if($coordinate) $novelty->coordinate()->attach($coordinate->id);

            $symbol->chart->load([
                                'chartEdition' => function($query){
                                    $query->leftJoin(DB::raw('
                                        (
                                            select chart_id, max(created_at) max_created_at
                                            from chart_edition
                                            group by chart_id
                                        ) che
                                    '), function($join){
                                        $join->on('chart_edition.chart_id', '=', 'che.chart_id');
                                        $join->on('chart_edition.created_at', '=', 'che.max_created_at');
                                    })
                                    ->select('chart_edition.*')
                                    ->whereNotNull('che.chart_id');
                                }
                            ]);
       
            if($symbol->chart)
            {
                $chartEditionId = $symbol->chart->pluck('chartEdition')->collapse()->pluck('id');
                if ($chartEditionId) 
                    $novelty->chartEdition()->syncWithoutDetaching($chartEditionId, [
                        'created_by' => $user->username,
                        'updated_by' => $user->username,
                    ]);
            }

        }

        if($name)
        {
            $noveltyLang = new NoveltyLang();
            $noveltyLang->name = $name;
            $noveltyLang->language_id = $language->id;

            $novelty->noveltyLang()->save($noveltyLang);
        }else if($hasSymbol){
            $dataLangs = $symbol->symbolLangs;

            if($dataLangs)
            {
                $langs = [];
                foreach($dataLangs as $item)
                {
                    $lng = new NoveltyLang();
                    $lng->name = $item->name;
                    $lng->language_id = $item->language_id;

                    $langs[] = $lng;
                }

                $novelty->noveltyLangs()->saveMany($langs);
            }
        }

        $this->generateNoveltySequence($notice->id);

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
        $noveltyType = $request->input('noveltyType');
        $characterType = CharacterType::find($request->input('characterType'));
        $symbol = Symbol::find($request->input('symbol'));

        //Novedad a cancelar
        $parent = Novelty::find($request->input('parent'));

        $novelty = $notice->novelty()->findOrFail($noveltyId);
        $novelty->novelty_type_id = $noveltyType;
        $novelty->character_type_id = $characterType->id;

        //Validamos si tiene una novedad por cancelar
        if($parent)
        {
            if($parent->characterType->alias === 'P')
            {
                return $this->errorResponse('Una novedad Permanente no puede ser cancelada', 409);
            }
            
            if($parent->characterType->alias === 'T' && $characterType->alias === 'G')
            {
                return $this->errorResponse('Una novedad Temporal no puede ser cancelada por una novedad General', 409);
            }

            //Validamos si la novedad anteriormente NO tenia asociado una novedad a cancelar
            //y que no hayan seleccionado algun simbolo
            if(!$novelty->parent && !$symbol)
            {
                $novelty->parent_id = $parent->id;
                $parent->state = 'C';
                $novelty->state = 'A';
    
                $parent->save();
            }

            if($novelty->symbol && $symbol && ($novelty->symbol->id !== $symbol->id))
            {
                $novelty->coordinate()->detach();
                $novelty->chartEdition()->detach();
            }else if($novelty->symbol && !$symbol)
            {
                $novelty->symbol_id = null;
            }


            //Validamos si la novedad anteriormente SI tenia asociada una novedad a cancelar
            //y si dicha novedad es diferete a la que hayan seleccionado
            if($novelty->parent && ($novelty->parent->id !== $parent->id ))
            {
                if($symbol)
                {
                    if($parent->symbol && ($symbol->id !== $parent->symbol->id))
                    {
                        return $this->errorResponse('La ayuda o peligro seleccionado no corresponde con la ayuda o peligro asociado a la novedad a cancelar', 409);
                    }

                    $coordinate = $symbol->coordinate()->orderBy('created_at', 'desc')->first();

                    if($coordinate) $novelty->coordinate()->syncWithoutDetaching($coordinate->id);

                    $symbol->chart->load([
                        'chartEdition' => function($query){
                            $query->leftJoin(DB::raw('
                                (
                                    select chart_id, max(created_at) max_created_at
                                    from chart_edition
                                    group by chart_id
                                ) che
                            '), function($join){
                                $join->on('chart_edition.chart_id', '=', 'che.chart_id');
                                $join->on('chart_edition.created_at', '=', 'che.max_created_at');
                            })
                            ->select('chart_edition.*')
                            ->whereNotNull('che.chart_id');
                        }
                    ]);
        
                    if($symbol->chart)
                    {
                        $chartEditionId = $symbol->chart->pluck('chartEdition')->collapse()->pluck('id');
                        if ($chartEditionId) $novelty->chartEdition()->syncWithoutDetaching($chartEditionId);
                    }

                    $novelty->symbol_id = $symbol->id;
                }else if($parent->symbol)
                {
                    return $this->errorResponse('Debe seleccionar la ayuda o peligro asociado a la novedad a cancelar', 409);
                }

                $novelty->parent->state = 'A';
                $novelty->parent->save();

                $novelty->parent_id = $parent->id;
                $parent->state = 'C';

                $parent->save();
            }else if($novelty->parent && ($novelty->parent->id === $parent->id ))
            {
                if($symbol)
                {
                    if($parent->symbol && ($symbol->id !== $parent->symbol->id))
                    {
                        return $this->errorResponse('La ayuda o peligro seleccionado no corresponde con la ayuda o peligro asociado a la novedad a cancelar', 409);
                    }

                    $coordinate = $symbol->coordinate()->orderBy('created_at', 'desc')->first();

                    if($coordinate) $novelty->coordinate()->syncWithoutDetaching($coordinate->id);

                    $symbol->chart->load([
                        'chartEdition' => function($query){
                            $query->leftJoin(DB::raw('
                                (
                                    select chart_id, max(created_at) max_created_at
                                    from chart_edition
                                    group by chart_id
                                ) che
                            '), function($join){
                                $join->on('chart_edition.chart_id', '=', 'che.chart_id');
                                $join->on('chart_edition.created_at', '=', 'che.max_created_at');
                            })
                            ->select('chart_edition.*')
                            ->whereNotNull('che.chart_id');
                        }
                    ]);
        
                    if($symbol->chart)
                    {
                        $chartEditionId = $symbol->chart->pluck('chartEdition')->collapse()->pluck('id');
                        if ($chartEditionId) $novelty->chartEdition()->syncWithoutDetaching($chartEditionId);
                    }

                    $novelty->symbol_id = $symbol->id;
                }else if($parent->symbol)
                {
                    return $this->errorResponse('Debe seleccionar la ayuda o peligro asociado a la novedad a cancelar', 409);
                }

            }else if(!$novelty->parent && $symbol)
            {
                if($parent->symbol && ($symbol->id !== $parent->symbol->id))
                {
                    return $this->errorResponse('La ayuda o peligro seleccionado no corresponde con la ayuda o peligro asociado a la novedad a cancelar', 409);
                }

                $coordinate = $symbol->coordinate()->orderBy('created_at', 'desc')->first();

                if($coordinate) $novelty->coordinate()->syncWithoutDetaching($coordinate->id);

                $symbol->chart->load([
                    'chartEdition' => function($query){
                        $query->leftJoin(DB::raw('
                            (
                                select chart_id, max(created_at) max_created_at
                                from chart_edition
                                group by chart_id
                            ) che
                        '), function($join){
                            $join->on('chart_edition.chart_id', '=', 'che.chart_id');
                            $join->on('chart_edition.created_at', '=', 'che.max_created_at');
                        })
                        ->select('chart_edition.*')
                        ->whereNotNull('che.chart_id');
                    }
                ]);
    
                if($symbol->chart)
                {
                    $chartEditionId = $symbol->chart->pluck('chartEdition')->collapse()->pluck('id');
                    if ($chartEditionId) $novelty->chartEdition()->syncWithoutDetaching($chartEditionId);
                }

                $novelty->symbol_id = $symbol->id;
                $novelty->parent_id = $parent->id;
                
                $parent->state = 'C';
                $parent->save();
            }else if(!$symbol && $parent->symbol)
            {
                return $this->errorResponse('Debe seleccionar la ayuda o peligro asociado a la novedad a cancelar', 409);
            }
            
        }else if($novelty->parent)
        {
            $novelty->parent->state = 'A';
            $novelty->parent->save();

            $novelty->parent_id = null;
        }
        
        if($symbol && !$parent)
        {
            if($novelty->state === 'C')
            {
                $noveltyNext = Novelty::where('parent_id', $novelty->id)->first();

                $noveltyNextNumItem = $noveltyNext->num_item;
                $noveltyNextNoticeNumber = $noveltyNext->notice->number;
                if(!$noveltyNext->symbol)
                {
                    return $this->errorResponse("Debe primero especificar la ayuda o peligro en la novedad #$noveltyNextNumItem del aviso No $noveltyNextNoticeNumber", 409);
                }else if($noveltyNext->symbol->id !== $symbol->id)
                {
                    $noveltyNextSymbolName = $noveltyNext->symbol->symbolLang()->first()->name;
                    return $this->errorResponse("Debe seleccionar la ayuda o peligro de nombre $noveltyNextSymbolName, ya que es la que se encuentra en la novedad #$noveltyNextNumItem del aviso No $noveltyNextNoticeNumber", 409);
                }
            }

            $noveltyTemp = Novelty::where('state', 'A')
                                  ->where('symbol_id', $symbol->id)
                                  ->whereHas('characterType', function($query){
                                        $query->where('alias', 'T');
                                  })
                                  ->first();

            if($noveltyTemp && ($noveltyTemp->id !== $novelty->id))
            {
                $noticeNumber = $noveltyTemp->notice->number;
                $noveltyNum = $noveltyTemp->num_item;
                
                return $this->errorResponse("La ayuda o peligro se encuentra pendiente por cancelar en la novedad #$noveltyNum del aviso $noticeNumber", 409);
            }

            $symbol->chart->load([
                'chartEdition' => function($query){
                    $query->leftJoin(DB::raw('
                        (
                            select chart_id, max(created_at) max_created_at
                            from chart_edition
                            group by chart_id
                        ) che
                    '), function($join){
                        $join->on('chart_edition.chart_id', '=', 'che.chart_id');
                        $join->on('chart_edition.created_at', '=', 'che.max_created_at');
                    })
                    ->select('chart_edition.*')
                    ->whereNotNull('che.chart_id');
                }
            ]);

            if($novelty->symbol && ($symbol->id !== $novelty->symbol->id))
            {
                $novelty->coordinate()->detach();
                $novelty->chartEdition()->detach();
            }

            if($symbol->chart)
            {
                $chartEditionId = $symbol->chart->pluck('chartEdition')->collapse()->pluck('id');
                if ($chartEditionId) $novelty->chartEdition()->syncWithoutDetaching($chartEditionId);
            }

            $coordinate = $symbol->coordinate()->orderBy('created_at', 'desc')->first();

            if($coordinate) $novelty->coordinate()->syncWithoutDetaching($coordinate->id);

            $novelty->symbol_id = $symbol->id;
        }

        if(!$symbol && !$parent)
        {
            if($novelty->symbol)
            {
                $novelty->coordinate()->detach();
                $novelty->chartEdition()->detach();
                $novelty->symbol_id = null;
            }

            if($novelty->parent)
            {
                $novelty->parent_id = null;
                $novelty->parent->state = 'A';
                $novelty->parent->save();
            }
        }
        
        if($novelty->isClean()){
            return $this->errorResponse('Debe especificar por lo menos un valor diferente para actualizar', 409);
        }
        
        $novelty->save();
        
        $this->generateNoveltySequence($notice->id);

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
        $novelty = $notice->novelty()->findOrFail($noveltyId);

        $noveltyNext = Novelty::where('parent_id', $novelty->id)->first();

        if($noveltyNext)
        {
            $noveltyNextNumItem = $noveltyNext->num_item;
            $noveltyNextNoticeNumber = $noveltyNext->notice->number;

            return $this->errorResponse("Debe primero eliminar la novedad #$noveltyNextNumItem del aviso No $noveltyNextNoticeNumber", 409);
        }

        if($novelty->parent)
        {
            $novelty->parent->state = 'A';
            $novelty->parent->save();
        }

        $novelty->delete();

        $this->generateNoveltySequence($notice->id);

        return new NoveltyResource($novelty);
    }

    private function generateNoveltySequence($noticeId)
    {
        //Generamos la variable row en mysql iniciando en 0
        DB::statement('SET @row := 0');

        //actualizamos el num_item en base a la variable row + 1
        DB::table('novelty')
            ->where('notice_id', $noticeId)
            ->orderBy('created_at', 'asc')
            ->update(['num_item' => DB::raw('(@row := @row + 1)')]);
    }
}