<!-- 9f8c76d4fd53ab486067f853803a4afd -->
<?php
   if(empty($_GET['city']))
   {
   	echo '<script>alert("Enter the name of city")</script>';
   }
   else
   {
   	$city=$_GET['city'];
   	$api_url="https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=9f8c76d4fd53ab486067f853803a4afd";
   	$curl=curl_init();
   	curl_setopt($curl, CURLOPT_HEADER, 0);
   	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   	curl_setopt($curl, CURLOPT_URL, $api_url);
   	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
   	curl_setopt($curl, CURLOPT_VERBOSE, 0);
   	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   	$response = curl_exec($curl);
   	$data=json_decode($response,true);
   	$tempcelsius = $data['main']['temp'] - 273;

    $weather = "<b>".$data['name'].",".$data['sys']['country']."<br>".$tempcelsius."&deg;C</b> <br>";
    $weather .= "<b> weather Condition : </b>".$data['weather']['0']['description']."<br>";
    $weather .= "<b> Atmosperic pressure : </b>".$data['main']['pressure']."hpa <br>";
    $weather .= "<b> Wind Speed : </b>".$data['wind']['speed']."meter/sec <br>";
    $weather .= "<b> Cloudness : </b>".$data['clouds']['all']."%<br>";
    date_default_timezone_set('Asia/Calcutta');
    $sunrise = $data['sys']['sunrise'];
    $weather .= "<b> sunrise : </b>" .date("g:i a",$sunrise);
   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Current Whether</title>
</head>
<style>
	body{
		background-color: #8285a8;
		font-family: arial;
	}
	.Container{
		background-color: white;
		width: 500px;
		margin: auto;
	}
</style>
<body>
	<div class="Container">
		<h1>Search Any City Weather</h1>
		<form method="get" action="">
		Enter City : <input type="text" name="city" placeholder="Name of City"/><br/><br/>
		<input type="submit" name="submit" value="Enter"/>
	</form>
	<div class="output">
       <?php 
        if (!empty($weather)) {
          echo '<div class="alert alert-success mt-4" role="alert">
         '.$weather.'</div>';
        }
        ?> 
      </div>
	</div>

</body>
</html>