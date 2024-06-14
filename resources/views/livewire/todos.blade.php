<?php

use function Livewire\Volt\{state};

//
   state(['task']);

   $add = function(){
   \App\Models\Todo::create([
    'user_id'=> auth()->id(),
    'task'=> $this->task
   ]);
   }
?>

<div>
<form wire:submit="add">
  <input type="text" wire:model='task'><br><br>
  <button class="btn " type="submit">Add</button>
</form>


</div>
