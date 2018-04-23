<?php
namespace romaloverboy\partner\models;

use yii\base\Model;
use Yii;
class lopez extends Model{
	
   public function square_preview($file, $size, $path, $_path){
	   // Открываем оригинальное изображение
	   header("Content-Type: image/jpg");
	   $random_string = mt_rand(55, 99999999999999);
	   $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
	   //$source = imagecreatefromjpeg($file);
	   list($w_i, $h_i, $type) = getimagesize($file);
	   $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
	   if ($ext) {
		$func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
        // Создаём дескриптор для работы с исходным изображением
	    $source = $func($file);
	   } else {
		   echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
		   return false;
    }
	   // Получаем размеры оригинального изображения
	   
	   list($width, $height) = getimagesize($file);
	   // Превью
	   $thumbs = imagecreatetruecolor($size, $size);
	   // Горизонтальное изображение
	   if ($width > $height && $width > $size){
		   imagecopyresampled($thumbs, $source, 0, 0, (($width-$height)/2), 0, $size, $size, $height, $height);
		   }
		   // Вертикальное изображение
		   elseif ($height > $width && $height > $size){
			   imagecopyresampled($thumbs, $source, 0, 0, 0, (($height-$width)/2), $size, $size, $width, $width);
			   }
			   // Если квадрат
			   elseif ($height == $width && $height > $size){
				   imagecopyresampled($thumbs, $source, 0, 0, 0, 0, $size, $size, $width, $width);
				   } else {
					   $thumbs = $source;
					   }
					   // Выводим изображение
					  
					 $progm = $path . $random_string . "." . $ext;
					 $save_to_db = $_path . $random_string . "." . $ext;
					 imagejpeg($thumbs, $progm);
					 
					 return $save_to_db;
					 }
}
?>