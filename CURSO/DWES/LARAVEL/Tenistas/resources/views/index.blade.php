<x-app-layout>
    <x-slot name="header">
<<<<<<< HEAD
        <h1 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight" style="text-align: center;">
            Página principal
        </h1>
=======
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight" style="text-align: center">
            Página principal
        </h2>
>>>>>>> 779b74e3815e2692cc2e7e8811892a8cdfc44521
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold text-center text-gray-800">Selección de tabla</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tarjeta de Tenistas -->
                    <div class="bg-red-100 p-6 rounded-lg shadow-lg text-center">
                        <h3 class="text-xl font-bold text-red-700">Tenistas</h3>
<<<<<<< HEAD
                        <p class="text-gray-600">Datos sobre tenistas</p>
                        <a href="{{ route('tenistas.index') }}" class="mt-4 inline-block px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800">
=======
                        <p class="text-red-600">Datos sobre tenistas</p>
                        <a href="{{ route('tenistas.index') }}" class="mt-4 inline-block px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-300">
>>>>>>> 779b74e3815e2692cc2e7e8811892a8cdfc44521
                            Ver Tenistas
                        </a>
                    </div>

                    <!-- Tarjeta de Torneos -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center">
                        <h3 class="text-xl font-bold text-gray-700">Torneos</h3>
                        <p class="text-gray-600">Datos sobre torneos</p>
<<<<<<< HEAD
                        <a href="{{ route('torneos.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-800">
=======
                        <a href="{{ route('torneos.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-300">
>>>>>>> 779b74e3815e2692cc2e7e8811892a8cdfc44521
                            Ver Torneos
                        </a>
                    </div>

                    <!-- Tarjeta de Títulos -->
                    <div class="bg-purple-100 p-6 rounded-lg shadow-lg text-center">
                        <h3 class="text-xl font-bold text-purple-700">Títulos</h3>
                        <p class="text-purple-600">Datos sobre títulos</p>
<<<<<<< HEAD
                        <a href="{{ route('titulos.index') }}" class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-800">
=======
                        <a href="{{ route('titulos.index') }}" class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-300">
>>>>>>> 779b74e3815e2692cc2e7e8811892a8cdfc44521
                            Ver Títulos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
