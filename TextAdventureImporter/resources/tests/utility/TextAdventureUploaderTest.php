<?php

namespace Apps\TextAdventureImporter\resources\tests\utility;

use PHPUnit\Framework\TestCase;
use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;

class TextAdventureUploaderTest extends TestCase
{

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

    public function testPathToUploadFileToReturnsTheString_NO_FILE_SELECTED_IfAFileHasNotBeenSelectedForUpload(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
        $this->assertEquals(
            'NO_FILE_SELECTED',
            $textAdventureUploader->pathToUploadFileTo()
        );
    }

    public function testPathToUploadFileToReturnsNameOfFileSelectedForUploadPrefixedByPathToUploadsDirectory(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
        $_FILES["fileToUpload"]["name"] = 'Foo.html';
        $this->assertEquals(
            $textAdventureUploader->pathToUploadsDirectory() . DIRECTORY_SEPARATOR . $_FILES["fileToUpload"]["name"],
            $textAdventureUploader->pathToUploadFileTo()
        );
    }
}

