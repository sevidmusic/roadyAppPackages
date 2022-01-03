<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\media;

use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use UnitTests\classes\component\SwitchableComponentTest;
use roady\classes\primary\Positionable;
use Exception;

/**
 * Defines tests for the Media class.
 */
class MediaTest extends SwitchableComponentTest 
{

    public function setUp(): void
    {
        $this->setSwitchableComponent(
            $this->newMediaInstance()
        );
        $this->setSwitchableComponentParentTestInstances();
    }
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

    public function testDecreasePositionDecreasesPosition(): void 
    {
        $specifiedPosition = rand(0, 1000);
        $media = $this->newMediaInstance(mediaPosition:$specifiedPosition);
        $media->decreasePosition();
        $this->assertTrue(
            $media->getPosition() < $specifiedPosition,
            'decreasePosition() must decrease the assigned position.',
        );
    }

    public function testGetContainerReturnsMediaTypeWithoutNamespace(): void
    {
        $media = $this->newMediaInstance();
        $typeName = explode('\\', $media->getType());
        $typeName = array_pop($typeName);
        $this->assertEquals(
            $typeName,
            $media->getContainer(),
            'getContainer() must return the Media\'s type excluding the namespace.',
        );
    }

    public function testGetLocationReturnsValueAssignedToMEDIA_LOCATIONConstant(): void
    {
        $media = $this->newMediaInstance();
        $this->assertEquals(
            $media::MEDIA_LOCATION,
            $media->getLocation(),
            'getLocation() must return value of Media::MEDIA_LOCATION'
        );
    }
    public function testGetNameReturnsAssignedName(): void
    {
        $expectedName = 'MediaName' . rand(0, 10000);
        $media = $this->newMediaInstance(mediaName: $expectedName);
        $this->assertEquals(
            $expectedName,
            $media->getName(),
            'getName() must return assigned name.',
        );
    }

    public function testGetPositionReturnsAssignedPosition(): void 
    {
        $specifiedPosition = rand(0, 1000);
        $media = $this->newMediaInstance(mediaPosition:$specifiedPosition);
        $this->assertEquals(
            $specifiedPosition,
            $media->getPosition(),
            'getPosition() must return the assigned position.',
        );
    }

    public function testIncreasePositionIncreasesPosition(): void 
    {
        $specifiedPosition = rand(0, 1000);
        $media = $this->newMediaInstance(mediaPosition:$specifiedPosition);
        $media->increasePosition();
        $this->assertTrue(
            $media->getPosition() > $specifiedPosition,
            'increasePosition() must increase the assigned position.',
        );
    }

    public function testMediaIsAccessibleReturnsFalseIfMediasUrlIsNotAccessible(): void
    {
        $specifiedUrl = 'http://localhost:' . rand(8000, 8999) . '/' . rand(0, 1000) . '/url/is/not/accessible';
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertFalse(
            $media->mediaIsAccessible(),
            'mediaIsAccessible() must return the false if the media url is not accessible.',
        );
    }

    public function testMediaIsAccessibleReturnsFalseIfRequestToMediasUrlDoesNotReturnHttpResponseCode200(): void
    {
        $specifiedUrl = 'https://roady.tech/page/does/not/exist.html';
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertFalse(
            $media->mediaIsAccessible(),
            'mediaIsAccessible() must return the false if a request to the media url does not return http response code 200.',
        );
    }

    public function testMediaIsAccessibleReturnsTrueIfRequestToMediasUrlReturnsHttpResponseCode200(): void
    {
        $specifiedUrl = 'https://darlingdata.tech/index.php';
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertTrue(
            $media->mediaIsAccessible(),
            'mediaIsAccessible() must return the true if a request to the media url returns http response code 200.',
        );
    }

    public function testMediaUrlReturnsAssignedMediaUrl(): void 
    {
        $specifiedUrl = 'http://localhost:' . rand(8000, 8999);
        $media = $this->newMediaInstance(mediaUrl:$specifiedUrl);
        $this->assertEquals(
            $specifiedUrl,
            $media->mediaUrl(),
            'Media::mediaUrl() must return the assigned url.'
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
            'Media::metaData() must return the assigned metadata.'
        );
    }

    public function testSwitchStateSwitchesState(): void
    {
        $media = $this->newMediaInstance();
        $initialState = $media->getState();
        $media->switchState();
        $this->assertNotEquals(
            $initialState,
            $media->getState(),
            'getState() must return the assigned state.',
        );
    }

    public function testMimeContentTypeReturnsContentTypeReturnedOnGetHeadersRequestToMediaUrl(): void
    {
        $media = $this->newMediaInstance();
        $expectedErrorValue = 'COULD_NOT_DETERMINE_MIME_TYPE';
        try {
            $headers = get_headers(
                $media->mediaUrl(), 
                associative: true
            );
            $mimeContentType = (
                is_array($headers) 
                ? ($headers['Content-Type'] ?? $expectedErrorValue) 
                : $expectedErrorValue
            );
        } catch (Exception $e) {
            $mimeContentType = $expectedErrorValue;
        }
        $this->assertEquals(
            $mimeContentType,
            $media->mimeContentType()
        );
    }
}

