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
}

