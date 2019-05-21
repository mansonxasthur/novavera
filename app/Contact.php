<?php

namespace App;

class Contact
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $inquiry;
    /**
     * @var string
     */
    public $message;

    /**
     * Contact constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $inquiry
     * @param string $message
     */
    public function __construct(string $name, string $email, string $phone, string $inquiry, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->inquiry = $inquiry;
        $this->message = $message;
    }
}