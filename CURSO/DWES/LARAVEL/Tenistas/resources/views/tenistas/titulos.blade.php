<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Títulos ganados por {{ $tenista->nombre }} {{ $tenista->apellidos }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Lista de títulos</h3>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">TENISTA</th>
                                    <th scope="col" class="px-6 py-3">ID DEL TORNEO</th>
                                    <th scope="col" class="px-6 py-3">TORNEO</th>
                                    <th scope="col" class="px-6 py-3">AÑO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($titulos as $titulo)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <td class="px-6 py-4">{{ $tenista->nombre }} {{ $tenista->apellidos }}</td>
                                        <td class="px-6 py-4">{{ $titulo->torneo_id }}</td>
                                        <td class="px-6 py-4">{{ $titulo->torneo->nombre }}</td>
                                        <td class="px-6 py-4">{{ $titulo->anno }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4" colspan="4">No hay títulos registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Agregar paginación -->
                    {{ $titulos->links() }}

                    <div class="mt-4">
                        <a href="{{ route('tenistas.index') }}" class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800">
                            Volver al listado de tenistas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
