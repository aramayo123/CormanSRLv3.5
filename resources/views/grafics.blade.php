<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.0/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de tareas') }}
            <button id="theme-toggle" type="button"
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm px-1">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <section class="bg-gray-50 p-3 sm:p-5">
                        <div class="mx-auto max-w-screen-xl">
                            <!-- Start coding here -->
                            <div id="contenedor" class="shadow-lg p-3 mb-5 bg-white"></div>
                            <div
                                class="bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
                                <div class="overflow-x-auto px-5">
                                    <table data-order='[[ 7, "desc" ]]' data-page-length='25'
                                        class="w-full text-sm text-left text-gray-500 my-1 m-5 p-5" id="tabla">
                                        @if (count($tareas))
                                            <thead class="text-xs text-gray-700 uppercase">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        Ticket</th>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        Cliente</th>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        Sucursal</th>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl text-red-500 bg-red-200 outline outline-offset-0 outline-1 outline-gray-800">
                                                        Prioridad</th>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl text-red-500 bg-red-200 outline outline-offset-0 outline-1 outline-gray-800">
                                                        Estado</th>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        Certificado</th>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl text-red-500 bg-red-200 outline outline-offset-0 outline-1 outline-gray-800">
                                                        ATM</th>
                                                    <th scope="col"
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        Fecha</th>
                                                </tr>
                                            </thead>
                                        @endif
                                        <tbody>
                                            @forelse ($tareas as $tarea)
                                                <tr class="border-b">
                                                    <th scope="row"
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        {{ $tarea->tipo_de_tarea == 'PREVENTIVO' ? 'Preventivo' : $tarea->ticket }}
                                                    </th>
                                                    <td
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        {{ $tarea->Cliente->cliente }}</td>
                                                    <td
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        {{ $tarea->Sucursal->sucursal }}</td>
                                                    <td
                                                        class="px-4 py-3 rounded-xl text-{{ $tarea->ColorTipoPrioridad() }}-500 bg-{{ $tarea->ColorTipoPrioridad() }}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        <?php
                                                        echo $tarea->Prioridad ? $tarea->Prioridad->prioridad : '-';
                                                        ?></td>
                                                    <td
                                                        class="px-4 py-3 rounded-xl text-{{ $tarea->ColorEstado() }}-500 bg-{{ $tarea->ColorEstado() }}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        <?php
                                                        echo $tarea->Estado ? $tarea->Estado->estado : '-';
                                                        ?></td>
                                                    <td
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        {{ $tarea->Certificado() }}</td>
                                                    <td
                                                        class="px-4 py-3 text-{{ $tarea->ColorAtm() }}-500 bg-{{ $tarea->ColorAtm() }}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        {{ $tarea->Atm() }}</td>
                                                    <td
                                                        class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                                        {{ $tarea->fecha_mail }}</td>
                                                </tr>
                                            @empty
                                        </tbody>
                                        <p class="text-center text-slate-950 my-5">Todavia no existen tareas
                                            registradas</p>
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  
<script src="https://cdn.datatables.net/searchpanes/1.2.0/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src=https://code.highcharts.com/highcharts.js></script>

<script>
    $(document).ready(function() {
        // Creamos la DataTable
        var table = $('#tabla').DataTable({
            dom: 'Pfrtip', //La P es para ver el panel de búsquedas
        });

        // Creamos el gráfico con los datos iniciales    
        var container = $('#contenedor');
        var chart = Highcharts.chart(container[0], {
            chart: {
                type: 'pie',
            },
            title: {
                text: 'Personal por puesto',
            },
            series: [{
                data: chartData(table),
            }, ],
        });

        // En cada seleccion de filtro, actualiza los datos en el gráfico.
        table.on('draw', function() {
            chart.series[0].setData(chartData(table));
        });
        //funcion chartData
        function chartData(table) {
            var filasAfectadas = {};
            // Contamos el número de entradas para cada puesto (Puesto) 
            // columna 1 = [0=nombre, 1=puesto, 2=pais]
            table.column(2, {
                search: 'applied'
            }).data().each(function(val) {
                if (filasAfectadas[val]) {
                    filasAfectadas[val] += 1;
                } else {
                    filasAfectadas[val] = 1;
                }
            });

            // Y mapeamos al formato que usa highcharts
            //usamos la funcion $map de jquery 
            //$.map(array, function(value, index){});

            return $.map(filasAfectadas, function(cantidad, clave) {
                console.log(filasAfectadas); //nos muestra la cantidad filas seleccionadas
                //console.log("clave: "+clave+" cantidad: "+cantidad);
                return {
                    name: clave,
                    y: cantidad,
                };

            });
        }
    });
</script>
