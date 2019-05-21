<?php


namespace App;


class ConsultationRequest
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
     * ConsultationRequest constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     */
    public function __construct(string $name, string $email, string $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }
}