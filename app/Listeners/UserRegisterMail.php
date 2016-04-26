<?php

namespace App\Listeners;

use App\User;
use Illuminate\Contracts\Mail\Mailer;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterMail
{
    protected $mailer;
    protected $userModel;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer, User $userModel)
    {
        $this->mailer = $mailer;
        $this->userModel = $userModel;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user = $this->userModel->find($event->userId);

        // отправить письмо пользователю
        $email = $user->email;

        $this->mailer->send('emails.user_registered', compact('user'), function ($m) use ($email) {
            $m->from(config('marketplace.email'))
                ->to($email)
                ->subject(config('marketplace.emailUserRegistered'));
        });
    }
}
