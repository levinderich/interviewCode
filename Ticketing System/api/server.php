<?php
/**
 * server.php
 *
 * Handles AJAX requests, implemented as a Chain of Commands
 */

function __autoload($class_name)
{
    require_once('../classes/' . $class_name . '.php');
}

$itsCC = new ItsCommandChain();

$itsCC->addCommand(new GetTicketsCommand());
$itsCC->addCommand(new GetCommentsCommand());
$itsCC->addCommand(new AddTicketCommand());
$itsCC->addCommand(new AddCommentCommand());
$itsCC->addCommand(new UpdateTicketCommand());

$name = $_REQUEST['command'];
// Everything after the command
$args = array_slice($_REQUEST, 1);

$itsCC->runCommand($name, $args);
