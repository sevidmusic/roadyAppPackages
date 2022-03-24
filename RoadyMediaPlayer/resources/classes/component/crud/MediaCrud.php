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
        $storedComponent = parent::read($storable);
        $storedComponentImplements = class_implements($storedComponent);
        if($this->isAMediaImplementation($storedComponent)) {
            /** @var MediaInterface $storedComponent */
            return $storedComponent;
        }
        return new Media(
            $storable->getName(),
            new Positionable(),
            'MEDIA_DOES_NOT_EXIST_IN_STORAGE',
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

    private static function mockMedia(): MediaInterface
    {
        return new Media(
            'MockMediaForMediaCrudUse',
            new Positionable(),
            '',
            []
        );
    }

    public function readAllMedia(string|object $mediaType): array
    {
        $typeName = explode(
            '\\',
            (is_string($mediaType) ? $mediaType : $mediaType::class)
        );
        $mediaContainer = array_pop($typeName);
        $storedComponents = parent::readAll(
            self::mockMedia()->getLocation(),
            $mediaContainer
        );
        $media = [];
        foreach($storedComponents as $component) {
            if($this->isAMediaImplementation($component)) {
                array_push($media, $component);
            }
        }
        /** @var array<int, MediaInterface> $media */
        return $media;
    }

    public function deleteMedia(MediaInterface $media): bool
    {
        return parent::delete($media);
    }


    private function isAMediaImplementation(Component $component): bool
    {
        $compnentImplements = class_implements($component);
        if(is_array($compnentImplements) && in_array(MediaInterface::class, $compnentImplements)) {
            return true;
        }
        return false;
    }
}
