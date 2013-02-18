                                
<?php 
$json_url = "https://alpha-api.app.net/stream/0/posts/tag/mondaynightdanceparty";
$json = file_get_contents($json_url);
$json=str_replace('},]',"}]",$json);


$data = json_decode($json, true);


//echo "The size of this array is:  " . sizeof( $data['data'] );

$post_array = $data["data"];

//So a big array with a bunch of other arrays in side of it.  First we want to know how big our first array is. 


$post_array_size = sizeof( $post_array );


//counter

$cnt = 0;
// Connect to DB 
$con = mysql_connect("xxxxxxx","xxxxxx","xxxxxxx");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }else{

  	echo "Connection Successful!!!!!";
  }


//while we still have items left to process...keep going.
while ( $cnt < $post_array_size )
{
  //Get Mentions Array
	$mentions_array = $post_array[$cnt]["entities"]["mentions"];

	$mentions_array1 = $post_array[$cnt]["entities"]["mentions"];


	//Say who the user is
	$user = $post_array[$cnt]["user"]["username"];

	$result = mysql_query("SELECT Username FROM Account_info WHERE Username = '$user'");

     // row not found, do stuff...
	//echo "UsEr: " . $user;


//inserting name into db
	mysql_select_db("Currentcy", $con);

	//See how many items we have and go through them if there's some.
 	$mentions_size = sizeof( $mentions_array );
	if ( $mentions_size != 0 )
	{

		
		
		$mention_count = 0;
		while ( $mention_count < $mentions_size   )
		{
				$mentioned_name = $mentions_array[$mention_count]["name"] ;
				if ( $mentioned_name )
				{

					if(mysql_num_rows($result) != 0) {
					echo "Mentioned:  " . $mentioned_name . "<br>";


					mysql_query("INSERT INTO Mentions (User,Mentioned) VALUES ('$user','$mentioned_name')");
                    
				}
			}

				$mention_count++;
			}
	}

	echo "<hr>";



	$cnt++;											  



	}


mysql_close($con);

?>