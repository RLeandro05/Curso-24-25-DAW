<x-app-layout>
    <x-slot name="header">
        {{ $header }} <!-- Aquí se usará el 'header' pasado en la ruta -->
    </x-slot>

    <p>{{ $slot }}</p> <!-- Aquí se usará el 'slot' pasado en la ruta -->
</x-app-layout>