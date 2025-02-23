<h1>Añadir un nuevo tenista</h1>

<form action="{{ route('store.storeTenistas') }}" method="POST">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <br><br>
    
    <label>Apellidos:</label>
    <input type="text" name="apellidos" required>

    <br><br>
    
    <label>Altura:</label>
    <input type="number" name="altura" step="0.01" required>

    <br><br>
    
    <label>Año de Nacimiento:</label>
    <input type="number" name="anno_nacimiento" required>

    <br><br>
    
    <label>Mano:</label>
    <select name="mano" required>
        <option value="Diestro">Diestro</option>
        <option value="Zurdo">Zurdo</option>
    </select>

    <br><br>
    
    <button type="submit">Guardar</button> || <a href="{{ route('index.indexTenistas') }}" style="display: inline-block; padding: 10px 15px; background: black; color: white; text-decoration: none; border-radius: 5px;">Volver</a>

</form>
