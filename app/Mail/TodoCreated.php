<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;

use Illuminate\Queue\SerializesModels;
use App\Models\Todo;

class TodoCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $todo;

    /**
     * Create a new message instance.
     */
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Todo Created')
            ->from(new Address('ankitkaushik@gmail.com', 'Ankit'))
            ->replyTo(new Address('ankitkaushikmail@gmail.com', 'Ankit Kaushik'))
            ->view('emails.todo-created')
            ->with([
                'content' => 'Testing ' . $this->todo->task
            ]);
    }
}
