<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\media;

use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use Exception;
use roady\classes\component\SwitchableComponent ;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\primary\Positionable;

class Media extends SwitchableComponent implements MediaInterface
{

    /**
     * Instantiate a new Media instance.
     *
     * @param string $name The name to assign to the Media.
     *
     * @param Positionable $positionable A Positionable instance
     *                                   that will manage
     *                                   the media's position.
     *
     * @param string $mediaUrl The Media's url.
     *
     * @param array <string, string> $metaData An array of the Media's
     *                                         metadata.
     *
     */
    public function __construct(
        string $name,
        private Positionable $positionable,
        private string $mediaUrl,
        private array $metaData,
    )
    {
        $mediaClass = get_class($this);
        $typeName = explode('\\', $mediaClass);
        $typeName = array_pop($typeName);
        $storable = new Storable(
            $name,
            self::determineAppropriateLocation(),
            $typeName
        );
        parent::__construct($storable, new Switchable());
    }

    private static function currentRequest(): Request
    {
        return new Request(
            new Storable(
                'CurrentRequest',
                'Requests',
                'Media'
            ),
            new Switchable()
        );
    }

    private static function determineAppropriateLocation(): string
    {

        return strval(
            preg_replace(
                "#[^a-zA-Z0-9]+#",
                '',
                strval(
                    (
                        parse_url(self::currentRequest()->getUrl(),  PHP_URL_HOST)
                        ??
                        'localhost'
                    )
                )
            ) . strval(
                (
                    parse_url(self::currentRequest()->getUrl(),  PHP_URL_PORT)
                    ??
                    '8080'
                )
            ) . self::MEDIA_LOCATION
        );
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

    public function mimeContentType(): string
    {
        $couldNotDetermineMime = 'COULD_NOT_DETERMINE_MIME_TYPE';
        try {
            $headers = get_headers(
                $this->mediaUrl(),
                associative: true
            );
            return (
                is_array($headers)
                ? ($headers['Content-Type'] ?? $couldNotDetermineMime)
                : $couldNotDetermineMime
            );
        } catch (Exception $e) {
            $this->log(
                'Failed to determine media\'s mime/content type, an error occurred: %s',
                $e->getMessage()
            );
        }
        return $couldNotDetermineMime;
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
