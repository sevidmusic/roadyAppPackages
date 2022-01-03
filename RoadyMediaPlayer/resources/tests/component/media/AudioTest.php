<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\media;

use Apps\RoadyMediaPlayer\resources\classes\component\media\Audio;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use roady\classes\primary\Positionable;

/**
 * Defines tests for the Audio class.
 */
class AudioTest extends MediaTest
{

    protected function newMediaInstance(
        string $mediaName = 'Audio',
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Media {
        return $this->newAudioInstance(
            audioName: $mediaName,
            mediaUrl: $mediaUrl, 
            mediaPosition: $mediaPosition, 
            metaData: $metaData
        ); 
    }

    /**
     * Return a new Audio instance for testing.
     *
     * @param string $mediaUrl The url to assign to the test Audio.
     *
     * @param int|float $mediaPosition The position to assign to the
     *                                 test Audio.
     * 
     * @param array<string, string> $metaData The meta data to assign
     *                                        to the test Audio.
     */
    protected function newAudioInstance(
        string $audioName = 'Audio',
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Audio {
        return new Audio(
            $audioName,
            new Positionable($mediaPosition),
            $mediaUrl,
            $metaData
        );
    }

    public function testMediaIsAccessibleReturnsFalseIfMediasUrlPointsToMediaWithAnUnSupportedMimeType(): void
    {
        $audio = $this->newAudioInstance(mediaUrl: 'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp4');
        $this->assertFalse(
            $audio->mediaIsAccessible()
        );
    }

    public function testMediaIsAccessibleReturnsTrueIfMediasUrlPointsToMediaWithASupportedMimeType(): void
    {
        $validMediaUrls = [
            'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3',
        ];
        foreach($validMediaUrls as $mediaUrl) {
            $audio = $this->newAudioInstance(mediaUrl: $mediaUrl);
            $this->assertTrue(
                $audio->mediaIsAccessible()
            );
        }
    }

    public function testMediaIsAccessibleReturnsTrueIfRequestToMediasUrlReturnsHttpResponseCode200(): void
    {
        /** 
         * Overwrite parent test method:
         *
         *  MediaTest::testMediaIsAccessibleReturnsTrueIfRequestToMediasUrlReturnsHttpResponseCode200(), 
         *
         * A 200 response is not sufficient, Mime/Content Type must 
         * match as well. 
         *
         */
        $this->testMediaIsAccessibleReturnsTrueIfMediasUrlPointsToMediaWithASupportedMimeType();
    }
}
