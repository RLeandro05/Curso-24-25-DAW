<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white
<<<<<<< HEAD
leading-tight" style="text-align: center;">
=======
leading-tight" style="text-align: center">
>>>>>>> 779b74e3815e2692cc2e7e8811892a8cdfc44521
            Crear un nuevo Torneo
        </h2>
    </x-slot>
    <!-- definimos el contenido a renderizar ( no hace falta poner slot
)-->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-g sm:px.20 bg-white border-b
border-gray-200">
                    <botton class="p-4">
                        <a href="{{route('torneos.index')}}"
                            class="inline-flex items-center px-4 py-2 border border-transparent
text-sm font-medium bg-black text-white rounded-md hover:bg-gray-800">
                            Volver al listado
                        </a>
                    </botton>
                </div>
                @include('torneos.partials.form')
            </div>
        </div>
    </div>
</x-app-layout>