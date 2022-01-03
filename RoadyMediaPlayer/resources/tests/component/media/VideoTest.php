<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\media;

use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use roady\classes\primary\Positionable;

/**
 * Defines tests for the Video class.
 */
class VideoTest extends MediaTest
{

    protected function newMediaInstance(
        string $mediaName = 'Video',
        string $mediaUrl = 'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Media {
        return $this->newVideoInstance(
            videoName: $mediaName,
            mediaUrl: $mediaUrl, 
            mediaPosition: $mediaPosition, 
            metaData: $metaData
        ); 
    }

    /**
     * Return a new Video instance for testing.
     *
     * @param string $mediaUrl The url to assign to the test Video.
     *
     * @param int|float $mediaPosition The position to assign to the
     *                                 test Video.
     * 
     * @param array<string, string> $metaData The meta data to assign
     *                                        to the test Video.
     */
    protected function newVideoInstance(
        string $videoName = 'Video',
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Video {
        return new Video(
            $videoName,
            new Positionable($mediaPosition),
            $mediaUrl,
            $metaData
        );
    }

    public function testMediaIsAccessibleReturnsFalseIfMediasUrlPointsToMediaWithAnUnSupportedMimeType(): void
    {
        $video = $this->newVideoInstance(mediaUrl: 'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3');
        $this->assertFalse(
            $video->mediaIsAccessible()
        );
    }

    public function testMediaIsAccessibleReturnsTrueIfMediasUrlPointsToMediaWithASupportedMimeType(): void
    {
        $validMediaUrls = [
            'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
            'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp4',
        ];
        foreach($validMediaUrls as $mediaUrl) {
            $video = $this->newVideoInstance(mediaUrl: $mediaUrl);
            $this->assertTrue(
                $video->mediaIsAccessible()
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
