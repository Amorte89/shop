<?php
require_once '../config/config.php';
checkFile();
function checkFile() {
    if ($_FILES) {
        if (($_FILES['upload_file']['type'] == 'image/gif') || ($_FILES['upload_file']['type'] == 'image/jpeg') || ($_FILES['upload_file']['type'] == 'image/png')
            && ($_FILES['upload_file']['size'] !=0 and $_FILES['upload_file']['size'] <= 512000)) //проверяем файл
        {
            $extension = 'jpeg';
            $filename = uniqid($_FILES['upload_file']['name']).'.'.$extension; //создаем уникальное имя файла (хотя не понял как удалить его предыдущее название)
            $upload = move_uploaded_file($_FILES["upload_file"]["tmp_name"], UPLOAD_DIR . $filename);
            if ($upload) {
                copy(UPLOAD_DIR . $filename, DEFULT_IMG . $filename);
            }
        }
        else echo "<p style='text-align: center'>Некоррeктный файл!</p>";
    }
}
function showImage() {
    if ($dir = opendir(DEFULT_IMG)) {
        while ($file = readdir($dir)) {
            if (is_file(DEFULT_IMG . $file)) {
                $path = IMG . $file;
                echo "<a href=\"{$path}\" target='_blank'><img src=\"{$path}\" alt='img'  style='width: 25%'></a><br>";
            }
        }
        closedir($dir);
    }
}

/*
 * Тут у меня нехватило соображения как вставить эту фунцию...
 * function create_thumbnail($path, $save, $width, $height) {
    $info = getimagesize($path); //получаем размеры картинки и ее тип
    $size = array($info[0], $info[1]); //закидываем размеры в массив

    //В зависимости от расширения картинки вызываем соответствующую функцию
    if ($info['mime'] == 'image/png') {
        $src = imagecreatefrompng($path); //создаём новое изображение из файла
    } else if ($info['mime'] == 'image/jpeg') {
        $src = imagecreatefromjpeg($path);
    } else if ($info['mime'] == 'image/gif') {
        $src = imagecreatefromgif($path);
    } else {
        return false;
    }

    $thumb = imagecreatetruecolor($width, $height); //возвращает идентификатор изображения, представляющий черное изображение заданного размера
    $src_aspect = $size[0] / $size[1]; //отношение ширины к высоте исходника
    $thumb_aspect = $width / $height; //отношение ширины к высоте аватарки

    if($src_aspect < $thumb_aspect) { 		//узкий вариант (фиксированная ширина) 		$scale = $width / $size[0]; 		$new_size = array($width, $width / $src_aspect); 		$src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //Ищем расстояние по высоте от края картинки до начала картины после обрезки 	} else if ($src_aspect > $thumb_aspect) {
        //широкий вариант (фиксированная высота)
        $scale = $height / $size[1];
        $new_size = array($height * $src_aspect, $height);
        $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0); //Ищем расстояние по ширине от края картинки до начала картины после обрезки
    } else {
        //другое
        $new_size = array($width, $height);
        $src_pos = array(0,0);
    }

    $new_size[0] = max($new_size[0], 1);
    $new_size[1] = max($new_size[1], 1);

    imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
    //Копирование и изменение размера изображения с ресемплированием

    if($save === false) {
        return imagepng($thumb); //Выводит JPEG/PNG/GIF изображение
    } else {
        return imagepng($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
    }

}*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Картинки</title>
</head>
<body>
<br>
<form action="" enctype="multipart/form-data" method="post" style="text-align: center">
    <input type="file" name="upload_file">
    <input type="submit" value="Загрузить">
</form>
<br><hr>
<?php
showImage();
?>
</body>
</html>

