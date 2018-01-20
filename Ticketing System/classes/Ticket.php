<?php

class Ticket
{
    public $system;
    public $issue;
    public $status;

    public function __construct($system, $issue, $status = "Pending")
    {
        $this->system = $system;
        $this->issue = $issue;
        $this->status = $status;
    }

    public function getSystem()
    {
        return $this->system;
    }

    public function getIssue()
    {
        return $this->issue;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
