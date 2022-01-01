<?php

namespace Apps\RoadyMediaPlayer\resources\interfaces\component\media;

use roady\interfaces\component\SwitchableComponent;
use roady\interfaces\primary\Positionable;

/**
 * A SwitchableComponent that represents a piece of media that 
 * accessible at a specific url.
 *
 * - Constants -
 *
 * MEDIA_LOCATION:            The name of the location assigned to all Media.
 *                            This is the value that will be returned by
 *                            Media->getLocation()
 *
 * - Methods -
 *
 * metaData(): array          Return an array of the Media's metadata.
 *
 * mediaUrl(): string         The url that point's the Media.
 *
 * mediaIsAccessible(): bool  True if the Media's url is accessible,
 *                            and returns an 200 Http Response Code.
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
     * Return true if the Media's is accessible,
     * false otherwise.
     *
     * @return bool True if the Media is accessible, false otherwise.
     */
    public function mediaIsAccessible(): bool;
}
