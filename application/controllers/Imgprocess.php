<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imgprocess extends CI_Controller {

	public function index()
	{
		$this->load->view('imgprocess');
		

	}

public function __construct()
{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
}
public function do_upload()
{
	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$target = $target_file . time(). basename( $_FILES['fileToUpload']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	  if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	  } else {
		echo "File is not an image.";
		$uploadOk = 0;
	  }
	}
	
	// Check if file already exists
	if (file_exists($target_file)) {
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		try {
			require_once('Simpleimage.php');
		
			  $image = new \abeautifulsite\SimpleImage();
		
			  $image
			->fromFile($target_file)                     // load image.jpg
			->autoOrient()                              // adjust orientation based on exif data
			->resize(320, 200)                          // resize to 320x200 pixels
			->flip('x')                                 // flip horizontally
			->colorize('black')                      // tint dark blue
			->border('black', 10)                       // add a 10 pixel black border
			->overlay('img/watermark.png', 'bottom right')  // add a watermark image
			->toFile($target, 'image/png')   ;   // convert to PNG and save a copy to new-image.png
		
		} catch(Exception $error) {
		  echo $error->getMessage();
		}	
		$this->load->view('imgprocess');
		echo "Your File has been modified successfully";

	} else {
		echo "Sorry, there was an error uploading your file.";
	  }
	}
	}

}

