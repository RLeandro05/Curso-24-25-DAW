<form action="{{ $actionUrl }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method($method)

    <!-- Nombre del Torneo -->
    <div class="mb-4">
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $torneo->nombre) }}" 
            placeholder="Escribe el nombre del torneo"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        @error('nombre')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Ciudad del Torneo -->
    <div class="mb-4">
        <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad', $torneo->ciudad) }}" 
            placeholder="Ciudad del torneo"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        @error('ciudad')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Selección de Superficie -->
    <div class="mb-4">
        <label for="superficie_id" class="block text-sm font-medium text-gray-700">Superficie</label>
        <select name="superficie_id" id="superficie_id" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <option value="">Seleccione una superficie</option>
            @foreach($superficies as $id => $nombre)
                <option value="{{ $id }}" {{ old('superficie_id', $torneo->superficie_id) == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
        @error('superficie_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Botón de Enviar -->
    <div class="text-center">
        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="margin-bottom: 1em; text-align: left;">
            {{ $submitButtonText }}
        </button>
    </div>
</form>
