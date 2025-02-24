<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center">
           Listado de tenistas
        </h2>
    </x-slot>  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <!-- Tarjeta de Crear Tenista -->
                <div class="p-6 bg-blue-100 rounded-lg shadow-md text-center mb-4">
                    <h3 class="text-lg font-bold text-blue-700">Crear Tenista</h3>
                    <p class="text-gray-600">Añade un nuevo tenista a la base de datos.</p>
                    <a href="{{ route('tenistas.create') }}" class="mt-2 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">
                        Crear Tenista
                    </a>
                </div>

                <!-- Tabla de Tenistas -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Apellidos</th>
                                <th scope="col" class="px-6 py-3">Altura</th>
                                <th scope="col" class="px-6 py-3">Año de Nacimiento</th>
                                <th scope="col" class="px-6 py-3">Mano</th>
                                <th scope="col" class="px-6 py-3">Títulos</th>
                                <th scope="col" class="px-6 py-3">Creada en Fecha</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tenistas as $tenista)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $tenista->nombre }}</td>
                                <td class="px-6 py-4">{{ $tenista->apellidos }}</td>
                                <td class="px-6 py-4">{{ $tenista->altura }} cm</td>
                                <td class="px-6 py-4">{{ $tenista->anno_nacimiento }}</td>
                                <td class="px-6 py-4 capitalize">{{ $tenista->mano }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('tenistas.titulos', $tenista->id) }}" class="font-medium text-blue-600 hover:underline">
                                        {{ $tenista->titulos_count ?? 0 }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{ $tenista->created_at->format('d/m/Y H:i:s') }}</td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <a href="{{ route('tenistas.edit', $tenista) }}" class="text-orange-600 hover:underline">
                                        Editar
                                    </a>
                                    <form action="{{ route('tenistas.destroy', $tenista) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este tenista?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">No hay tenistas registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $tenistas->links() }}
                </div>
            </div>

            <!-- Botón de Volver -->
            <div class="mt-6">
                <a href="{{ route('estadisticas.index') }}" class="text-green-600 hover:underline">
                    Volver a página principal
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
