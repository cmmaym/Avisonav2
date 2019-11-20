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

        * {
            /* box-sizing: border-box; */
        }

        .general-border{
            border: 1pt solid #000;
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
        .keep-together {
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
                font-weight: 700;
                display: flex;
                flex-direction: column;
            }
                .header__title1{
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
                    align-items: center;
                    text-align: center;
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

        .notice{
            margin-top: 20pt;
            font-size: 13.5pt;
        }
            .notice__content-row-element{
                display: flex;
            }
            .notice__content-row1,
            .notice__content-row2{
                display: flex;
            }
                .notice__content-row1 > div:first-child{
                    flex: 1 0 auto;
                }
                .notice__content-row1 > div:last-child{
                    flex: 3 0 auto;
                }

                .notice__content-row2 > div{
                    flex: 1 0 20%;
                }
            .notice__content-row4 > div > div{
                padding: 5pt;
            }
            .notice__content-row4__item{
                display: flex;
                align-items: center;
            }
                .notice__content-row4__item:first-child{
                    margin-bottom: 10pt;
                }
                .notice__content-row4 > div > div:last-child{
                    flex: 1 0 auto;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            .notice__content-row4__label{
                flex: 0 0 20%;
                text-align: center;
            }
        
        .novelty{
            margin-top: 20pt;
            font-size: 13.5pt;
        }
            .novelty__item{
                padding: 20pt 0 20pt 0;
                border-bottom: 2pt dashed #000;
            }
            .novelty > div:first-of-type + div{
                padding-top: 0;
            }
            .novelty > div:first-of-type ~ div:last-of-type{
                padding-bottom: 0;
                border: none;
            }
            .novelty__item-content{
                display: flex;
            }
            .novelty__item-row1,
            .novelty__item-row2,
            .novelty__item-row3,
            .novelty__item-row4{
                display: flex;
            }
            .novelty__item-row1 > div:first-child{
                flex: 0 0 30%;
            }
            .novelty__item-row1 > div:last-child{
                flex: 0 0 70%;
            }
            .novelty__item-row2 > div{
                flex: 0 0 33%;
            }
            .novelty__item-row3 > div:first-child{
                flex: 0 0 60%;
            }
            .novelty__item-row3 > div:last-child{
                flex: 0 0 40%;
            }
            .novelty__item-row4 > div:first-child{
                flex: 0 0 30%;
            }
            .novelty__item-row4 > div{
                flex: 0 0 23.3333%;
            }
            .novelty__item-row4__label1{
                text-align: center;
                flex: 0 0 50%;
                box-sizing: border-box;
            }
            .novelty__item-row4__label2{
                text-align: center;
                flex: 0 0 65%;
                box-sizing: border-box;
            }
            .novelty__item-row4__label3{
                text-align: center;
                flex: 0 0 25%;
            }
            .novelty__item-row4__label4{
                text-align: center;
                flex: 0 0 30%;
            }
    </style>
</head>
<body>
    <div class="header general-border">
        <div class="header__logo-dimar border-right">
            <img src="{{ resource_path('assets/img/dimar-logo.png') }}"/>
        </div>
        <div class="header__title">
            <div class="header__title1 border-bottom">
                FORMATO REVISIÓN PARA EDICIÓN Y DISTRIBUCIÓN DE AVISOS A LOS NAVEGANTES
            </div>
            <div class="header__title2">
                Subproceso: GESTIÓN DE LA INFORMACIÓN CARTOGRÁFICA, OCEANOGRÁFICA Y METEOROLÓGICA
            </div>
        </div>
        <div class="header__version border-left">
            <div class="header__version-cod border-bottom">
                <span>Código: &nbsp;</span>
                <span> M10-03-FOR-019</span>
            </div>
            <div class="header__version-number">
                <span>Versión: &nbsp;</span>
                <span> 3</span>
            </div>
        </div>
    </div>
    <div class="notice general-border">
        <div class="general-title">I. INFORMACIÓN AVISO A LOS NAVEGANTES</div>
        <div class="notice__content">
            <div class="notice__content-row1 border-bottom">
                <div class="notice__content-row-element">
                    <span class="label-title">Numero:</span>
                    <span class="element-text">200</span>
                </div>
                <div class="notice__content-row-element">
                    <span class="label-title">Ubicación:</span>
                    <span class="element-text">Cartagena - Mar Caribe Colombiano</span>
                </div>
            </div>
            <div class="notice__content-row2 border-bottom">
                <div class="notice__content-row-element">
                    <span class="label-title">Fuente de origen: </span>
                    <span class="element-text">SEMAC</span>
                </div>
                <div class="notice__content-row-element">
                    <span class="label-title">Fecha: </span>
                    <span class="element-text">9/10/2019</span>
                </div>
            </div>
            <div class="notice__content-row2 border-bottom">
                <div class="notice__content-row-element">
                    <span class="label-title">Reportado por: </span>
                    <span class="element-text">Diego Garcia</span>
                </div>
                <div class="notice__content-row-element">
                    <span class="label-title">No. Reportes: </span>
                    <span class="element-text">1,2,3</span>
                </div>
            </div>
            <div class="notice__content-row4">
                <div class="notice__content-row-element">
                    <span class="notice__content-row4__label label-title">Verificación de posiciones geográficas: </span>
                    <div class="border-right">
                        <div class="notice__content-row4__item">
                            <input type="checkbox" class="checkbox-size" checked/>
                            Lista de ayudas de la Republica de Colombia
                        </div>
                        <div class="notice__content-row4__item">
                            <input type="checkbox" class="checkbox-size"/>
                            Carta Nautica - Archivo Digital
                        </div>
                    </div>
                    <div>
                        202, 203, 204
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="novelty general-border">
        <div class="general-title">II. NOVEDADES REPORTADAS</div>
        <div class="novelty__item keep-together">
            <div class="novelty__item-row1 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Novedad:</span>
                    <span class="element-text">No. 1</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Estado:</span>
                    <span class="element-text">---------------</span>
                </div>
            </div>
            <div class="novelty__item-row2 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Nombre:</span>
                    <span class="element-text">Boya 33</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Tipo de novedad:</span>
                    <span class="element-text">Trasladar</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Carácter:</span>
                    <span class="element-text">Temporal</span>
                </div>
            </div>
            <div class="novelty__item-row3 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Posición (WGS-84):</span>
                    <div class="element-group">
                        <p>10°57.5600’ N, 74°45.3400’ W</p>
                    </div>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Cartas Náuticas afectadas:</span>
                    <div class="element-group">
                        <p>253 / 6 ed. 2016</p>
                    </div>
                </div>
            </div>
            <div class="novelty__item-row4">
                <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label1">Características de la luz:</span>
                    <span class="element-text">FI GBY 3.00s</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label2">Altitud (m) / Cobertura (mn):</span>
                    <div class="element-group">
                        <p>4m</p>
                        <p>6mn</p>
                    </div>
                </div>
                 <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label3">Color / Forma:</span>
                    <div class="element-group">
                        <p>Verde</p>
                        <p>Boya pilar</p>
                    </div>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label4">Marca de tope:</span>
                    <span class="element-text">Cilindro verde</span>
                </div>
            </div>
        </div>
        <div class="novelty__item keep-together">
            <div class="novelty__item-row1 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Novedad:</span>
                    <span class="element-text">No. 2</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Estado:</span>
                    <span class="element-text">Cancela novedad No. 1 del aviso 210 del año 2019</span>
                </div>
            </div>
            <div class="novelty__item-row2 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Nombre:</span>
                    <span class="element-text">Boya 33</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Tipo de novedad:</span>
                    <span class="element-text">Trasladar</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Carácter:</span>
                    <span class="element-text">Temporal</span>
                </div>
            </div>
            <div class="novelty__item-row3 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Posición (WGS-84):</span>
                    <div class="element-group">
                        <p>10°57.5600’ N, 74°45.3400’ W</p>
                    </div>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Cartas Náuticas afectadas:</span>
                    <div class="element-group">
                        <p>253 / 6 ed. 2016</p>
                    </div>
                </div>
            </div>
            <div class="novelty__item-row4">
                <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label1">Características de la luz:</span>
                    <span class="element-text">FI GBY 3.00s</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label2">Altitud (m) / Cobertura (mn):</span>
                    <div class="element-group">
                        <p>4m</p>
                        <p>6mn</p>
                    </div>
                </div>
                 <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label3">Color / Forma:</span>
                    <div class="element-group">
                        <p>Verde</p>
                        <p>Boya pilar</p>
                    </div>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title novelty__item-row4__label4">Marca de tope:</span>
                    <span class="element-text">Cilindro verde</span>
                </div>
            </div>
        </div>
        <div class="novelty__item keep-together">
            <div class="novelty__item-row1 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Novedad:</span>
                    <span class="element-text">No. 3</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Estado:</span>
                    <span class="element-text">---------------</span>
                </div>
            </div>
            <div class="novelty__item-row2 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Nombre:</span>
                    <span class="element-text">Búsqueda y rescate</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Tipo de novedad:</span>
                    <span class="element-text">Búsqueda y rescate</span>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Carácter:</span>
                    <span class="element-text">General</span>
                </div>
            </div>
            <div class="novelty__item-row3 border-bottom">
                <div class="novelty__item-content">
                    <span class="label-title">Posición (WGS-84):</span>
                    <div class="element-group">
                        <p>10°57.5600’ N, 74°45.3400’ W</p>
                        <p>10°57.5600’ N, 74°45.3400’ W</p>
                        <p>10°57.5600’ N, 74°45.3400’ W</p>
                        <p>10°57.5600’ N, 74°45.3400’ W</p>
                    </div>
                </div>
                <div class="novelty__item-content">
                    <span class="label-title">Cartas Náuticas afectadas:</span>
                    <div class="element-group">
                        <p>206 / 6 ed. 2016</p>
                        <p>206 / 6 ed. 2016</p>
                        <p>206 / 6 ed. 2016</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>