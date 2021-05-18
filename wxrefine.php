<!-- <?php
$link = mysqli_connect("localhost", "root", "", "popredict");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. Check your internet connection and try again." . mysqli_connect_error());
}

// Attempt insert query execution
$sql = "SELECT * FROM outwxdata ORDER BY OutTime DESC";


$result = mysqli_query($link, $sql);

/* fetch associative array */
while ($row = mysqli_fetch_assoc($result)) {
    $lat = $row["Lat"]; $long = $row["Lng"];
    $locname = $row["LocName"];
    $coord = "$lat, $long";
    $outID = $row["OutID"];

    $odates = $row["OutTime"];

    $ndate = date("Y-m-d", strtotime($odates));
    $nconv = date("H", strtotime($odates));
    // $ntime = intval($nconv);

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


$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[0]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[0]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[0]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[0]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[0]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[0]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[0]->{'dewpoint'};

$timee = "$ndate 00:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
        	echo "Unable to update" . mysqli_error($link);
        }



$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[1]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[1]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[1]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[1]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[1]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[1]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[1]->{'dewpoint'};

$timee = "$ndate 01:00:00";



echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }



$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[2]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[2]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[2]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[2]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[2]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[2]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[2]->{'dewpoint'};


$timee = "$ndate 02:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }


$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[3]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[3]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[3]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[3]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[3]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[3]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[3]->{'dewpoint'};


$timee = "$ndate 03:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }




$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[4]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[4]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[4]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[4]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[4]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[4]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[4]->{'dewpoint'};


$timee = "$ndate 04:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[5]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[5]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[5]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[5]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[5]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[5]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[5]->{'dewpoint'};


$timee = "$ndate 05:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }



$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[6]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[6]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[6]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[6]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[6]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[6]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[6]->{'dewpoint'};


$timee = "$ndate 06:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[7]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[7]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[7]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[7]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[7]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[7]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[7]->{'dewpoint'};


$timee = "$ndate 07:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[8]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[8]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[8]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[8]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[8]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[8]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[8]->{'dewpoint'};


$timee = "$ndate 08:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[9]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[9]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[9]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[9]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[9]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[9]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[9]->{'dewpoint'};


$timee = "$ndate 09:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[10]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[10]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[10]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[10]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[10]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[10]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[10]->{'dewpoint'};


$timee = "$ndate 10:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[11]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[11]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[11]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[11]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[11]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[11]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[11]->{'dewpoint'};


$timee = "$ndate 11:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }



$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[12]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[12]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[12]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[12]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[12]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[12]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[12]->{'dewpoint'};


$timee = "$ndate 12:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[13]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[13]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[13]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[13]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[13]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[13]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[13]->{'dewpoint'};


$timee = "$ndate 13:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[14]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[14]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[14]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[14]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[14]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[14]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[14]->{'dewpoint'};


$timee = "$ndate 14:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[15]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[15]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[15]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[15]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[15]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[15]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[15]->{'dewpoint'};


$timee = "$ndate 15:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[16]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[16]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[16]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[16]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[16]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[16]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[16]->{'dewpoint'};


$timee = "$ndate 16:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[17]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[17]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[17]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[17]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[17]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[17]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[17]->{'dewpoint'};


$timee = "$ndate 17:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[18]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[18]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[18]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[18]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[18]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[18]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[18]->{'dewpoint'};


$timee = "$ndate 18:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[19]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[19]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[19]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[19]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[19]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[19]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[19]->{'dewpoint'};


$timee = "$ndate 19:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[20]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[20]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[20]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[20]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[20]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[20]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[20]->{'dewpoint'};


$timee = "$ndate 20:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[21]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[21]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[21]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[21]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[21]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[21]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[21]->{'dewpoint'};


$timee = "$ndate 21:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[22]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[22]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[22]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[22]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[22]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[22]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[22]->{'dewpoint'};


$timee = "$ndate 22:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }

$temp = $data->{"historical"}->{"$ndate"}->{"hourly"}[23]->{'temperature'};
$precip = $data->{"historical"}->{"$ndate"}->{"hourly"}[23]->{'precip'};
$windSpd = $data->{"historical"}->{"$ndate"}->{"hourly"}[23]->{'wind_speed'};
$windGust = $data->{"historical"}->{"$ndate"}->{"hourly"}[23]->{'windgust'};
$press = $data->{"historical"}->{"$ndate"}->{"hourly"}[23]->{'pressure'};
$humid = $data->{"historical"}->{"$ndate"}->{"hourly"}[23]->{'humidity'};
$dew = $data->{"historical"}->{"$ndate"}->{"hourly"}[23]->{'dewpoint'};


$timee = "$ndate 23:00:00";


echo $outID . "," . $temp . "," . $precip . "," . $windSpd . "," . $windGust . "," . $press . "," . $humid . "," . $dew ;

$sql2 = "INSERT INTO outwxdata 
        (LocName, Lat, Lng, OutTime, Type, Temp, Precip, WindSpd, WindGust, Press, Humid, Dew) 
        VALUES 
        ('$locname', '$lat', '$long', '$timee', 'No outage', '$temp', '$precip', '$windSpd', '$windGust', '$press', '$humid', '$dew' )";


if (mysqli_query($link, $sql2)){
        }else{
          echo "Unable to update" . mysqli_error($link);
        }



}



curl_close($ch);


?>
 -->