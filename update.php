	<?php	
	
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "";
	
		for ($x = 1; $x <= 5; $x++) {
		
		
			$data = file_get_contents('http://publishers.spilgames.com/en/rss-3?limit=100&format=json&platform=Crossplatform&page='.$x);
			$hasil = json_decode($data);
			
			foreach($hasil->entries as $entry){
				$gameURL = $entry->gameUrl;
				$title = htmlentities(($entry->title), ENT_QUOTES);
				$discription =  htmlentities(($entry->description), ENT_QUOTES);
				$catagory = $entry->category;
				
				$thumbnails = $entry->thumbnails;
				$thumbnail = $thumbnails->large;
				
				//database code
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "INSERT INTO game (title, description, url, catagory, thumbnail)
						VALUES ('".$title."', '".$discription."', '".$gameURL."', '".$catagory."', '".$thumbnail."')";
						
				if (mysqli_query($conn, $sql)) {
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}

				mysqli_close($conn);
				
			}
		}
		
		$data = file_get_contents('http://www.htmlgames.com/rss/games.php?json');
		$hasil = json_decode($data);
		foreach($hasil as $entry){
			$gameURL = stripslashes($entry->url);
			$title = htmlentities(stripslashes($entry->name), ENT_QUOTES);
			$discription = htmlentities(stripslashes($entry->description), ENT_QUOTES);
			$catagory = $entry->category;
			$thumbnail = stripslashes($entry->thumb3);
			
			//database code
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			$sql = "INSERT INTO game (title, description, url, catagory, thumbnail)
						VALUES ('".$title."', '".$discription."', '".$gameURL."', '".$catagory."', '".$thumbnail."')";
					
			if (mysqli_query($conn, $sql)) {
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			mysqli_close($conn);
			
		}
		
		$data = file_get_contents('https://games.gamepix.com/games');
		$hasil = json_decode($data);
		
		foreach($hasil->data as $entry){
				$gameURL = $entry->url;
				$title = htmlentities(($entry->title), ENT_QUOTES);
				$discription =  htmlentities(($entry->description), ENT_QUOTES);
				$catagory = $entry->category;
				$thumbnail = $entry->thumbnailUrl;
				
				//database code
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				
				$sql = "INSERT INTO game (title, description, url, catagory, thumbnail)
						VALUES ('".$title."', '".$discription."', '".$gameURL."', '".$catagory."', '".$thumbnail."')";
						
				if (mysqli_query($conn, $sql)) {
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}

				mysqli_close($conn);
			
		}
		echo 'complete';
		
		
	?>