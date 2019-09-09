<!DOCTYPE html>
<html>
    <head>
        <title>Final Project PHP 2</title> <!-- title changed -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'process.php'; ?>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
		
		<!-- INPUT FORM -->
		<div class="container">
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
			
            <div class="form-group"> <!-- form <label>s and <input name= changed -->
            <label>Title</label>
            <input type="text" name="title" class="form-control" 
                   value="<?php echo $title; ?>" placeholder="Enter title"> <!-- echo $ changed from $name to $title -->
            </div>
			
            <div class="form-group">
            <label>Artist</label>
            <input type="text" name="artist" 
                   value="<?php echo $artist; ?>" class="form-control" placeholder="Enter artist">
            </div>
			
			<div class="form-group">
            <label>Album</label>
            <input type="text" name="album" 
                   value="<?php echo $album; ?>" class="form-control" placeholder="Enter album">
            </div>
			
            <div class="form-group">
            <?php 
            if ($update == true): 
            ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button> 
            <?php endif; ?>
            </div>
        </form>
		
        </div>
		<a href="home.php"><u>Home</u></a>
		</div>
		
		
		
       
    </body>