<?php

namespace App;

use DateTime;

class User {
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public DateTime $createdOn;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdOn = new DateTime();
    }

    public function getCreatedOn(): string 
    {
        return $this->createdOn->format('Y-m-d H:i:s');
    }
}
