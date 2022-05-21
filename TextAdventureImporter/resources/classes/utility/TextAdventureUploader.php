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

    public const MAXIMUM_ALLOWED_FILE_SIZE = 1000000;

    public const A_FILE_WAS_NOT_SELECTED_FOR_UPLOAD_ERROR_MESSAGE =
        'A Twine html file was not selected. Please select a Twine ' .
        'html file to upload!';

    public const SELECTED_FILE_IS_NOT_AN_HTML_FILE_ERROR_MESSAGE =
        'The selected file is not a valid ' .
        ' html file. Only html files may be uploaded.';

    public const FILE_TO_UPLOAD_SIZE_EXCEEDS_ALLOWED_FILE_SIZE_ERROR_MESSAGE =
        'The selected file is too large! Please choose a file ' .
        'that is less than 1 megabytes.';

    public const FILE_WAS_ALREADY_UPLOADED_AND_REQUEST_DID_NOT_INDICATE_EXISTING_FILE_SHOULD_BE_REPLACE_ERROR_MESSAGE =
        'A file already exists whose name ' .
        'matches the name of the specified file. ' .
        'Please select a file with a different name, or check ' .
        'the  "Replace Existing" box.';

    private Request $previousRequest;

    /**
     * @var array<int, string> $errorMessages
     */
    private array $errorMessages = [];

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
        $fileToUploadIsAnHtmlFile = strtolower(
            pathinfo(
                $this->nameOfFileToUpload(),
                PATHINFO_EXTENSION
            )
        ) === 'html';
        if($fileToUploadIsAnHtmlFile) {
            return true;
        }
        array_push(
            $this->errorMessages,
            self::SELECTED_FILE_IS_NOT_AN_HTML_FILE_ERROR_MESSAGE,
        );
        return false;
    }

    public function currentRequest(): Request
    {
        return $this->currentRequest;
    }


    public function fileToUploadSizeExceedsAllowedFileSize(): bool
    {
        // @todo Refactor to more accurately check file size
        if (
            (
                $_FILES
                [self::FILE_TO_UPLOAD_INDEX]
                [TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX]
                ??
                self::MAXIMUM_ALLOWED_FILE_SIZE
            ) > self::MAXIMUM_ALLOWED_FILE_SIZE
        ) {
            array_push(
                $this->errorMessages,
                self::FILE_TO_UPLOAD_SIZE_EXCEEDS_ALLOWED_FILE_SIZE_ERROR_MESSAGE,
            );
            return true;
        }
        return false;

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
        if (
            (
                $this->currentRequest()
                     ->getPost()[self::REPLACE_EXISTING_GAME_INDEX]
                ??
                ''
            )
            ===
            'true'
        ) {
            return true;
        }
        array_push(
            $this->errorMessages,
            self::FILE_WAS_ALREADY_UPLOADED_AND_REQUEST_DID_NOT_INDICATE_EXISTING_FILE_SHOULD_BE_REPLACE_ERROR_MESSAGE,
        );
        return false;
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

    /**
     * @return array<int, string>
     */
    public function errorMessages(): array
    {
        return $this->errorMessages;
    }

    public function aFileWasSelectedForUpload(): bool
    {
        if($this->nameOfFileToUpload() === self::NO_FILE_SELECTED) {
            array_push(
                $this->errorMessages,
                self::A_FILE_WAS_NOT_SELECTED_FOR_UPLOAD_ERROR_MESSAGE,
            );
            return false;
        }
        return true;
    }

    public function uploadIsPossible(): bool
    {
        return
            isset($_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX]['error'])
            &&
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

    public function rootUrl(): string
    {
        return
            $this->rootUrlScheme() .
            $this->rootUrlHost() .
            $this->rootUrlPort();
    }

    private function rootUrlHost(): string
    {
        return strval(
            parse_url(
                $this->currentRequest()->getUrl(),
                PHP_URL_HOST
            )
        );
    }

    private function rootUrlScheme(): string
    {
        return strval(
            parse_url(
                $this->currentRequest()->getUrl(),
                PHP_URL_SCHEME
            )
        ) . '://';
    }

    private function rootUrlPort(): string
    {
        $port =  strval(
            parse_url(
                $this->currentRequest()->getUrl(),
                PHP_URL_PORT
            )
        );
        return (empty($port) ? '' : ':' . $port);
    }
}

