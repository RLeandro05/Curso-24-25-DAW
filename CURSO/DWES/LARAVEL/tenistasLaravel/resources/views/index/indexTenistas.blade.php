<!-- Vista indexTenistas.blade.php -->

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-g sm:px.20 bg-white border-b border-gray-200">
                <h1>Listado de Tenistas</h1>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table border="1" style="border-collapse: collapse;" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">id</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Apellidos</th>
                                <th scope="col" class="px-6 py-3">Altura</th>
                                <th scope="col" class="px-6 py-3">Año de Nacimiento</th>
                                <th scope="col" class="px-6 py-3">Mano con la que juega</th>
                                <th scope="col" class="px-6 py-3">Fecha creación</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($tenistas as $tenista)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4">{{$tenista->id}}</td>
                                <td class="px-6 py-4">{{$tenista->nombre}}</td>
                                <td class="px-6 py-4">{{$tenista->apellidos}}</td>
                                <td class="px-6 py-4">{{$tenista->altura}}</td>
                                <td class="px-6 py-4">{{$tenista->anno_nacimiento}}</td>
                                <td class="px-6 py-4">{{$tenista->mano}}</td>
                                <td class="px-6 py-4">{{$tenista->created_at->format("d/m/Y")}}</td>
                                <td class="px-6 py-4">
                                    <a href="{{route('edit.editTenistas',$tenista)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a> ||
                                    <a href="{{route('create.createTenistas')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium bg-black text-white rounded-md hover:bg-gray-800">Crear Tenista</a>
                                    <form action="{{ route('destroy.destroyTenistas', $tenista) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button style="width: 100%;" type="submit" onclick="return confirm('¿Estás seguro de eliminar este tenista?');">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">No hay tenistas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Paginación (esto se verá después de quitar el dd()) -->
                    {{$tenistas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>