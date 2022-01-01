<?php

namespace Apps\RoadyMediaPlayer\resources\interfaces\component\crud;

use roady\interfaces\component\Crud\ComponentCrud;
use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media;
use roady\interfaces\primary\Storable;

/**
 * A MediaCrud is a ComponentCrud that can be used to create, read, 
 * update, and delete Media from storage.
 *
 * The MediaCrud defines the following methods which function as 
 * alternatives to the create(), read(), readAll(), update(), and 
 * delete() methods, and define appropriately type hinted method 
 * parameters.
 *
 * For example, the createMedia() method expects an instance of the
 * Media interface, as opposed to the create() method which will 
 * accept any implementation of the Component interface.
 *
 * - Methods -
 *
 * public function createMedia(Media $media): bool;
 * public function readMedia(Storable $storable): Media;
 * public function deleteMedia(Media $media): bool;
 * public function readAllMedia(string $mediaType): array;
 *
 */
interface MediaCrud extends ComponentCrud
{
    public function createMedia(Media $media): bool;
    public function readMedia(Storable $storable): Media;
    public function updateMedia(Media $originalMedia, Media $newMedia): bool;
}
