<?php
// Array with names
/*
$a[] = "Anna";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Petunia";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";
*/

/*
$hint = "";
*/

// lookup all hints from array if $q is different from "" 
/*
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}
*/

// Output "no suggestion" if no hint was found or output correct values 
/*
echo $hint === "" ? "no suggestion" : $hint;
?>
*/

// get the q parameter from URL


/*
$dir    = '/articles';
$files = scandir($dir, 1);

Результатом будет нечто вроде:
Array
(
    [0] => somedir
    [1] => foo.txt
    [2] => bar.php
    [3] => ..
    [4] => .
)
*/











//Параметры запроса
$page = $_REQUEST["page"];
$count = $_REQUEST["count"];

//Количество статей всего
$dir    = './articles/';
$folders = scandir($dir, 1);
$count_of_articles = count($folders)-2;


//Номера первой и последней статей для отображения
$start_index = $count_of_articles - ($page-1)*$count;
$end_index = $count_of_articles - $page*$count + 1;
if ($end_index < 1){
    $end_index = 1;
}



//Заносим в массив значение количества статей
$arr[] = $count_of_articles;

//Добавляем в массив статьи
for ($i = $start_index; $i >= $end_index; $i--) {
    $title = file_get_contents('./articles/'.$i.'/title.txt', true);
    $text = file_get_contents('./articles/'.$i.'/text.txt', true);
    $image = './articles/'.$i.'/picture.jpg';
    $article = array('title' => $title, 'text' => $text, 'image' => $image);
    $arr[] = $article;
}

//Преобразование JSON
$response = json_encode($arr);

//Ответ
echo $response;
