<?php


use Livewire\Component;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\{state , with};
//State 
   state(['task']);

//to pass $todos list 
   with([
    'todos'=> fn()=>  auth()->user()->todos
   ]);

   //Function to handle form submission
  $add = function(){

  auth()->user()->todos()->create([
     'task'=> $this->task
   ]);


   //Send Mail to USer
   Mail::to(auth()->user())->queue(new TodoCreated($todo));


   $this->task = '';
   };

///Function To delte
  $delete = function(\App\Models\Todo $todo){
  $todo->delete();
   }
?>

<div class="">
<form wire:submit="add" class="py-4">
  <input type="text" wire:model='task'>
  <button class="btn " type="submit">Add</button>
</form>

<div class="  bg-slate-900 p-4 text-white">
  @foreach ($todos as $todo )
  <div class="p-2 border rounded flex justify-between">
    {{$todo->task}}
    <button wire:click="delete({{$todo->id}})" class="bg-red-600 p-1 rounded">Delete</button>
  </div>
  @endforeach
</div>
</div>
