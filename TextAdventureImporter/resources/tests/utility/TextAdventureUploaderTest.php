<?php

namespace Apps\TextAdventureImporter\resources\tests\utility;

use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;
use PHPUnit\Framework\TestCase;
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
    }

    public function testNameOfFileToUploadRetunrsTheValueOfTheNO_FILE_SELECTEDConstantIfAFileHasNotBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest()
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
            $this->mockCurrentRequest()
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
            $this->mockCurrentRequest()
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
            $this->mockCurrentRequest()
        );
        $this->assertEquals(
             TextAdventureUploader::NO_FILE_SELECTED,
            $textAdventureUploader->pathToUploadFileTo()
        );
    }

    public function testPathToUploadsDirectoryReturnsExpectedPathToUploadsDirectory(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest()
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

    public function testFILENAME_INDEXConstantIsAssignedTheString_fileToUpload(): void
    {
        $this->assertEquals(
            'name',
            TextAdventureUploader::FILENAME_INDEX
        );
    }

    public function testNO_FILE_SELECTEDConstantIsAssignedTheString_fileToUpload(): void
    {
        $this->assertEquals(
            'NO_FILE_SELECTED',
            TextAdventureUploader::NO_FILE_SELECTED
        );
    }

    public function testFileToUploadIsAnHtmlFileReturnsFalseIfFileSelcetedForUploadDoesNotHaveTheExtension_html(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest()
        );
        $this->assertFalse(
            $textAdventureUploader->fileToUploadIsAnHtmlFile(),
            TextAdventureUploader::class .
            '->' . __FUNCTION__ .
            '() must return false if file '.
            'to upload does not have the extension `html`.'
        );
    }

    public function testFileToUploadIsAnHtmlFileReturnsTrueIfFileSelcetedForUploadHasTheExtension_html(): void
    {
        $textAdventureUploader = new TextAdventureUploader(
            $this->mockCurrentRequest()
        );
        $_FILES[TextAdventureUploader::FILE_TO_UPLOAD_INDEX][TextAdventureUploader::FILENAME_INDEX] = 'foo.html';
        $this->assertTrue(
            $textAdventureUploader->fileToUploadIsAnHtmlFile(),
            TextAdventureUploader::class .
            '->' . __FUNCTION__ .
            '() must return true if file '.
            'to upload has the extension `html`.'
        );
    }

    public function testCurrentRequestReturnsARequestInstanceWhoseUrlMatchesTheCurrentRequestsUrl(): void
    {
        $currentRequest = $this->mockCurrentRequest();
        $textAdventureUploader = new TextAdventureUploader(
            $currentRequest
        );
        $this->assertEquals(
            $currentRequest->getUrl(),
            $textAdventureUploader->currentRequest()->getUrl(),
            TextAdventureUploader::class .
            '->' .
            __FUNCTION__ .
            '() must return a ' .
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
            $currentRequest
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
            $currentRequest
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
}

