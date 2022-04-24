<?php

use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;

$currentRequest = new Request(
    new Storable('CurrentRequest',
        'Requests',
        'Index'
    ),
    new Switchable()
);

$textAdventureUploader = new TextAdventureUploader();

$target_dir = $textAdventureUploader->pathToUploadsDirectory();
$target_file = $textAdventureUploader->pathToUploadFileTo();
$uploadIsPossible = true;
$uploadedFileType = strtolower(
    pathinfo($target_file,PATHINFO_EXTENSION)
);
$fileToUpload = $textAdventureUploader->nameOfFileToUpload();
var_dump(
    [
        'target_dir' => $target_dir,
        'target_file' => $target_file,
        'fileToUpload' => $fileToUpload,
    ]
);
if(($currentRequest->getPost()["ImportTwineFile"] ?? '') === 'Import Twine File') {
    if(empty($_FILES["fileToUpload"]["name"])) {
        echo "
            <p class=\"roady-error-message\">
                A Twine html file was not selected.
                Please select a Twine html file to upload!
            </p>
        ";
      $uploadIsPossible = false;
    }
    if($uploadIsPossible !== false && $uploadedFileType != "html") {
        echo "
            <p class=\"roady-error-message\">
                Only Twine html files can be uploaded!
                Please select a Twine html file to upload
            </p>
        ";
      $uploadIsPossible = false;
    }
    if (
        $uploadIsPossible !== false
        &&
        ($_FILES["fileToUpload"]["size"] ?? 5000000) > 5000000
    ) {
        echo "
            <p class=\"roady-error-message\">
                The file is too large!
            </p>
        ";
      $uploadIsPossible = false;
    }
    if (
        $uploadIsPossible !== false
        &&
        boolval(($currentRequest->getPost()['replaceExistingGame'] ?? false)) !== true
        &&
        file_exists($target_file)
    ) {
        echo "
            <p class=\"roady-error-message\">
                A Twine file with the same name was already uploaded.
                Please upload a Twine file with a unique name, or
                check the
                <span>Replace Existing App</span> check box below.
            </p>
        ";
        $uploadIsPossible = false;
    }
    if ($uploadIsPossible) {
        if(!is_dir($target_dir)) {
            mkdir($target_dir);
        }
        echo match(
            move_uploaded_file(
                $_FILES["fileToUpload"]["tmp_name"],
                $target_file
            )
        ) {
            true => "
                <p class=\"roady-success-message\">
                    The file ".
                    htmlspecialchars(
                        basename($_FILES["fileToUpload"]["name"])
                    ) .
                    " has been uploaded.
                </p>",
            default => "
                <p class=\"roady-error-message\">
                    Sorry, there was an error uploading your file.
                </p>",
        };
    }
}
?>

<form
    class="roady-form"
    action="index.php?request=TextAdventureImporter"
    method="post"
    enctype="multipart/form-data"
>
    <label
        class="roady-form-input-label"
        for="fileToUpload"
    >
        Select A Twine Html File To Upload:
    </label>
    <input
        id="fileToUpload"
        class="roady-form-input"
        type="file"
        name="fileToUpload"
    >
    <label
        class="roady-form-input-label"
        for="fileToUpload"
    >
        Replace Existing Game:
    </label>
    <input
        id="replaceExistingGame"
        class="roady-form-input"
        type="checkbox"
        <?php
        echo match(
            ($currentRequest->getPost()['replaceExistingGame'] ?? '')
        ) {
            'true' => 'checked',
            default => '',
        };
        ?>
        name="replaceExistingGame"
        value="true"
    >
    <input
        type="submit"
        class="roady-form-input"
        value="Import Twine File"
        name="ImportTwineFile"
    >
</form>

