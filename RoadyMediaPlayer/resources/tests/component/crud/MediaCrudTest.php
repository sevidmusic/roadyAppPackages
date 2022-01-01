<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\crud;

use PHPUnit\Framework\TestCase;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use roady\classes\primary\Positionable;

class MediaCrudTest extends TestCase 
{

    /**
     * Return a new Media instance for testing.
     */
    protected function newMediaInstance(): Media {
        $mediaUrls = [
            'https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg4.png',
            'https://ddmsmedia.us-east-1.linodeobjects.com/READMEDemo.gif',
            'https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm',
            'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
            'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3',
        ];
        return new Media(
            'name',
            new Positionable(rand(0, 1000)),
            $mediaUrls[array_rand($mediaUrls)],
            [
                'Artist' => 'Foo' . rand(0, 1000),
                'Title' => 'Bar' . rand(0, 1000),
                'Description' => 'Lorem ' . rand(0, 87) . 'ipsum',
                'Added' => date('YmdHms'),
            ]
        );
    }

    public function testShouldFail(): void { $this->assertFalse(true); }
}
