<?php
// 파일명: clublist_config.php
// 설명: 클럽 명단을 가지고 오기 위해 db와 연동


// db와 연동하기 위한 기본 세팅
        $db_name  = 'formzip';
        $hostname = '127.0.0.1';
        $username = 'root';
        $password = 'gksehdeo357';

        // connect to the database(json으로 파일을 보내기 위해 PDO 방식 체택)
        $dbh = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
        // club table에서 필요한 내용 select
        $sql = 'SELECT c_name,field,img_name FROM club';

        // use prepared statements, even if not strictly required is good practice
        $stmt = $dbh->prepare( $sql );

        // execute the query
        $stmt->execute();

        // fetch the results into an array
        $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

        // json으로 변경
        $json = json_encode( $result );
        // echo the json string
        echo $json;
?>