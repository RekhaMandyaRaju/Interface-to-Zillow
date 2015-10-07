<?php
header('Access-Control-Allow-Origin: *');

$street_address=$_GET['street'];
$city=$_GET['city'];
$state=$_GET['state'];
	
 
 $url="http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1dxhzezgaob_5rw5j&address=".urlencode($street_address)."&citystatezip="
				.urlencode($city)."%2C+".urlencode($state)."&rentzestimate=true"; 
/*$url="http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1dxhzezgaob_5rw5j&address=666+Vineland+Ave&citystatezip=la+puente%2C+CA&rentzestimate=true";*/
 $xml =  new SimpleXMLElement($url,0,true);
$zpid=$xml->response->results->result->zpid;
$url1="http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1dxhzezgaob_5rw5j&unit-type=percent&zpid=$zpid&width=600&height=300&chartDuration=1year";
$url2="http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1dxhzezgaob_5rw5j&unit-type=percent&zpid=$zpid&width=600&height=300&chartDuration=5years";
$url3="http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1dxhzezgaob_5rw5j&unit-type=percent&zpid=$zpid&width=600&height=300&chartDuration=10years"; 	

$xml1= new SimpleXMLElement($url1,0,true);
$xml2= new SimpleXMLElement($url2,0,true);
$xml3= new SimpleXMLElement($url3,0,true);

if(($xml->response->results->result->zestimate->valueChange !=null) && !empty($xml->response->results->result->zestimate->valueChange) && ($xml->response->results->result->zestimate->valueChange > 0))
$estValSign="+";
else if(($xml->response->results->result->zestimate->valueChange !=null) && !empty($xml->response->results->result->zestimate->valueChange) && ($xml->response->results->result->zestimate->valueChange < 0))
$estValSign="-";
else
$estValSign="";

if(($xml->response->results->result->rentzestimate->valueChange != null) && !empty($xml->response->results->result->rentzestimate->valueChange) &&
($xml->response->results->result->rentzestimate->valueChange > 0))
$rentEstValSign="+";

else if(($xml->response->results->result->rentzestimate->valueChange != null) && !empty($xml->response->results->result->rentzestimate->valueChange) &&
($xml->response->results->result->rentzestimate->valueChange < 0))	
$rentEstValSign="-";
else
$rentEstValSign="";


date_default_timezone_set('America/Los_Angeles');
if(($xml->response->results->result->zestimate->{'last-updated'} != null) && !empty($xml->response->results->result->zestimate->{'last-updated'}))
$lastUpdated =(string)(date('d-M-Y',(strtotime($xml->response->results->result->zestimate->{'last-updated'}))));
else
$lastUpdated="";

if(($xml->response->results->result->links->homedetails !=null) && !empty($xml->response->results->result->links->homedetails))
$homeDetails=(string)$xml->response->results->result->links->homedetails;
else
$homeDetails="";

if(($xml->response->results->result->address->street != null) && !empty($xml->response->results->result->address->street))
$street= (string)$xml->response->results->result->address->street;
else
$street="";

if(($xml->response->results->result->address->city != null) && !empty($xml->response->results->result->address->city))
$city= (string)$xml->response->results->result->address->city;
else
$city="";

if(($xml->response->results->result->address->state != null) && !empty($xml->response->results->result->address->state))
$state= (string)$xml->response->results->result->address->state;
else
$state="";

if(($xml->response->results->result->address->zipcode != null) && !empty($xml->response->results->result->address->zipcode))
$zipcode=(string)$xml->response->results->result->address->zipcode;
else
$zipcode="";

if(($xml->response->results->result->useCode != null) && !empty($xml->response->results->result->useCode))
$useCode = (string)$xml->response->results->result->useCode;
else
$useCode="";

if(($xml->response->results->result->lastSoldPrice !=null) && !empty($xml->response->results->result->lastSoldPrice))
$lastSoldPrice=(string)(number_format(floatval($xml->response->results->result->lastSoldPrice),2));
else
$lastSoldPrice="";

if(($xml->response->results->result->yearBuilt !=null) && !empty($xml->response->results->result->yearBuilt))
$yearBuilt=(string)$xml->response->results->result->yearBuilt;
else
$yearBuilt="";

if(($xml->response->results->result->lastSoldDate != null) && !empty($xml->response->results->result->lastSoldDate))
$lastSoldDate=(string)date('d-M-Y',(strtotime($xml->response->results->result->lastSoldDate)));
else
$lastSoldDate="";

if(($xml->response->results->result->lotSizeSqFt != null) && !empty($xml->response->results->result->lotSizeSqFt))
$lotSizeSqFt=(string)$xml->response->results->result->lotSizeSqFt;
else
$lotSizeSqFt="";

if(($xml->response->results->result->zestimate->amount !=null) && !empty($xml->response->results->result->zestimate->amount))
$estimateAmount=(string)(number_format(floatval($xml->response->results->result->zestimate->amount),2));
else
$estimateAmount="";

if(($xml->response->results->result->finishedSqFt != null) && !empty($xml->response->results->result->finishedSqFt))
$finishedSqFt=(string)(number_format(floatval($xml->response->results->result->finishedSqFt)));
else
$finishedSqFt="";

if(($xml->response->results->result->zestimate->valueChange !=null) && !empty($xml->response->results->result->zestimate->valueChange))
$eValueChange=(string)(number_format(floatval(abs($xml->response->results->result->zestimate->valueChange)),2));
else
$eValueChange="";

if(($xml->response->results->result->bathrooms != null) && !empty($xml->response->results->result->bathrooms))
$bathrooms = (string)$xml->response->results->result->bathrooms;
else
$bathrooms="";

if(($xml->response->results->result->zestimate->valuationRange->low != null) && !empty($xml->response->results->result->zestimate->valuationRange->low))
$valRangeLow=(string)(number_format(floatval($xml->response->results->result->zestimate->valuationRange->low),2));
else
$valRangeLow="";

if(($xml->response->results->result->zestimate->valuationRange->high != null) && !empty($xml->response->results->result->zestimate->valuationRange->high))
$valRangeHigh=(string)(number_format(floatval($xml->response->results->result->zestimate->valuationRange->high),2));
else
$valRangeHigh="";

if(($xml->response->results->result->bedrooms != null) && !empty($xml->response->results->result->bedrooms))
$bedrooms=(string)$xml->response->results->result->bedrooms;
else
$bedrooms="";

if(($xml->response->results->result->rentzestimate->{'last-updated'} !=null) && !empty($xml->response->results->result->rentzestimate->{'last-updated'}))
$rlastUpdate=(string)(date('d-M-Y',(strtotime($xml->response->results->result->rentzestimate->{'last-updated'}))));
else
$rlastUpdate="";

if(($xml->response->results->result->rentzestimate->amount != null) && !empty($xml->response->results->result->rentzestimate->amount))
$restimateAmount=(string)(number_format(floatval($xml->response->results->result->rentzestimate->amount),2));
else
$restimateAmount="";

if(($xml->response->results->result->taxAssessmentYear != null) && !empty($xml->response->results->result->taxAssessmentYear))
$taxAssessYr=(string)($xml->response->results->result->taxAssessmentYear);
else
$taxAssessYr="";

if(($xml->response->results->result->rentzestimate->valuationRange->low != null) && !empty($xml->response->results->result->rentzestimate->valuationRange->low))
$rentValLow=(string)(number_format(floatval($xml->response->results->result->rentzestimate->valuationRange->low),2));
else
$rentValLow="";

if(($xml->response->results->result->rentzestimate->valuationRange->high !=null) && !empty($xml->response->results->result->rentzestimate->valuationRange->high))
$rentValHigh=(string)(number_format(floatval($xml->response->results->result->rentzestimate->valuationRange->high),2));
else
$rentValHigh="";

if(($xml->response->results->result->rentzestimate->valueChange != null) && !empty($xml->response->results->result->rentzestimate->valueChange))
$restValChange=(string)(number_format(floatval(abs($xml->response->results->result->rentzestimate->valueChange)),2));
else
$restValChange="";

if(($xml->response->results->result->taxAssessment != null) && !empty($xml->response->results->result->taxAssessment))
$taxAssess=(string)(number_format(floatval($xml->response->results->result->taxAssessment),2));
else
$taxAssess="";

$array = 
   array("result" =>
array( "homedetails"=>$homeDetails,
 "street" =>$street,
"city"=>$city,
"state"=>$state,
"zipcode"=>$zipcode,
"useCode"=>$useCode,
"lastSoldPrice"=>$lastSoldPrice,
"yearBuilt"=>$yearBuilt,
"lastSoldDate"=>$lastSoldDate,
"lotSizeSqFt"=>$lotSizeSqFt,
"estimateLastUpdate"=>$lastUpdated,
"estimateAmount"=>$estimateAmount,
"finishedSqFt"=>$finishedSqFt,
"estimateValueChangeSign"=>$estValSign,
"imgn"=>"http://cs-server.usc.edu:45678/hw/hw6/down_r.gif",
"imgp"=>"http://cs-server.usc.edu:45678/hw/hw6/up_g.gif",
"estimateValueChange"=>$eValueChange,
"bathrooms"=>$bathrooms,
"estimateValuationRangeLow"=>$valRangeLow,
"estimateValuationRangeHigh"=>$valRangeHigh,
"bedrooms"=>$bedrooms,
"restimateLastUpdate"=>$rlastUpdate,
"restimateAmount"=>$restimateAmount,
"taxAssessmentYear"=>$taxAssessYr,
"restimateValueChangeSign"=>$rentEstValSign,
"restimateValueChange"=>$restValChange,
"taxAssessment"=>$taxAssess,
"restimateValuationRangeLow"=>$rentValLow,
"restimateValuationRangeHigh"=>$rentValHigh,
),
"chart"=>array("1year"=>array("url"=>(string)$xml1->response->url),
"5years"=>array("url"=>(string)$xml2->response->url),
"10years"=>array("url"=>(string)$xml3->response->url)
)

);


$jsonstring = json_encode($array);
echo $jsonstring;


?>	