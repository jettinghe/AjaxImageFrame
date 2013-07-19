<?php
use Carbon\Carbon;
class ImageController extends BaseController {

	public function upload()
	{

	    if (!empty($_FILES)) {

	        $tempFile = $_FILES['file']['tmp_name'];
	        $path = $_FILES['file']['name'];
			$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
	        $resouce;
	        switch($ext){
	        	case 'jpg':
	        	case 'jpeg':
	        	$resource = imagecreatefromjpeg($tempFile);
	        	break;
	        	case 'png':
	        	$resource = imagecreatefrompng($tempFile);
	        	break;
	        	case 'gif':
	        	$resource = imagecreatefromgif($tempFile);
	        	break;
	        }         
	        $cropsize = 808;
	    	$width = imagesx($resource);
	    	$height = imagesy($resource);
	    	$x = round($width/2) - round($cropsize/2);
	    	$y = round($height/2) - round($cropsize/2);
	        $localPath = 'images/';
	         
	        $localFile =  $localPath. 'ivoteicare';
	        $localThumb =  $localPath. 'thumbnail';
	    
	    	
            $cropped  = Image::make($tempFile)->crop(808, 808, $x, $y);
            $cropped->save($localFile . '.jpg');

	        

	    }//end check empty file and upload
	    
	}


	public function overlay()
	{
		if(file_exists('images/yourimage.jpg'))
		{
			unlink('images/yourimage.jpg');
		}
		$img = imagecreatefromjpeg('images/ivoteicare.jpg');
		$sheepmask = imagecreatefrompng('images/i-vote-and-i-care_sheep.png');
		$cattlemask = imagecreatefrompng('images/i-vote-and-i-care_cattle.png');
		$overlay = Input::get('overlay');
		if($overlay == 'sheep'){
			imagecopyresampled($img, $sheepmask, 0, 0, 0, 0, imagesx($img), imagesy($img),imagesy($sheepmask), imagesy($sheepmask));
			imagejpeg($img, "images/yourimage.jpg", 100);
			return View::make('ivoteicare')->with('message', 'Here is Your Image');
		}
		elseif($overlay == 'cattle'){
			imagecopyresampled($img, $cattlemask, 0, 0, 0, 0, imagesx($img), imagesy($img), imagesy($cattlemask), imagesy($cattlemask));
			imagejpeg($img, "images/yourimage.jpg");
			return View::make('ivoteicare')->with('message', 'Here is Your Image');
		}

	}
}