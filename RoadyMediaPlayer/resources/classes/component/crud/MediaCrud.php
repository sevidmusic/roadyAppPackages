<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\crud;

use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use Apps\RoadyMediaPlayer\resources\interfaces\component\crud\MediaCrud as MediaCrudInterface;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use roady\classes\component\Crud\ComponentCrud;
use roady\interfaces\component\Component;
use roady\interfaces\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\primary\Positionable;

class MediaCrud extends ComponentCrud implements MediaCrudInterface
{

    public function createMedia(MediaInterface $media): bool 
    {
        return parent::create($media);
    }    

    public function readMedia(Storable $storable): MediaInterface 
    {
        $storedCompnent = parent::read($storable);
        $storedCompnentImplements = class_implements($storedCompnent);
        if(is_array($storedCompnentImplements) && in_array(MediaInterface::class, $storedCompnentImplements)) {
            /** @var MediaInterface $storedCompnent */
            return $storedCompnent;
        }
        return new Media(
            $storable->getName(),
            new Positionable(),
            'http://localhost:8080/page/not/found/rand' . rand(1000, 1000),
            [
                'Error' => 'MEDIA_DOES_NOT_EXIST_IN_STORAGE',
                'MediaName' => $storable->getName(),
                'MediaUniqueId' => $storable->getUniqueId(),
                'MediaLocation' => $storable->getLocation(),
                'MediaContainer' => $storable->getContainer(),
            ]
        );
    }

    public function updateMedia(MediaInterface $originalMedia, MediaInterface $newMedia): bool 
    {
        return parent::update($originalMedia, $newMedia);
    }

    public function readAllMedia(string|object $mediaType): array
    {
        return [];
    }

    public function deleteMedia(MediaInterface $media): bool 
    {
        return parent::delete($media);
    }
}
