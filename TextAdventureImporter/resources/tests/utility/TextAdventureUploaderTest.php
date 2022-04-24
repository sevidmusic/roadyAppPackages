<?php

namespace Apps\TextAdventureImporter\resources\tests\utility;

use PHPUnit\Framework\TestCase;
use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;

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

    public function testNameOfFileToUploadRetunrsTheString_NO_FILE_SELECTED_IfAFileHasNotBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
        $this->assertEquals(
            'NO_FILE_SELECTED',
            $textAdventureUploader->nameOfFileToUpload()
        );
    }

    public function testNameOfFileToUploadRetunrsTheNameOfTheFileToUploadIfAFileHasBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
        $_FILES["fileToUpload"]["name"] = 'Foo.html';
        $this->assertEquals(
            $_FILES["fileToUpload"]["name"],
            $textAdventureUploader->nameOfFileToUpload()
        );
    }

    public function testPathToUploadFileToReturnsTheNameOfFileToUploadPrefixedByThePathToUploadsDirectory(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
        $_FILES["fileToUpload"]["name"] = 'Foo.html';
        $this->assertEquals(
            $textAdventureUploader->pathToUploadsDirectory() . DIRECTORY_SEPARATOR . $textAdventureUploader->nameOfFileToUpload(),
            $textAdventureUploader->pathToUploadFileTo()
        );
    }

    public function testPathToUploadFileToReturnsTheString_NO_FILE_SELECTED_IfAFileHasNotBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
        $this->assertEquals(
            'NO_FILE_SELECTED',
            $textAdventureUploader->pathToUploadFileTo()
        );
    }

    public function testPathToUploadsDirectoryReturnsExpectedPathToUploadsDirectory(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
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
}

