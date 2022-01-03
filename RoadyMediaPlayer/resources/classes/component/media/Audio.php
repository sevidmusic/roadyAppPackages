<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\media;

use Exception;

class Audio extends Media 
{

    /**
     * @return array<int, string> An array of Mime types supported 
     *                            video Mime Types.
     */
    private function supportedAudioMimeTypes(): array 
    {
        return [
            'audio/mpeg',
        ];
    }

    public function mediaIsAccessible(): bool
    {
        try {
            $contentType = $this->mimeContentType();
            if(in_array($contentType, $this->supportedAudioMimeTypes())) {
                return parent::mediaIsAccessible(); 
            }
        } catch (Exception $e) {
            $this->log(
                'Failed to determine if media is accessible, an error occurred: %s',
                $e->getMessage()
            );
        }
        $this->log(
            'The requested media is not a supported Audio type, media url: %s',
            $this->mediaUrl()
        );
        return false; 
    }

}
