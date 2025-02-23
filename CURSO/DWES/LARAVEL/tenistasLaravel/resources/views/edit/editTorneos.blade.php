<h1>Editar un torneo</h1>

<form action="{{ route('update.updateTorneos', $torneo) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ $torneo->nombre }}" required>

    <br><br>
    
    <label>Ciudad:</label>
    <input type="text" name="ciudad" value="{{ $torneo->ciudad }}" required>

    <br><br>
    
    <button type="submit">Actualizar</button> || <a href="{{ route('index.indexTorneos') }}" style="display: inline-block; padding: 10px 15px; background: black; color: white; text-decoration: none; border-radius: 5px;">Volver</a>

</form>
