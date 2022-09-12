<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        html, body {
            background-color: #fff;
            color: #000;
            font-family: Arial;
            font-weight: 400;
            margin: 0;
        }

        .display-flex{
            display: flex;
        }

        .justify-content-center{
            justify-content: center;
        }

        .general-border{
            border: 1pt solid #000;
        }

        .border-top{
            border-top: 1pt solid #000;
        }

        .border-bottom{
            border-bottom: 1pt solid #000;
        }

        .border-left{
            border-left: 1pt solid #000;
        }

        .border-right{
            border-right: 1pt solid #000;
        }

        .font-bold{
            font-weight: bold;
        }

        .general-title{
            background-color: #0070C0;
            color: white;
            text-align: center;
        }

        .label-title{
            background-color: #dee2e6;
            padding: 5pt;
            display: flex;
            align-items: center;
            flex: 0 0 auto;
        }

        .element-text{
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .checkbox-size{
            -webkit-transform: scale(1.3);
        }

        .element-group{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
            .element-group > p{
                margin: 0;
            }

        /* Page Breaks */
        /*Que un determinado contenido de un contenedor no se distribuya en dos páginas (si cabe en una página). 
        Cuando se utiliza la clase keep-together, se crea un salto de página antes del contenedor si es necesario.*/
        .keep-together{
            page-break-inside: avoid;
        }

        .header{
            height: 112.5pt;
            display: flex;
        }

            .header__logo-dimar{
                width: 35%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
                .header__logo-dimar > img{
                    width: 100%;
                }

            .header__title{
                display: flex;
                flex-direction: column;
            }
                .header__title1{
                    font-weight: 700;
                    font-size: 12.5pt;
                    flex: 1;
                    display: fleX;
                    align-items: center;
                    text-align: center;
                }
                .header__title2{
                    font-size: 11pt;
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    padding-left: 5pt;
                }

            .header__version{
                width: 35%;
                display: flex;
                flex-direction: column;
            }
                .header__version > div{
                    flex: 1;
                    display: flex;
                    align-items: center;
                    padding-left: 3.75pt;
                 }
                 .header__version > div > span:first-of-type{
                    font-weight: 700;
                 }
        
        .info-notice{
            margin-top: 10pt;
        }
            .info-notice__row1 > div:first-child{
                flex: 0 0 30%;
            }
            .info-notice__row1 > div:last-child{
                flex: 0 0 70%;
            }
            .info-notice__row2 > span{
                flex: 0 0 20%;
                text-align: center;
            }
            .info-notice__row2 > div {
                display: flex;
                flex-direction: column;
                width: 100%;
            }
                .info-notice__row2 > div > div{
                    flex: 1 0 auto;
                }
                .info-notice__row2 > div > div:first-child{
                    padding: 5pt 0 5pt 5pt;
                }
                .info-notice__row2 > div > div:last-child > div:first-child{
                    padding: 5pt 0 5pt 5pt;
                    box-sizing: border-box;
                }
                .info-notice__row2 > div > div:last-child > div{
                    flex: 0 0 50%;
                }
                .info-notice__row2 > div > div:last-child > div:last-child{
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                }
            .info-notice__row3 > div,
            .info-notice__row4 > div,
            .info-notice__row5 > div,
            .info-notice__row6 > div,
            .info-notice__row7 > div,
            .info-notice__row8 > div,
            .info-notice__row9 > div,
            .info-notice__row10 > div{
                flex: 0 0 50%;
            }

            .info-notice__row5 > div{
                height: 50pt;
                overflow: hidden;
                text-align: center;
            }

            .info-notice__row5 > div > img{
                max-width: 400pt;
                max-height: 50pt;
            }
                .info-notice__row9 > div > span{
                    flex: 0 0 50%;
                    text-align: center;
                    justify-content: center;
                }
                .info-notice__row9 > div > div,
                .info-notice__row10 > div > div{
                    flex: 0 0 50%;
                    justify-content: space-around;
                    align-items: center;
                }
            .info-notice__row11 > div{
                height: 100pt;
            }
                .info-notice__row11 > div > span:last-child{
                    text-align: justify;
                    padding: 10pt;
                }
            
            .firmas{
            }

            .firmas__row1{
                display: flex;
                width: 100%;
                justify-content: center;
                margin-top: 90pt;
            }

            .firmas__row1 > div {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
                .firmas__row1 > div > div + div {
                    width: 300px;
                    height: 0.5pt;
                    background: #000;
                }

                .firmas__row1 img {
                    height: 70pt;
                    max-width: 100%;
                }

            /*.firmas__row2{
                display: flex;
                width: 100%;
                justify-content: center;
                margin-top: 100pt;
            }*/
                /*.firmas__row1 > div,
                .firmas__row2 > div{
                    flex: 0 0 50%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    height: 100pt;
                }*/
             /*       .firmas__row1 > div > div + div,
                    .firmas__row2 > div > div + div{
                        width: 150%;
                        height: 0.5pt;
                        background: #000;
                    }

            .firmas__row1 img,
            .firmas__row2 img {
                height: 70pt;
                max-width: 100%;
            }*/

        .novelty{
            margin-top: 10pt;
        }
            .novelty__row1{
                display: flex;
                background-color: #dee2e6;
            }
            .novelty__row1 > div,
            .novelty__row2 > div{
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .novelty__row2{
                border-bottom: 1pt solid #000;
            }
                .novelty__row2:last-child{
                    border: 0;
                }
                .novelty__row2 > div{
                    text-align: center;
                    word-wrap: break-word;
                }
                .novelty__number{
                    flex: 0 0 3.5%;
                }
                .novelty__caracter{
                    flex: 0 0 7%;
                }

                .novelty__tnovedad{
                    flex: 0 0 10%;
                }

                .novelty__nombre,
                .novelty__position,
                .novelty__alt-scope,
                .novelty__color-form{
                    flex: 0 0 10%;
                    display: flex;
                    flex-direction: column;
                }
                    .novelty__position > p,
                    .novelty__color-form > p{
                        margin: 5pt 0 5pt 0;
                        font-size: 11pt;
                    }
                .novelty__feature,
                .novelty__alt-scope{
                    flex: 0 0 12%;
                }
                .novelty__color-form{
                    flex: 0 0 13%;
                }
                .novelty__topmark{
                    flex: 0 0 11%;
                }
                .novelty__state{
                    flex: 0 0 10%;
                }
        .notice-description{
            margin-top: 10pt;
        }
            .notice-description__row1{
                background-color: #dee2e6;
            }
                .notice-description__row1 > div:first-child,
                .notice-description__row2 > div:first-child{
                    flex: 0 0 60%;
                    text-align: justify;
                    padding: 5pt;
                }
                .notice-description__row1 > div:last-child,
                .notice-description__row2 > div:last-child{
                    flex: 0 0 40%;
                    text-align: center;
                }
                .notice-description__row2-chart{
                    display: flex;
                    padding: 5pt 5pt 5pt 0;
                }
                    .notice-description__row2-chart > div:first-child{
                        flex: 0 0 30%;
                        padding-left: 3pt;
                    }
                    .notice-description__row2-chart > div:last-child{
                        flex: 0 0 70%;
                        text-align: initial;
                        word-wrap: break-word;
                    }
                .notice-description__row2-c{
                    display: flex;
                    justify-content: space-between;
                    padding: 5pt 5pt 5pt 0;
                }
                    .notice-description__row2-c > div:first-child{
                        flex: 0 0 70%;
                        text-align: initial;
                        padding-left: 3pt;
                    }
                    .notice-description__row2-c > div:last-child{
                        flex: 0 0 30%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
    </style>
</head>
<body>
    <!-- Pagina 1 -->
    <div class="header general-border">
        <div class="header__logo-dimar border-right">
            <img src="{{ resource_path('assets/img/escudo-dimar.png') }}"/>
        </div>
        <div class="header__title">
            <div class="header__title1 border-bottom">
                FORMATO REVISIÓN PARA EDICIÓN Y DISTRIBUCIÓN DE AVISOS A LOS NAVEGANTES
            </div>
            <div class="header__title2">
                <div>
                    <span class="font-bold">Proceso: </span>GESTIÓN DE LA INFORMACIÓN HIDROGRÁFICA
                </div>
                <div>
                    <span class="font-bold">Código: </span>M14-00-FOR-019
                </div>
                <div>
                    <span class="font-bold">Versión: </span>05
                </div>
            </div>
        </div>
    </div>
    <div class="info-notice general-border">
        <div class="info-notice__title general-title">
            I. INFORMACIÓN AVISO A LOS NAVEGANTES
        </div>
        <div class="info-notice__row1 display-flex border-bottom">
            <div class="display-flex">
                <span class="label-title">Aviso No.:</span>
                <span class="element-text">{{ $notice->number }}</span>
            </div>
            <div class="display-flex">
                <span class="label-title">Ubicación:</span>
                <span class="element-text">{{ $notice->location->name }} - {{ $notice->location->zone->zoneLang->name }}</span>
            </div>
        </div>
        <div class="info-notice__row2 display-flex border-bottom">
            <span class="label-title">Revisión del origen de la información:</span>
            <div>
                <div class="border-bottom">
                    <input type="checkbox" class="checkbox-size" {{ $notice->sourceReviewAidList ? 'checked' : null }}/>
                    Lista de ayudas de la Republica de Colombia
                </div>
                <div class="display-flex">
                    <div class="border-right">
                        <input type="checkbox" class="checkbox-size" {{ $notice->sourceReviewChart ? 'checked' : null }}/>
                        Carta Nautica - Archivo Digital
                    </div>
                    <div>
                        @foreach($notice->charts as $item)
                            @if(!$loop->last)
                                <span>{{ $item ?? null }},</span>
                            @elseif($loop->count == 1 || $loop->last)
                                <span>{{ $item ?? null }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="info-notice__title general-title">
            II. INFORMACIÓN REPORTE DE NOVEDADES
        </div>
        <div class="info-notice__row3 display-flex border-bottom">
            <div class="display-flex">
                <span class="label-title">Fuente de origen:</span>
                <span class="element-text">{{ $notice->reportSource->name }}</span>
            </div>
            <div class="display-flex">
                <span class="label-title">Reportado por:</span>
                <span class="element-text">{{ $notice->reportingUser->name }}</span>
            </div>
        </div>
        <div class="info-notice__row4 display-flex">
            <div class="display-flex">
                <span class="label-title">Fecha:</span>
                <span class="element-text">{{ $notice->report_date->format('d/m/Y') }}</span>
            </div>
            <div class="display-flex">
                <span class="label-title">Reporte No:</span>
                <span class="element-text">{{ $notice->reports_numbers }}</span>
            </div>
        </div>
        <div class="info-notice__title general-title">
            III. VERIFICACIÓN DE NOVEDADES
        </div>
        <div class="info-notice__row5 display-flex border-bottom">
            @php
                $firmaEditor = $notice->user->firm_path ? storage_path('app/public/'.$notice->user->firm_path) : null;
                $firmaRevisor = $notice->reviewUser->firm_path ? storage_path('app/public/'.$notice->reviewUser->firm_path) : null;
            @endphp
            <div class="border-right"><img src="{{ $firmaEditor }}"/></div>
            <div><img src="{{ $firmaRevisor }}"/></div>
        </div>
        <div class="info-notice__row6 display-flex border-bottom">
            <div class="border-right">
                <span class="label-title justify-content-center">Firma del Editor</span>
            </div>
            <div>
                <span class="label-title justify-content-center">Firma del Revisor</span>
            </div>
        </div>
        <div class="info-notice__row7 display-flex border-bottom">
            <div class="display-flex border-right">
                <span class="label-title">Nombre del Editor:</span>
                <span class="element-text">{{ $notice->user->name1 ?? null }} {{ $notice->user->name2 ?? null }} {{ $notice->user->last_name1 ?? null }} {{ $notice->user->last_name2 ?? null }}</span>
            </div>
            <div class="display-flex">
                <span class="label-title">Nombre del Revisor:</span>
                <span class="element-text">{{ $notice->reviewUser->name1 ?? null }} {{ $notice->reviewUser->name2 ?? null }} {{ $notice->reviewUser->last_name1 ?? null }} {{ $notice->reviewUser->last_name2 ?? null }}</span>
            </div>
        </div>
        <div class="info-notice__row8 display-flex border-bottom">
            <div class="display-flex border-right">
                <span class="label-title">Fecha de edición:</span>
                <span class="element-text">{{ $notice->created_at->format('d/m/Y') ?? null }}</span>
            </div>
            <div class="display-flex">
                <span class="label-title">Fecha de Revisión:</span>
                <span class="element-text">{{ $notice->review_date ? $notice->review_date->format('d/m/Y') : null }}</span>
            </div>
        </div>
        <div class="info-notice__row9 display-flex">
            <div class="display-flex border-right">
                <span class="label-title">Fecha publicación aviso en la página web: www.cioh.org.co</span>
                <span class="element-text">{{ $notice->created_at->format('d/m/Y') ?? null }}</span>
            </div>
            <div class="display-flex">
                <span class="label-title">Confirmado en la web:</span>
                <div class="display-flex">
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->hasWebChecking == 'Y' ? 'checked' : null }}/>SI
                    </div>
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->hasWebChecking == 'N' ? 'checked' : null }}/>NO
                    </div>
                </div>
            </div>
        </div>
        <div class="info-notice__title general-title">
            IV. DIVULGACIÓN
        </div>
        <div class="info-notice__row10 display-flex border-bottom">
            <div class="display-flex border-right">
                <span class="label-title">Fecha envío e-mail:</span>
                <span class="element-text">{{ $notice->dateEmailSent->format('d/m/Y') }}</span>
            </div>
            <div class="display-flex">
                <span class="label-title">Gremio Marítimo:</span>
                <div class="display-flex">
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->sentTo == 'C' || $notice->sentTo == 'A' ? 'checked' : null }}/>Caribe
                    </div>
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->sentTo == 'P' || $notice->sentTo == 'A' ? 'checked' : null }}/>Pacifico
                    </div>
                </div>
            </div>
        </div>
        <div class="info-notice__row11 display-flex">
            <div class="display-flex">
                <span class="label-title">Observaciones:</span>
                <span class="element-text">
                    {!! nl2br(e($notice->observation ?? '')) ?? null !!}
                </span>
            </div>
        </div>
    </div>
    <div class="firmas">
        @php
            //$firmaPerson1 = $firmas->firm_person1 ? storage_path('app/public/'.$firmas->firm_person1) : null;
            $firmaPerson2 = $firmas->firm_person2 ? storage_path('app/public/'.$firmas->firm_person2) : null;
            //$firmaPerson3 = $rhUser->firm_path ? storage_path('app/public/'.$rhUser->firm_path) : null;
        @endphp
        <div class="firmas__row1">
            {{--<div>
                <div>
                    <img src="{{ $firmaPerson1 }}"/>
                </div>
                <div></div>
                <span>Responsable Avisos a los navegantes</span>
            </div>--}}
            <div>
                <div>
                    <img src="{{ $firmaPerson2 }}"/>
                </div>
                <div></div>
                <span>Responsable Área Náutica</span>
            </div>
        </div>
        {{--<div class="firmas__row2">
            <div>
                <div>
                    <img src="{{ $firmaPerson3 }}"/>
                </div>
                <div></div>
                <span>Responsable Sección de Hidrografia</span>
            </div>
        </div>--}}
    </div>
    <!-- Pagina 2 -->
    <div class="header general-border" style="page-break-before: always;">
        <div class="header__logo-dimar border-right">
            <img src="{{ resource_path('assets/img/escudo-dimar.png') }}"/>
        </div>
        <div class="header__title">
            <div class="header__title1 border-bottom">
                FORMATO REVISIÓN PARA EDICIÓN Y DISTRIBUCIÓN DE AVISOS A LOS NAVEGANTES
            </div>
            <div class="header__title2">
                <div>
                    <span class="font-bold">Proceso: </span>GESTIÓN DE LA INFORMACIÓN HIDROGRÁFICA
                </div>
                <div>
                    <span class="font-bold">Código: </span>M14-00-FOR-019
                </div>
                <div>
                    <span class="font-bold">Versión: </span>05
                </div>
            </div>
        </div>
    </div>
    <div class="novelty general-border">
        <div class="general-title">
            V. MODELO DE AVISO EN PÁGINA WEB
        </div>
        <div class="novelty__row1 border-bottom">
            <div class="novelty__number border-right">Item No.</div>
            <div class="novelty__caracter border-right">Carácter</div>
            <div class="novelty__nombre border-right">Nombre</div>
            <div class="novelty__tnovedad border-right">Tipo de novedad</div>
            <div class="novelty__position border-right">Posición (WGS-84)</div>
            <div class="novelty__feature border-right">Características de la luz</div>
            <div class="novelty__alt-scope border-right">Altitud (m) / Cobertura (mn)</div>
            <div class="novelty__color-form border-right">Color / Forma</div>
            <div class="novelty__topmark border-right">Marca de tope</div>
            <div class="novelty__state">Estado</div>
        </div>
        @foreach($notice->novelty_es as $novelty)
            <div class="novelty__row2 display-flex keep-together">
                <div class="novelty__number border-right">{{ $novelty->num_item ?? '--------------' }}</div>
                <div class="novelty__caracter border-right">{{ $novelty->characterType->alias ?? '--------------' }}</div>
                <div class="novelty__nombre border-right">{{ $novelty->noveltyLang->name ?? '--------------'}}</div>
                <div class="novelty__tnovedad border-right">{{ $novelty->noveltyType->noveltyTypeLang->name ?? '--------------' }}</div>
                <div class="novelty__position border-right">
                    @if(!is_null($novelty->spatial_data))
                        @foreach($novelty->spatial_data as $spatialItem)
                            @if($spatialItem instanceof Grimzy\LaravelMysqlSpatial\Types\Point)
                                <p>{{ dd2dmStringFormat([$spatialItem->getLng(), $spatialItem->getLat()])[1] }}, {{ dd2dmStringFormat([$spatialItem->getLng(), $spatialItem->getLat()])[0] }}</p>
                            @elseif($spatialItem instanceof Grimzy\LaravelMysqlSpatial\Types\Polygon)
                                @foreach($spatialItem as $item)
                                    @foreach($item as $data)
                                        <p>{{ dd2dmStringFormat([$data->getLng(), $data->getLat()])[1] }}, {{ dd2dmStringFormat([$data->getLng(), $data->getLat()])[0] }}</p>
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        <p>--------------</p>
                    @endif
                </div>
                <div class="novelty__feature border-right">
                    @if($novelty->symbol && $novelty->symbol->symbol->aid && $novelty->symbol->is_light_properties_visible)
                        @if($novelty->symbol->symbol && $novelty->symbol->symbol->is_legacy)
                            {{ $novelty->symbol->symbol->aid->legacy_destello }}
                        @else
                            {{ $novelty->symbol->symbol->aid->lightClass->alias ?? null }}
                            {{
                                ($novelty->symbol->symbol && $novelty->symbol->symbol->aid && $novelty->symbol->symbol->aid->period)
                                    ? $novelty->symbol->symbol->aid->period->flash_group == 1
                                        ? null
                                        : '('.$novelty->symbol->symbol->aid->period->flash_group.')'
                                    : null
                            }}
                            @if($novelty->symbol->symbol && $novelty->symbol->symbol->aid && count($novelty->symbol->symbol->aid->aidColorLight) > 0)
                                &nbsp;
                                @foreach($novelty->symbol->symbol->aid->aidColorLight as $item)
                                    <span>{{ $item->alias ?? null }}</span>
                                @endforeach
                                &nbsp;
                            @endif
                            {{
                                ($novelty->symbol->symbol && $novelty->symbol->symbol->aid && $novelty->symbol->symbol->aid->period)
                                    ? $novelty->symbol->symbol->aid->period->time.'s'
                                    : null
                            }}
                        @endif
                    @else
                        --------------
                    @endif
                </div>
                <div class="novelty__alt-scope border-right">
                    @if($novelty->symbol && $novelty->symbol->symbol->aid)
                        <span>{{ $novelty->symbol->symbol->aid->height->elevation ?? 0 }}m</span>
                        <span>{{ $novelty->symbol->symbol->aid->nominalScope->scope ?? 0 }}mn</span>
                    @else
                        --------------
                    @endif
                </div>
                <div class="novelty__color-form border-right">
                    @if($novelty->symbol && $novelty->symbol->symbol->aid)
                        <p>{{ $novelty->symbol->symbol->aid->colorStructurePattern->colorStructureLang->name ?? null }}</p>
                        <p>{{ $novelty->symbol->symbol->aid->aidTypeForm->aidTypeFormLang->description ?? null }}</p>
                    @else
                        --------------
                    @endif
                </div>
                <div class="novelty__topmark border-right">
                    {{ $novelty->symbol->symbol->aid->topMark->topMarkLang->description ?? '--------------' }}
                </div>
                <div class="novelty__state">
                    @if($novelty->parent)
                        Cancela novedad No. {{ $novelty->parent->num_item }} del aviso {{ $novelty->parent->notice->number }} del año {{ $novelty->parent->notice->year }}
                    @else
                        --------------
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="notice-description general-border keep-together">
        <div class="notice-description__row1 display-flex border-bottom">
            <div class="border-right">Descripción</div>
            <div>Publicaciones afectadas</div>
        </div>
        <div class="notice-description__row2 display-flex">
            <div class="border-right">
                {!! nl2br(e($notice->noticeLangs['es']->description ?? '')) ?? null !!}
            </div>
            <div>
                <div class="notice-description__row2-chart border-bottom">
                    <div>Cartas Nauticas:</div>
                    <div>
                        @foreach($notice->chart as $item)
                            @if(!$loop->last)
                                <span>{{ $item->number ?? null }},</span>
                            @elseif($loop->count == 1 || $loop->last)
                                <span>{{ $item->number ?? null }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="notice-description__row2-c border-bottom">
                    <div>
                        Catálogo de los Océanos y Costas de Colombia.
                        {{ $notice->catalogOceanCoast ? 'Edición '.$notice->catalogOceanCoast->edition.' de '.$notice->catalogOceanCoast->year : null }}
                    </div>
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->catalogOceanCoast ? 'checked' : null }}/>
                    </div>
                </div>
                <div class="notice-description__row2-c">
                    <div>
                        Lista de Luces República de Colombia Costa Caribe y Pacífica Colombianas.
                        {{ $notice->LightList ? 'Edición '.$notice->LightList->edition.' de '.$notice->LightList->year : null }}
                    </div>
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->LightList ? 'checked' : null }}/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagina 3 -->
    <div class="novelty general-border keep-together">
        <div class="general-title">
            VI. VIEW AVAILABLE ON THE WEB PAGE
        </div>
        <div class="novelty__row1 border-bottom">
            <div class="novelty__number border-right">Item No.</div>
            <div class="novelty__caracter border-right">Type</div>
            <div class="novelty__nombre border-right">Name</div>
            <div class="novelty__tnovedad border-right">Novelty Type</div>
            <div class="novelty__position border-right">Position (WGS-84)</div>
            <div class="novelty__feature border-right">Characteristics light</div>
            <div class="novelty__alt-scope border-right">Height (m) / Coverage (nm)</div>
            <div class="novelty__color-form border-right">Color / Shape</div>
            <div class="novelty__topmark border-right">Top Mark</div>
            <div class="novelty__state">State</div>
        </div>
        @foreach($notice->novelty_en as $novelty)
            <div class="novelty__row2 display-flex keep-together">
                <div class="novelty__number border-right">{{ $novelty->num_item ?? '--------------' }}</div>
                <div class="novelty__caracter border-right">{{ $novelty->characterType->alias ?? '--------------' }}</div>
                <div class="novelty__nombre border-right">{{ $novelty->noveltyLang->name ?? '--------------'}}</div>
                <div class="novelty__tnovedad border-right">{{ $novelty->noveltyType->noveltyTypeLang->name ?? '--------------' }}</div>
                <div class="novelty__position border-right">
                    @if(!is_null($novelty->spatial_data))
                        @foreach($novelty->spatial_data as $spatialItem)
                            @if($spatialItem instanceof Grimzy\LaravelMysqlSpatial\Types\Point)
                                <p>{{ dd2dmStringFormat([$spatialItem->getLng(), $spatialItem->getLat()])[1] }}, {{ dd2dmStringFormat([$spatialItem->getLng(), $spatialItem->getLat()])[0] }}</p>
                            @elseif($spatialItem instanceof Grimzy\LaravelMysqlSpatial\Types\Polygon)
                                @foreach($spatialItem as $item)
                                    @foreach($item as $data)
                                        <p>{{ dd2dmStringFormat([$data->getLng(), $data->getLat()])[1] }}, {{ dd2dmStringFormat([$data->getLng(), $data->getLat()])[0] }}</p>
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        <p>--------------</p>
                    @endif
                </div>
                <div class="novelty__feature border-right">
                    @if($novelty->symbol && $novelty->symbol->symbol->aid && $novelty->symbol->is_light_properties_visible)
                        @if($novelty->symbol->symbol && $novelty->symbol->symbol->is_legacy)
                            {{ $novelty->symbol->symbol->aid->legacy_destello }}
                        @else
                            {{ $novelty->symbol->symbol->aid->lightClass->alias ?? null }}
                            {{
                                ($novelty->symbol->symbol && $novelty->symbol->symbol->aid && $novelty->symbol->symbol->aid->period)
                                    ? $novelty->symbol->symbol->aid->period->flash_group == 1
                                        ? null
                                        : '('.$novelty->symbol->symbol->aid->period->flash_group.')'
                                    : null
                            }}
                            @if($novelty->symbol->symbol && $novelty->symbol->symbol->aid && count($novelty->symbol->symbol->aid->aidColorLight) > 0)
                                &nbsp;
                                @foreach($novelty->symbol->symbol->aid->aidColorLight as $item)
                                    <span>{{ $item->alias ?? null }}</span>
                                @endforeach
                                &nbsp;
                            @endif
                            {{
                                ($novelty->symbol->symbol && $novelty->symbol->symbol->aid && $novelty->symbol->symbol->aid->period)
                                    ? $novelty->symbol->symbol->aid->period->time.'s'
                                    : null
                            }}
                        @endif
                    @else
                        --------------
                    @endif
                </div>
                <div class="novelty__alt-scope border-right">
                    @if($novelty->symbol && $novelty->symbol->symbol->aid)
                        <span>{{ $novelty->symbol->symbol->aid->height->elevation ?? 0 }}m</span>
                        <span>{{ $novelty->symbol->symbol->aid->nominalScope->scope ?? 0 }}mn</span>
                    @else
                        --------------
                    @endif
                </div>
                <div class="novelty__color-form border-right">
                    @if($novelty->symbol && $novelty->symbol->symbol->aid)
                        <p>{{ $novelty->symbol->symbol->aid->colorStructurePattern->colorStructureLang->name ?? null }}</p>
                        <p>{{ $novelty->symbol->symbol->aid->aidTypeForm->aidTypeFormLang->description ?? null }}</p>
                    @else
                        --------------
                    @endif
                </div>
                <div class="novelty__topmark border-right">
                    {{ $novelty->symbol->symbol->aid->topMark->topMarkLang->description ?? '--------------' }}
                </div>
                <div class="novelty__state">
                    @if($novelty->parent)
                        Cancels novelty No. {{ $novelty->parent->num_item }} of notice {{ $novelty->parent->notice->number }} of the year {{ $novelty->parent->notice->year }}
                    @else
                        --------------
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="notice-description general-border keep-together">
        <div class="notice-description__row1 display-flex border-bottom">
            <div class="border-right">Description</div>
            <div>Publicaciones afectadas</div>
        </div>
        <div class="notice-description__row2 display-flex">
            <div class="border-right">
                {!! nl2br(e($notice->noticeLangs['en']->description ?? '')) ?? null !!}
            </div>
            <div>
                <div class="notice-description__row2-chart border-bottom">
                    <div>Nautical charts:</div>
                    <div>
                        @foreach($notice->chart as $item)
                            @if(!$loop->last)
                                <span>{{ $item->number ?? null }},</span>
                            @elseif($loop->count == 1 || $loop->last)
                                <span>{{ $item->number ?? null }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="notice-description__row2-c border-bottom">
                    <div>
                        Catalog of Oceans and Coasts of Colombia.
                        {{ $notice->catalogOceanCoast ? 'Edition '.$notice->catalogOceanCoast->edition.' of '.$notice->catalogOceanCoast->year : null }}
                    </div>
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->catalogOceanCoast ? 'checked' : null }}/>
                    </div>
                </div>
                <div class="notice-description__row2-c">
                    <div>
                        List of Lights Republic of Colombia Caribbean Coast and Pacific Colombian.
                        {{ $notice->LightList ? 'Edition '.$notice->LightList->edition.' of '.$notice->LightList->year : null }}
                    </div>
                    <div>
                        <input type="checkbox" class="checkbox-size" {{ $notice->LightList ? 'checked' : null }}/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>