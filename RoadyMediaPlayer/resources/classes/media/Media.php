<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\media;

use roady\classes\component\SwitchableComponent ;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;
use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;

class Media extends SwitchableComponent implements MediaInterface {

    /**
     * Instantiate a new Media instance.
     *
     * @param string $url The Media's url.
     * @param array <string, string> $metaData An array of the Media's
     *                                         meta data.
     *
     */
    public function __construct(
        StorableInterface $storable, 
        SwitchableInterface $switchable,
        private string $url, 
        private array $metaData
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
        return 'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm';
    }

    public function mediaIsAccessible(): bool 
    {
        return true;
    }
}
