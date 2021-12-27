<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\media;

use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use roady\classes\component\SwitchableComponent ;
use roady\interfaces\primary\Positionable;
use roady\interfaces\primary\Storable;
use roady\interfaces\primary\Switchable;
use \Exception;

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

    /**
     * Purge any items in the array whose key and value are not of
     * type string.
     *
     * @param array<mixed> $array The array to purge.
     *
     */
    private function purgeNonStrings(array &$array): void
    {
        foreach($array as $key => $value) {
            if(is_string($key) && is_string($value)) {
                continue;
            }
            unset($array[$key]);
        }
    }

    public function metaData(): array
    {
        $this->purgeNonStrings($this->metaData);
        return $this->metaData;
    }

    public function mediaUrl(): string 
    {
        return $this->mediaUrl;
    }

    public function mediaIsAccessible(): bool 
    {
        try {
            $headers = get_headers(
                $this->mediaUrl(), 
                associative: true
            );
            $responseCode = (
                is_array($headers) 
                ? ($headers[0] ?? 'COULD_NOT_DETERMINE_RESPONSE_CODE') 
                : 'FAILED_TO_GET_HEADER'
            );
            if($responseCode === 'HTTP/1.1 200 OK') {
                return true; 
            }
        } catch (Exception $e) {
            $this->log(
                'Failed to determine if media is accessible, an error occurred: %s',
                $e->getMessage()
            );
        }
        $this->log(
            'The requested media is not available at the url: %s',
            $this->mediaUrl()
        );
        return false;
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
