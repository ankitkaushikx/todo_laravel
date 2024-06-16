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
    <div class="flex flex-wrap justify-center items-center">
        <div class="w-full md:w-auto mb-2 md:mb-0 md:mr-4">
            <div class="text-white bg-white bg-opacity-10 px-4 py-2 rounded-lg mb-2 md:mb-0 md:inline-block">
                Total: {{ $todos->count() }}
            </div>
        </div>
        <div class="w-full md:w-auto mb-2 md:mb-0 md:mr-4">
            <div class="text-white bg-red-500 px-4 py-2 rounded-lg mb-2 md:mb-0 md:inline-block">
                Pending: {{ $todos->where('stage', 'pending')->count() }}
            </div>
        </div>
        <div class="w-full md:w-auto mb-2 md:mb-0 md:mr-4">
            <div class="text-white bg-blue-500 px-4 py-2 rounded-lg mb-2 md:mb-0 md:inline-block">
                Working: {{ $todos->where('stage', 'working')->count() }}
            </div>
        </div>
        <div class="w-full md:w-auto mb-2 md:mb-0 md:mr-4">
            <div class="text-white bg-yellow-500 px-4 py-2 rounded-lg mb-2 md:mb-0 md:inline-block">
                Started: {{ $todos->where('stage', 'started')->count() }}
            </div>
        </div>
        <div class="w-full md:w-auto mb-2 md:mb-0">
            <div class="text-white bg-green-500 px-4 py-2 rounded-lg md:inline-block">
                Completed: {{ $todos->where('stage', 'completed')->count() }}
            </div>
        </div>
    </div>
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
        <span class="flex-grow">{{ $todo->task }}</span>
        <button wire:click="delete({{$todo->id}})" class="bg-red-600 text-white p-1 rounded">Delete</button>
      </div>
    @endforeach
  </div>
</div>
