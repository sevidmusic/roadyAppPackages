<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\media;

use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use roady\classes\primary\Positionable;

/**
 * Defines tests for the Image calass.
 */
class ImageTest extends MediaTest
{

    protected function newMediaInstance(
        string $mediaName = 'Media',
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Media {
        return $this->newImageInstance(
            imageName: $mediaName,
            mediaUrl: $mediaUrl, 
            mediaPosition: $mediaPosition, 
            metaData: $metaData
        ); 
    }

    /**
     * Return a new Image instance for testing.
     *
     * @param string $mediaUrl The url to assign to the test Image.
     *
     * @param int|float $mediaPosition The position to assign to the
     *                                 test Image.
     * 
     * @param array<string, string> $metaData The meta data to assign
     *                                        to the test Image.
     */
    protected function newImageInstance(
        string $imageName = 'Image',
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Image {
        return new Image(
            $imageName,
            new Positionable($mediaPosition),
            $mediaUrl,
            $metaData
        );
    }

    public function testMediaIsAccessibleReturnsFalseIfMediasUrlPointsToMediaWithAnUnSupportedMimeType(): void
    {
        $image = $this->newImageInstance(mediaUrl: 'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp4');
        $this->assertFalse(
            $image->mediaIsAccessible()
        );
    }

    public function testMediaIsAccessibleReturnsTrueIfMediasUrlPointsToMediaWithASupportedMimeType(): void
    {
        $validMediaUrls = [
            'https://roadymedia.us-east-1.linodeobjects.com/roadyLogo.png',
            'https://roadymedia.us-east-1.linodeobjects.com/favicon.ico',
            'https://ddmsmedia.us-east-1.linodeobjects.com/image2.jpg',
            'https://ddmsmedia.us-east-1.linodeobjects.com/DDMSInstallationExample.gif',
        ];
        foreach($validMediaUrls as $mediaUrl) {
            $image = $this->newImageInstance(mediaUrl: $mediaUrl);
            $this->assertTrue(
                $image->mediaIsAccessible()
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
