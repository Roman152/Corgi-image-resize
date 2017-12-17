<!--
	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
-->
<?php set_time_limit(600); header('Content-Type: text/html; charset=utf-8');?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
<title> Korgi jpegSizer - сжатие картинок jpeg на хостинге</title>
<style>body {text-align: center} table {margin: auto} td {text-align: center; border: 1px solid #ccc; padding: 12px 20px; background: #eee; width: 50%}
#custom-handle, #custom-handle1 {width: 2em;height: 1.6em;top: 50%;margin-top: -.8em;text-align: center; line-height: 1.6em; font-size: 0.8em; cursor: pointer}
.phptime {border: 1px solid #ccc; display: inline-block; position: fixed; bottom: 0px; right: 0px; padding: 10px 20px; background: #eee}
.imgresult {font-size: 12px;  background: rgba(255,255,255,0.5); padding: 20px 10px; margin-top: 20px}
.page {max-width: 1100px; margin: auto; background: rgba(255,255,255,0.5); padding: 20px 10px}
hr {color: #ccc; border: 1px solid #ccc;}
body {background: #000 url(https://roman152.github.io/korgijpegsize/fon.jpg); background-attachment: fixed; background-repeat: repeat;}
.header {background: rgba(0, 0, 0, 0.63); text-align: left; padding-left: 20px;}
.rightheader {float: right; margin: 50px 10px 0px 0px; text-align: right}
.rightheader a {color: #fff; text-decoration: none}
input[type="text"] {border: 1px solid #ccc; border-radius: 5px; padding: 5px 10px; background: #444; color: #fff}
.ui-slider-horizontal .ui-slider-range-min {left: 0; background: #4e4e4e;}
label {user-select: none;}

input[type=submit] {background: #555; border: 2px solid #444; border-radius: 4px; color: #fff; padding: 5px 10px; cursor: pointer}
input[type=submit]:hover {background: #000}

input[type=radio] {display: none;}
input[type=radio] + label:before {content: "\f096"; font-family: FontAwesome; display: inline-block; margin: 0px 5px 0px 0px; font-size: 16px; color: #222; width: 12px}
input[type=radio]:checked + label:before {content: "\f046"; font-family: FontAwesome; color: #fff}
input[type=radio] + label {background: #ddd; padding: 4px 10px; border-radius: 5px; cursor: pointer}
input[type=radio]:checked + label {background: #555; color: #fff}

input[type=checkbox] {display: none;}
input[type=checkbox] + label:before {content: "\f096"; font-family: FontAwesome; display: inline-block; margin: 0px 5px 0px 0px; font-size: 16px; color: #222; width: 12px}
input[type=checkbox]:checked + label:before {content: "\f046"; font-family: FontAwesome; color: #fff;}
input[type=checkbox] + label {background: #ddd; padding: 4px 10px; border-radius: 5px; cursor: pointer}
input[type=checkbox]:checked + label {background: #555; color: #fff}
</style>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"><script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" rel="stylesheet">
<script>
	//Slider
    window.onload=function(){
		$(function() {
			var handle = $( "#custom-handle" );
			$( "#slider" ).slider({range:"min",value:90, min:1,max:100,step:1,
			  create: function() {
				handle.text( $( this ).slider( "value" ) );
			  },
			  slide: function( event, ui ) {
				handle.text( ui.value );
				$( "#imgquality" ).val( ui.value );
			  }
			});
			var handle1 = $( "#custom-handle1" );
			$( "#slider1" ).slider({range:"min",value:5, min:1,max:10,step:1,
			  create: function() {
				handle1.text( $( this ).slider( "value" ) );
			  },
			  slide: function( event, ui ) {
				handle1.text( ui.value );
				$( "#speed" ).val( ui.value );
			  }
			});
		});
	}
</script>
</head>
<body>

<!-------------------------------------------------------------
---------------------------------------------------------------
--------------------------------------------------------------->

<div class="page">
<div class="header">
	<img src="https://roman152.github.io/korgijpegsize/korgi.png" style="width: 400px"/>
	<div class="rightheader"><a href="https://spb-sait.ru/stati/41-korgi-jpegsizer.html"><i class="fa fa-link" aria-hidden="true"></i> Ссылка на последнюю версию</a><br /><a href="https://spb-sait.ru/kontakty.html"><i class="fa fa-envelope" aria-hidden="true"></i> Отправить замечание или рекомендацию</a></div>
</div>
<form action="fs.php" method="POST">
<table style="width: 100%">
	<tr>
		<td>Длина<br /><input type="TEXT" name="width" value="0"></td>
		<td>Ширина<br /><input type="TEXT" name="height" value="0"></td>
	</tr>
		</tr>
		<tr>
		<td colspan="2"><input type="checkbox" id="zoom" name="zoom" value="zoom" checked><label for="zoom">не увеличивать, если меньше</label></td>
	</tr>
		<tr>
		<td><b>Качество</b></td>
		<td><div id="slider"><div id="custom-handle" class="ui-slider-handle"></div></div><input id="imgquality" type="text"  name="imgquality" style="display: none" value="90"/></td>
	</tr>
		<td style="text-align: right; padding: 3px">
			<input type="radio" id="c1" name="radiomode" value="1" checked/>
			<label for="c1">Стандартный режим</label>
		</td>
		<td style="text-align: left;; padding: 9px 3px">
			<input type="radio" id="c2" name="radiomode" value="2"/>
			<label for="c2"><span></span>Менять только качество</label>
		</td>
	</tr>
	</tr>
		<tr>
		<td><b>Скорость обработки</b><br /><span style="font-size: 12px">(чем больше значение, тем быстрее, но больше нагрузка на сервер)</span></td>
		<td><div id="slider1"><div id="custom-handle1" class="ui-slider-handle"></div></div><input id="speed" type="text"  name="speed" style="display: none" value="50"/></td>
	</tr>
	</tr>
		<td colspan="2">
			<input type="submit" value="&#xf135 Конвертировать"  class="fa fa-input">
		</td>
	</tr>
</table>

</form>

<!-------------------------------------------------------------
---------------------------------------------------------------
--------------------------------------------------------------->

<?php
if (($_POST['width']>0) or ($_POST['height']>0) or ($_POST['radiomode']==2))
	{
		//здесь прописываем код обработки формы
		$width=$_POST['width'];
		$height=$_POST['height'];
		$zoom=$_POST['zoom'];
		$imgquality=$_POST['imgquality'];
		$speed=$_POST['speed'];
		$radiomode=$_POST['radiomode'];
		$str_out=mb_strtoupper ($str_out, 'UTF-8');
		echo ('<div style="background:#eee; display: inline-block; padding: 5px 10px; border-radius: 5px"><b>Установлено качество: </b>'.$imgquality.'</div>');


		$filelist = glob("*.jpg", GLOB_MARK);
		echo '<div class="imgresult">';
			foreach ($filelist as $filename){
				foo(realpath($filename), $width, $height, $radiomode, $imgquality, $speed, $zoom);
		}
		echo '</div>';
	}
else
	{
	echo ('<div style="background: #eee; display: inline-block; padding: 10px 15px; border-radius: 5px"><i class="fa fa-exclamation" aria-hidden="true"></i> Пожалуйста, укажите параметры</div>');
	echo ('<div style="background: #eee; display: inline-block; padding: 10px 15px; border-radius: 5px; margin-top: 10px; font-size: 12px"><i class="fa fa-штащ" aria-hidden="true"></i> Данный скрипт сжимает все изображения в формате JPEG в папке на сайте, достаточно просто запустить конвертирование с нужными параметрами. После завершения конвертации рекомендуем удалять данный скрипт.</div>');
	}
?>
<?php	function foo($filename, $width, $height, $radiomode, $imgquality, $speed, $zoom) {
		// Вывод адреса изображения для отладки
		echo '<br />'.$filename.'<br />';
		// ПРОВЕРКА НА ИЗОБРАЖЕНИЕ
		$size = getimagesize($filename); // если это изображение и у него определён размер, то продолжаем
		if ($size){

			// РАБОТАЕМ КОРРЕКТНО. ОПРЕДЕЛЯЕМ ТИП
			//header("Content-type: {$size['mime']}");

			// ПОЛУЧАЕМ НОВЫЕ РАЗМЕРЫ
			list($width_orig, $height_orig) = getimagesize($filename); 
			
			/*Фильтруем разрешения и разрешение на ресайз*/
			if (($radiomode==1) and ($width==0) and ($height>0)) {
				$width = (($height / $height_orig) * $width_orig);
			}
			if (($radiomode==1) and ($width>0) and ($height==0)) {
				$height = (($width / $width_orig) * $height_orig);
			}
			if ($radiomode==2) {
				$width = $width_orig;
				$height = $height_orig;
			}
			$width = round($width);
			$height = round($height);
			
			if ((($zoom=='zoom') and (($height>$height_orig) or ($width>$width_orig))) or (($height==$height_orig) or ($width==$width_orig)))
				{
					echo 'Пропущен, так как нельзя увеличивать то, что меньше или равно запрашиваемых размеров<br />';
				}
			else {
			
				echo ($width_orig.'X'.$height_orig.'------>'.$width.'X'.$height.'<br /><hr />');
				
				// Ресемплирование
				$image_p = imagecreatetruecolor($width, $height); 
				$image = imagecreatefromjpeg($filename); 
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig); 

				// Сохранение
				imagejpeg($image_p, $filename, $imgquality); 
				sleep(1/$speed);
				}
			
			} 

		
	}
?>
<?php 
if (ini_get('max_execution_time')<100) 
	{
		echo ('<div class="phptime">Максимальное время выполнения скрипта '.ini_get('max_execution_time').' секунд<br /> рекомендуется значение не ниже 100</div>');
	}
?>
</div>
</body>
</html>
