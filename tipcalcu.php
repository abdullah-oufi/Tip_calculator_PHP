<!DOCTYPE html>
<html>
<head>
	<title>Tips calculator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>

<?php
$true = false;
$active_custom = false;
$color=$error='';
$checked = 15;
$che=true;
$split = 1;
$custom= $custom_r='';
//print_r($_POST);

if (isset($_POST) 
	&& isset($_POST['bill'])
	&& isset($_POST['radio'])
	&& isset($_POST['split']) ) {
	if (	is_numeric($_POST['bill']) 
		&& 	(is_numeric($_POST['radio']) || $_POST['radio']== 'custom' )
		&& 	is_numeric($_POST['split'])  ){
		if ( $_POST['bill']>0	&&	$_POST['radio']>0 && $_POST['split']>0){
			if ($_POST['split'] > 1) { $split = $_POST['split']; }
			$bill = abs($_POST['bill']);
			$checked = abs($_POST['radio']);
			$tip = $bill*0.01*abs($_POST['radio']);	
			$total = $tip+ $bill;
			$true = true;
			$value = $bill;
			
		}else if($_POST['bill']>0	&&	$_POST['radio']=='custom' && $_POST['split']>0){
			if ($_POST['split'] > 1) { $split = $_POST['split']; }
			$active_custom = true;
			$custom = $_POST['custom'];// valor numerico
			$custom_r = $_POST['radio'];// valor de texto custom
			$bill = abs($_POST['bill']);
			$checke_custom = abs($custom);
			$tip = $bill*0.01*abs($custom);	
			$total = $tip+ $bill;
			$true = true;
			$value = $bill;

		}else{$value = $_POST['bill'];$error='<div class="alert alert-danger" role="alert"> <strong>Heads up!</strong> This alert needs your attention, Your input is Not a Positive Value. </div>';$color='has-error';}
	}else{$value = $_POST['bill'];$error='<div class="alert alert-danger" role="alert"> <strong>Heads up!</strong> This alert needs your attention, Your input is Not a Number. </div>';$color='has-error';}
}else{$value = 0;}

?>

<body>
	<br /><div class="row list" >
	  <div class="col-md-4 col-md-offset-4 alert alert-info" >
	  <form method="POST" action="#">	  
	  <ol class="breadcrumb text-center">
	  		<li class="active text-center">Tip-Calculator</li>
		</ol>
		<hr>
	  	<div class="row">
		  <div class="col-md-12 text-center">
		  	<h2>Tip Calculator</h2>
		  </div>
		</div><br /><br />
		<div class="row">
		  <div class="col-md-12">
		  	<label>Bill Subtotal</label><?php print $error;?>	  	
		  	<?php print "<div class='input-group has-warning $color'>";?>
			  	<span class="input-group-addon">$</span>
			  	
			  	<?php print "<input placeholder='12.34' type='text'  name='bill' class='form-control $color ' value ='$value' aria-label='Amount (to the nearest dollar)'>";?>
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
				print '  <input type="radio" name="radio" value="'.$valor.'"';
				if ($valor%$checked==0 && $che==true && $active_custom == false) {print 'checked';$che=false;}
		  		print '  > '.$valor.'%  '; 
				print '</label>';
			}
			print '<br /><div class="row">';
			print '  	<div class="col-md-12 form-group">';
			print '			<input type="radio" name="radio" value="custom" ';
			if ($custom_r == 'custom' && $che==true && $active_custom == true) {print 'checked';$che=false;}
		  	print '		> <label >Custom: ';
		  	print "		<input type='text' size='3' name='custom' value='$custom'> %</label>";
			print '	</div>';
			print '</div>';
			unset($valor); 
		  ?>
		  </div>
		</div><br />
		<div class="row form-inline">
		  	<div class="col-md-12 form-group">
		  		<label>Split: </label>
		    	<?php print "<input class='form-control' placeholder='1' size='3' type='text' name='split' value='$split'> <label>  person(s)</label>";?>
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
			print '    Total: <strong>$'.number_format($total,2).'</strong>';
			if (isset($split) && $split>1) {
				print '    <hr>';
				print '    Tip each: $'.number_format(($tip/$split),2);
				print '    <br />';
				print '    Total each: $'.number_format(($total/$split),2);
			}
			print '  </div>';
			print '</div>';
			unset($bill);
			unset($tip);
			unset($total);
			unset($true);
			unset($value);
			unset($split);
		}		

		?>
		<div class="row">
		  	<div class="col-md-12">
		  		<button type="submit" class="btn btn-success btn-lg btn-block">Calculate Tip!</button>
			</div>
		</div>
		</form>
	  </div>
	</div>
</body>
</html>
