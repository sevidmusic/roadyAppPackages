<?php

namespace Apps\TextAdventureImporter\resources\tests\utility;

use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;
use PHPUnit\Framework\TestCase;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

class TextAdventureUploaderTest extends TestCase
{

    private const MAXIMUM_ALLOWED_FILE_SIZE = 1000000;
    private const INVALID_FILE_SIZE = 1000001;

    public function tearDown(): void
    {
        unset($_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX]);
        foreach(
            $this->mockComponentCrud()
                 ->readAll(
                     $this->mockRequest()->getLocation(),
                     $this->mockRequest()->getContainer()
                 ) as $testComponent
        ) {
            $this->mockComponentCrud()->delete($testComponent);
        }

    }

    private function mockUploadRequest(
        Request $request,
        bool $fileWasSelected,
        bool $fileSizeIsValid,
        bool $fileIsAnHtmlFile,
        bool $setReplaceExistingGame,
        bool $setPostRequestId,
    ): void
    {
        $request->import(
            [
                'post' => [
                    TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX
                    => ($setReplaceExistingGame ? 'true' : ''),
                    TextAdventureUploader::POST_REQUEST_ID_INDEX
                    => (
                        $setPostRequestId
                        ? $request->getUniqueId()
                        : ''
                    )
                ]
            ]
        );
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = (
                $fileWasSelected
                ? $request->getUniqueId()
                : ''
            ) .
            (
                $fileWasSelected && $fileIsAnHtmlFile
                ? '.html'
                : ''
            );
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX]
            = (
                $fileSizeIsValid
                ? self::MAXIMUM_ALLOWED_FILE_SIZE
                : self::INVALID_FILE_SIZE
            );
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::TEMPORARY_FILENAME_INDEX]
            = (
                $fileWasSelected
                ? $request->getUniqueId()
                : ''
            ) .
            (
                $fileWasSelected && $fileIsAnHtmlFile
                ? '.html'
                : ''
            );
    }

    public function testNameOfFileToUploadRetunrsTheValueOfTheNO_FILE_SELECTEDConstantIfAFileHasNotBeenSelectedForUpload(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
             TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->nameOfFileToUpload()
        );
        /**
         * Also test case where an upload Request has been
         * made but a file was not actually selected.
         */
        $this->mockUploadRequest(
            $request,
            fileWasSelected: false,
            fileSizeIsValid: false,
            fileIsAnHtmlFile: false,
            setReplaceExistingGame: false,
            setPostRequestId: false,
        );
        $this->assertEquals(
             TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->nameOfFileToUpload()
        );
    }

    public function testNameOfFileToUploadRetunrsTheNameOfTheFileToUploadIfAFileHasBeenSelectedForUpload(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX],
            $textAdventureUploader->nameOfFileToUpload()
        );
    }

    /**
     * @todo Consider instead using sha1_file() to generate
     * a hash of the file to use as the uploaded files
     * name. It would be safer than using a predictable name.
     */
    public function testPathToUploadFileToReturnsTheNameOfFileToUploadPrefixedByThePathToUploadsDirectory(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $textAdventureUploader->pathToUploadsDirectory() .
            DIRECTORY_SEPARATOR .
            $textAdventureUploader->nameOfFileToUpload(),
            $textAdventureUploader->pathToUploadFileTo()
        );
    }

    public function testPathToUploadFileToReturnsTheString_NO_FILE_SELECTED_IfAFileHasNotBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        $this->assertEquals(
             TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->pathToUploadFileTo()
        );
    }

    public function testPathToUploadsDirectoryReturnsExpectedPathToUploadsDirectory(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        $expectedPath = (
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
        $this->assertEquals(
            $expectedPath,
            $textAdventureUploader->pathToUploadsDirectory()
        );
    }

    public function testFILE_TO_UPLOAD_SIZE_INDEXConstantIsAssignedTheString_size(): void
    {
        $this->assertEquals(
            'size',
            TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX,
            'TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX constant must ' .
            'be assigned the string `size`.'
        );
    }

    public function testFILE_TO_UPLOAD_INDEXConstantIsAssignedTheString_fileToUpload(): void
    {
        $this->assertEquals(
            'fileToUpload',
            TextAdventureUploader::FILE_TO_UPLOAD_INDEX,
            'TextAdventureUploader::FILE_TO_UPLOAD_INDEX constant must ' .
            'be assigned the string `fileToUpload`.'
        );
    }

    public function testPOST_REQUEST_ID_INDEXConstantIsAssignedTheString_postRequestId(): void
    {
        $this->assertEquals(
            'postRequestId',
            TextAdventureUploader::POST_REQUEST_ID_INDEX,
            'TextAdventureUploader::POST_REQUEST_ID_INDEX constant must ' .
            'be assigned the string `postRequestId`.'
        );
    }

    public function testREPLACE_EXISTING_GAME_INDEXConstantIsAssignedTheString_replaceExistingGame(): void
    {
        $this->assertEquals(
            'replaceExistingGame',
            TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX,
            'TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX constant must ' .
            'be assigned the string `replaceExistingGame`.'
        );
    }

    public function testFILENAME_INDEXConstantIsAssignedTheString_name(): void
    {
        $this->assertEquals(
            'name',
            TextAdventureUploader::FILENAME_INDEX,
            'TextAdventureUploader::FILENAME_INDEX constant must ' .
            'be assigned the string `name`.'
        );
    }

    public function tesTEMPORARY_FILENAME_INDEXConstantIsAssignedTheString__tmp_name(): void
    {
        $this->assertEquals(
            'tmp_name',
            TextAdventureUploader::TEMPORARY_FILENAME_INDEX,
            'TextAdventureUploader::TEMPORARY_FILENAME_INDEX ' .
            'constant must be assigned the string `tmp_name`.'
        );
    }

    public function testNO_FILE_SELECTEDConstantIsAssignedTheString_NO_FILE_SELECTED(): void
    {
        $this->assertEquals(
            'NO_FILE_SELECTED',
            TextAdventureUploader::NO_FILE_SELECTED,
            'TextAdventureUploader::NO_FILE_SELECTED constant must ' .
            'be assigned the string `NO_FILE_SELECTED`.'
        );
    }

    public function testFileToUploadIsAnHtmlFileReturnsFalseIfFileSelcetedForUploadDoesNotHaveTheExtension_html(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: false,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertFalse(
            $textAdventureUploader->fileToUploadIsAnHtmlFile(),
            TextAdventureUploader::class .
            '->fileToUploadIsAnHtmlFile() must return false if file '.
            'to upload does not have the extension `html`.'
        );
    }

    public function testFileToUploadIsAnHtmlFileReturnsTrueIfFileSelcetedForUploadHasTheExtension_html(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertTrue(
            $textAdventureUploader->fileToUploadIsAnHtmlFile(),
            TextAdventureUploader::class .
            '->fileToUploadIsAnHtmlFile() must return true if' .
            'file to upload does have the extension `html`.'
        );
    }

    public function testCurrentRequestReturnsARequestInstanceWhoseUrlMatchesTheRequestSpecifiedOnInstantiation(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request->getUrl(),
            $textAdventureUploader->currentRequest()->getUrl(),
            TextAdventureUploader::class .
            '->currentRequest() must return a ' .
            Request::class .
            ' instance whose url matches the url for the current' .
            'request.'

        );
    }

    public function testCurrentRequestReturnsARequestInstanceWhosePostDataMatchesTheCurrentRequestsPostData(): void
    {
        $request = $this->mockRequest();
        $request->import(['post' => ['post data']]);
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request->getPost(),
            $textAdventureUploader->currentRequest()->getPost(),
            TextAdventureUploader::class .
            '->' .
            __FUNCTION__ .
            '() must return a ' .
            Request::class .
            ' instance whose $_POST data matches the url for the ' .
            'current request.'

        );
    }

    public function testCurrentRequestReturnsARequestInstanceWhoseGetDataMatchesTheCurrentRequestsGetData(): void
    {
        $request = $this->mockRequest();
        $request->import(['get' => ['get data']]);
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request->getPost(),
            $textAdventureUploader->currentRequest()->getPost(),
            TextAdventureUploader::class .
            '->' .
            __FUNCTION__ .
            '() must return a ' .
            Request::class .
            ' instance whose $_POST data matches the url for the ' .
            'current request.'

        );
    }

    private function mockRequest(): Request
    {
        return new Request(
            new Storable(
                'CurrentRequest',
                'Requests',
                'Index'
            ),
            new Switchable()
        );
    }

    public function testFileToUploadSizeExceedsAllowedFileSizeReturnsFalseIfSizeOfFileToUploadDoesNotExceedAllowedFileSize(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertFalse(
            $textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize(),
            TextAdventureUploader::class .
            '->fileToUploadSizeExceedsAllowedFileSize() must ' .
            'return false if size of file to upload does not ' .
            'exceed the maximum allowed file size of ' .
            self::MAXIMUM_ALLOWED_FILE_SIZE .
            ' bytes.'
        );
    }

    public function testFileToUploadSizeExceedsAllowedFileSizeReturnsTrueIfSizeOfFileToUploadExceedsAllowedFileSize(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: false,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertTrue(
            $textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize(),
            TextAdventureUploader::class .
            '->fileToUploadSizeExceedsAllowedFileSize() must ' .
            'return true if size of file to upload exceeds ' .
            'the maximum allowed file size of ' .
            self::MAXIMUM_ALLOWED_FILE_SIZE .
            ' bytes.'
        );
    }

    public function mockComponentCrud(): ComponentCrud
    {
        return new ComponentCrud(
            new Storable(
                'TextAdventureUploaderTestComponentCrud',
                'TextAdventureImporter',
                'ComponentCruds'
            ),
            new Switchable(),
            new JsonStorageDriver(
                new Storable(
                    'TextAdventureUploaderTestJsonStorageDriver',
                    'TextAdventureImporter',
                    'Drivers'
                ),
                new Switchable()
            )
        );
    }

    public function testComponentCrudReturnsAssignedComponentCrud(): void
    {
        $specifiedComponentCrud = $this->mockComponentCrud();
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $specifiedComponentCrud
        );
        $this->assertEquals(
            $specifiedComponentCrud,
            $textAdventureUploader->componentCrud(),
            'The ' . TextAdventureUploader::class .
            '->componentCrud() method must return the ' .
            ComponentCrud::class . ' instance that was assigned on ' .
            ' instantiation of a new ' . TextAdventureUploader::class
        );
    }

    public function testSpecifiedRequestIsStoredOnInstantiation(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request,
            $this->mockComponentCrud()->read(
                $request
            ),
            'The specified ' .
            Request::class .
            ' must be stored on ' .
            'instantiation of a new ' .
            TextAdventureUploader::class
        );
    }

    public function testSpecifiedRequestReplacesExistingStoredRequestWhoseNameTypeLocationAndContainerMatchSpecifiedRequestOnInstantiation(): void
    {
        $failureMessagePrefix =
            'If a stored ' . Request::class . ' exists whose ' .
            'name, type, location, and container match the ' .
            'specified ' . Request::class . ', then the specified ' .
            Request::class . ' must be used to update the stored ' .
            Request::class . ' on instantiation of a new ' .
            TextAdventureUploader::class . '.';
        $previousRequest = $this->mockRequest();
        $newRequest = $this->mockRequest();
        $firstTextAdventureUploader = new TextAdventureUploader(
            $previousRequest,
            $this->mockComponentCrud()
        );
        $secondTextAdventureUploader = new TextAdventureUploader(
            $newRequest,
            $this->mockComponentCrud()
        );
        $this->assertNotEquals(
            $previousRequest,
            $this->mockComponentCrud()->read(
                $previousRequest
            ),
            $failureMessagePrefix .
            'The original ' . Request::class . ' was not updated, ' .
            'it still exists in storage.'
        );
        $this->assertEquals(
            $newRequest,
            $this->mockComponentCrud()->read(
                $newRequest
            ),
            $failureMessagePrefix .
            'The specified' . Request::class . ' was not stored.'
        );
    }


    public function testPreviousRequestReturnsPreviouslyStoredRequest(): void
    {
        $previousRequest = $this->mockRequest();
        $firstTextAdventureUploader = new TextAdventureUploader(
            $previousRequest,
            $this->mockComponentCrud()
        );
        $secondTextAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $previousRequest,
            $secondTextAdventureUploader->previousRequest(),
            TextAdventureUploader::class .
            '->previousRequest() must return the ' .
            'previous ' . Request::class . ' that was updated ' .
            'on last instantiation of a ' .
            TextAdventureUploader::class
        );
    }

    public function testPreviousRequestReturnsSpecifiedRequestIfARequestWasNotPreviouslyStored(): void
    {
        $newRequest = $this->mockRequest();
        $firstTextAdventureUploader = new TextAdventureUploader(
            $newRequest,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $newRequest,
            $firstTextAdventureUploader->previousRequest(),
            TextAdventureUploader::class .
            '->previousRequest() must return the ' .
            'specified ' . Request::class . ' if a ' .
            Request::class . ' was not previously stored.'
        );
    }


    public function testPostRequestIdReturnsTheString_NO_FILE_SELECTED_IfPostRequestIdIsNotSetInCurrentRequestsPOSTData(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->postRequestId(),
            TextAdventureUploader::class .
            '->postRequestId() must return the ' .
            'string `NO_FILE_SELECTED` if the specified ' .
            Request::class .
            '\'s $_POST data does not contain a postRequestId.'
        );
    }

    public function testPostRequestIdReturnsThePostRequestIdSetInTheCurrentRequestsPOSTData(): void
    {
        $request = $this->mockRequest();
        $request->import(
            [
                'post' => [
                    TextAdventureUploader::POST_REQUEST_ID_INDEX
                    => $request->getUniqueId()
                ]
            ]
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request->getUniqueId(),
            $textAdventureUploader->postRequestId(),
            TextAdventureUploader::class .
            '->postRequestId() must return the value of the ' .
            TextAdventureUploader::POST_REQUEST_ID_INDEX . ' ' .
            'set in the specified ' .
            Request::class . '\'s $_POST data if it is defined.'
        );
    }

    public function testReplaceExistingGameReturnsFalseIf_POST_REPLACE_EXISTING_GAME_INDEX_IsNotSetToTheString_true(): void
    {
        // TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertFalse(
            $textAdventureUploader->replaceExistingGame(),
            TextAdventureUploader::class .
            '->replaceExistingGame() must return false ' .
            'if the replaceExistingGame value set in the specified ' .
            Request::class . '\'s $_POST data is not assigned the ' .
            'string `true`.'
        );
    }

    public function testReplaceExistingGameReturnsTrueIf_POST_REPLACE_EXISTING_GAME_INDEX_IsSetToTheString_true(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: true,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertTrue(
            $textAdventureUploader->replaceExistingGame(),
            TextAdventureUploader::class .
            '->replaceExistingGame() must return true ' .
            'if the replaceExistingGame value set in the specified ' .
            Request::class . '\'s $_POST data is assigned the ' .
            'string `true`.'
        );
    }

    public function testFileToUploadsTemporaryNameReturnsTheString_NO_FILE_SELECTED_If_FILES__FILE_TO_UPLOAD_INDEX__TEMPORARY_FILENAME_INDEX_IsNotSet(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->fileToUploadsTemporaryName(),
            TextAdventureUploader::class .
            '->fileToUploadsTemporaryName() must return the ' .
            'string `NO_FILE_SELECTED` if ' .
            '`$_FILES[' .
            TextAdventureUploader::FILE_TO_UPLOAD_INDEX .
            '][' .
            TextAdventureUploader::TEMPORARY_FILENAME_INDEX .
            ']` is not set.'
        );
    }

    public function testFileToUploadsTemporaryNameReturnsValueAssignedTo_FILES__FILE_TO_UPLOAD_INDEX__TEMPORARY_FILENAME_INDEX_IfItIsSet(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request->getUniqueId() . '.html',
            $textAdventureUploader->fileToUploadsTemporaryName(),
            TextAdventureUploader::class .
            '->fileToUploadsTemporaryName() must return ' .
            '$_FILES[' .
            TextAdventureUploader::FILE_TO_UPLOAD_INDEX .
            '][' .
            TextAdventureUploader::TEMPORARY_FILENAME_INDEX .
            '] if it is set.'
        );
    }

    public function testUploadCreatesUploadsDirectoryIfItDoesNotExist(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        $textAdventureUploader->upload();
        $this->assertTrue(
            is_dir($textAdventureUploader->pathToUploadsDirectory()),
            'The ' . TextAdventureUploader::class . '->upload() ' .
            'method must create the uploads directory if it does ' .
            'not exist'
        );
        rmdir($textAdventureUploader->pathToUploadsDirectory());
    }

    public function testUploadIsPossibleReturnsFalseIfAFileWasAlreadyUploadedWhoseNameMatchesTheNameOfTheFileToUploadAndReplaceExistingGameReturnsFalse(): void
    {
        $request = $this->mockRequest();
        $testFileName = $request->getUniqueId() . '.html';
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $pathToTestFile =
            $textAdventureUploader->pathToUploadsDirectory() .
            DIRECTORY_SEPARATOR .
            $testFileName;
        if(
            !is_dir($textAdventureUploader->pathToUploadsDirectory())
        ) {
            mkdir($textAdventureUploader->pathToUploadsDirectory());
        }
        file_put_contents(
            $pathToTestFile,
            $request->getName() . PHP_EOL . $request->getUniqueId()
        );
        if(!$textAdventureUploader->replaceExistingGame()) {
            $this->assertFalse(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible() must return `false` if ' .
                'a file was already uploaded whose name matches ' .
                'the name of the file to upload, and the `' .
                TextAdventureUploader::class .
                '->replaceExistingGame()` method returns false.'
            );
        }
        unlink($pathToTestFile);
        rmdir($textAdventureUploader->pathToUploadsDirectory());
    }

    public function testUploadIsPossibleReturnsTrueIfAFileWasAlreadyUploadedWhoseNameMatchesTheNameOfTheFileToUploadAndReplaceExistingGameReturnsTrue(): void
    {
        $request = $this->mockRequest();
        $testFileName = $request->getUniqueId() . '.html';
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: true,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $pathToTestFile =
            $textAdventureUploader->pathToUploadsDirectory() .
            DIRECTORY_SEPARATOR .
            $testFileName;
        if(
            !is_dir($textAdventureUploader->pathToUploadsDirectory())
        ) {
            mkdir($textAdventureUploader->pathToUploadsDirectory());
        }
        file_put_contents(
            $pathToTestFile,
            $request->getName()
        );
        if($textAdventureUploader->replaceExistingGame()) {
            $this->assertTrue(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible() must return `true` if ' .
                'a file was already uploaded whose name matches ' .
                'the name of the file to upload, and the `' .
                TextAdventureUploader::class .
                '->replaceExistingGame()` method returns true.'
            );
        }
        unlink($pathToTestFile);
        rmdir($textAdventureUploader->pathToUploadsDirectory());
    }

    public function testUploadIsPossibleReturnsFalseIfFileToUploadSizeExceedsAllowedFileSizeReturnsTrue(): void
    {
        $request =$this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: false,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        if(
            $textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize()
        ) {
            $this->assertFalse(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible() must ' .
                'return false if ' .
                TextAdventureUploader::class .
                '->fileToUploadSizeExceedsAllowedFileSize() ' .
                'returns true'
            );
        }
    }

    public function testUploadIsPossibleReturnsFalseIfFileToUploadIsAnHtmlFileReturnsFalse(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: false,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        if(
            !$textAdventureUploader->fileToUploadIsAnHtmlFile()
        ) {
            $this->assertFalse(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible() must ' .
                'return false if ' .
                TextAdventureUploader::class .
                '->fileToUploadIsAnHtmlFile() ' .
                'returns false'
            );
        }
    }

    public function testUploadIsPossibleReturnsFalseIfNameOfFileToUploadReturnsTheString_NO_FILE_SELECTED(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        if(
            $textAdventureUploader->nameOfFileToUpload()
            ===
            TextAdventureUploader::NO_FILE_SELECTED
        ) {
            $this->assertFalse(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible() must return false ' .
                'if ' . TextAdventureUploader::class .
                '->nameOfFileToUpload() returns the string' .
                TextAdventureUploader::NO_FILE_SELECTED
            );
        }
    }

    public function testUploadIsPossibleReturnsFalseIfPreviousRequestIdDoesNotMatchPostRequestId(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        if(
            $textAdventureUploader->previousRequest()->getUniqueId()
            !==
            $textAdventureUploader->postRequestId()
        ) {
            $this->assertFalse(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible() must return false ' .
                'if the id returned by ' .
                TextAdventureUploader::class .
                '->postRequestId() does not match the ' .
                'the previous ' . Request::class . '\'s ' .
                'unique id.'
            );
        }
    }

    public function testUploadIsPossibleReturnsFalseIfPostRequestIdDoesNotMatchPreviousRequestId(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: true,
            setPostRequestId: true,
        );
        /**
         * Instantiate initial instance to set previous
         * Request.
         */
        $intialTextAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        /**
         * Instantiate a second instance to invalidate
         * previous Request.
         */
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        if(
            $textAdventureUploader->previousRequest()->getUniqueId()
            !==
            $textAdventureUploader->postRequestId()
        ) {
            $this->assertFalse(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible()' .
                'must return false if the ' .
                'previous Request\'s id does not' .
                'match the postRequestId set in $_POST'
            );
        }
    }

    public function testAFileWasSelectedReturnsFalseIfAFileWasNotSeletedForUpload(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertFalse(
            $textAdventureUploader->aFileWasSelectedForUpload(),
            TextAdventureUploader::class .
            '->aFileWasSelectedForUpload() must return `false` if ' .
            'a file was not selected for upload.'
        );
    }

    public function testAFileWasSelectedReturnsTrueIfAFileWasSeletedForUpload(): void
    {
        $request = $this->mockRequest();
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertTrue(
            $textAdventureUploader->aFileWasSelectedForUpload(),
            TextAdventureUploader::class .
            '->aFileWasSelectedForUpload() must return `true` if ' .
            'a file was selected for upload.'
        );
    }

    public function testUploadIsPossibleReturnsFalseIfAFileWasSelectedReturnsFalse(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        if(!$textAdventureUploader->aFileWasSelectedForUpload()) {
            $this->assertFalse(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->aFileWasSelectedForUpload() must return `false`' .
                'if a file was not selected for upload.'
            );
        }
    }

    public function testUploadIsPossibleReturnsTrueIf_AFileWasSelected_TheSelectedFileIsAnHtmlFile_TheSelectedFileDoesNotExceedTheMaximumFileSize_ThePostRequestIdMatchesThePreviousRequestId(): void
    {
        $request = $this->mockRequest();
        $testFileName = $request->getUniqueId() . '.html';
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        if(
            $textAdventureUploader->aFileWasSelectedForUpload()
            &&
            $textAdventureUploader->fileToUploadIsAnHtmlFile()
            &&
            !$textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize()
            &&
            (
                $textAdventureUploader->previousRequest()->getUniqueId()
                ===
                $textAdventureUploader->postRequestId()
            )
        ) {
            $this->assertTrue(
                $textAdventureUploader->uploadIsPossible(),
                TextAdventureUploader::class .
                '->uploadIsPossible() must return `true` if ' .
                'a file was selected for upload, the selected ' .
                'file is an html file, file does not exceed the ' .
                'maximum allowed file size, and the postRequestId ' .
                'matches the previous ' . Request::class . '\'s id.'
            );
        }
    }

    public function test_A_FILE_WAS_NOT_SELECTED_FOR_UPLOAD_ERROR_MESSAGE_IsAssignedTheAppropriateErrorMessage(): void
    {
        $expectedErrorMessage = 'A Twine html file was not ' .
           'selected. Please select a Twine html file to upload!';
        $this->assertEquals(
            $expectedErrorMessage,
            TextAdventureUploader::A_FILE_WAS_NOT_SELECTED_FOR_UPLOAD_ERROR_MESSAGE,
            TextAdventureUploader::class .
            '::A_FILE_WAS_NOT_SELECTED_FOR_UPLOAD_ERROR_MESSAGE ' .
            'must be assigned the string: ' .
            $expectedErrorMessage
        );
    }

    public function testErrorsReturnsAnArrayThatIncludesAnErrorMessageIndicatingAFileWasNotSelectedForUploadIfAFileWasSelectedForUploadReturnsFalse(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockRequest(),
            $this->mockComponentCrud()
        );
        if(!$textAdventureUploader->aFileWasSelectedForUpload()) {
            $this->assertTrue(
                in_array(
                    TextAdventureUploader::A_FILE_WAS_NOT_SELECTED_FOR_UPLOAD_ERROR_MESSAGE,
                    $textAdventureUploader->errorMessages(),
                ),
                TextAdventureUploader::class .
                '->errorMessages() must return an array that ' .
                'includes an error message that indicates a ' .
                'file was not selected for upload if ' .
                TextAdventureUploader::class .
                '->aFileWasSelectedForUpload() returns `false`'
            );
        }
    }

    public function test_SELECTED_FILE_IS_NOT_AN_HTML_FILE_ERROR_MESSAGE_IsAssignedTheAppropriateErrorMessage(): void
    {
        $expectedErrorMessage = 'The selected file is not a valid ' .
           ' html file. Only html files may be uploaded.';
        $this->assertEquals(
            $expectedErrorMessage,
            TextAdventureUploader::SELECTED_FILE_IS_NOT_AN_HTML_FILE_ERROR_MESSAGE,
            TextAdventureUploader::class .
            '::SELECTED_FILE_IS_NOT_AN_HTML_FILE_ERROR_MESSAGE ' .
            'must be assigned the string: ' .
            $expectedErrorMessage
        );
    }

    public function testErrorsReturnsAnArrayThatIncludesAnErrorMessageIndicatingATheSlectedFileIsNotAnHtmlFileIfFileToUploadIsAnHtmlFileReturnsFalse(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: true,
            fileIsAnHtmlFile: false,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        if(!$textAdventureUploader->fileToUploadIsAnHtmlFile()) {
            $this->assertTrue(
                in_array(
                    TextAdventureUploader::SELECTED_FILE_IS_NOT_AN_HTML_FILE_ERROR_MESSAGE,
                    $textAdventureUploader->errorMessages(),
                ),
                TextAdventureUploader::class .
                '->errorMessages() must return an array that ' .
                'includes an error message that indicates a ' .
                'the selected file is not an html file if ' .
                TextAdventureUploader::class .
                '->fileToUploadIsAnHtmlFile() returns `false`'
            );
        }
    }

    public function test_FILE_TO_UPLOAD_SIZE_EXCEEDS_ALLOWED_FILE_SIZE_ERROR_MESSAGE_IsAssignedTheAppropriateErrorMessage(): void
    {
        $expectedErrorMessage = 'The selected file is too large! ' .
            'Please choose a file that is less than ' .
            strval(
                (
                    TextAdventureUploader::MAXIMUM_ALLOWED_FILE_SIZE
                    *
                    0.000001
                )
            ) . ' megabytes.';
        $this->assertEquals(
            $expectedErrorMessage,
            TextAdventureUploader::FILE_TO_UPLOAD_SIZE_EXCEEDS_ALLOWED_FILE_SIZE_ERROR_MESSAGE,
            TextAdventureUploader::class .
            '::FILE_TO_UPLOAD_SIZE_EXCEEDS_ALLOWED_FILE_SIZE_ERROR_MESSAGE ' .
            'must be assigned the string: ' .
            $expectedErrorMessage
        );
    }

    public function testErrorsReturnsAnArrayThatIncludesAnErrorMessageIndicatingATheSlectedFilesSizeExceedsTheMaximumAllowedFileSizeIfFileToUploadSizeExceedsAllowedFileSizeReturnsTrue(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->mockUploadRequest(
            $request,
            fileWasSelected: true,
            fileSizeIsValid: false,
            fileIsAnHtmlFile: true,
            setReplaceExistingGame: false,
            setPostRequestId: true,
        );
        if($textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize()) {
            $this->assertTrue(
                in_array(
                    TextAdventureUploader::FILE_TO_UPLOAD_SIZE_EXCEEDS_ALLOWED_FILE_SIZE_ERROR_MESSAGE,
                    $textAdventureUploader->errorMessages(),
                ),
                TextAdventureUploader::class .
                '->errorMessages() must return an array that ' .
                'includes an error message that indicates a ' .
                'the selected file\'s size eceeds the ' .
                'maximum allowed files size if ' .
                TextAdventureUploader::class .
                '->fileToUploadIsAnHtmlFile() returns `false`'
            );
        }
    }

    public function testRootUrlReturnsRootUrlDerivedFromSpecifiedRequest(): void
    {
        $request = $this->mockRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $scheme = parse_url(
            $request->getUrl(),
            PHP_URL_SCHEME
        );
        $host = parse_url($request->getUrl(), PHP_URL_HOST);
        $port =  parse_url($request->getUrl(), PHP_URL_PORT);
        $expectedRootUrl = $scheme . '://' . $host .
            (empty($port) ? '' : ':' . $port);
        $this->assertEquals(
            $expectedRootUrl,
            $textAdventureUploader->rootUrl(),
        );
    }

    public function test_MAXIMUM_ALLOWED_FILE_SIZE_IsAssignedTheInteger_1000000(): void
    {
        $this->assertEquals(
            self::MAXIMUM_ALLOWED_FILE_SIZE,
            TextAdventureUploader::MAXIMUM_ALLOWED_FILE_SIZE,
            TextAdventureUploader::class .
            '::MAXIMUM_ALLOWED_FILE_SIZE must be assigned the ' .
            'integer ' .
            self::MAXIMUM_ALLOWED_FILE_SIZE
        );
    }

    public function test_FILE_WAS_ALREADY_UPLOADED_AND_REQUEST_DID_NOT_INDICATE_EXISTING_FILE_SHOULD_BE_REPLACE_ERROR_MESSAGE_IsAssignedTheAppropriateErrorMessage(): void
    {
        // FILE_WAS_ALREADY_UPLOADED_AND_REQUEST_DID_NOT_INDICATE_EXISTING_FILE_SHOULD_BE_REPLACE_ERROR_MESSAGE
        $expectedErrorMessage = 'A file already exists whose name ' .
            'matches the name of the specified file\'s name. ' .
            'Please select a file with a different name, or check ' .
            'the  "Replace Existing" box.';
        $this->assertEquals(
            $expectedErrorMessage,
            TextAdventureUploader::FILE_WAS_ALREADY_UPLOADED_AND_REQUEST_DID_NOT_INDICATE_EXISTING_FILE_SHOULD_BE_REPLACE_ERROR_MESSAGE,
            TextAdventureUploader::class .
            '::FILE_WAS_ALREADY_UPLOADED_AND_REQUEST_DID_NOT_INDICATE_EXISTING_FILE_SHOULD_BE_REPLACE_ERROR_MESSAGE ' .
            'must be assigned the string: ' .
            $expectedErrorMessage
        );
    }
}

/**
 *

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
 */

