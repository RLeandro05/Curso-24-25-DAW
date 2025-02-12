<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-white leading-tight">
            Cabecera
        </h2>
    </x-slot>
    <!-- definimos el contenido a renderizar ( no hace falta poner slot )-->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-g sm:px.20 bg-white border-b border-gray-200">
                    Cuerpo
                </div>
            </div>
        </div>
</x-app-layout>