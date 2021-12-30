<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\media;

use PHPUnit\Framework\TestCase;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use roady\classes\primary\Positionable;

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
        string $mediaName = 'Media',
        string $mediaUrl = 'http://localhost:8080', 
        int|float $mediaPosition = 0, 
        array $metaData = []
    ): Media {
        return new Media(
            $mediaName,
            new Positionable($mediaPosition),
            $mediaUrl,
            $metaData
        );
    }

    public function testGetNameReturnsAssignedName(): void
    {
        $expectedName = 'MediaName' . rand(0, 10000);
        $media = $this->newMediaInstance(mediaName: $expectedName);
        $this->assertEquals(
            $expectedName,
            $media->getName()
        );
    }

    public function testGetLocationReturnsValueAssignedToMEDIA_LOCATIONConstant(): void
    {
        $media = $this->newMediaInstance();
        $this->assertEquals(
            Media::MEDIA_LOCATION,
            $media->getLocation(),
        );
    }

    public function testGetContainerReturnsMediTypeWithoutNamespace(): void
    {
        $media = $this->newMediaInstance();
        $typeName = explode('\\', $media->getType());
        $typeName = array_pop($typeName);
        $this->assertEquals(
            $typeName,
            $media->getContainer(),
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

    public function testMetaDataReturnsASingleDimensionalAssociativeArrayWhoseKeysAndValuesAreStrings(): void 
    {
        $specifiedMetaData = [
            'foo' => 'bar' . rand(1000, 9999),
            'bar' => strval(rand(0, 10)),
            'baz' => [
                'foo' => 'value should be ignored',
                'bar' => 'value should be ignored',
            ],
            rand(0, 9999),
            123.456789,
            (object) ['foo' => 'bar'],
        ];
        /** @phpstan-ignore-next-line */
        $media = $this->newMediaInstance(metaData:$specifiedMetaData);
        foreach($media->metaData() as $key => $value) {
            $this->assertTrue(
                is_string($key), 
                'Media::metaData() must return an array whose keys are strings.'
            );
            $this->assertTrue(
                is_string($value), 
                'Media::metaData() must return an array whose values are strings.'
            );
        }
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
        $specifiedUrl = 'https://darlingdata.tech/index.php';
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertTrue(
            $media->mediaIsAccessible()
        );
    }
}

