<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class NewFeedback extends Notification implements ShouldQueue
{
    use Queueable;

    private $fbk;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fbk)
    {
        $this->fbk = $fbk;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        // $task = $this->task;
        // $feedback->idea_id = $request->get( 'idea' );
        // $feedback->task_id = $request->get( 'task' );
        // $feedback->link_id = $request->get( 'link' );
        // $feedback->ques_id = $request->get( 'ques' );

        return (new SlackMessage)
            ->content('A user has submitted a new feedback.')
            ->attachment(function ($attachment) {
            // ->attachment(function ($attachment) use ($url) {
                $attachment->title($this->fbk->task->name."\n".$this->fbk->task->text)
                    ->content($this->fbk->comment)
                    ->fields([
                                'Idea' => $this->fbk->idea->name,
                                'Submitted by' => $this->fbk->user->fname,
                            ]);
                // $attachment->title('Submission')
                // $attachment->title($task->task->name, $url)
                           
            });
    }
}
