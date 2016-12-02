<!DOCTYPE html>
<html>
<head>
	<title>Tips calculator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<?php
$true = false;
//print_r($_POST);

if (isset($_POST) 
	&& isset($_POST['bill'])
	&& isset($_POST['radio'])) {
	if (	is_numeric($_POST['bill']) 
		&& 	is_numeric($_POST['radio'])){
		if ( $_POST['bill']>0	&&	$_POST['radio']>0 ){
			$bill = abs($_POST['bill']);
			$tip = $bill*0.01*abs($_POST['radio']);	
			$total = $tip+ $bill;
			$true = true;
			$value = $bill;
		}else{$value = 0;}	
	}else{$value = 0;}
}else{$value = 0;}

?>

<body>
	<div class="row list" >
	  <div class="col-md-4 col-md-offset-4 alert alert-info" >
	  <form method="POST" action="#">	  
	  <ol class="breadcrumb">
	  		<li class="active">Tip Calculator</li>
		</ol>
	  	<div class="row">
		  <div class="col-md-12">
		  	<h2>Tip Calculator</h2>
		  </div>
		</div><br /><br />
		<div class="row">
		  <div class="col-md-12">
		  	<label>Bill Subtotal</label>		  	
		  	<div class="input-group has-warning">
			  	<span class="input-group-addon">$</span>
			  	
			  	<?php print "<input type='text' name='bill' class='form-control' value ='$value' aria-label='Amount (to the nearest dollar)'>";?>
			</div>
		  </div>
		</div><br />
		<div class="row">
		  <div class="col-md-5">
		  	<label>Tip Percentage</label>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  <?php
		  foreach (array(10, 15, 20) as &$valor) {			    
				print '<label class="radio-inline">';
				print '  <input type="radio" name="radio" value="'.$valor.'"> '.$valor.'%  '; 
				print '</label>';
			}
			unset($valor); 
		  ?>
		  </div>
		</div><br />
		
		<?php
		if (isset($total)&& isset($tip) && $true) {
			print '<div class="panel panel-default alert-warning">';
			print '  <div class="panel-body">';
			print '    SubTotal: $'.number_format($bill,2);
			print '    <br />';
			print '    Tip: $'.number_format($tip,2);
			print '    <br />';
			print '    Total: $'.number_format($total,2);
			print '  </div>';
			print '</div>';
			unset($bill);
			unset($tip);
			unset($total);
			unset($true);
			unset($value);
		}
		

		?>

		<div class="row">
		  	<div class="col-md-12">
		  		<button type="submit" class="btn btn-success btn-lg btn-block">Calculate!</button>
			</div>
		</div>
		</form>
	  </div>
	</div>
</body>
</html>