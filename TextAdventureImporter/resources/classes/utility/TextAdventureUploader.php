<?php

namespace Apps\TextAdventureImporter\resources\classes\utility;

use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
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

    private Request $previousRequest;

    public function __construct(
        private Request $currentRequest,
        private ComponentCrud $componentCrud
    ) {
        try {
            /** @var Request $previousRequest */
            $previousRequest = $componentCrud->readByNameAndType(
                $currentRequest->getName(),
                $currentRequest->getType(),
                $currentRequest->getLocation(),
                $currentRequest->getContainer()
            );
            $componentCrud->update($previousRequest, $currentRequest);
            $this->previousRequest = $previousRequest;
        } catch (\RuntimeException $errorMessage) {
            $componentCrud->create($currentRequest);
            $this->previousRequest = $currentRequest;
        }
    }

    public function previousRequest(): Request
    {
        return $this->previousRequest;
    }

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
                $this->nameOfFileToUpload(),
                PATHINFO_EXTENSION
            )
        ) === 'html';
    }

    public function currentRequest(): Request
    {
        return $this->currentRequest;
    }


    public function fileToUploadSizeExceedsAllowedFileSize(): bool
    {
        return (
            $_FILES["fileToUpload"]["size"] ?? 5000000
        ) > 5000000;

    }


    public function componentCrud(): ComponentCrud
    {
        return $this->componentCrud;
    }

    public function postRequestId(): string
    {
        return ($this->currentRequest()->getPost()['postRequestId'] ?? '');
    }

    public function replaceExistingGame(): bool
    {
        return (
            (
                $this->currentRequest()
                     ->getPost()['replaceExistingGame']
                ??
                ''
            )
            ===
            'true'
        );
    }
}

