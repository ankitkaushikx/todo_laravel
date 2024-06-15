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
    'todos'=> fn()=>  auth()->user()->todos()->orderBy('created_at', 'desc')->get(),

   ]);


 

   // Count By "Stage"
 
   //Function to handle form submission
  $add = function(){

  $todo = auth()->user()->todos()->create([
     'task'=> $this->task
   ]);


   //Send Mail to USer
  //  Mail::to(auth()->user())->send(new TodoCreated($todo));


   $this->task = '';
   };

///Function To delte
  $delete = function(\App\Models\Todo $todo){
  $todo->delete();
   };

 

?>

<div class="">
    <form wire:submit.prevent="add" class="py-4 flex">
        <input type="text" wire:model.lazy="task" class="flex-grow p-2 border rounded-l">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Add</button>
    </form>

    <div>
        <div class="py-2 bg-slate-900 text-white text-center">
          Total: {{ $todos->count() }} <!-- Display total count of todos -->
          Pending: {{ $todos->where('stage', 'pending')->count() }} |
          Working: {{$todos->where('stage','working')->count()}} |
</div>

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
            <span class="flex-grow text-white">{{ $todo->id }}. {{ $todo->task }}</span>
            <button wire:click="delete({{ $todo->id }})" class="bg-red-600 text-white p-1 rounded">Delete</button>
        </div>
        @endforeach
    </div>
</div>
