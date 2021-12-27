<?php

namespace Apps\RoadyMediaPlayer\resources\tests\media;

use PHPUnit\Framework\TestCase;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

class MediaTest extends TestCase 
{

    /**
     * Return a new Media instance for testing.
     *
     * @param string $mediaUrl The url to assign to the test Media.
     *
     * @param int|float $mediaPosition The position to assign to the
     *                                 test Media.
     * 
     * @param array<string, string> $metaData The meta data to assign
     *                                        to the test Media.
     */
    protected function newMediaInstance(
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Media {
        return new Media(
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

    public function testMediaUrlReturnsAssignedMediaUrl(): void 
    {
        $specifiedUrl = 'http://localhost:' . rand(8000, 8999);
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertEquals(
            $specifiedUrl,
            $media->mediaUrl(),
            'Media::mediaUrl() must return the url assigned on instantiation.'
        );
    }

    public function testMetaDataReturnsAssignedMetaData(): void 
    {
        $specifiedMetaData = [
            'foo' => 'bar' . rand(1000, 9999),
            'baz' => strval(rand(0, 10)),
        ];
        $media = $this->newMediaInstance(metaData:$specifiedMetaData);
        $this->assertEquals(
            $specifiedMetaData,
            $media->metaData(),
            'Media::metaData() must return the array of meta data assigned on instantiation.'
        );
    }

    public function testIncreasePositionIncreasesPosition(): void 
    {
        $specifiedPosition = rand(0, 1000);
        $media = $this->newMediaInstance(mediaPosition:$specifiedPosition);
        $media->increasePosition();
        $this->assertTrue(
            $media->getPosition() > $specifiedPosition
        );
    }

    public function testDecreasePositionDecreasesPosition(): void 
    {
        $specifiedPosition = rand(0, 1000);
        $media = $this->newMediaInstance(mediaPosition:$specifiedPosition);
        $media->decreasePosition();
        $this->assertTrue(
            $media->getPosition() < $specifiedPosition
        );
    }

    public function testGetPositionReturnsAssignedPosition(): void 
    {
        $specifiedPosition = rand(0, 1000);
        $media = $this->newMediaInstance(mediaPosition:$specifiedPosition);
        $this->assertEquals(
            $specifiedPosition,
            $media->getPosition()
        );
    }

    public function testSwitchStateSwitchesState(): void
    {
        $media = $this->newMediaInstance();
        $initialState = $media->getState();
        $media->switchState();
        $this->assertNotEquals(
            $initialState,
            $media->getState()
        );
    }

    public function testMediaIsAccessibleReturnsFalseIfMediasUrlIsNotAccessible(): void
    {
        $specifiedUrl = 'http://localhost:' . rand(8000, 8999) . '/' . rand(0, 1000) . '/url/is/not/accessible';
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertFalse(
            $media->mediaIsAccessible()
        );
    }

    public function testMediaIsAccessibleReturnsFalseIfRequestToMediasUrlDoesNotReturnHttpResponseCode200(): void
    {
        $specifiedUrl = 'https://roady.tech/page/does/not/exist.html';
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertFalse(
            $media->mediaIsAccessible()
        );
    }

    public function testMediaIsAccessibleReturnsTrueIfRequestToMediasUrlReturnsHttpResponseCode200(): void
    {
        $specifiedUrl = 'https://roady.tech/index.php';
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertTrue(
            $media->mediaIsAccessible()
        );
    }
}

