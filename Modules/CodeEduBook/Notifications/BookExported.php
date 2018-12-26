<?php

namespace CodeEduBook\Notifications;

use CodeEduBook\Models\Book;
use CodeEduUser\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookExported extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Book
     */
    private $book;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Book $book)
    {
        //
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'nexmo', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Seu livro foi expotado.")
                    ->greeting("Olá {$this->user->name}!")
                    ->line("O livro {$this->book->title} já foi xportado.")
                    ->action('Download', route('books.download', ['id', $this->book->id]))
                    ->line("Obrigado por usar a nossa aplicação.");
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
            ->content("O livro {$this->book->title} foi exportado. Fazer download em " . route('books.download', ['id', $this->book->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
