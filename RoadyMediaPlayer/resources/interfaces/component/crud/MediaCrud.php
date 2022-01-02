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
 *
 */
interface MediaCrud extends ComponentCrud
{
    public function createMedia(Media $media): bool;
    public function readMedia(Storable $storable): Media;
    public function updateMedia(Media $originalMedia, Media $newMedia): bool;
    /**
     * Read all stored Media of a specified type from storage.
     *
     * For example:
     *
     * $mediaCrud->readAll(Media::class)
     * $mediaCrud->readAll(Audio::class)
     * $mediaCrud->readAll($videoInstance)
     * $mediaCrud->readAll($imageInstance)
     *
     *
     * @param class-string<object>|object $mediaType A fully qualified
     *                                               class name, or an
     *                                               object instance
     *                                               that will be used
     *                                               to determine where
     *                                               in storage the 
     *                                               Media should be
     *                                               read from.
     *                                               Note: If the 
     *                                               specified class
     *                                               or object is not
     *                                               an implementation
     *                                               of the Media 
     *                                               interface then an
     *                                               empty array will
     *                                               be returned.
     *
     * @return array<int, string> A numerically indexed array of
     *                            the all stored Media of the 
     *                            specified type.
     */
    public function readAllMedia(string|object $mediaType): array;
    public function deleteMedia(Media $media): bool;
}
