<?php
//==============================================================================/
// file name: clublist_config.php                                              //
//what to do: connect with db and return clublist data to clublist       page  //
//==============================================================================/

        // set up the connection variables
        $db_name  = 'formzip';
        $hostname = '127.0.0.1';
        $username = 'root';
        $password = 'gksehdeo357';

        // connect to the database
        $dbh = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);

        $sql = 'SELECT c_name,field,img_name FROM club';

        // use prepared statements, even if not strictly required is good practice
        $stmt = $dbh->prepare( $sql );

        // execute the query
        $stmt->execute();

        // fetch the results into an array
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

        // convert to json
        $json = json_encode( $result );
        // echo the json string
        echo $json;
?>