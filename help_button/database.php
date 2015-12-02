<?php

//config:
$host = "localhost";
$databaseName = "";
$username = "";
$password = "";


$connectionString = "mysql:host=" . $host . ";dbname=" . $databaseName;

try 
{
    $pdo = new PDO($connectionString, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) 
{
    echo "
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset=\"UTF-8\">
            <title>Database Error</title>
	</head>
	<body>
            <h1>
		Their is a database error.
            </h1>
            <p>
		The error returned is:
		" . $e->getMessage() . "
            </p>
	</body>
    </html>";
}

?>