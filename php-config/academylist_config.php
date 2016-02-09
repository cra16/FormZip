<?php 
//==============================================================================/
// file name: academylist_config.php                                           //
//what to do: connect with db and return academylist data to academylist page  //
//==============================================================================/


// set up the connection variables
$db_name  = 'formzip';
$hostname = '127.0.0.1';
$username = 'root';
$password = 'gksehdeo357';

// connect to the database
$dbh = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);

$sql = 'SELECT a_name,dept,img_name FROM academy';

// use prepared statements, even if not strictly required is good practice
$stmt = $dbh->prepare( $sql );

// execute the query
$stmt->execute();

// fetch the results into an array
$result = $stmt->fetchAll( PDO::FETCH_ASSOC );

// convert to json
$json = json_encode( $result );

//close Database
$dbh = null;
// echo the json string
echo $json;
?>