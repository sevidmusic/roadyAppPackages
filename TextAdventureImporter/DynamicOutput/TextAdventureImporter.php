<?php

use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use rig\classes\command\ConfigureAppOutput;
use rig\classes\ui\CommandLineUI;

$configureAppOutput = new ConfigureAppOutput();
$currentRequest = new Request(
    new Storable(
        'LastRequest',
        'TextAdventureImporter',
        'UploadRequests'
    ),
    new Switchable()
);
$textAdventureUploader = new TextAdventureUploader(
    $currentRequest,
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
if(
    $textAdventureUploader->previousRequest()->getUniqueId()
    ===
    $textAdventureUploader->postRequestId()
) {
    if (
        $textAdventureUploader->uploadIsPossible()
    ) {
        $textAdventureUploader->upload();
        $uploadWasSuccessful = move_uploaded_file(
            $textAdventureUploader->fileToUploadsTemporaryName(),
            $textAdventureUploader->pathToUploadFileTo()
        );
        echo match(
           $uploadWasSuccessful
        ) {
            true => $fileUploadedSuccessfullyMessage,
            default => $failedToUploadFileMessage,
        };
        if($uploadWasSuccessful) {
            try {
                $componentName = strval(
                    preg_replace(
                        "/[^A-Za-z0-9 ]/",
                        '',
                        str_replace('.html', '', $textAdventureUploader->nameOfFileToUpload())
                    )
                );
                echo '<div class="roady-generic-container">';
                echo '<pre class="roady-multi-line-code-container">';
                echo '<code class="roady-multi-line-code">';
                $configureAppOutput->run(
                    new CommandLineUI(),
                    $configureAppOutput->prepareArguments(
                        [
                            '--for-app',
                            $componentName,
                            '--name',
                            $componentName,
                            '--output',
                            strval(
                                file_get_contents(
                                    $textAdventureUploader->pathToUploadFileTo()
                                )
                            ),
                        ]
                    )
                );
                echo '</code>';
                echo '</pre>';
                echo '</div>';
                $pathToAppsComponentsPhp = strval(
                    str_replace(
                        'TextAdventureImporter' .
                        DIRECTORY_SEPARATOR .
                        'DynamicOutput',
                        $componentName .
                        DIRECTORY_SEPARATOR .
                        'Components.php',
                        strval(realpath(__DIR__))
                    )
                );
                $host = parse_url(
                    $currentRequest->getUrl(),
                    PHP_URL_HOST
                );
                $port =  parse_url(
                    $currentRequest->getUrl(),
                    PHP_URL_PORT
                );
                $rootUrl = 'https://' . $host . $port;
                var_dump($rootUrl);
                try {
                    exec(
                        PHP_BINARY .
                        ' ' .
                        escapeshellarg($pathToAppsComponentsPhp) .
                        " '" . $rootUrl . "'"
                    );
                } catch (\RuntimeException $error) {
                    echo '<p class="roady-error-message">Failed to build new App</p>';
                }
            } catch (\RuntimeException $error) {
                echo '<p class="roady-error-message">An error occurred, ConfigureAppOutput failed</p>';
                echo '<p class="roady-error-message">Error: ' . $error->getMessage() . '</p>';
            }
        }
    }
}
?>

<?php



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

