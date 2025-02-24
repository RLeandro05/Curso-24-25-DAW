<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Estadísticas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold text-center text-gray-800">Bienvenido a la sección de estadísticas</h2>
                <p class="text-center text-gray-600 mb-6">
                    Explora datos clave sobre tenistas, torneos y títulos en la aplicación.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tarjeta de Tenistas -->
                    <div class="bg-blue-100 p-6 rounded-lg shadow-lg text-center">
                        <h3 class="text-xl font-bold text-blue-700">Tenistas</h3>
                        <p class="text-gray-600">Consulta estadísticas generales sobre los tenistas.</p>
                        <a href="{{ route('tenistas.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">
                            Ver estadísticas
                        </a>
                    </div>

                    <!-- Tarjeta de Torneos -->
                    <div class="bg-yellow-100 p-6 rounded-lg shadow-lg text-center">
                        <h3 class="text-xl font-bold text-yellow-700">Torneos</h3>
                        <p class="text-gray-600">Descubre datos sobre los torneos organizados.</p>
                        <a href="{{ route('torneos.index') }}" class="mt-4 inline-block px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-800">
                            Ver estadísticas
                        </a>
                    </div>

                    <!-- Tarjeta de Títulos -->
                    <div class="bg-green-100 p-6 rounded-lg shadow-lg text-center">
                        <h3 class="text-xl font-bold text-green-700">Títulos</h3>
                        <p class="text-gray-600">Analiza la cantidad de títulos ganados por cada tenista.</p>
                        <a href="{{ route('titulos.index') }}" class="mt-4 inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-800">
                            Ver estadísticas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
