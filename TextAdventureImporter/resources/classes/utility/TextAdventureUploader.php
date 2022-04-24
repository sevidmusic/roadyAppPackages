<?php

namespace Apps\TextAdventureImporter\resources\classes\utility;

use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

class TextAdventureUploader {

    public const NO_FILE_SELECTED = 'NO_FILE_SELECTED';

    private const RELATIVE_PATH_TO_UPLOADS_DIRECTORY =
        'Apps' .
        DIRECTORY_SEPARATOR .
        'TextAdventureImporter' .
        DIRECTORY_SEPARATOR .
        'resources' .
        DIRECTORY_SEPARATOR .
        'uploads';

    private const CLASS_SEPARATOR = '\\';

    public const FILE_TO_UPLOAD_INDEX = 'fileToUpload';

    public const FILENAME_INDEX = 'name';

    public function pathToUploadsDirectory(): string
    {
        return (
            str_replace(
                str_replace(
                    self::CLASS_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    __NAMESPACE__
                ),
                self::RELATIVE_PATH_TO_UPLOADS_DIRECTORY,
                __DIR__
            )
        );
    }

    public function pathToUploadFileTo(): string
    {
        return match(
            $this->nameOfFileToUpload() !== self::NO_FILE_SELECTED
        ) {
            true =>
                $this->pathToUploadsDirectory() .
                DIRECTORY_SEPARATOR .
                basename($this->nameOfFileToUpload()),
            default => $this->nameOfFileToUpload(),
        };
    }

    public function nameOfFileToUpload(): string
    {
        return match(
            !empty($_FILES[self::FILE_TO_UPLOAD_INDEX][self::FILENAME_INDEX] ?? '')
        )
        {
            true => $_FILES[self::FILE_TO_UPLOAD_INDEX][self::FILENAME_INDEX],
            default => self::NO_FILE_SELECTED
        };
    }

    public function fileToUploadIsAnHtmlFile(): bool
    {
        return strtolower(
            pathinfo(
                $this->pathToUploadFileTo(),
                PATHINFO_EXTENSION
            )
        ) === 'html';
    }

    public function currentRequest(): Request
    {
        return new Request(
            new Storable(
                'CurrentRequest',
                'TextAdventureImporterRequests',
                'UploadRequests'
            ),
            new Switchable()
        );
    }
}

