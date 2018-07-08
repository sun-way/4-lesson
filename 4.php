<?php

// формируем урл для запроса для Москвы

$url='http://api.openweathermap.org/data/2.5/find?q=Moscow,RU&type=like&APPID=3a41967d489d2595e96206e848c4f0c4';

$data = file_get_contents($url);
// если получили данные
if($data){
    // декодируем полученные данные
    $dataJson = json_decode($data);
    // получаем только нужные данные
    $arrayDays = $dataJson->list;
    // выводим данные
    foreach($arrayDays as $oneDay){
        echo'<h2>Погода в Москве</h2>';
        $date= date("d.m.Y", $oneDay->dt); //Дата
        echo "Дата: " . $date, "<br/>";

        // температура  днем
        $temp1=$oneDay->main->temp_max;
        $temp_ma=$temp1-273;
        $temp_ma=round($temp_ma,0);
        echo "максим темп-ра: " .$temp_ma . " °C" ."<br/>";

        // температура Но4ью
        $temp2=$oneDay->main->temp_min;
        $temp_mi=$temp2-273;
        $temp_mi=round($temp_mi,0);
        echo "миним темп-ра: " .$temp_mi." °C" ."<br/>";

        //echo "temp_min: " . $oneDay->main->temp_min-273 . "<br/>";
        //echo "Скорость ветра: " . $oneDay->main->speed . "<br/>";
        echo "Погода: " . $oneDay->weather[0]->description . "<br/>";

        $press=$oneDay->main->pressure;
        $press=$press/1.33333333;
        $press=round($press,1);
        echo "Давление: " . $press . "  мм.рт.ст". "<br/>";
        echo "Влажность: " . $oneDay->main->humidity . "<br/>";
        //echo "Текущая  температура : " . $oneDay ->main->temp . "<br/>";

        $temp3=$oneDay->main->temp;
        $temp_ob=$temp3-273;
        $temp_ob=round($temp_ob,0);
        echo "Текущая  температура: " .$temp_ob." °C" ."<br/>";
        //  weather -> day -> today -> temperature;
        echo "<hr/>";
    }
}else{
    echo "Сервер не доступен!";
}



?>