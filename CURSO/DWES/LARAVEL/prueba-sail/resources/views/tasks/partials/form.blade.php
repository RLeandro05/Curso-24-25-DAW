<form action="{{$actionURL}}" method="POST" class="max-w-sm mx-auto">
  @csrf
  <div class="mb-5">
    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
    <input type="text" name="name" value="{{old('name',$task->name)}}" placeholder="Escribe tu tarea" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
    @error('name')
<span class="text-red-500 text-sm"> {{$message}}</span>
    @enderror
 </div>
  <div class="mb-5">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escribe tu mensaje</label>
      <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deja tu comentario...">{{old('description',$task->description)}}</textarea>
      @error('description')
      <span class="text-red-500 text-sm"> {{$message}}</span>
            @enderror
    </div>
  <div class="flex items-start mb-5">
    <div class="flex items-center h-5">
      <input id="completed" name="completed" {{old('completed',$task->completed)?'checked':''}} type="checkbox" value="1" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"  />
    </div>
    <label for="completed" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Completada?</label>
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{$submitButtonText}}</button>  </form>