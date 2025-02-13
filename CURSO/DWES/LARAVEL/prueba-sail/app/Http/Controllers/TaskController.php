<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function index()
   {
      $tasks=Task::paginate(perPage:3);
      return view('tasks.index', [
      'tasks' => $tasks,
      ]);
   }
   public function create() {
      return view("tasks.create", [
         "task"=>new Task(),
         "actionURL"=>route("tasks.store"),
         "submitButtonText"=>"Crear Tarea"
      ]);
   }
}
