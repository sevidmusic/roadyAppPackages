<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\media;

use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

class ImageTest extends MediaTest
{

    protected function newMediaInstance(
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Media {
        return $this->newImageInstance(
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
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Image {
        return new Image(
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
    private function supportedImageMimeTypes(): array 
    {
        return [
            'image/png',
            'image/x-icon',
            'image/jpeg',
            'image/gif',
        ];
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
