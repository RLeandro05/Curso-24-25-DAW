<h1>Editar un nuevo tenista</h1>

<form action="{{ route('update.updateTenistas', $tenista) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ $tenista->nombre }}" required>

    <br><br>
    
    <label>Apellidos:</label>
    <input type="text" name="apellidos" value="{{ $tenista->apellidos }}" required>

    <br><br>
    
    <label>Altura:</label>
    <input type="number" name="altura" step="0.01" value="{{ $tenista->altura }}" required>

    <br><br>
    
    <label>Año de Nacimiento:</label>
    <input type="number" name="anno_nacimiento" value="{{ $tenista->anno_nacimiento }}" required>

    <br><br>
    
    <label>Mano:</label>
    <select name="mano" required>
        <option value="Diestro" {{ $tenista->mano == 'Diestro' ? 'selected' : '' }}>Diestro</option>
        <option value="Zurdo" {{ $tenista->mano == 'Zurdo' ? 'selected' : '' }}>Zurdo</option>
    </select>

    <br><br>
    
    <button type="submit">Actualizar</button> || <a href="{{ route('index.indexTenistas') }}" style="display: inline-block; padding: 10px 15px; background: black; color: white; text-decoration: none; border-radius: 5px;">Volver</a>

</form>
