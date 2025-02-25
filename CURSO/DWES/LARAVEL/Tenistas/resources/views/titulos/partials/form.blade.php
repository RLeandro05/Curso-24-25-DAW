
    <form action="{{ $actionUrl }}" method="POST" class="mt-6 max-w-lg mx-auto">
        @csrf
        @method($method)

        <!-- Selección de Tenista -->
        <div class="mb-5">
            <label for="tenista_id" class="block text-sm font-medium text-gray-900 dark:text-white">Tenista</label>
            <select name="tenista_id" id="tenista_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach($tenistas as $tenista)
                    <option value="{{ $tenista->id }}" {{ old('tenista_id', $titulo->tenista_id ?? '') == $tenista->id ? 'selected' : '' }}>
                        {{ $tenista->nombre }} {{ $tenista->apellidos }}
                    </option>
                @endforeach
            </select>
            @error('tenista_id')
                <span class="text-red-500 text-sm"> {{ $message }}</span>
            @enderror
        </div>

        <!-- Selección de Torneo -->
        <div class="mb-5">
            <label for="torneo_id" class="block text-sm font-medium text-gray-900 dark:text-white">Torneo</label>
            <select name="torneo_id" id="torneo_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach($torneos as $torneo)
                    <option value="{{ $torneo->id }}" {{ old('torneo_id', $titulo->torneo_id ?? '') == $torneo->id ? 'selected' : '' }}>
                        {{ $torneo->nombre }}
                    </option>
                @endforeach
            </select>
            @error('torneo_id')
                <span class="text-red-500 text-sm"> {{ $message }}</span>
            @enderror
        </div>

        <!-- Campo de Año -->
        <div class="mb-5">
            <label for="anno" class="block text-sm font-medium text-gray-900 dark:text-white">Año</label>
            <input type="number" name="anno" value="{{ old('anno', $titulo->anno ?? '') }}" placeholder="Ingrese el año"
                id="anno"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
            @error('anno')
                <span class="text-red-500 text-sm"> {{ $message }}</span>
            @enderror
        </div>

        <!-- Mensaje de Error General -->
        @if (session('error'))
            <div class="text-red-500 text-sm mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Botón Crear Título -->
        <button type="submit"
            class="w-full sm:w-auto px-5 py-2.5 bg-green-700 text-white font-medium rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300" style="margin-bottom: 1em;">
            {{ $submitButtonText }}
        </button>
    </form>
