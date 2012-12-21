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

//while we still have items left to process...keep going.
while ( $cnt < $post_array_size )
{
  //Get Mentions Array
	$mentions_array = $post_array[$cnt]["entities"]["mentions"];
	//Say who the user is
	echo "User: " . $post_array[$cnt]["user"]["username"] . "<br>";
	
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
					echo "Mentioned:  " . $mentioned_name . "<br>";
					
				}
				$mention_count++;
			}
	}
		
	echo "<hr>";
	
	
	
	$cnt++;											  
		
		
	
	}




?>
