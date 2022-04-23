<?php

namespace Apps\TextAdventureImporter\resources\classes\utility;

class TextAdventureUploader {


    public function pathToUploadsDirectory(): string
    {
        return (
            str_replace(
                str_replace(
                    '\\',
                    DIRECTORY_SEPARATOR,
                    __NAMESPACE__
                ),
                'Apps' .
                DIRECTORY_SEPARATOR .
                'TextAdventureImporter' .
                DIRECTORY_SEPARATOR .
                'resources' .
                DIRECTORY_SEPARATOR .
                'uploads',
                __DIR__
            )
        );
    }

    public function pathToUploadFileTo(): string
    {
        return $this->pathToUploadsDirectory() .
            basename(
                ($_FILES["fileToUpload"]["name"] ?? 'NO_FILE_SELECTED')
            );
    }
}
