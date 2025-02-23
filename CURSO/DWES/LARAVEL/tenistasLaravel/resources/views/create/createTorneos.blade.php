<h1>Añadir un nuevo torneo</h1>

<form action="{{ route('store.storeTorneos') }}" method="POST">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <br><br>
    
    <label>Ciudad:</label>
    <input type="text" name="ciudad" required>

    <br><br>
    
    <button type="submit">Guardar</button> || <a href="{{ route('index.indexTorneos') }}" style="display: inline-block; padding: 10px 15px; background: black; color: white; text-decoration: none; border-radius: 5px;">Volver</a>

</form>
