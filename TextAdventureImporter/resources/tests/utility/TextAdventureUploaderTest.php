<?php

namespace Apps\TextAdventureImporter\resources\tests\utility;

use PHPUnit\Framework\TestCase;
use Apps\TextAdventureImporter\resources\classes\utility\TextAdventureUploader;

class TextAdventureUploaderTest extends TestCase
{

    public function testUploadsDirectoryPathReturnsExpectedPathToUploadsDirectory(): void
    {
        $textAdventureUploader = new TextAdventureUploader();
        error_log(
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
    }
}

