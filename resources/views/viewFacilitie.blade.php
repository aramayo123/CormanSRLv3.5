@php

    use Carbon\Carbon;
    $fecha = Carbon::parse(Carbon::now());
    $date = $fecha->locale(); //con esto revise que el lenguaje fuera es

@endphp


<section class="bg-gray-50 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="mx-auto mb-5 p-5">
                    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between items-start w-full">
                            <div class="flex-col items-center">
                                <div class="flex items-center mb-1">
                                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">
                                        Remedys realizados en {{ $fecha->monthName }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Line Chart -->
                        <div class="py-6" id="pie-chart"></div>
                    </div>
                </div>

                <div class="mx-auto mb-5 p-5">
                    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between items-start w-full">
                            <div class="flex-col items-center">
                                <div class="flex items-center mb-1">
                                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Nivel
                                        de emergencia en {{ $fecha->monthName }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Line Chart -->
                        <div class="py-6" id="pie-chart2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<figure class="highcharts-figure">
    <div id="remedys-anual"></div>
</figure>

<figure class="highcharts-figure">
    <div id="materiales-mensual"></div>
</figure>

<figure class="highcharts-figure">
    <div id="sucursales-mensual"></div>
</figure>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    const trabajos_sucursal = document.querySelector("#trabajos_sucursal");
    const trabajos_material = document.querySelector("#trabajos_material");
    const all_tareas = @json($all_tareas);
    const materials_gast = @json($materialesGastados);
    const total_correctivos = parseInt("<?php echo $total_correctivos; ?>", 10);
    const total_atm = parseInt("<?php echo $total_atm; ?>", 10);
    //console.log(total_correctivos + " " + total_atm)
    const getChartOptions = () => {
        return {
            series: [total_correctivos, total_atm],
            colors: ["#b048a3", "#6169c9"],
            chart: {
                height: 420,
                width: "100%",
                type: "pie",
            },
            stroke: {
                colors: ["black"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    labels: {
                        show: true,
                    },
                    size: "100%",
                    dataLabels: {
                        offset: -25
                    }
                },
            },
            labels: ["Sucursales", "ATM"].map((label, index) => `${label} (${totals[index]})`),
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            legend: {
                position: "top",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }
    const totals = [total_correctivos, total_atm];
    if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions(totals));
        chart.render();
    }
    const total_altas = parseInt("<?php echo $total_altas; ?>", 10);
    const total_medias = parseInt("<?php echo $total_medias; ?>", 10);
    const total_bajas = parseInt("<?php echo $total_bajas; ?>", 10);
    //console.log(total_altas + " " + total_medias + " " + total_bajas)
    const getChartOptions2 = () => {
        return {
            series: [total_altas, total_medias, total_bajas],
            colors: ["#E41010", "#de8240", "#00B6FF"],
            chart: {
                height: 420,
                width: "100%",
                type: "pie",
            },
            stroke: {
                colors: ["black"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    labels: {
                        show: true,
                    },
                    size: "100%",
                    dataLabels: {
                        offset: -25
                    }
                },
            },
            labels: ["Alta", "Media", "Baja"].map((label, index) => `${label} (${totals2[index]})`),
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            legend: {
                position: "top",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }
    const totals2 = [total_altas, total_medias, total_bajas];
    if (document.getElementById("pie-chart2") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart2"), getChartOptions2(totals2));
        chart.render();
    }
</script>

@php
    use App\Models\Tarea;
    use App\Models\MaterialGastado;
    use App\Models\Sucursal;
    $remedys_anual = [];
    $meses = [
        'ASS',
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre',
    ];
    for ($i = 1; $i <= now()->month; $i++) {
        $cantidad = count(Tarea::whereMonth('fecha_cerrado', $i)->where('estado_id', '2')->get());
        array_push($remedys_anual, [$meses[$i], $cantidad, 335504]);
    }

    $aux = [];
    $groupedMaterials = [];
    foreach ($materialesGastados as $material) {
        array_push($aux, [
            $material->Material->descripcion,
            $material->cantidad,
            $material->cantidad * $material->precio,
        ]);
    }
    foreach ($aux as $material) {
        $name = $material[0];
        $quantity = $material[1];
        $price = $material[2];

        if (!isset($groupedMaterials[$name])) {
            $groupedMaterials[$name] = [
                'name' => $name,
                'total_quantity' => 0,
                'total_price' => 0,
            ];
        }
        $groupedMaterials[$name]['total_quantity'] += $quantity;
        $groupedMaterials[$name]['total_price'] += $price;
    }
    usort($groupedMaterials, function ($a, $b) {
        return $b['total_price'] <=> $a['total_price'];
    });
    $materiales_mas_gastados = [];
    foreach ($groupedMaterials as $material) {
        array_push($materiales_mas_gastados, [
            $material['name'],
            $material['total_price'],
            $material['total_quantity'],
        ]);
    }
    $conteoVisitas = [];
    foreach ($all_tareas as $tarea) {
        $name = $tarea->Sucursal->numero . ' ' . $tarea->Sucursal->sucursal;
        $date = $tarea->fecha_cerrado;
        
        if (!isset($conteoVisitas[$name])) {
            $conteoVisitas[$name] = [];
        }

        if (!in_array($date, $conteoVisitas[$name])) {
            $conteoVisitas[$name][] = $date;
        }
    }
    $sucursales_mas_visitadas = [];
    foreach ($conteoVisitas as $sucursal => $fechas) {
        array_push($sucursales_mas_visitadas, [$sucursal, count($fechas), 335504]);
    }
    $rubros_mas_solicitados = [];
    $sucursals = Sucursal::with('tareas')->get();
    foreach ($sucursals as $sucursal) {
        foreach ($sucursal->Tareas as $tarea) {
            foreach ($tarea->materialesGastados as $material_gastado) {
                array_push($rubros_mas_solicitados, array($sucursal->numero." ".$sucursal->sucursal, $material_gastado->Material->Rubro->rubro));
            }
        }
    }
    //print_r($rubros_mas_solicitados);
    $collection = collect($rubros_mas_solicitados);

    $grouped = $collection->groupBy(function ($item) {
        return $item[0]; // Agrupa por rubro
    });
    //$rubros_mas_solicitados = $grouped;
    
    $rubros_mas_solicitados = [];
    
    foreach ($grouped as $auxex) {
        $aux = collect($auxex);
        $group = $aux->groupBy(function ($item) {
            return $item[1]; // Agrupa por rubro
        })->map(function ($items) {
            return $items->count(); // Cuenta la cantidad de ocurrencias para cada rubro
        });
        $maxCount = $group->max();
        // Encuentra el primer rubro con el conteo máximo
        $firstMostFrequent = $group->filter(function ($count) use ($maxCount) {
            return $count == $maxCount; // Filtra los rubros que tienen el conteo máximo
        })->keys()->first(); // Obtiene la primera clave del resultado filtrado
        array_push($rubros_mas_solicitados, array($auxex[0][0], $firstMostFrequent));
    }
@endphp

<div class="p-5 mt-5">
    <p class="mb-5 text-xl">Rubros mas solicitados</p>
    <div class="relative overflow-x-auto">
        <table class="w-md text-sm text-left rtl:text-right text-gray-900 rounded-full">
            <thead class="text-xs uppercase bg-gray-400 text-gray-900">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Sucursal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rubro
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rubros_mas_solicitados as $sucursal)
                    <tr class="bg-gray-300 border-gray-700 hover:bg-gray-500">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900">
                            {{ $sucursal[0] }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900">
                            {{ $sucursal[1] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
    #remedys-anual,
    #materiales-mensual,
    #sucursales-mensual,
    #rubros-sucursales {
        height: 500px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 900px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variwide.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    const remedys_anual = @json($remedys_anual);
    const materiales_mas_gastados = @json($materiales_mas_gastados);
    const sucursales_mas_visitadas = @json($sucursales_mas_visitadas);
    const rubros_mas_solicitados = @json($rubros_mas_solicitados);
    //console.log(materiales_mas_gastados)
    Highcharts.chart('remedys-anual', {

        chart: {
            type: 'variwide'
        },

        title: {
            text: 'Trabajos realizados en el 2024'
        },

        subtitle: {
            text: 'Incluyen remedys realizados en preventivo'
        },

        xAxis: {
            title: {
                text: 'Meses'
            },
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Cantidad de trabajos'
            }
        },
        yAxis: {
            title: {
                text: 'Cantidad de trabajos'
            }
        },
        caption: {
            text: ''
        },

        legend: {
            enabled: false
        },
        series: [{
            name: 'Remedys realizados',
            data: remedys_anual,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            },
            tooltip: {
                pointFormat: 'Trabajos realizados: <b>{point.y}</b><br>'
            },
            borderRadius: 3,
            colorByPoint: true
        }],
        lang: {
            viewFullscreen: 'Ver en pantalla completa', // Texto para ver en pantalla completa
            printChart: 'Imprimir gráfico', // Texto para imprimir el gráfico
            downloadPNG: 'Descargar PNG', // Texto para descargar en formato PNG
            downloadJPEG: 'Descargar JPEG', // Texto para descargar en formato JPEG
            downloadPDF: 'Descargar PDF', // Texto para descargar en formato PDF
            downloadSVG: 'Descargar SVG', // Texto para descargar en formato SVG
            downloadCSV: 'Descargar CSV', // Texto para descargar en formato CSV
            downloadXLS: 'Descargar XLS', // Texto para descargar en formato Excel (XLS)
            viewData: 'Ver tabla de datos', // Texto para ver la tabla de datos
            contextButtonTitle: 'Opciones del gráfico', // Texto para el botón de opciones del gráfico
            decimalPoint: ',', // Punto decimal usado en los números
            thousandsSep: '.', // Separador de miles en los números
            noData: 'No hay datos para mostrar', // Texto mostrado cuando no hay datos
            loading: 'Cargando...', // Texto mostrado mientras el gráfico se carga
            resetZoom: 'Restablecer zoom', // Texto para restablecer el zoom
            resetZoomTitle: 'Restablecer el nivel de zoom 1:1', // Título del botón de restablecer zoom
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
                'Dic'
            ], // Meses abreviados
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ], // Nombres completos de los meses
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                'Sábado'
            ], // Nombres de los días de la semana
            exportButtonTitle: 'Exportar gráfico', // Título del botón de exportar
            rangeSelectorFrom: 'Desde', // Texto para el selector de rango (desde)
            rangeSelectorTo: 'Hasta', // Texto para el selector de rango (hasta)
            rangeSelectorZoom: 'Zoom', // Texto para el zoom del selector de rango
            loading: 'Cargando...', // Texto de carga
            contextButtonTitle: 'Opciones de gráfico', // Título del botón de contexto
            drillUpText: 'Volver a {series.name}' // Texto para volver a una serie en gráficos de drilldown
        }
    });

    Highcharts.chart('materiales-mensual', {

        chart: {
            type: 'variwide'
        },

        title: {
            text: 'Materiales gastados en el mes {{ $fecha->monthName }}'
        },

        subtitle: {
            text: ''
        },

        xAxis: {
            title: {
                text: 'Materiales'
            },
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Costo $'
            }
        },
        caption: {
            text: ''
        },

        legend: {
            enabled: false
        },
        lang: {
            viewFullscreen: 'Ver en pantalla completa', // Texto para ver en pantalla completa
            printChart: 'Imprimir gráfico', // Texto para imprimir el gráfico
            downloadPNG: 'Descargar PNG', // Texto para descargar en formato PNG
            downloadJPEG: 'Descargar JPEG', // Texto para descargar en formato JPEG
            downloadPDF: 'Descargar PDF', // Texto para descargar en formato PDF
            downloadSVG: 'Descargar SVG', // Texto para descargar en formato SVG
            downloadCSV: 'Descargar CSV', // Texto para descargar en formato CSV
            downloadXLS: 'Descargar XLS', // Texto para descargar en formato Excel (XLS)
            viewData: 'Ver tabla de datos', // Texto para ver la tabla de datos
            contextButtonTitle: 'Opciones del gráfico', // Texto para el botón de opciones del gráfico
            decimalPoint: ',', // Punto decimal usado en los números
            thousandsSep: '.', // Separador de miles en los números
            noData: 'No hay datos para mostrar', // Texto mostrado cuando no hay datos
            loading: 'Cargando...', // Texto mostrado mientras el gráfico se carga
            resetZoom: 'Restablecer zoom', // Texto para restablecer el zoom
            resetZoomTitle: 'Restablecer el nivel de zoom 1:1', // Título del botón de restablecer zoom
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
                'Dic'
            ], // Meses abreviados
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ], // Nombres completos de los meses
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                'Sábado'
            ], // Nombres de los días de la semana
            exportButtonTitle: 'Exportar gráfico', // Título del botón de exportar
            rangeSelectorFrom: 'Desde', // Texto para el selector de rango (desde)
            rangeSelectorTo: 'Hasta', // Texto para el selector de rango (hasta)
            rangeSelectorZoom: 'Zoom', // Texto para el zoom del selector de rango
            loading: 'Cargando...', // Texto de carga
            contextButtonTitle: 'Opciones de gráfico', // Título del botón de contexto
            drillUpText: 'Volver a {series.name}' // Texto para volver a una serie en gráficos de drilldown
        },
        series: [{
            name: 'Materiales mas utilizados',
            data: materiales_mas_gastados,
            dataLabels: {
                enabled: true,
                format: '{point.z:.0f}'
            },
            tooltip: {
                pointFormat: 'Cantidad del material: <b>{point.z}</b><br>' +
                    'Costo: <b>$ {point.y}</b><br>'
            },
            borderRadius: 3,
            colorByPoint: true,
        }]
    });

    Highcharts.chart('sucursales-mensual', {

        chart: {
            type: 'variwide'
        },

        title: {
            text: 'Sucursales visitadas en el mes {{ $fecha->monthName }}'
        },

        subtitle: {
            text: ''
        },

        xAxis: {
            title: {
                text: 'Sucursales'
            },
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Visitas'
            }
        },
        caption: {
            text: ''
        },

        legend: {
            enabled: false
        },
        lang: {
            viewFullscreen: 'Ver en pantalla completa', // Texto para ver en pantalla completa
            printChart: 'Imprimir gráfico', // Texto para imprimir el gráfico
            downloadPNG: 'Descargar PNG', // Texto para descargar en formato PNG
            downloadJPEG: 'Descargar JPEG', // Texto para descargar en formato JPEG
            downloadPDF: 'Descargar PDF', // Texto para descargar en formato PDF
            downloadSVG: 'Descargar SVG', // Texto para descargar en formato SVG
            downloadCSV: 'Descargar CSV', // Texto para descargar en formato CSV
            downloadXLS: 'Descargar XLS', // Texto para descargar en formato Excel (XLS)
            viewData: 'Ver tabla de datos', // Texto para ver la tabla de datos
            contextButtonTitle: 'Opciones del gráfico', // Texto para el botón de opciones del gráfico
            decimalPoint: ',', // Punto decimal usado en los números
            thousandsSep: '.', // Separador de miles en los números
            noData: 'No hay datos para mostrar', // Texto mostrado cuando no hay datos
            loading: 'Cargando...', // Texto mostrado mientras el gráfico se carga
            resetZoom: 'Restablecer zoom', // Texto para restablecer el zoom
            resetZoomTitle: 'Restablecer el nivel de zoom 1:1', // Título del botón de restablecer zoom
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
                'Dic'
            ], // Meses abreviados
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ], // Nombres completos de los meses
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                'Sábado'
            ], // Nombres de los días de la semana
            exportButtonTitle: 'Exportar gráfico', // Título del botón de exportar
            rangeSelectorFrom: 'Desde', // Texto para el selector de rango (desde)
            rangeSelectorTo: 'Hasta', // Texto para el selector de rango (hasta)
            rangeSelectorZoom: 'Zoom', // Texto para el zoom del selector de rango
            loading: 'Cargando...', // Texto de carga
            contextButtonTitle: 'Opciones de gráfico', // Título del botón de contexto
            drillUpText: 'Volver a {series.name}' // Texto para volver a una serie en gráficos de drilldown
        },
        series: [{
            name: 'Sucursales visitadas',
            data: sucursales_mas_visitadas,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            },
            tooltip: {
                pointFormat: 'Veces visitadas: <b>{point.y}</b><br>'
            },
            borderRadius: 3,
            colorByPoint: true
        }]
    });

</script>
