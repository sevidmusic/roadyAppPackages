<?php

use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;

$componentCrud = new ComponentCrud(
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
);
$currentRequest = new Request(
    new Storable(
        'LastRequest',
        'TextAdventureImporter',
        'UploadRequests'
    ),
    new Switchable()
);

try {
    $lastRequest = $componentCrud->readByNameAndType(
        $currentRequest->getName(),
        $currentRequest->getType(),
        $currentRequest->getLocation(),
        $currentRequest->getContainer()
    );
} catch (\RuntimeException $errorMessage) {
    $lastRequest = $currentRequest;
}
$textAdventureUploader = new TextAdventureUploader(
    $currentRequest, $componentCrud
);
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

$postRequestId = (
    isset($currentRequest->getPost()['lastRequestId'])
    ? $currentRequest->getPost()['lastRequestId']
    : strval(rand(1000, 70000)
    )
);

if(
    $lastRequest->getUniqueId()
    ===
    $postRequestId
) {
    $vars = [
        'currentRequstId' => $currentRequest->getUniqueId(),
        'lastRequest' => $lastRequest->getUniqueId(),
        'postRequestId' => $postRequestId,
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
        type="hidden"
        name="lastRequestId"
        value="<?php echo $currentRequest->getUniqueId(); ?>"
    >
    <input
        class="roady-form-input"
        type="submit"
        name="ImportTwineFile"
        value="Import Twine File"
    >
</form>

