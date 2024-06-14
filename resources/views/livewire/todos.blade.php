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


   \App\Models\Todo::create([
    'user_id'=> auth()->id(),
    'task'=> $this->task
   ]);

   $this->task = '';
   }
?>

<div>
<form wire:submit="add">
  <input type="text" wire:model='task'>
  <button class="btn " type="submit">Add</button>
</form>

<div>
  @foreach ($todos as $todo )
  <div class="">
    {{$todo->task}}
  </div>
  @endforeach
</div>
</div>
