<?php 

	include "Afro.php";

	get('/gamesAll/(.*?)/(.*?)/(.*?)', function($Afro, $limit, $page, $sort) {
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$return_arr = array();
		
		if(strpos(strtolower ("".$sort), strtolower ("t")) !== FALSE){
			$sql = "SELECT * FROM game ORDER BY ".$sort." ASC LIMIT ".(($page-1)*$limit).",".$limit;
		}
		else{
			$sql = "SELECT * FROM game ORDER BY ".$sort." DESC LIMIT ".(($page-1)*$limit).",".$limit;
		}
		$sql = "SELECT * FROM game ORDER BY ".$sort." DESC LIMIT ".(($page-1)*$limit).",".$limit;
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$row_array['id'] = $row['id'];
				$row_array['title'] = $row['title'];
				$row_array['url'] = $row['url'];
				$row_array['catagory'] = $row['catagory'];
				$row_array['thumbnail'] = $row['thumbnail'];
				$row_array['views'] = $row['views'];
				$row_array['description'] = $row['description'];
				array_push($return_arr,$row_array);
			}
		}
		mysqli_close($conn);
		echo json_encode($return_arr);
		
	});
	
	get('/gamesCategory/(.*?)/(.*?)/(.*?)/(.*?)', function($Afro, $limit, $page, $sort, $category) {
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$return_arr = array();
		
		$sql = "SELECT * FROM game  WHERE catagory = '".$category."' ORDER BY ".$sort." DESC LIMIT ".(($page-1)*$limit).",".$limit;
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$row_array['id'] = $row['id'];
				$row_array['title'] = $row['title'];
				$row_array['url'] = $row['url'];
				$row_array['catagory'] = $row['catagory'];
				$row_array['thumbnail'] = $row['thumbnail'];
				$row_array['views'] = $row['views'];
				$row_array['description'] = $row['description'];
				array_push($return_arr,$row_array);
			}
		}
		mysqli_close($conn);
		echo json_encode($return_arr);
		
	});
	get('/game/(.*?)', function($Afro,$gameID) {
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "arcadech_games";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$return_arr = array();
		
		$sql = "SELECT * FROM game  WHERE id = '".$gameID."'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$row_array['id'] = $row['id'];
				$row_array['title'] = $row['title'];
				$row_array['url'] = $row['url'];
				$row_array['catagory'] = $row['catagory'];
				$row_array['thumbnail'] = $row['thumbnail'];
				$row_array['views'] = $row['views'];
				$row_array['description'] = $row['description'];
				array_push($return_arr,$row_array);
			}
		}
		mysqli_close($conn);
		echo json_encode($return_arr);
		
	});
	

	get('/category/(.*?)', function() {
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$return_arr = array();
		$sql ="	SELECT DISTINCT catagory FROM `game` ORDER BY catagory ASC ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$row_array['catagory'] = $row['catagory'];
				array_push($return_arr,$row_array);
			}
		}
		mysqli_close($conn);
		echo json_encode($return_arr);
		
	});
	get('/search/(.*?)', function($Afro,$word) {
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$return_arr = array();
		
		$sql = "SELECT * FROM game WHERE title LIKE '%".$word."%' ORDER BY title";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$row_array['id'] = $row['id'];
				$row_array['title'] = $row['title'];
				$row_array['url'] = $row['url'];
				$row_array['catagory'] = $row['catagory'];
				$row_array['thumbnail'] = $row['thumbnail'];
				$row_array['views'] = $row['views'];
				$row_array['description'] = $row['description'];
				array_push($return_arr,$row_array);
			}
		}
		mysqli_close($conn);
		echo json_encode($return_arr);
	});
	get('/searchAvd/(.*?)/(.*?)', function($Afro,$word,$category) {
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$sql = "SELECT * FROM game WHERE title LIKE '%".$word."%' AND catagory = '".$category."' ORDER BY title";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$row_array['id'] = $row['id'];
				$row_array['title'] = $row['title'];
				$row_array['url'] = $row['url'];
				$row_array['catagory'] = $row['catagory'];
				$row_array['thumbnail'] = $row['thumbnail'];
				$row_array['views'] = $row['views'];
				$row_array['description'] = $row['description'];
				array_push($return_arr,$row_array);
			}
		}
		mysqli_close($conn);
		echo json_encode($return_arr);
	});
	get('/increment/view/(.*?)', function($Afro,$gameID) {
		$servername = "localhost";
		$username = "";
		$password = "";
		$dbname = "";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$view = 0;
		
		$sql = "SELECT * FROM game  WHERE id = '".$gameID."'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				
				$view = $row['views'];
			}
		}
		$view = $view+1;
		
		$sql2 = "UPDATE game SET views='".$view."' WHERE id='".$gameID."'";
		
		echo "".$view;
		
		mysqli_query($conn, $sql2);
		mysqli_close($conn);
	});

	

?>
