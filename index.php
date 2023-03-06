<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries</title>
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
<form action="" method="POST" name="countriesAdd-form">
        <label>Country</label>
        <input type="text" name="country" class="form-control"/><br>
        <button type="submit" name="addButton" class="btn btn-success">Add Country to the File</button>
    </form><br>  

    <?php  
    
$file = fopen("countries.txt", 'a+'); fclose($file); //Если файла не существует, во избежание ошибки file_get_contents, он создается
 
$ourData = file_get_contents("countries.txt"); // получаем данные из файла 
$countries = json_decode($ourData, true); // Преобразуем в массив
// var_dump($countries); // выводим массив   

if (!empty($_POST['country'])){   // Проверка на значение в поле
    
    $country = $_POST['country'];

    $flag = true;

    if ($countries != null){
        foreach ($countries as $value) {    // Проверка на наличие в файле
            if($value===$country){
                echo "Данная страна уже существует в списке!";
                $flag = false;
                break;
            } 
        }
    }
    if($flag == true){
        $countries[]=$country;
    } 

    $json = json_encode($countries,JSON_UNESCAPED_UNICODE); //Кодирование массива в формат JSON
    $file = fopen("countries.txt", 'w'); //Открытие файла для перезаписи
        fwrite($file, $json);
    fclose($file);    
}
else{
    echo 'Введите значение!';
}

// Создание элемента select и вывода списка стран
    $str = "<br><select>";    
    $resultData = file_get_contents("countries.txt"); 
    $resultCountries = json_decode($resultData, true);
    if ($resultCountries != null){
        foreach ($resultCountries as $value) {    
            $str .= "<option>".$value."</option>";            
        }
    }   
    $str .= "</select>";
    echo $str;
//2 часть со словарём

    // $file2 = fopen("dictionary.txt", 'a+'); 
    // function getCountries() {
    //     $cntr = explode(PHP_EOL, file_get_contents("dictionary.txt"));
    //     return $cntr;
    // }
    // function checkCountry($countrY) {
    //     $countrs = getCountries();
    //     $flag = true;
    //     foreach ($countrs as $value) {    // Проверка на наличие в файле
    //         if($value===$countrY){
    //             echo "Данная страна уже существует в списке!";
    //             $flag = false;
    //             break;
    //         } 
    //     }
    //     if($flag == true){
    //     $countrs[]=$countrY;
    //     } 

    //             $json = json_encode($countrs,JSON_UNESCAPED_UNICODE); //Кодирование массива в формат JSON
    //     $file = fopen("countries.txt", 'w'); //Открытие файла для перезаписи
    //         fwrite($file, $json);
    //     }

    //     if(!empty($_POST['country'])) {
    //         $tmp = $_POST['country'];
    //             $status = checkCountry($tmp);
    //             print($status ? "Страна записалась." : "Страна не записалась.");
    //         }

    // //print_r(getCountries());
    // //fclose($file);
    // fclose($file2);
?>
   
</div>
</body>
</html>


    