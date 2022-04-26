<?php

use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'TextAdventureImporterRequests',
        'UploadRequests'
    ),
    new Switchable()
);
$textAdventureUploader = new TextAdventureUploader($currentRequest);
$uploadIsPossible = true;
$aFileWasNotSelectedMessage = '
    <p class="roady-error-message">
        A Twine html file was not selected.
        Please select a Twine html file to upload!
    </p>
';
$invalidFileTypeMessage = '
    <p class="roady-error-message">
        Only Twine html files can be uploaded!
        Please select a Twine html file to upload
    </p>
';
$fileIsToLargeMessage = '
    <p class="roady-error-message">
        The file is too large!
    </p>
';

$theSpecifiedTwineFileWasAlreadyImportedMessage = "
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

if(
    (
        $textAdventureUploader->currentRequest()
                              ->getPost()["ImportTwineFile"] ?? ''
    )
    === 'Import Twine File'
) {
    if(
        $textAdventureUploader->nameOfFileToUpload()
        ===
        TextAdventureUploader::NO_FILE_SELECTED
    ) {
        echo $aFileWasNotSelectedMessage;
        $uploadIsPossible = false;
    }
    if(
        $uploadIsPossible !== false
        &&
        !$textAdventureUploader->fileToUploadIsAnHtmlFile()
    ) {
        echo $invalidFileTypeMessage;
        $uploadIsPossible = false;
    }
    if (
        $uploadIsPossible !== false
        &&
        $textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize()
    ) {
        echo $fileIsToLargeMessage;
        $uploadIsPossible = false;
    }
    if (
        $uploadIsPossible !== false
        &&
        boolval(
            (
                $textAdventureUploader->currentRequest()
                                      ->getPost()
                                      ['replaceExistingGame']
                ??
                false
            )
        ) !== true
        &&
        file_exists($textAdventureUploader->pathToUploadFileTo())
    ) {
        echo $theSpecifiedTwineFileWasAlreadyImportedMessage;
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
                $textAdventureUploader->currentRequest()->getPost()['replaceExistingGame']
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

