<?php

use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;

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

$textAdventureUploader = new TextAdventureUploader(
    new Request(
        new Storable(
            'LastRequest',
            'TextAdventureImporter',
            'UploadRequests'
        ),
        new Switchable()
    ),
    new ComponentCrud(
        new Storable(
            'ComponentCrud',
            'TextAdventureImporter',
            'ComponentCruds'
        ),
        new Switchable(),
        new JsonStorageDriver(
            new Storable(
                'JsonStorageDriver',
                'TextAdventureImporter',
                'StorageDrivers'
            ),
            new Switchable()
        )
    )
);

$fileUploadedSuccessfullyMessage = "
    <p class=\"roady-success-message\">
        The file ".
        htmlspecialchars(
            basename($textAdventureUploader->nameOfFileToUpload())
        ) .
    " has been uploaded.
    </p>";

$failedToUploadFileMessage = "
    <p class=\"roady-error-message\">
        Sorry, there was an error uploading your file.
    </p>";

$uploadIsPossible = true;

if(
    $textAdventureUploader->previousRequest()->getUniqueId()
    ===
    $textAdventureUploader->postRequestId()
) {
    $vars = [
        'currentRequstId' =>
        $textAdventureUploader->currentRequest()->getUniqueId(),
        'lastRequest' =>
        $textAdventureUploader->previousRequest()->getUniqueId(),
        $textAdventureUploader::POST_REQUEST_ID_INDEX
        => $textAdventureUploader->postRequestId(),
    ];

    echo '<ul class="roady-ul-list">';
    foreach($vars as $varKey => $varValue) {
        echo '<li>' . $varKey . '</li>';
        echo '<li>' . strval($varValue) . '</li>';
    }
    echo '</ul>';
    if(
        $textAdventureUploader->nameOfFileToUpload()
        ===
        TextAdventureUploader::NO_FILE_SELECTED
    ) {
        echo $aFileWasNotSelectedMessage;
        $uploadIsPossible = false;
    }
    if (
        $uploadIsPossible
        &&
        $textAdventureUploader->uploadIsPossible()
    ) {
        $textAdventureUploader->upload();
        echo match(
            move_uploaded_file(
                $textAdventureUploader->fileToUploadsTemporaryName(),
                $textAdventureUploader->pathToUploadFileTo()
            )
        ) {
            true => $fileUploadedSuccessfullyMessage,
            default => $failedToUploadFileMessage,
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
        for="<?php
            echo $textAdventureUploader::FILE_TO_UPLOAD_INDEX;
        ?>"
    >
        Select A Twine Html File To Upload:
    </label>
    <input
        id="<?php
            echo $textAdventureUploader::FILE_TO_UPLOAD_INDEX;
        ?>"
        class="roady-form-input"
        type="file"
        name="<?php
            echo $textAdventureUploader::FILE_TO_UPLOAD_INDEX;
        ?>"
    >
    <label
        class="roady-form-input-label"
        for="<?php
                echo
                $textAdventureUploader::REPLACE_EXISTING_GAME_INDEX;
            ?>"
    >
        Replace Existing Game:
    </label>
    <input
        id="<?php
            echo $textAdventureUploader::REPLACE_EXISTING_GAME_INDEX;
        ?>"
        class="roady-form-input"
        type="checkbox"
        <?php
        echo match($textAdventureUploader->replaceExistingGame()) {
            true => 'checked',
            default => '',
        };
        ?>
        name="<?php
            echo $textAdventureUploader::REPLACE_EXISTING_GAME_INDEX;
        ?>"
        value="true"
    >
    <input
        type="hidden"
        name="<?php
            echo $textAdventureUploader::POST_REQUEST_ID_INDEX;
        ?>"
        value="<?php
        echo $textAdventureUploader->currentRequest()
                                   ->getUniqueId();
        ?>"
    >
    <input
        class="roady-form-input"
        type="submit"
        name="ImportTwineFile"
        value="Import Twine File"
    >
</form>

