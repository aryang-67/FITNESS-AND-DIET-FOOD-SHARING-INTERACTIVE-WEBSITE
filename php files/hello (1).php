<html>
<head><meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="newStyle.css">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



</head>
<body>
<center><img src="logo.png" ></center>
  <nav class="navbar navbar-inverse bg-inverse">
  <div class="container-fluid">
    <div class="navbar-header"> 
      <a class="navbar-brand"> Recipe Hunt</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    
      <li><a href='recipe.php' >Show all recipes</a></li>
    </ul>
  <ul class="nav navbar-nav ">
  <li><a href='add.php' >Add New Recipe</a></li>
</ul>
  </div>
</nav>


<br><br>


<?php
	include('conn.php');
	$query = "select * from receipe";
	$rs = $conn->query($query);
	$h=0;
	if($rs){
?>
<div class="container-fluid">
<?php 
	while($fe=$rs->fetch_object()){  
?>
	<div class="row">
		<div class="col-md-12">
			<div class="row" style="border:1px solid black;">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
						<br>
							<img class="img-rounded" src="<?php echo $fe->imagesrc;?>" height="30%" width="30%">
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<br>
							<?php echo $fe->r_name;?>
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" class="one" >
						<br>
							<?php echo $fe->ing;?>
						<br>
						</div>
					</div>
					<div class="row" class="one" >
						<div class="col-md-12">
						<br>
							<?php echo $fe->STEPS;?>
						<br>
						</div>
					</div>
				</div>
				<?php if($fe=$rs->fetch_object()) {?>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
						<br>
							<img class="img-rounded" src="<?php echo $fe->imagesrc;?>" height="30%" width="30%">
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<br>
							<?php echo $fe->r_name;?>
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" class="one" >
						<br>
							<?php echo $fe->ing;?>
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" class="one" >
						<br>
							<?php echo $fe->STEPS;?>
						<br>
						</div>
					</div>
				</div>
				<?php }else{break;}?>
				
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>
</div>
<?php
	} 
?>
</body>
</html>
