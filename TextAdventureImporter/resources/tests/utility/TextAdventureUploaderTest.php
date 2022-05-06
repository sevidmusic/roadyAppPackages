<?php

namespace Apps\TextAdventureImporter\resources\tests\utility;

use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;
use PHPUnit\Framework\TestCase;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

/**
 * Defines tests for the TextAdventureUploader.
 *
 * Methods:
 * public function tearDown(): void
 * public function testNameOfFileToUploadRetunrsTheString_NO_FILE_SELECTED_IfAFileHasNotBeenSelectedForUpload(): void
 * public function testPathToUploadFileToReturnsNameOfFileSelectedForUploadPrefixedByPathToUploadsDirectory(): void
 * public function testPathToUploadFileToReturnsTheString_NO_FILE_SELECTED_IfAFileHasNotBeenSelectedForUpload(): void
 * public function testPathToUploadsDirectoryReturnsExpectedPathToUploadsDirectory(): void
 *
 */
class TextAdventureUploaderTest extends TestCase
{

    public function tearDown(): void
    {
        unset($_FILES["fileToUpload"]["name"]);
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
         * Also test for case where $_FILES['fileToUpload']['name']
         * is empty
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
        $_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
               [TextAdventureUploader::FILENAME_INDEX] = 'TwineFile.html';
        $this->assertEquals(
            $_FILES["fileToUpload"]["name"],
            $textAdventureUploader->nameOfFileToUpload()
        );
    }

    public function testPathToUploadFileToReturnsTheNameOfFileToUploadPrefixedByThePathToUploadsDirectory(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
            $this->mockComponentCrud()
        );
        $_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX]
               [TextAdventureUploader::FILENAME_INDEX] = 'TwineFile.html';
        $this->assertEquals(
            $textAdventureUploader->pathToUploadsDirectory() . DIRECTORY_SEPARATOR . $textAdventureUploader->nameOfFileToUpload(),
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

    public function testFILE_TO_UPLOAD_INDEXConstantIsAssignedTheString_fileToUpload(): void
    {
        $this->assertEquals(
            'fileToUpload',
            TextAdventureUploader::FILE_TO_UPLOAD_INDEX
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
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest(),
            $this->mockComponentCrud()
        );
        $_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX][TextAdventureUploader::FILENAME_INDEX] = 'foo.html';
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
        $_FILES["fileToUpload"]["size"] = 4999999;
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
        $_FILES["fileToUpload"]["size"] = 5000001;
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
            'The specified ' . Request::class . ' must be stored on ' .
            'instantiation of a new ' . TextAdventureUploader::class
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


    public function testPostRequestIdReturnsAnEmptyStringIfNotSetInCurrentRequestsPOSTData(): void
    {
        $request = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEmpty(
            $textAdventureUploader->postRequestId(),
            TextAdventureUploader::class .
            '->postRequestId() must return an empty ' .
            'string if the specified ' . Request::class .
            '\'s $_POST data does not contain a postRequestId.'
        );
    }

    public function testPostRequestIdReturnsThePostRequestIdSetInTheCurrentRequestsPOSTData(): void
    {
        $request = $this->mockCurrentRequest();
        $request->import(
            [
                'post' => [
                    'postRequestId' => $request->getUniqueId()
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
            'postRequestId set in the specified ' .
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
                    'replaceExistingGame' => 'true'
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

    public function testFileToUploadsActualNameReturnsAnEmptyStringIf_fileToUpload_name_IsNotSetIn_FILES(): void
    {
        $request = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEmpty(
            $textAdventureUploader->fileToUploadsActualName(),
            TextAdventureUploader::class .
            '->fileToUploadsActualName() must return an ' .
            'empty string if $_FILES["fileToUpload"]["name"] is ' .
            'not set'
        );
    }

    public function testFileToUploadsActualNameReturnsValueAssignedTo_fileToUpload_name_IsSetIn_FILES(): void
    {
        $request = $this->mockCurrentRequest();
        $_FILES["fileToUpload"]["name"] = $request->getUniqueId();
        $textAdventureUploader = new TextAdventureUploader(
            $request,
            $this->mockComponentCrud()
        );
        $this->assertEquals(
            $request->getUniqueId(),
            $textAdventureUploader->fileToUploadsActualName(),
            TextAdventureUploader::class .
            '->fileToUploadsActualName() must return an ' .
            'empty string if $_FILES["fileToUpload"]["name"] is ' .
            'not set'
        );
    }
}

