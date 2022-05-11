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

    public function tearDown(): void
    {
        unset($_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX]);
        foreach(
            $this->mockComponentCrud()
                 ->readAll(
                     $this->mockCurrentRequest()->getLocation(),
                     $this->mockCurrentRequest()->getContainer()
                 ) as $testComponent
        ) {
            $this->mockComponentCrud()->delete($testComponent);
        }

    }

    public function testNameOfFileToUploadRetunrsTheValueOfTheNO_FILE_SELECTEDConstantIfAFileHasNotBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
            $this->mockComponentCrud()
        );
        $this->assertEquals(
             TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->nameOfFileToUpload()
        );
        /**
         * Also test for case where
         * $_FILES
         *     [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
         *     [TextAdventureUploader::FILENAME_INDEX]
         * is empty.
         */
        $_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
               [TextAdventureUploader::FILENAME_INDEX] = '';
        $this->assertEquals(
             TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->nameOfFileToUpload()
        );
    }

    public function testNameOfFileToUploadRetunrsTheNameOfTheFileToUploadIfAFileHasBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
            $this->mockComponentCrud()
        );
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = 'TwineFile.html';
        $this->assertEquals(
            $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX],
            $textAdventureUploader->nameOfFileToUpload()
        );
    }

    public function testPathToUploadFileToReturnsTheNameOfFileToUploadPrefixedByThePathToUploadsDirectory(): void
    {
        $request = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = $request->getUniqueId() . '.html';
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
            $this->mockCurrentRequest(),
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
            $this->mockCurrentRequest(),
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
            TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX
        );
    }

    public function testFILE_TO_UPLOAD_INDEXConstantIsAssignedTheString_fileToUpload(): void
    {
        $this->assertEquals(
            'fileToUpload',
            TextAdventureUploader::FILE_TO_UPLOAD_INDEX
        );
    }

    public function testPOST_REQUEST_ID_INDEXConstantIsAssignedTheString_postRequestId(): void
    {
        $this->assertEquals(
            TextAdventureUploader::POST_REQUEST_ID_INDEX,
            TextAdventureUploader::POST_REQUEST_ID_INDEX
        );
    }

    public function testREPLACE_EXISTING_GAMEConstantIsAssignedTheString_replaceExistingGame(): void
    {
        $this->assertEquals(
            TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX,
            TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX
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
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
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
        $request = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = $request->getUniqueId() . '.html';
        $this->assertTrue(
            $textAdventureUploader->fileToUploadIsAnHtmlFile(),
            TextAdventureUploader::class .
            '->fileToUploadIsAnHtmlFile() must return true if' .
            'file to upload does have the extension `html`.'
        );
    }

    public function testCurrentRequestReturnsARequestInstanceWhoseUrlMatchesTheRequestSpecifiedOnInstantiation(): void
    {
        $currentRequest = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $currentRequest,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $currentRequest->getUrl(),
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
        $currentRequest = $this->mockCurrentRequest();
        $currentRequest->import(['post' => ['post data']]);
        $textAdventureUploader = new TextAdventureUploader(
            $currentRequest,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $currentRequest->getPost(),
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
        $currentRequest = $this->mockCurrentRequest();
        $currentRequest->import(['get' => ['get data']]);
        $textAdventureUploader = new TextAdventureUploader(
            $currentRequest,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $currentRequest->getPost(),
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

    private function mockCurrentRequest(): Request
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

    public function testFileToUploadSizeExceedsAllowedFileSizeReturnsFalseIfSizeOfFileToUploadDoesNotExceedAllowedFileSizeOf_5000000_bytes(): void
    {
        $_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX][TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX] = 4999999;
        $currentRequest = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $currentRequest,
            $this->mockComponentCrud()
        );
        $this->assertFalse(
            $textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize(),
            TextAdventureUploader::class .
            '->fileToUploadSizeExceedsAllowedFileSize() must ' .
            'return false if size of file to upload does not ' .
            'exceed the maximum allowed file size of 5000000 bytes.'
        );
    }

    public function testFileToUploadSizeExceedsAllowedFileSizeReturnsTrueIfSizeOfFileToUploadExceedsAllowedFileSizeOf_5000000_bytes(): void
    {
        $_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX][TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX] = 5000001;
        $currentRequest = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $currentRequest,
            $this->mockComponentCrud()
        );
        $this->assertTrue(
            $textAdventureUploader->fileToUploadSizeExceedsAllowedFileSize(),
            TextAdventureUploader::class .
            '->fileToUploadSizeExceedsAllowedFileSize() must ' .
            'return true if size of file to upload exceeds ' .
            'the maximum allowed file size of 5000000 bytes.'
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
            $this->mockCurrentRequest(),
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
        $currentRequest = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $currentRequest,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $currentRequest,
            $this->mockComponentCrud()->read(
                $currentRequest
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
        $previousRequest = $this->mockCurrentRequest();
        $newRequest = $this->mockCurrentRequest();
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
        $previousRequest = $this->mockCurrentRequest();
        $firstTextAdventureUploader = new TextAdventureUploader(
            $previousRequest,
            $this->mockComponentCrud()
        );
        $secondTextAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
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
        $newRequest = $this->mockCurrentRequest();
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
        $request = $this->mockCurrentRequest();
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
        $request = $this->mockCurrentRequest();
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

    public function testReplaceExistingGameReturnsFalseIfValueSetInSpecifiedRequestsPOSTDataForReplaceExistingGameIsNotSetToTheString_true(): void
    {
        $request = $this->mockCurrentRequest();
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

    public function testReplaceExistingGameReturnsTrueIfValueSetInSpecifiedRequestsPOSTDataForReplaceExistingGameIsSetToTheString_true(): void
    {
        $request = $this->mockCurrentRequest();
        $request->import(
            [
                'post' => [
                    TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX
                    => 'true'
                ]
            ]
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

    public function testFileToUploadsTemporaryNameReturnsTheString_NO_FILE_SELECTED_If_fileToUpload__tmp_name_IsNotSetIn_FILES(): void
    {
        $request = $this->mockCurrentRequest();
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

    public function testFileToUploadsTemporaryNameReturnsValueAssignedTo_fileToUpload__tmp_name_IfItIsSetIn_FILES(): void
    {
        $request = $this->mockCurrentRequest();
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::TEMPORARY_FILENAME_INDEX]
            = $request->getUniqueId();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request->getUniqueId(),
            $textAdventureUploader->fileToUploadsTemporaryName(),
            TextAdventureUploader::class .
            '->fileToUploadsTemporaryName() must return an ' .
            'empty string if ' .
            '$_FILES[' .
            TextAdventureUploader::FILE_TO_UPLOAD_INDEX .
            '][' .
            TextAdventureUploader::FILENAME_INDEX .
            '] is not set.'
        );
    }

    public function testUploadCreatesUploadsDirectoryIfItDoesNotExist(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
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
        $request = $this->mockCurrentRequest();
        $testFileName = $request->getUniqueId() . '.html';
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = $testFileName;
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
        $request = $this->mockCurrentRequest();
        $testFileName = $request->getUniqueId() . '.html';
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = $testFileName;
        $request->import(
            [
                'post' => [
                    TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX
                    => 'true',
                    TextAdventureUploader::POST_REQUEST_ID_INDEX
                    => $request->getUniqueId()
                ]
            ]
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
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILE_TO_UPLOAD_SIZE_INDEX]
            = 5000001;
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
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

        $request = $this->mockCurrentRequest();
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = $request->getUniqueId();
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
            $this->mockCurrentRequest(),
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
            $this->mockCurrentRequest(),
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
        $request = $this->mockCurrentRequest();
        $testFileName = $request->getUniqueId() . '.html';
        $_FILES
            [TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
            [TextAdventureUploader::FILENAME_INDEX]
            = $testFileName;
        $request->import(
            [
                'post' => [
                    TextAdventureUploader::REPLACE_EXISTING_GAME_INDEX
                    => 'true',
                    TextAdventureUploader::POST_REQUEST_ID_INDEX
                    => $request->getUniqueId()
                ]
            ]
        );
        /**
         * Instantiate initial instance to set previous
         * Request.
         */
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        /**
         * Instantiate a second instance to invalidate
         * previous Request.
         */
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
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
}

/**
 *
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

