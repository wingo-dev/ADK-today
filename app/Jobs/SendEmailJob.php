<?php

namespace App\Jobs;

use App\Models\User;
use App\Utils\Common\UserRoles;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->details['type'] == 'email-verification') {
            $email = $this->details['email'];
            Mail::send("emails.postverification", [], function ($message) use ($email) {
                $message->to($email);
                $message->subject("Email Verified");
            });
        }
        else if ($this->details['type'] == 'admin-account-creation') {
            $email = $this->details['email'];
            $password = $this->details['password'];
            Mail::send("emails.admin-account-create-notification", ['email' => $email, 'password' => $password], function ($message) use ($email) {
                $message->to($email);
                $message->subject("Your Administrative Account Details");
            });
        }
        else if ($this->details['type'] == 'user-account-creation') {
            $email = $this->details['email'];
            $password = $this->details['password'];
            $role = $this->details['role'];
            Mail::send("emails.user-account-create-notification", ['email' => $email, 'password' => $password, 'role' => $role], function ($message) use ($email) {
                $message->to($email);
                $message->subject("Your Account Details");
            });
        }

        else if ($this->details['type'] == 'tag-suggestion') {
            $user_name = $this->details['user_name'];
            $category_name = $this->details['category_name'];
            $tag_name = $this->details['tag_name'];
            $admins = User::where('role', UserRoles::ADMIN)->orWhere('role', UserRoles::SUPER_ADMIN)->get();
            foreach ($admins as $admin) {
                Mail::send("emails.tag-suggestion-notification", ['user_name' => $user_name, 'category' => $category_name, 'tag' => $tag_name], function ($message) use ($admin) {
                    $message->to($admin->email);
                    $message->subject("Tag Suggesstion Notification");
                });
            }
        }
        if ($this->details['type'] == 'category-suggestion') {
            $user_name = $this->details['user_name'];
            $category_name = $this->details['category_name'];
            $admins = User::where('role', UserRoles::ADMIN)->orWhere('role', UserRoles::SUPER_ADMIN)->get();
            foreach ($admins as $admin) {
                Mail::send("emails.category-suggestion-notification", ['user_name' => $user_name, 'category' => $category_name], function ($message) use ($admin) {
                    $message->to($admin->email);
                    $message->subject("Category Suggesstion Notification");
                });
            }
        }
    }
}
