<?php
/*NO HTML HERE!! Linked to addRecord.php */

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'music') or die(mysqli_error($mysqli));

$last_id = 0;
$id = 0;
$update = false;
$title = ''; /* changed to $title from $name */
$artist = ''; /* changed to $artist from $location */
$album = ''; /* added */

if (isset($_POST['save'])){ /* "save" is the "name=" of button, connected to line 97 of index.php */
    $title = $_POST['title']; /* changed to 'title' from "name" is the "name=" of an input box connected to line 73 of index.php*/
    $artist = $_POST['artist']; /* changed to 'artist' from "location" is the "name=" of an input box connected to line 73 of index.php*/
	$album = $_POST['album']; /* added */
    $mysqli->query("INSERT INTO music (title, artist, album) VALUES('$title', '$artist', '$album')") or /* see p.443 @ id'less insertion letting AI do its thing */
            die($mysqli->error);
			
	$last_id = mysqli_insert_id($mysqli);
        
    $_SESSION['message'] = "Record has been saved! Title: $title Artist: $artist Album: $album ID is $last_id ";
    $_SESSION['msg_type'] = "success";
    
    header("location: addRecord.php");
    
}
/*below links to "delete" button that appears next to each result item in table */
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM music WHERE id=$id") or die($mysqli->error()); /* table changed from data to music */
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: addRecord.php");
}

/*below links to "edit" button that appears next to each result item in table */
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM music WHERE id=$id") or die($mysqli->error()); /* table changed from data to music */
    if (mysqli_num_rows($result)==1){
        $row = $result->fetch_array();
        $title = $row['title']; /* changed from... $name = $row['name']; */
        $artist = $row['artist']; /* changed from... $location = $row['location']; */
		$album = $row['album']; /* added */
    }
}

/* 'Update button only appears afterthe "edit" button is clicked */
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $title = $_POST['title']; /* changed from  $name = $_POST['name'];  */
    $artist = $_POST['artist']; /* changed from  $location = $_POST['location'];  */
	$album = $_POST['album']; /* added */
    
    $mysqli->query("UPDATE music SET title='$title', artist='$artist', album='$album' WHERE id=$id") or
            die($mysqli->error);
			
	/* changed from $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or
            die($mysqli->error);*/	
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: addRecord.php');
}