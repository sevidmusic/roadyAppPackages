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
    // Allow certain file formats
    if(empty($_FILES["fileToUpload"]["name"])) {
      echo "<p class=\"roady-error-message\">A Twine html file was not selected. Please select a Twine html file to upload!</p>";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($uploadedFileType != "html") {
      if($uploadOk !== 0) { echo "<p class=\"roady-error-message\">Only Twine html files can be uploaded! Please select a Twine html file to upload</p>"; }
      $uploadOk = 0;
    }

    // Check file size
    if (($_FILES["fileToUpload"]["size"] ?? 5000000) > 5000000) {
      if($uploadOk !== 0) { echo "<p class=\"roady-error-message\">The file is too large!</p>"; }
      $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      if($uploadOk !== 0) { echo "<p class=\"roady-error-message\">A Twine file with the same name was already uploaded. Please upload a Twine file with a unique name!</p>"; }
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk !== 0) {
        if(!is_dir($target_dir)) {
            mkdir($target_dir);
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p class=\"roady-success-message\">The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.</p>";
        } else {
            echo "<p class=\"roady-error-message\">Sorry, there was an error uploading your file.</p>";
        }
    }
}
?>

<form class="roady-form" action="index.php?request=TextAdventureImporter" method="post" enctype="multipart/form-data">
  <label class="roady-form-input-label" for="fileToUpload">Select A Twine Html File To Upload:</label>
  <input id="fileToUpload" class="roady-form-input" type="file" name="fileToUpload">
  <input type="submit" class="roady-form-input" value="Import Twine File" name="submit">
</form>
