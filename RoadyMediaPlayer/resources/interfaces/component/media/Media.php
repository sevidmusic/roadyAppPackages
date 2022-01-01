<?php

namespace Apps\RoadyMediaPlayer\resources\interfaces\component\media;

use roady\interfaces\component\SwitchableComponent;
use roady\interfaces\primary\Positionable;

/**
 * Media is type of SwitchableComponent that represents a piece of 
 * media that is accessible at a url.
 *
 * - Constants -
 *
 * MEDIA_LOCATION:            The name of the location assigned to 
 *                            all Media.
 *
 * - Methods -
 *
 * public function metaData(): array
 * public function mediaUrl(): string
 * public function mediaIsAccessible(): bool
 */
interface Media extends Positionable, SwitchableComponent
{

    /**
     * @var string MEDIA_LOCATION The name of the location that will
     *                            be assigned to all implementations
     *                            of the Media interface. This is the
     *                            value that will be returned when
     *                            a Media instance's getLocation()
     *                            method is called.
     */
    const MEDIA_LOCATION = 'RoadyMediaPlayer';

    /**
     * Return a single dimensional associative array of the
     * Media's meta data.
     *
     * @return array<string, string> A single dimensional array of 
     *                               the Media's meta data.
     */
    public function metaData(): array;

    /**
     * Return the Media's url.
     *
     * @return string The Media's url.
     */
    public function mediaUrl(): string;

    /**
     * Return true only if a request to the Media's url is returns
     * Http Response Code 200.
     *
     * @return bool True if the Media is accessible, false otherwise.
     */
    public function mediaIsAccessible(): bool;
}
