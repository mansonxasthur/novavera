<?php


namespace App;


class Inquiry
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
    public $project;
    /**
     * @var string
     */
    public $location;
    /**
     * @var string
     */
    public $message;

    /**
     * Inquiry constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $project
     * @param string $location
     * @param string $message
     */
    public function __construct(string $name, string $email, string $project, string $location, string $message)
    {

        $this->name = $name;
        $this->email = $email;
        $this->project = $project;
        $this->location = $location;
        $this->message = $message;
    }
}