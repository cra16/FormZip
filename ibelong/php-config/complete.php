<?php 
	$button = $_GET ["submit"]; 
	$search = $_GET ["search"]; 

	if( !$search ) 
		echo "you didn't submit a keyword"; 
	//clublistpage로 돌아가기 + alert
	else { 
		if( strlen( $search ) <= 1 ) 
			echo "Search term too short"; 
		//clublistpast + alert

		else { 
			echo "You searched for <b> $search </b> <hr size='1' > </ br > "; 
			mysql_connect( "localhost","root","helloworld206") ; 
			mysql_select_db("formzip"); 

			$search_exploded = explode ( " ", $search ); 
			$x = 0; 

			foreach( $search_exploded as $search_each ) { 
				$x++; 
				$construct = ""; 
				if( $x == 1 ) 
					$construct ="club_name LIKE '%$search_each%'"; 
				else 
					$construct ="AND club_name LIKE '%$search_each%'"; 
			} 

				$construct = " SELECT * FROM club WHERE $construct "; 
				$run = mysql_query( $construct ); 
				$foundnum = mysql_num_rows($run); 
				if ($foundnum == 0){ 
					echo "Sorry, there are no matching result for <b>$search</b>. </br>
					 <br/> 1. Try more general words. for example: If you want to search 
					 'how to create a website' then use general keyword like 'create' 
					 'website' <br/> 2. Try different words with similar meaning <br/> 
					 3. Please check your spelling";
					 } 
				else { 
					echo "$foundnum results found !<p>"; 
					while( $runrows = mysql_fetch_assoc( $run ) ) { 
						$title = $runrows ['title']; 
						$desc = $runrows ['description']; 
						$url = $runrows ['url']; 
						echo "<a href='$url'> <b> $title </b> </a> <br> $desc <br> <a href='$url'> $url </a> <p>"; 
					} 
				} 
		} 
	} 

?>
