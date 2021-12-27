<?php

namespace Apps\RoadyMediaPlayer\resources\tests\media;

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
}
