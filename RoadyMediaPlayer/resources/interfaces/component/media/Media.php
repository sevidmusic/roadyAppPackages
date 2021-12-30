<?php

namespace Apps\RoadyMediaPlayer\resources\interfaces\component\media;

use roady\interfaces\primary\Positionable;

/**
 * A SwitchableComponent that represents a piece of media that 
 * accessible at a specific url.
 */
interface Media extends Positionable
{

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
