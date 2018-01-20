<?php

/**
 * ItsCommandChain.php
 *
 * Chain of Command classes for handling server requests
 */
interface ICommand
{
    function onCommand($name, $args);
}

class ItsCommandChain
{
    private $_commands = array();

    public function addCommand($cmd)
    {
        $this->_commands[] = $cmd;
    }

    public function runCommand($name, $args)
    {
        foreach ($this->_commands as $cmd) {
            if ($cmd->onCommand($name, $args))
                return;
        }
    }
}

class GetTicketsCommand implements ICommand
{
    public function onCommand($name, $args)
    {
        if ($name != 'getTickets') return false;

        $email = $args['email'];

        $pdo = TicketsPDO::getInstance();
        $results = $pdo->getTicketData($email);

        $data = array();
        foreach ($results as $row) {
            $data[] = $row;
        }

        echo json_encode($data);

        return true;
    }
}

class GetCommentsCommand implements ICommand
{
    public function onCommand($name, $args)
    {
        if ($name != 'getComments') return false;

        $ticketId = $args['ticket-id'];

        $pdo = TicketsPDO::getInstance();
        $results = $pdo->getCommentData($ticketId);

        $data = array();
        foreach ($results as $row) {
            $data[] = $row;
        }

        echo json_encode($data);

        return true;
    }
}

class AddTicketCommand implements ICommand
{
    public function onCommand($name, $args)
    {
        if ($name != 'addTicket') return false;

        $user = new User($args['email'], $args['first-name'], $args['last-name']);
        $ticket = new Ticket($args['system'], $args['issue']);

        $pdo = TicketsPDO::getInstance();
        $pdo->insertUserData($user);
        $pdo->insertTicketData($ticket, $user);

        return true;
    }
}

class AddCommentCommand implements ICommand
{
    public function onCommand($name, $args)
    {
        if ($name != 'addComment') return false;

        $message = "<b>" . $args['name'] . ":</b> " . $args['comment'];
        $comment = new Comment($args['ticket-id'], $message);

        $pdo = TicketsPDO::getInstance();
        $pdo->insertCommentData($comment);

        return true;
    }
}


class UpdateTicketCommand implements ICommand
{
    public function onCommand($name, $args)
    {
        if ($name != 'updateStatus') return false;

        $ticketId = $args['ticket-id'];
        $status = $args['status'];

        $pdo = TicketsPDO::getInstance();
        $pdo->updateTicketData($ticketId, $status);

        return true;
    }
}
