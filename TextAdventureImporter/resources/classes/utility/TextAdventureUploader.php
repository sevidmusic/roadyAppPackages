<?php

namespace Apps\TextAdventureImporter\resources\classes\utility;

class TextAdventureUploader {


    public function uploadsDirectroyPath(): string
    {
        return (
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
