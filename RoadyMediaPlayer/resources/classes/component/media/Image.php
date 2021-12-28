<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\media;

use \Exception;

class Image extends Media 
{

    /**
     * @return array<int, string> An array of Mime types supported 
     *                            video Mime Types.
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
