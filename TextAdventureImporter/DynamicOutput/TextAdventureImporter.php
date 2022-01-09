<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$target_dir = "Apps/TextAdventureImporter/resources/uploads/";

$target_file = $target_dir . basename(($_FILES["fileToUpload"]["name"] ?? 'noname'));
$uploadOk = 1;
$uploadedFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$fileToUpload = ($_FILES["fileToUpload"]["tmp_name"] ?? 'notvalid');

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {


    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if (($_FILES["fileToUpload"]["size"] ?? 5000000) > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($uploadedFileType != "html") {
      echo "Sorry, only html files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    
    else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
}
?>

<form action="index.php?request=TextAdventureImporter" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Import Twine File" name="submit">
</form>