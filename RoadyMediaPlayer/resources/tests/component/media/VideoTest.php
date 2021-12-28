<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\media;

use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

class VideoTest extends MediaTest
{

    protected function newMediaInstance(
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Media {
        return $this->newVideoInstance(
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
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Video {
        return new Video(
            new Storable(
                'name',
                'location',
                'container'
            ),
            new Switchable(),
            new Positionable($mediaPosition),
            $mediaUrl,
            $metaData
        );
    }

    /**
     * @return array<int, string> An array of Mime types supported 
     *                            video Mime Types.
     */
    private function supportedVideoMimeTypes(): array 
    {
        return [
            'video/webm',
            'video/mp4',
        ];
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
