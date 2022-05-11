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

    public const FILE_TO_UPLOAD_SIZE_INDEX = 'size';

    public const POST_REQUEST_ID_INDEX = 'postRequestId';

    public const REPLACE_EXISTING_GAME_INDEX = 'replaceExistingGame';

    public const FILENAME_INDEX = 'name';

    public const TEMPORARY_FILENAME_INDEX = 'tmp_name';

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
            !empty(
                (
                    $_FILES
                    [self::FILE_TO_UPLOAD_INDEX]
                    [self::FILENAME_INDEX]
                    ??
                    ''
                )
            )
        )
        {
            true =>
                $_FILES
                [self::FILE_TO_UPLOAD_INDEX]
                [self::FILENAME_INDEX],
            default => self::NO_FILE_SELECTED
        };
    }

    public function fileToUploadIsAnHtmlFile(): bool
    {
        // @todo Refactor to more securely verify file is an html file
        // @see https://www.php.net/manual/en/features.file-upload.php
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
        // @todo Refactor to more accurately check file size
        return (
            $_FILES[self::FILE_TO_UPLOAD_INDEX][TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX] ?? 5000000
        ) > 5000000;

    }

    public function componentCrud(): ComponentCrud
    {
        return $this->componentCrud;
    }

    public function postRequestId(): string
    {
        return (
            $this->currentRequest()
                 ->getPost()[self::POST_REQUEST_ID_INDEX]
            ??
            self::NO_FILE_SELECTED
        );
    }

    public function replaceExistingGame(): bool
    {
        return (
            (
                $this->currentRequest()
                     ->getPost()[self::REPLACE_EXISTING_GAME_INDEX]
                ??
                ''
            )
            ===
            'true'
        );
    }

    public function fileToUploadsTemporaryName(): string
    {
        return (
            $_FILES[self::FILE_TO_UPLOAD_INDEX]["tmp_name"]
            ??
            self::NO_FILE_SELECTED
        );
    }

    public function upload(): bool
    {
        if(!is_dir($this->pathToUploadsDirectory())) {
            mkdir($this->pathToUploadsDirectory());
        }
        return false;
    }

    private function safeToReplaceExistingGame(): bool
    {
        return match(
            file_exists($this->pathToUploadFileTo())
        ) {
            /**
             * true: There is an existing game, so return
             * replaceExistingGame(), whose value
             * will reflect whether or not the Request
             * indicated the existing game should
             * be replaced.
             */
            true => $this->replaceExistingGame(),
            /**
             * default: There is not an existing game, so a
             * replacement would not occur, i.e., it is safe
             * to proceed with upload.
             */
            default => true,
        };
    }

    public function aFileWasSelectedForUpload(): bool
    {
        return $this->nameOfFileToUpload() !== self::NO_FILE_SELECTED;
    }

    public function uploadIsPossible(): bool
    {
        return
            $this->aFileWasSelectedForUpload()
            &&
            $this->fileToUploadIsAnHtmlFile()
            &&
            !$this->fileToUploadSizeExceedsAllowedFileSize()
            &&
            (
                $this->previousRequest()->getUniqueId()
                ===
                $this->postRequestId()
            )
            &&
            $this->safeToReplaceExistingGame();
    }
}

