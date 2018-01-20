<?php

/**
 * Class TicketsPDO
 *
 * Database management code implemented using PDO
 */
class TicketsPDO
{
    private $db;
    private static $instance;

    // check if there is an instance of the class already created
    // If there is no instance then create TicketsPDO
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new TicketsPDO();
        }
        return static::$instance;
    }


    // Protected constructor to prevent creating a new instance of the
    // *Singleton* via the `new` operator from outside of this class.
    protected function __construct()
    {
        try {
            // Create the tickets database
            $this->db = new PDO('sqlite:../tickets.db');
            // Set errormode to exceptions
            $this->db->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            // Create the table in the database
            $this->createTables();
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    // Create the tables in the database
    public function createTables()
    {
        // Create the Tickets table
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS Tickets (
              id INTEGER PRIMARY KEY,
              status VARCHAR(255),
              system VARCHAR (255),
              issue VARCHAR(255),
              user_email VARCHAR(255),
              FOREIGN KEY (user_email) REFERENCES Users(email)
            )");
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }

        // Create the Users table
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS Users (
              email VARCHAR(255) PRIMARY KEY,
              first_name VARCHAR(255), 
              last_name VARCHAR (255)
            )");
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }

        // Create the Comments table
        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS Comments (
              id INTEGER PRIMARY KEY,
              ticket_id INTEGER,
              comment VARCHAR(255),
              FOREIGN KEY (ticket_id) REFERENCES Tickets(id)
            )");
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    // Insert ticket data into the Tickets table
    public function insertTicketData(Ticket $ticket, User $user)
    {
        try {
            // Get the values from the classes by calling the getter functions
            $status = $ticket->getStatus();
            $system = $ticket->getSystem();
            $issue = $ticket->getIssue();
            $email = $user->getEmail();

            // Prepare INSERT statement to SQLite3 file db
            $insert = "INSERT INTO Tickets (id, status, system, issue, user_email)
                VALUES (:id, :status, :system, :issue, :user_email)";
            $sql = $this->db->prepare($insert);
            $sql->bindParam(':status', $status);
            $sql->bindParam(':system', $system);
            $sql->bindParam(':issue', $issue);
            $sql->bindParam(':user_email', $email);

            $sql->execute();
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    // Insert user data into the Users table
    public function insertUserData(User $user)
    {
        try {
            // Get the values from the classes by calling the getter functions
            $email = $user->getEmail();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();

            // Prepare INSERT statement to SQLite3 file db
            $insert = "INSERT INTO Users (email, first_name, last_name)
                VALUES (:email, :first_name, :last_name)";
            $sql = $this->db->prepare($insert);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':first_name', $firstName);
            $sql->bindParam(':last_name', $lastName);

            $sql->execute();
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    // Insert comment data into the Comments table
    public function insertCommentData(Comment $comment)
    {
        try {
            // Get the values from the classes by calling the getter functions
            $message = $comment->getMessage();
            $ticketId = $comment->getTicketId();

            // Prepare INSERT statement to SQLite3 file db
            $insert = "INSERT INTO Comments (ticket_id, comment)
                VALUES (:ticket_id, :comment)";
            $sql = $this->db->prepare($insert);
            $sql->bindParam(':ticket_id', $ticketId);
            $sql->bindParam(':comment', $message);

            $sql->execute();
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    // Get the ticket data or get all ticket data where email matches
    public function getTicketData($email)
    {
        try {
            // Prepare INSERT statement to SQLite3 file db
            if ($email === "*") {
                $result = $this->db->query('SELECT * FROM Tickets');
            } else {
                $result = $this->db->query('SELECT * FROM Tickets WHERE user_email = ' . $this->db->quote($email));
            }
            return $result;
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    // Get all the comment data where the ticket id matches
    public function getCommentData($ticketId)
    {
        try {
            // Prepare select statement to SQLite3 file db
            $result = $this->db->query('SELECT * FROM Comments WHERE ticket_id = ' . $ticketId);
            return $result;
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    // Get all data from the user table
    public function getUserData()
    {
        try {
            // Prepare select statement to SQLite3 file db
            $result = $this->db->query('SELECT * FROM Users');
            return $result;
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }

    public function getMaxValue()
    {
        try {
            $result = $this->db->query('SELECT MAX(id) FROM Tickets');
            return $result;
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }


    // Update the ticket table with the new status
    public function updateTicketData($ticketId, $status)
    {
        try {
            // Prepare INSERT statement to SQLite3 file db
            $update = "UPDATE Tickets 
            SET status = :status
            WHERE id = :ticket_id";
            $sql = $this->db->prepare($update);
            $sql->bindParam(':status', $status);
            $sql->bindParam(':ticket_id', $ticketId);

            $sql->execute();
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
    }
}
