<?php

namespace Apps\RoadyMediaPlayer\resources\tests\media;

use PHPUnit\Framework\TestCase;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

class MediaTest extends TestCase 
{

    public function testMediaUrlReturnsAssignedMediaUrl(): void 
    {
        $specifiedUrl = 'http://localhost:' . rand(8000, 8999);
        $media = new Media(
            new Storable(
                'name',
                'location',
                'container'
            ),
            new Switchable(),
            new Positionable(),
            $specifiedUrl,
            []
        );
        $this->assertEquals(
            $specifiedUrl,
            $media->mediaUrl()
        );
    }

    public function testMetaDataReturnsAssignedMetaData(): void 
    {
        $specifiedMetaData = [
            'foo' => 'bar',
            'baz' => strval(rand(0, 10)),
        ];
        $media = new Media(
            new Storable(
                'name',
                'location',
                'container'
            ),
            new Switchable(),
            new Positionable(),
            'http://localhost:8080',
            $specifiedMetaData
        );
        $this->assertEquals(
            $specifiedMetaData,
            $media->metaData()
        );
    }
}

