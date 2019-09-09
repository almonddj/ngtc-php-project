<!DOCTYPE html>
<html>
    <head>
        <title>Final Project PHP 2</title> <!-- title changed -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </head>
	
	
	
    <body>
	<h1>Home.php</h1>
              
		<!-- search bar -->
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> <!-- linked to search.php -->
		<div class="form-group">
		<label>search for...</label>
		<input type="text" name="keyword" required= "required" placeholder="Enter keyword"> 
		<button type="submit" class="btn btn-info" name="submit-search">SEARCH</button>
		</div>
		
		<!-- HTML OUTLINE for TABLE of DISPLAY AREA -->
		</form>
        <div class="container">
            <div class="row justify-content-center">
                <table class="table">
                    <thead><!--table headings-->
                        <tr>
                            <th>Title</th> 
                            <th>Artist</th>
							<th>Album</th>						
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>				
		<!-- PHP puts info into TABLE under the headings-->	
	<?php
		$mysqli = new mysqli('localhost', 'root', '', 'music') or die(mysqli_error($mysqli));
		$result = '';
		$keyword = '@@@';
		$queryResult = 0;
		if (isset($_POST['submit-search'])) {
			$keyword = mysqli_real_escape_string($mysqli, $_POST['keyword']);
			$sql = "SELECT * FROM music WHERE title LIKE '%$keyword%' OR artist 
			LIKE '%$keyword%' OR album LIKE '%$keyword%'";
			$result = mysqli_query($mysqli, $sql);
			$queryResult = mysqli_num_rows($result);
		}
	
		if ($queryResult > 0) { /*so$queryResult's value from inside the above IF statement carries through to here othrwse it wld b zero */
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td> <!-- echo $row['name']; changed to echo $row['title']; -->
                        <td><?php echo $row['artist']; ?></td> <!-- echo $row['location']; changed to echo $row['artist']; -->
						<td><?php echo $row['album']; ?></td> <!-- added -->
                        <td>
                            <a href="addRecord.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                               class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
		<?php endwhile; }?>    
                </table>
            </div>		
		<a href="addRecord.php">Add Record</a>
		
		
	
        
       
    </body>
	</html>