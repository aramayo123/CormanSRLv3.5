<section class="bg-gray-50 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button data-modal-target="carga-masiva" data-modal-toggle="carga-masiva" type="button"
                        class="flex items-center justify-center text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
                        <svg class="mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="19" height="19" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-4m5-13v4a1 1 0 0 1-1 1H5m0 6h9m0 0-2-2m2 2-2 2" />
                        </svg>Cargar
                    </button>
                    <a href="{{ url('materiales/create') }}"
                        class="flex items-center justify-center text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        <button type="button">Nuevo material</button>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto px-5">
                <table data-order='[[ 4, "desc" ]]' data-page-length='25' class="w-full text-sm text-left text-gray-500 " id="tabla">
                    @if (count($materiales))
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-4 py-3">#ID</th>
                                <th scope="col" class="px-4 py-3">Rubro</th>
                                <th scope="col" class="px-4 py-3">Descripcion</th>
                                <th scope="col" class="px-4 py-3">Unidad</th>
                                <th scope="col" class="px-4 py-3">Fecha de creacion</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                    @endif
                    <tbody>
                        @forelse ($materiales as $material)
                            <tr class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    #{{ $material->id }}</th>
                                <td class="px-4 py-3">{{ $material->Rubro->rubro }}</td>
                                <td class="px-4 py-3">{{ $material->descripcion }}</td>
                                <td class="px-4 py-3">{{ $material->unidad }}</td>
                                <td class="px-4 py-3">{{ $material->created_at }}</td>
                                <td class="px-4 py-3 flex items-center justify-center align-items-center">
                                    @can('materiales.update')
                                    <a href="{{ url('materiales/' . $material->id . '/edit') }}"
                                        class="hover:cursor-pointer hover:bg-gray-100">
                                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('materiales.destroy')
                                    <form action="{{ route('materiales.destroy', $material->id)}}" method="post" onclick="Eliminar(this, '{{ $material->descripcion }}')">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="hover:cursor-pointer hover:bg-gray-100 mt-1">
                                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                    </tbody>
                    <p class="text-center text-slate-950 my-5">Todavia no existen materiales registrados</p>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</section>
@include('materiales.modal')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="{{ asset('js/index.js') }} "></script>
<script>
    function Eliminar(e, material) {
        Swal.fire({
            title: "Estas seguro?",
            text: `Estas a punto de eliminar al material "${material}"`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                e.children[2].setAttribute('type', 'submit');
                e.submit();
            }
        });
    }
</script>