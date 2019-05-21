<?php


namespace App;


class Partner
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
    public $companyName;
    /**
     * @var string
     */
    public $jobTitle;
    /**
     * @var string
     */
    public $message;

    /**
     * Partner constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $companyName
     * @param string $jobTitle
     * @param string $message
     */
    public function __construct(string $name, string $email, string $phone, string $companyName, string $jobTitle, string $message)
    {

        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->companyName = $companyName;
        $this->jobTitle = $jobTitle;
        $this->message = $message;
    }
}