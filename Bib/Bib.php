<?php
require_once 'login.php';
echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .background{background: linear-gradient(orangered, gold)  no-repeat;background-size: cover ;}
        html { height: 100%; }
        body {height: 100%;}
    </style>
    <meta charset="utf-8">
    <title>Bib</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
</head>
<body class="background" >

<div class="container" align="center" >
    <h1>Model of Bib</h1><hr/>
_END;

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);

if (isset($_POST['username']) &&
    isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $queryUsers = "SELECT * FROM users WHERE username='$username'AND password='$password'";
    $users = $connection->query($queryUsers);
    $usersRows = $users->num_rows;
    
    if($usersRows == 0)
    {
        echo "<div align=\"left\"><h2>Error.This user does not exist.</h2>";
    }
    
    for ($j = 0 ; $j < $usersRows ; ++$j)
    {
        $users->data_seek($j);
        $userRow = $users->fetch_array(MYSQLI_ASSOC);
        $userLevel = $userRow['level'];
        
        if($userLevel == 1)
        {
            echo "<div align=\"left\"><h2>You can read next messages:</h2>";   
            $queryMessages = "SELECT * FROM bib WHERE level BETWEEN 1 AND 3";
            $messages = $connection->query($queryMessages);
            $messagesRows = $messages->num_rows;
            for ($i = 0 ; $i < $messagesRows ; ++$i)
            {
                $messages->data_seek($i);
                $messageRow = $messages->fetch_array(MYSQLI_ASSOC);
                $message = $messageRow['message'];
                $level = $messageRow['level'];
                echo "<strong>Message № $level : $message</strong><br>";
            }
            echo "</div>";
            
            echo "<div align=\"left\"><h2>You can write into next messages:</h2>";
            $query = "SELECT * FROM bib WHERE level = 1";
            $result = $connection->query($query);
            $resultRows = $result->num_rows;
            for ($a = 0 ; $a < $resultRows ; ++$a)
            {
                $result->data_seek($a);
                $resultRow = $result->fetch_array(MYSQLI_ASSOC);
                $level = $resultRow['level'];
                
                echo <<<_END
                <form method="POST" action="update.php">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><strong>Message № $level</strong></span>
                                <input type="text" class="form-control" placeholder="Tap here your message"
                                       aria-describedby="basic-addon1" name="message$level">        
                        </div>
                        <div class="form_group" align="center">
                            <input class="btn btn-primary" type="submit" value="Write" name="submitButton">
                        </div>
                </form>
_END;
            }
            echo "</div>"; 
        }
        
        elseif($userLevel == 2)
        {
            echo "<div align=\"left\"><h2>You can read next messages:</h2>";
            $queryMessages = "SELECT * FROM bib WHERE level BETWEEN 2 AND 3 ";
            $messages = $connection->query($queryMessages);
            $messagesRows = $messages->num_rows;
            for ($i = 0 ; $i < $messagesRows ; ++$i)
            {
                $messages->data_seek($i);
                $messageRow = $messages->fetch_array(MYSQLI_ASSOC);
                $message = $messageRow['message'];
                $level = $messageRow['level'];
                echo "<strong>Message № $level : $message</strong><br>";
            }
            echo "</div>";
            
            echo "<div align=\"left\"><h2>You can write into next messages:</h2>";
            $query = "SELECT * FROM bib WHERE level BETWEEN 1 AND 2";
            $result = $connection->query($query);
            $resultRows = $result->num_rows;
            for ($a = 0 ; $a < $resultRows ; ++$a)
            {
                $result->data_seek($a);
                $resultRow = $result->fetch_array(MYSQLI_ASSOC);
                $level = $resultRow['level'];
                
                echo <<<_END
                <form method="POST" action="update.php">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><strong>Message № $level</strong></span>
                                <input type="text" class="form-control" placeholder="Tap here your message"
                                       aria-describedby="basic-addon1" name="message$level">        
                        </div>
                        <div class="form_group" align="center">
                            <input class="btn btn-primary" type="submit" value="Write" name="submitButton">
                        </div>
                </form>
_END;
            }
            echo "</div>";
            
        }
        elseif($userLevel == 3)
        {
            echo "<div align=\"left\"><h2>You can read next messages:</h2>";
            $queryMessages = "SELECT * FROM bib WHERE level = 3 ";
            $messages = $connection->query($queryMessages);
            $messagesRows = $messages->num_rows;
            for ($i = 0 ; $i < $messagesRows ; ++$i)
            {
                $messages->data_seek($i);
                $messageRow = $messages->fetch_array(MYSQLI_ASSOC);
                $message = $messageRow['message'];
                $level = $messageRow['level'];
                echo "<strong>Message № $level : $message</strong><br>";
            }
            echo "</div>";
            
            echo "<div align=\"left\"><h2>You can write into next messages:</h2>";
            $query = "SELECT * FROM bib WHERE level BETWEEN 1 AND 3";
            $result = $connection->query($query);
            $resultRows = $result->num_rows;
            for ($a = 0 ; $a < $resultRows ; ++$a)
            {
                $result->data_seek($a);
                $resultRow = $result->fetch_array(MYSQLI_ASSOC);
                $level = $resultRow['level'];
                
                echo <<<_END
                <form method="POST" action="update.php">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><strong>Message № $level</strong></span>
                                <input type="text" class="form-control" placeholder="Tap here your message"
                                       aria-describedby="basic-addon1" name="message$level">        
                        </div>
                        <div class="form_group" align="center">
                            <input class="btn btn-primary" type="submit" value="Write" name="submitButton">
                        </div>
                </form>
_END;
            }
            echo "</div>";
        }
    }
}

$connection->close();

echo <<<_END
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
_END;


