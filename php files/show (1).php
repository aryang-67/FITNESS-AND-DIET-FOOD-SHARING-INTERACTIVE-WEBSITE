<head>
 <meta charset="utf-8">
<title>Recipe Hunt</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link href='https://fonts.googleapis.com/css?family=Bellefair  ' rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Kite one  ' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Fresca  ' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Salsa  ' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Acme  ' rel="stylesheet">
</head>

<body>

<?php
	include('conn.php');
	if(isset($_REQUEST['submit'])){
?><style>.hello{visibility:hidden;}</style><?php
		$hob = $_REQUEST['ch'];
		if(sizeof($hob)==0){
		}else{
			?>

			<script type="text/javascript">
		function valthis() {
var checkBoxes = document.getElementsByClassName( 'ch' );
var isChecked = false;
    for (var i = 0; i < checkBoxes.length; i++) {
        if ( checkBoxes[i].checked ) {
            isChecked = true;
        };
    };
    if ( isChecked ) {
        } else {
            alert( 'Please, check at least one checkbox!' );
        }   
}
				alert("You have selected <?php echo sizeof($hob) ?> items");
			</script>

			<?php
				$j="";
				for($x=0 ; $x<sizeof($hob) ; $x++){
					$j.="$hob[$x]";
					if($x!=sizeof($hob)-1){
						$j.=",";
					}
				}
				$k=sizeof($hob);
				$q="select * from receipe r inner join connection i on i.r_id = r.r_id where i.i_id IN ($j) group by r.r_name HAVING COUNT(*) = $k";
				$res=$conn->query($q);
				if($res){
					$chk=$res->num_rows;
					if($chk>0){
						?>
<h2 align="center" style="color:blue;font-size: 60px;font-family:Bellefair;">Possible Recipes</h2>
						<form action="" method="POST">
<p align="center" style="color:black;font-size: 20px;font-family:Fresca;">Select the recipe from the short listed ones to look upon.<br>Then click selected button.</p><div align="center">
<input type="submit" name="done" value="SELECTED" class="btn btn-success"></div>
						

						<?php
						while($fe=$res->fetch_object()){  
?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12" align="center">
						<br>
							<img  class="img-rounded" src="<?php echo $fe->imagesrc;?>" height="30%" width="30%">
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" align="center">
						<br><p style="color: red;font-size: 30px;font-weight:bold;font-family:Kite one;">
						<input type="radio" name="recipe" value="<?php echo $fe->r_name;?>">
							<?php echo $fe->r_name;?></p>
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" align="center">
						<br>
						<p style="color: black;font-size: 20px;font-family:Salsa;">
							<?php echo "INGREDIENTS: "; echo $fe->ing;?>
						</p>
						<br>
						</div>
					</div>
					
				</div>
				<?php if($fe=$res->fetch_object()) {  ?>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12" align="center">
						<br>
							<img class="img-rounded" src="<?php echo $fe->imagesrc;?>" height="30%" width="30%">
						<br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" align="center">
						<br><p style="color: red;font-size: 30px;font-weight:bold;font-family:Kite one;">
						<input type="radio" name="recipe" value="<?php echo $fe->r_name;?>">
							<?php  echo $fe->r_name;?>
						</p><br>
						</div>
					</div>
					<div class="row" align="center">
						<div class="col-md-12">
						<br>
						<p style="color: black;font-size: 20px;font-family:Salsa;">
							<?php echo "INGREDIENTS: "; echo $fe->ing;?>
						</p>
						<br>
						</div>
					</div>
					
				</div>
				<?php }else{ break 1;}?>
				
			</div>
		</div>
	</div>
	<?php
	}
	?>
						</form><?php
					}else{
						?><p align="center" style="color: black;font-size: 20px;font-family:Salsa;"><?php
						echo "Sorry no recipe found.";
						echo "<br />";
						echo "Would you like to contribute your recipe to the site.";
						?><a href='add.php'>Click here</a></p><?php
					}
				}
		}
	}
?>

<?php
	include('conn.php');
	if(isset($_REQUEST['done'])){
?><style>.hello{visibility:hidden;}</style><?php
		$has=$_REQUEST['recipe'];
		$sq = "select * from receipe where r_name='$has'";
		$rest = $conn->query($sq);
		if($rest){
?><h2 align="center" style="color:blue;font-size:60px;font-family:Bellefair">Recipe Details</h2><p style="color:black;font-size:20px;font-family:Salsa;" align="center">Here are the details of recipe you wanted to know about.</p>
<?php
			$fe = $rest->fetch_object();
?><center><img align="center" src="<?php echo $fe->imagesrc;?>"  style="border:10px solid;" class="img-rounded" height="40%" width="40%">
<br>
<figcaption align="center"><h2 style="color:red;font-weight:bold;font-family:Kite one;"><?php echo $fe->r_name; ?></h2></figcaption><br><br><br><h3 style="color:blue;font-family:Fresca;"><?php
echo "INGREDIENTS  REQUIRED";
echo "<br \>";

$tr = $fe->ing;
?></h3> <h4 style="color:black;font-family:Salsa;"> <?php echo wordwrap($tr,100,"<br>\n");
?></h4><br><br><br> <h3 style="color:blue;font-family:Fresca;"> <?php
echo "INSTRUCTIONS  TO  FOLLOW";
echo "<br \>";

$str = $fe->STEPS;?></h3> <h4 style="color:black;font-family:Salsa;"> 
<?php
echo wordwrap($str,100,"<br>\n");

?></h4><br><br><br> <h3 style="color:blue;font-family:Fresca;"> <?php
echo "SOURCE OF RECEIPE";
echo "<br \>";
$wet = "select * from restaurant where res_id=$fe->res_id";
$team = $conn->query($wet);
if($team){
	$tag = $team->fetch_object();
	$rt = $tag->res_name;

?></h3> <h4 style="color:black;font-family:Salsa;"> 
<?php
echo wordwrap($rt,100,"<br>\n");
}
}
				
	}
?>
<div class="hello">
<h2 align="center" style="color:blue;font-size:70px;font-family:Bellefair;">Choose your ingredients</h2><p style="color:black;font-size:20px;font-family:Salsa;" align="center">Left with ingredients and want to decide a recipe based upon that!<br>Choose the ingredients you have from below by ticking the check boxes.<br>After choosing press Submit button below.<br>In case you don't find your recipe and ingredient here, add one you think to cook.</p>
	<form action="" method="POST">

		<?php
			include('conn.php');
			$sql = "select * from ingredient";
			$re = $conn->query($sql);
			if($re){
			?><table align="center" class="table"><?php
			
				while($fes=$re->fetch_object()){
			
		?>
		<tr>
		<td width="20%" style="color:red;font-family:Kite one;font-size: 18px;font-weight:bold;"><input type="checkbox" name="ch[]" value="<?php echo $fes->i_id;?> ">
		<?php
			echo $fes->i_name;
			
			
		?></td>
		<?php if($fes=$re->fetch_object()){?>
		<td width="20%" style="color:red;font-family:Kite one;font-size: 18px;font-weight:bold;"><input type="checkbox" name="ch[]" value="<?php echo $fes->i_id;?> ">
		<?php
			echo $fes->i_name;
			
		}else{break;}?></td>

		<?php if($fes=$re->fetch_object()){?>
		<td width="20%" style="color:red;font-family:Kite one;font-size: 18px;font-weight:bold;"><input type="checkbox" name="ch[]" value="<?php echo $fes->i_id;?> ">
		<?php
			echo $fes->i_name;
				}
		else{break;}}}?></td>
		</tr>
	<tr><td colspan="3" align="center" style="font-family: salsa;font-size: 18px;">	
		<input type="submit" name="submit" value="Submit" class="btn btn-success"></td></tr>
</table>
	</form>
</div>
</body>
