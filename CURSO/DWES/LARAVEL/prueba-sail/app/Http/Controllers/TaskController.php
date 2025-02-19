<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function index()
   {
      $tasks=Task::latest(column: "id")->paginate(perPage:5);
      return view('tasks.index', [
      'tasks' => $tasks,
      ]);
   }
   public function create() {
      return view("tasks.create", [
         "task"=>new Task(),
         "method"=>"POST",
         "actionURL"=>route("tasks.store"),
         "submitButtonText"=>"Crear Tarea"
      ]);
   }
   public function edit(Task $task) {
      return view("tasks.edit", [
         "task"=>$task,
         "method"=>"PUT",
         "actionURL"=>route("tasks.update", $task),
         "submitButtonText"=>"Actualizar Tarea"
      ]);
   }
   public function update(Task $task, TaskRequest $request):RedirectResponse {
      $task->update($request->validated());
      return redirect()->route("tasks.index");
   }
   public function store(TaskRequest $request):RedirectResponse {
      Task::create($request->validated());
      return redirect()->route('tasks.index');
   }
   public function toggle(Task $task): RedirectResponse {
      $task->update([
         "completed"=>!$task->completed
      ]);
      return redirect()->route("tasks.index");
   }
}
