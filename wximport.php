<!-- <?php
$link = mysqli_connect("localhost", "root", "", "popredict");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. Check your internet connection and try again." . mysqli_connect_error());
}

// Attempt insert query execution
$sql = "SELECT * FROM outwxdata ORDER BY OutTime DESC LIMIT 2";


$result = mysqli_query($link, $sql);

/* fetch associative array */
while ($row = mysqli_fetch_assoc($result)) {
    $lat = $row["Lat"]; $long = $row["Long"];
    $coord = "$lat, $long";
    $outID = $row["OutID"];

    $odates = $row["OutTime"];

    $ndate = date("Y-m-d", strtotime($odates));
    $nconv = date("H", strtotime($odates));
    $ntime = intval($nconv);

    // echo $coord. " " .$ntime. "\n";


  $queryString = http_build_query([
  'access_key' => '08f665a073fee2b9652ce76c796ae2aa',
  'query' => $coord,
  'historical_date' => $ndate,
  'hourly' => 1,
  'interval' => 1,
]);

$ch = curl_init(sprintf('%s?%s', 'https://api.weatherstack.com/historical', $queryString));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

// echo $response;
// }

$data = json_decode($response);


$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}["$ntime"]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}["$ntime"]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}["$ntime"]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}["$ntime"]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}["$ntime"]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}["$ntime"]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}["$ntime"]->{'dewpoint'};


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "UPDATE outwxdata 
         SET Temp = '$temp', 
         Precip = '$precip',
         WindSpd = '$windSpd', 
         WindGust = '$windGust', 
         Press = '$press', 
         Humid = '$humid', 
         Dew = '$dew' 
         WHERE OutID = '$outID'";


if (mysqli_query($link, $sql2)){
        }else{
        	echo "Unable to update" . mysqli_error($link);
        }
}

curl_close($ch);


?>
 -->