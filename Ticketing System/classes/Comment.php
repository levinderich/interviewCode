<?php

class Comment
{
    private $message;
    private $ticketId;

    public function __construct($ticketId, $message)
    {
        $this->message = $message;
        $this->ticketId = $ticketId;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getTicketId()
    {
        return $this->ticketId;
    }

}
