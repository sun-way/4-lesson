<?php
//$url='http://api.openweathermap.org/data/2.5/find?q=Moscow,RU&type=like&APPID=3a41967d489d2595e96206e848c4f0c4';

$link = 'http://api.openweathermap.org/data/2.5/weather';
//$apiKey0 = 'e355704a95bf17365dabbacffce37ad0';
$apiKey='f3d4855cbacbc20a8845e49073b854df';
$city = 'London';
$units = 'metric';
$url = "{$link}?q={$city}&units={$units}&appid={$apiKey}";
$data= file_get_contents( __DIR__.'/v.json');
$dataJson = json_decode($data,true);
?>

<html lang="ru">
<head>
    <title>home</title>
    <meta charset="utf-8">
</head>
<body>
<table border="1">
    <thead>
    <tr>
        <td>Погода</td>
        <td>Темпиратура</td>
        <td>Темпиратура минимум</td>
        <td>Температура максимум</td>
        <td>Давление</td>
        <td>Влажность</td>
    </tr>
    </thead>
    <tbody>
<?php foreach ($dataJson as $list=> $value) {?>
<?php if (!(empty($value))) { echo 'Нет данных  в  ' .$list .  '<br>'; }?>
<?php foreach ($value as $val) { ?>
<?php if (!(empty($val) )) { ?>
        <tr>
            <td> <?php  echo (isset( $val['weather'][0]['description'])) ? 'Погода::  '. ($val['weather'][0]['description']) :  'Ошибка декодирования json' ?></td>
            <td> <?php echo (isset( $val['main']['temp'])) ? 'Температура::  '.($val['main']['temp']-273)  :  'не удалось получить температуру' ?></td>
            <td> <?php echo (isset( $val['main']['temp_min'])) ? 'Температура минимум::  '. ($val['main']['temp_min']-273).'°C':  'не удалось получить температуру min' ?></td>
            <td> <?php echo (isset( $val['main']['temp_max'])) ? 'Температура максимум::  '. ($val['main']['temp_max']-273).'°C':  'не удалось получить температуру maх' ?></td>
            <td> <?php echo (isset( $val['main']['pressure'])) ? 'Давление::  '. (round(($val['main']['pressure']/1.3333),0)).' мм.рт.ст':  'не удалось получить давление' ?></td>
            <td> <?php echo (isset( $val['main']['humidity'])) ? 'Влажность::  '.($val['main']['humidity'])  :  'не удалось получить влажность' ?></td>
        <tr>
    <?php }
    else { exit('Ошибка '); } }?>
    <?php } ?>
    </tbody>
</table>

</body>
</html>



