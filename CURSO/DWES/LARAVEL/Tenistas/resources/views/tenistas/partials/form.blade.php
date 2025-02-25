<form action="{{$actionUrl}}" method="POST" class="mt-6 max-w-lg mx-auto">
    @csrf
    @method($method)
        
    <div class="mb-5">
        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
        <input type="text" name="nombre" value="{{old('nombre', $tenista->nombre)}}" placeholder="Escribe el nombre" id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        @error('nombre')
            <span class="text-red-500 text-sm"> {{$message}}</span>
        @enderror
    </div>
    <div class="mb-5">
        <label for="apellidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
        <input type="text" name="apellidos" value="{{old('apellidos', $tenista->apellidos)}}" placeholder="Escribe el apellido" id="apellidos"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        @error('apellidos')
            <span class="text-red-500 text-sm"> {{$message}}</span>
        @enderror
    </div>
    <div class="mb-5">
        <label for="altura" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Altura</label>
        <input type="text" name="altura" value="{{old('altura', $tenista->altura)}}" placeholder="Escribe la altura" id="altura"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        @error('altura')
            <span class="text-red-500 text-sm"> {{$message}}</span>
        @enderror
    </div>
    <div class="mb-5">
    <label for="mano" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mano</label>
    <select name="mano" id="mano" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="Diestro" {{ old('mano', $tenista->mano) == 'Diestro' ? 'selected' : '' }}>Diestro</option>
        <option value="Zurdo" {{ old('mano', $tenista->mano) == 'Zurdo' ? 'selected' : '' }}>Zurdo</option>
    </select>
    @error('mano')
        <span class="text-red-500 text-sm"> {{$message}}</span>
    @enderror
</div>
    <div class="mb-5">
        <label for="anno_nacimiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Año de nacimiento</label>
        <input type="text" name="anno_nacimiento" value="{{old('anno_nacimiento', $tenista->anno_nacimiento)}}" placeholder="Escribe el año de cacimiento" id="anno_nacimiento"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        @error('anno_nacimiento')
            <span class="text-red-500 text-sm"> {{$message}}</span>
        @enderror
    </div>

    {{-- Esto mostrará los datos enviados en la página --}}
    <!--@dump(request()->all())-->
    <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="margin-bottom: 1em;">{{$sumbitButtonText}}
    </button>
</form>