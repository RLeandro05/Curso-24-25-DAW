<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center">
            Listado de Torneos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <!-- Tarjeta de Crear Torneo -->
                <div class="p-6 bg-yellow-100 rounded-lg shadow-md text-center mb-4">
                    <a href="{{ route('torneos.create') }}"
                        class="mt-2 inline-block px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-800">
                        Crear Torneo
                    </a>
                </div>

                <!-- Tabla de Torneos -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Ciudad</th>
                                <th scope="col" class="px-6 py-3">Superficie</th>
                                <th scope="col" class="px-6 py-3">Creada en Fecha</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($torneos as $torneo)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $torneo->id }}</td>
                                    <td class="px-6 py-4">{{ $torneo->nombre }}</td>
                                    <td class="px-6 py-4">{{ $torneo->ciudad }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $torneo->superficie_nombre }}</td>
                                    <td class="px-6 py-4">{{ $torneo->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <a href="{{ route('torneos.edit', $torneo) }}"
                                            class="text-orange-600 hover:underline">
                                            Editar
                                        </a>
                                        <form action="{{ route('torneos.destroy', $torneo) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres eliminar este torneo?');">
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
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay torneos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $torneos->links() }}
                </div>
            </div>

            <!-- Botón de Volver -->
            <div class="mt-6">
                <a href="{{ route('index') }}" class="text-green-600 hover:underline">
                    Volver a página principal
                </a>
                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>