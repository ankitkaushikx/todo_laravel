<?php

use App\Mail\TodoCreated;

use Livewire\Component;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function Livewire\Volt\{state , with};
//State 
   state(['task']);

//to pass $todos list 
   with([
    'todos'=> fn()=>  auth()->user()->todos()->orderBy('created_at', 'desc')->get()
   ]);

   //Function to handle form submission
  $add = function(){

  $todo = auth()->user()->todos()->create([
     'task'=> $this->task
   ]);


   //Send Mail to USer
   Mail::to(auth()->user())->send(new TodoCreated($todo));


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

<div>
  @foreach ($todos as $todo)
    <div class="p-4 border rounded flex justify-between 
      @if ($todo->stage == 'pending')
        bg-red-500
      @elseif ($todo->stage == 'started')
        bg-yellow-500
      @elseif ($todo->stage == 'working')
        bg-blue-500
         @elseif ($todo->stage == 'completed')
        bg-green-500
      @endif
    ">
      {{$todo->task}}
      <button wire:click="delete({{$todo->id}})" class="bg-red-600 p-1 rounded">Delete</button>
    </div>
  @endforeach
</div>
</div>
