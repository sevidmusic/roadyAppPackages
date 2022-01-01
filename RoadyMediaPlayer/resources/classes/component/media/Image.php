<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\media;

use Exception;

class Image extends Media 
{

    /**
     * Returns single dimensional, numerically indexed array of
     * supported Mime Types.
     *
     * @return array<int, string> An array of Mime types supported 
     *                            by the Image class.
     */
    private function supportedImageMimeTypes(): array 
    {
        return [
            'image/png',
            'image/x-icon',
            'image/jpeg',
            'image/gif',
        ];
    }

    /**
     * Will return true only if the Image's url is accessible, and
     * the Mime Type of the media that the Image's url points to is
     * supported.
     *
     * @return bool True if the Image's url is accessible, and the
     *              Mime Type of the media that the Image's url
     *              points is supported, false otherwise.
     *
     */
    public function mediaIsAccessible(): bool
    {
        try {
            $headers = get_headers(
                $this->mediaUrl(), 
                associative: true
            );
            $contentType = (
                is_array($headers) 
                ? ($headers['Content-Type'] ?? 'COULD_NOT_DETERMINE_MIME_TYPE') 
                : 'FAILED_TO_GET_HEADER'
            );
            if(in_array($contentType, $this->supportedImageMimeTypes())) {
                return parent::mediaIsAccessible(); 
            }
        } catch (Exception $e) {
            $this->log(
                'Failed to determine if media is accessible, an error occurred: %s',
                $e->getMessage()
            );
        }
        $this->log(
            'The requested media is not a supported Image type, media url: %s',
            $this->mediaUrl()
        );
        return false; 
    }

}
