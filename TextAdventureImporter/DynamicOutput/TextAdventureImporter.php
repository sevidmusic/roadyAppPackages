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

$uploadIsPossible = true;
$uploadedFileType = strtolower(
    pathinfo(
        $textAdventureUploader->pathToUploadFileTo(),
        PATHINFO_EXTENSION
    )
);
var_dump(
    [
        'target_dir' =>
            $textAdventureUploader->pathToUploadsDirectory(),
        'target_file' =>
            $textAdventureUploader->pathToUploadFileTo(),
    ]
);
if(
    ($currentRequest->getPost()["ImportTwineFile"] ?? '')
    ===
    'Import Twine File'
) {
    if(empty($_FILES["fileToUpload"]["name"])) {
        echo "
            <p class=\"roady-error-message\">
                A Twine html file was not selected.
                Please select a Twine html file to upload!
            </p>
        ";
      $uploadIsPossible = false;
    }
    if(
        $uploadIsPossible
        !==
        false
        &&
        $uploadedFileType != "html"
    ) {
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
        boolval(
            (
                $currentRequest->getPost()['replaceExistingGame']
                ??
                false
            )
        ) !== true
        &&
        file_exists($textAdventureUploader->pathToUploadFileTo())
    ) {
        echo "
            <div class=\"roady-error-message\">
                <p>
                    A Twine file with the same name was already
                    uploaded.
                </p>
                <p>
                    Please upload a Twine file with a unique name,
                    or check the <span>Replace Existing App</span>
                    check box below.
                </p>
            </div>
        ";
        $uploadIsPossible = false;
    }
    if ($uploadIsPossible) {
        if(
            !is_dir(
                $textAdventureUploader->pathToUploadsDirectory()
            )
        ) {
            mkdir(
                $textAdventureUploader->pathToUploadsDirectory()
            );
        }
        echo match(
            move_uploaded_file(
                $_FILES["fileToUpload"]["tmp_name"],
                $textAdventureUploader->pathToUploadFileTo()
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
            (
                $currentRequest->getPost()['replaceExistingGame']
                ??
                ''
            )
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

