<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center">
            Listado de Títulos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <!-- Tarjeta de Crear Título -->
                <div class="p-6 bg-blue-100 rounded-lg shadow-md text-center mb-4">
                    <a href="{{ route('titulos.create') }}"
                        class="mt-2 inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-800">
                        Crear Título
                    </a>
                </div>

                <!-- Tabla de Títulos -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Tenista</th>
                                <th scope="col" class="px-6 py-3">Torneo</th>
                                <th scope="col" class="px-6 py-3">Año</th>
                                <th scope="col" class="px-6 py-3">Creado en</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($titulos as $titulo)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $titulo->id }}</td>
                                    <td class="px-6 py-4">{{ $titulo->tenista->nombre }} {{ $titulo->tenista->apellidos }}
                                    </td>
                                    <td class="px-6 py-4">{{ $titulo->torneo->nombre }}</td>
                                    <td class="px-6 py-4">{{ $titulo->anno }}</td>
                                    <td class="px-6 py-4">{{ $titulo->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <a href="{{ route('titulos.edit', ['anno' => $titulo->anno, 'tenista_id' => $titulo->tenista_id, 'torneo_id' => $titulo->torneo_id]) }}"
                                            class="text-blue-600 hover:underline">
                                            Editar
                                        </a>
                                        <form
                                            action="{{ route('titulos.destroy', ['anno' => $titulo->anno, 'tenista_id' => $titulo->tenista_id, 'torneo_id' => $titulo->torneo_id]) }}"
                                            method="POST">
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
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay títulos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $titulos->links() }}
                </div>
            </div>

            <!-- Botón de Volver -->
            <div class="mt-6">
                <a href="{{ route('index') }}" class="mt-2 inline-block px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-800">
                    Inicio
                </a>
            </div>

            @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                        {{ session('error') }}
                    </div>
            @else
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>