<?php
namespace App\Entity;


class Comment {
    private User $CurrentUser;
    private string $message;
    public function __construct(User $CurrentUser, string $message)     
    {
        $this->CurrentUser = $CurrentUser;
        $this->message = $message;

    }
    public function getCurrentUser():User {
        return $this->CurrentUser;
    }
    public function getMessage():string {
        return $this->message;
    }
}
