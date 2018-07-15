<?php
$apiConfig = [
    'key' => '059d32e4933efe1aad5128e726d200c3',
    'url' => 'http://api.openweathermap.org/data/2.5/weather',
    'cityID' => 524901, // Moscow
    'units'=>'metric',
    'cityName'=>'Moscow',
];
if (isset($apiConfig['cityID'])) {
    $cityID = $apiConfig['cityID'];
} else {
    echo 'не  удалось  получить данные';
}
if (isset($apiConfig['cityName'])) {
    $cityID = $apiConfig['cityName'];
} else {
    echo 'не  удалось  получить данные';
}
$Url = "{$apiConfig['url']}?q={$apiConfig['cityName']}&units={$apiConfig['units']}&appid={$apiConfig['key']}";
$JSON = file_get_contents($Url);
if ($JSON !== false) {
    $responseArray = json_decode($JSON, true);
} else {
    exit('Невозможно получить данные с сервера');
}
if ($responseArray === null) {
    exit('Не возможно преобразовать данные из JSON');
}
$weather = $responseArray['weather'][0]['main'];
$temp = $responseArray['main']['temp'];
$windSpeed = $responseArray['wind']['speed'];
$windpressure = $responseArray['main']['pressure'];
$responseData = [];
$responseData[] = labelDataFactory('Погода', $weather);
$responseData[] = labelDataFactory('Температура', $temp);
$responseData[] = labelDataFactory('Ветер (скорость)', $windSpeed);
$responseData[] = labelDataFactory('Давление', $windpressure);
function taginator($tagname, $data,  $label = '') {
    if (empty($data)) {
        echo 'неуда4а';
    }
    echo "<$tagname>";

    if ($label) {
        echo "$label";
    }
    if (($tagname === 'ol' || $tagname === 'ul') && gettype($data) === 'array') {
        foreach ($data as $dataPice) {
            if (empty($dataPice)) {
                break;
            }
            echo '<li>', $dataPice['label'], ': ', $dataPice['data'], '</li>';
        }
    } else {
      echo $data;
    }
    echo "</$tagname>";
}

function labelDataFactory($label, $data) {
   if (empty($data)) {
        echo 'не  удалось  получить данные';
   }
    return [
     'label' => $label,
        'data' => $data,
   ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather</title>
</head>
<body>
    <?php
       taginator('h2', $responseArray['name'], 'Город: ');
       taginator('ul', $responseData);
    ?>
</body>
</html>
