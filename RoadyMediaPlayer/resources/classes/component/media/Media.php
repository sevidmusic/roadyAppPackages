<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\media;

use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use roady\classes\component\SwitchableComponent ;
use roady\interfaces\primary\Positionable;
use roady\interfaces\primary\Storable;
use roady\interfaces\primary\Switchable;

class Media extends SwitchableComponent implements MediaInterface {

    /**
     * Instantiate a new Media instance.
     *
     * @param string $mediaUrl The Media's url.
     * @param array <string, string> $metaData An array of the Media's
     *                                         meta data.
     *
     */
    public function __construct(
        Storable $storable, 
        Switchable $switchable,
        private Positionable $positionable,
        private string $mediaUrl, 
        private array $metaData,
    )
    {
        parent::__construct($storable, $switchable);
    }

    public function metaData(): array
    {
        return [
            'Title' => 'Quick Installation, setup, and Hello World Video',
            'Description' => 'Brief guide on installing and setting up roady, and creating a Hello World App',
            'RepoUrl' => 'https://roadydemos.us-east-1.linodeobjects.com',
        ];
    }

    public function mediaUrl(): string 
    {
        return $this->mediaUrl;
    }

    public function mediaIsAccessible(): bool 
    {
        return true;
    }

    public function increasePosition(): bool 
    {
        return $this->positionable->increasePosition();
        
    }
    public function decreasePosition(): bool 
    {
        return $this->positionable->decreasePosition();
    }

    public function getPosition(): float|int
    {
        return $this->positionable->getPosition();
    }
}
