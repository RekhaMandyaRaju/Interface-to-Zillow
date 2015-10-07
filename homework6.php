<html>
<head>
<title>Homework6
</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
function validateForm(){
var x = document.forms["myForm"]["street_add"].value;
var y = document.forms["myForm"]["city"].value;
var z = document.forms["myForm"]["state"].value;

    if ((x==null || x=="") && ((y==null || y=="")) && ((z==null || z==""))) {
        alert(" Please enter value for Street,City and State");
        return false;
    }
else if((x==null || x=="") && (y==null || y=="")){
alert(" Please enter value for Street and City");
        return false;
    
}
else if((x==null || x=="") && (z==null || z=="")){
alert(" Please enter value for Street and State");
        return false;
}
else if((y==null || y=="") && (z==null || z=="")){
alert(" Please enter value for City and State");
        return false;
}
else if(x==null || x==""){
alert(" Please enter value for Street");
        return false;
}
else if(y==null || y==""){
alert(" Please enter value for City");
        return false;
}
else if(z==null || z==""){
alert(" Please enter value for State");
        return false;
}
else
{
return true;
}
}

</script>
</head>
<body>
<h1><center> Real Estate Search</center></h1>
<form name="myForm" action="homework6.php" onsubmit="return validateForm()" method="post">
<fieldset class="box">
<div class="subbox">
<div class="required">
<div class="street"><label>Street Address:</label></div> 
</div>
<div class="pos1">
<input type="text" name="street_add" value="<?php echo isset($_POST["street_add"]) ?
$_POST["street_add"] : "" ?>" style="width:180px;">
</div>
<div class="required">
<div class="city"><label>City:</label></div>
</div>
<div class="pos2">
<input type="text" name="city" value="<?php echo isset($_POST["city"]) ?
$_POST["city"] : "" ?>" style="width:180px;left:150px;">
</div>
<div class="required">
<div class="state"><label>State:</label></div>
</div>
<div class="pos3"> <select name="state" size="1">

        <option value="<?php echo isset($_POST["state"]) ?$_POST["state"] : "" ?>"> <?php echo isset($_POST["state"]) ?$_POST["state"] : "" ?> </option>
	<option value="AK">AK</option>

	<option value="AL">AL</option>
	<option value="AR">AR</option>
	<option value="AZ">AZ</option>
	<option value="CA">CA</option>

	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DC">DC</option>
	<option value="DE">DE</option>

	<option value="FL">FL</option>
	<option value="GA">GA</option>
	<option value="HI">HI</option>
	<option value="IA">IA</option>

	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="KS">KS</option>

	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="MA">MA</option>
	<option value="MD">MD</option>

	<option value="ME">ME</option>
	<option value="MI">MI</option>
	<option value="MN">MN</option>
	<option value="MO">MO</option>

	<option value="MS">MS</option>
	<option value="MT">MT</option>
	<option value="NC">NC</option>
	<option value="ND">ND</option>

	<option value="NE">NE</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>

	<option value="NV">NV</option>
	<option value="NY">NY</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>

	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="RI">RI</option>
	<option value="SC">SC</option>

	<option value="SD">SD</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>

	<option value="VA">VA</option>
	<option value="VT">VT</option>
	<option value="WA">WA</option>
	<option value="WI">WI</option>

	<option value="WV">WV</option>
	<option value="WY">WY</option>
</select>
</div>
<br />
<div class="search">
<input type="submit" name="search" value="search"/></div>
<div class="imgpos">
<img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_150x40_rounded.gif" width="150" height="40" alt="Zillow Real Estate Search" />
</div>
<div class="required"><div class="mand"><label></label>-<i> Mandatory fields</i></div></div>
</div>
</fieldset>
</form>

<?php if(isset($_POST['street_add']) && isset($_POST['city']) && isset($_POST['state'])) {?>
<?php
$param1= $_POST['street_add'];
$param1=str_replace(' ','+',$param1);
$param2= $_POST['city'];
$param2=str_replace(' ','+',$param2);

$url = 'http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1dxhzezgaob_5rw5j&address='
 .$param1. '&citystatezip=' . $param2. '%2C+'. $_POST['state'].'&rentzestimate=true';
$content = file_get_contents('http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1dxhzezgaob_5rw5j&address=2636+Menlo+Avenue&citystatezip=los+angeles%2C+CA&rentzestimate=true');
$xml=simplexml_load_string(file_get_contents($url));
?>
<?php if($xml->message->code == 0) {?>
<center>
<h1>Search Results</h1>
<table>
<tr><th colspan=4>See more details for <a target="_blank" href = "<?php echo isset($xml->response->results->result->links->homedetails)?($xml->response->results->result->links->homedetails):""; ?>">
<?php echo $xml->response->results->result->address->street ." , " . $xml->response->results->result->address->city ." , ". 
$xml->response->results->result->address->state . " - " .
$xml->response->results->result->address->zipcode?>
</a> on Zillow 
</th></tr>
<tr><td>Property Type:</td>
<td><?php echo (isset($xml->response->results->result->useCode) && !empty($xml->response->results->result->useCode))
?$xml->response->results->result->useCode:"N/A";?></td>
<td>Last Sold Price:</td>
<td style="text-align:right"><?php echo (isset($xml->response->results->result->lastSoldPrice) && !empty($xml->response->results->result->lastSoldPrice))?"$":""?>
<?php echo (isset($xml->response->results->result->lastSoldPrice) && !empty($xml->response->results->result->lastSoldPrice))?
number_format(floatval($xml->response->results->result->lastSoldPrice),2):"N/A";?></td>
</tr>

<tr><td>Year Built:</td>
<td><?php echo (isset($xml->response->results->result->yearBuilt) && !empty($xml->response->results->result->yearBuilt))?
$xml->response->results->result->yearBuilt:"N/A";?></td>
<td>Last Sold Date:</td>
<td style="text-align:right"><?php 
date_default_timezone_set('America/Los_Angeles');
echo (isset($xml->response->results->result->lastSoldDate) && !empty($xml->response->results->result->lastSoldDate))?
(date('d-M-Y',(strtotime($xml->response->results->result->lastSoldDate)))):"N/A";?></td>
</tr>

<tr><td>Lot Size:</td>
<td><?php echo (isset($xml->response->results->result->lotSizeSqFt) && !empty($xml->response->results->result->lotSizeSqFt))?
number_format(floatval($xml->response->results->result->lotSizeSqFt),0):"N/A";?>
<?php echo (isset($xml->response->results->result->lotSizeSqFt) && !empty($xml->response->results->result->lotSizeSqFt))?" sq.ft.":""?></td>
<td>Zestimate <sup>&reg;</sup> Property Estimate as of <?php
date_default_timezone_set('America/Los_Angeles');
 echo (isset($xml->response->results->result->zestimate->{'last-updated'}) && !empty($xml->response->results->result->zestimate->{'last-updated'}))?
(date('d-M-Y',(strtotime($xml->response->results->result->zestimate->{'last-updated'})))):""; ?>:</td>

<td style="text-align:right"><?php echo (isset($xml->response->results->result->zestimate->amount) && !empty($xml->response->results->result->zestimate->amount))?"$":""?>
<?php
echo (isset($xml->response->results->result->zestimate->amount) && !empty($xml->response->results->result->zestimate->amount))?
number_format(floatval($xml->response->results->result->zestimate->amount),2):"N/A";?></td>
</tr>

<tr><td>Finished Area:</td>
<td><?php echo (isset($xml->response->results->result->finishedSqFt) && !empty($xml->response->results->result->finishedSqFt))?
number_format(floatval($xml->response->results->result->finishedSqFt),0):"N/A";?> 
<?php echo (isset($xml->response->results->result->finishedSqFt) && !empty($xml->response->results->result->finishedSqFt))?" sq.ft.":""?></td>
<td>30 Days Overall Change

<?php if($xml->response->results->result->zestimate->valueChange > 0) {?>
<?php
$image = "http://cs-server.usc.edu:45678/hw/hw6/up_g.gif";  
$width = 10;
$height = 14;
echo '<img src="'.$image.'" style=width:"' . $width . 'px;height:' . $height . 'px;">';
?>

<?php }
else if($xml->response->results->result->zestimate->valueChange < 0){ ?>
<?php
$image = "http://cs-server.usc.edu:45678/hw/hw6/down_r.gif";  
$width = 10;
$height = 14;
echo '<img src="'.$image.'" style=width:"' . $width . 'px;height:' . $height . 'px;">';
?>
<?php } ?>

:</td>
<td style="text-align:right"><?php echo (isset($xml->response->results->result->zestimate->valueChange) && 
!empty($xml->response->results->result->zestimate->valueChange))?"$":""?>

<?php echo (isset($xml->response->results->result->zestimate->valueChange) && !empty($xml->response->results->result->zestimate->valueChange))?
number_format(floatval(abs($xml->response->results->result->zestimate->valueChange)),2):"N/A";?></td>
</tr>

<tr><td>Bathrooms:</td>
<td><?php echo (isset($xml->response->results->result->bathrooms) && !empty($xml->response->results->result->bathrooms))?
$xml->response->results->result->bathrooms:"N/A";?></td>
<td>All Time Property Range:</td>
<td style="text-align:right"><?php echo (isset($xml->response->results->result->zestimate->valuationRange->low)
&& !empty($xml->response->results->result->zestimate->valuationRange->low))?"$":""?>
<?php echo (isset($xml->response->results->result->zestimate->valuationRange->low) && !empty($xml->response->results->result->zestimate->valuationRange->low))?
(number_format(floatval($xml->response->results->result->zestimate->valuationRange->low),2)):"";?>

<?php echo (isset($xml->response->results->result->zestimate->valuationRange->low)
&& !empty($xml->response->results->result->zestimate->valuationRange->low))?"-":"" ?>  
<?php echo (isset($xml->response->results->result->zestimate->valuationRange->high) && !empty($xml->response->results->result->zestimate->valuationRange->high))?"$":""?>
<?php echo (isset($xml->response->results->result->zestimate->valuationRange->high) && !empty($xml->response->results->result->zestimate->valuationRange->high))?
(number_format(floatval($xml->response->results->result->zestimate->valuationRange->high),2)):"N/A";?></td>
</tr>

<tr><td>Bedrooms:</td>
<td><?php echo (isset($xml->response->results->result->bedrooms) && !empty($xml->response->results->result->bedrooms))
?$xml->response->results->result->bedrooms:"N/A";?></td>
<td style="width: 350px">Rent Zestimate <sup>&reg;</sup> Valuation as of <?php 
date_default_timezone_set('America/Los_Angeles');
echo (isset($xml->response->results->result->rentzestimate->{'last-updated'}) && !empty($xml->response->results->result->rentzestimate->{'last-updated'}))?
(date('d-M-Y',(strtotime($xml->response->results->result->rentzestimate->{'last-updated'})))):"";?>:</td>
<td style="text-align:right"><?php echo isset($xml->response->results->result->rentzestimate->amount)?"$":""?>
<?php echo (isset($xml->response->results->result->rentzestimate->amount) && !empty($xml->response->results->result->rentzestimate->amount))?
(number_format(floatval($xml->response->results->result->rentzestimate->amount),2)):"N/A"; ?></td>
</tr>

<tr><td>Tax Assessment Year:</td>
<td><?php 
echo (isset($xml->response->results->result->taxAssessmentYear) && !empty($xml->response->results->result->taxAssessmentYear))?
$xml->response->results->result->taxAssessmentYear:"N/A"; ?></td>
<td>30 Days Rent Change
<?php if($xml->response->results->result->rentzestimate->valueChange > 0) {?>
<?php
$image = "http://cs-server.usc.edu:45678/hw/hw6/up_g.gif";  
$width = 10;
$height = 14;
echo '<img src="'.$image.'" style=width:"' . $width . 'px;height:' . $height . 'px;">';
?>

<?php }
else if($xml->response->results->result->rentzestimate->valueChange < 0){ ?>
<?php
$image = "http://cs-server.usc.edu:45678/hw/hw6/down_r.gif";  
$width = 10;
$height = 14;
echo '<img src="'.$image.'" style=width:"' . $width . 'px;height:' . $height . 'px;">';
?>
<?php } ?>
:</td>

<td style="text-align:right"><?php echo (isset($xml->response->results->result->rentzestimate->valueChange)
&& !empty($xml->response->results->result->rentzestimate->valueChange))?"$":""?>
<?php echo (isset($xml->response->results->result->rentzestimate->valueChange) && !empty($xml->response->results->result->rentzestimate->valueChange))?
(number_format(floatval(abs($xml->response->results->result->rentzestimate->valueChange)),2)):"N/A";?>
</td>
</tr>

<tr><td>Tax Assessment:</td>
<td><?php echo (isset($xml->response->results->result->taxAssessment) && !empty($xml->response->results->result->taxAssessment))?"$":""?>
<?php echo (isset($xml->response->results->result->taxAssessment) && !empty($xml->response->results->result->taxAssessment))
?number_format(floatval($xml->response->results->result->taxAssessment),2):"N/A";?></td>
<td>All Time Rent Range:</td>
<td style="text-align:right"><?php echo (isset($xml->response->results->result->rentzestimate->valuationRange->low)
&& !empty($xml->response->results->result->rentzestimate->valuationRange->low))?"$":""?>
<?php echo (isset($xml->response->results->result->rentzestimate->valuationRange->low) && !empty($xml->response->results->result->rentzestimate->valuationRange->low))?
(number_format(floatval($xml->response->results->result->rentzestimate->valuationRange->low),2)) :"";?> 

<?php echo (isset($xml->response->results->result->zestimate->valuationRange->high)
&& !empty($xml->response->results->result->zestimate->valuationRange->high))?"-":"" ?>
 
<?php echo (isset($xml->response->results->result->rentzestimate->valuationRange->high) && !empty($xml->response->results->result->rentzestimate->valuationRange->high))?"$":""?>
<?php echo (isset($xml->response->results->result->rentzestimate->valuationRange->high) && !empty($xml->response->results->result->rentzestimate->valuationRange->high))?
(number_format(floatval($xml->response->results->result->rentzestimate->valuationRange->high),2)):"N/A";?></td>
</tr>
</table>
<h4> © Zillow, Inc., 2006-2014. Use is subject to <a target="_blank" href="http://www.zillow.com/corp/Terms.htm">Terms of Use</a>
<br/><a target="_blank" href="http://www.zillow.com/zestimate/">What's a Zestimate?</a></h4>
</center>
<?php }
else { ?>
<center><h2>No exact match found--Verify that the given address is correct</h2></center>
<?php } ?>

<?php } ?>

</body>
</html>

