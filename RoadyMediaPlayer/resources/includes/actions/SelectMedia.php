<?php

namespace Apps\RoadyMediaPlayer\resources\includes\actions;

use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Audio;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Positionable;
use roady\classes\primary\Switchable;
use roady\classes\primary\Storable;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;

class SelectMedia
{
    public static function defaultMedia(): Media {
        return new Media(
            'MediaNotFound',
            new Positionable(rand(1, 10)),
            'http://localhost/media/not/found',
            []
        );
    }

    /**
     * Encode a Media object as a string.
     *
     * @return string
     */
    public static function encodeMedia(MediaInterface $media): string
    {
        return urlencode(base64_encode(serialize($media)));
    }

    /**
     * Decode a string encoded with the $encodeMedia function.
     *
     * @return MediaInterface
     */
    public static function decodeMedia(string $encodedString): MediaInterface
    {
        $decodedMedia = unserialize(
            base64_decode(
                urldecode($encodedString)
            )
        );
        $implements = (
            is_object($decodedMedia)
            ? class_implements($decodedMedia)
            : new \StdClass()
        );
        return (
            !in_array(
                MediaInterface::class,
                (is_array($implements) ? $implements : [])
            )
            ? self::defaultMedia()
            /** @var MediaInterface $decodedMedia */
            : $decodedMedia
        );
    }

    public static function mediaIsUnavailableMessage(MediaInterface $media): string {
        return '
            <div class="roady-media-player-system-message-container">
            <p>The requested media is not available at the moment.</p>
            <ul>
                <li>Media Name: ' .
                    $media->getName() .
                '</li>' .
                '<li>Media Url:
                    <a href="' . $media->mediaUrl() . '">' .
                        $media->mediaUrl() .
                    '</a>
                </li>
            </ul>
            </div>
        ';
    }


    public static function imageView(Image $image): string {
        return '<img src="' .
        $image->mediaUrl() .
        '">';
    }

    public static function videoView(Video $video): string {
        return
            '<video controls>' .
            '<source src="' . $video->mediaUrl() .
            '" type="' . $video->mimeContentType() .
            '">' . $video->getName() .
            ' is not available at the moment.</video>';
    }

    public static function audioView(Audio $audio): string {
        return
            '<h2>' . $audio->getName() . '</h2>' .
            '<audio controls autoplay>' .
            '<source src="' .
            $audio->mediaUrl() .
            '" type="' .
            $audio->mimeContentType() .
            '">' .
            $audio->getName() .
            ' is not available at the moment.</audio>';
    }

    public static function getRequestedMedia(Request $currentRequest): MediaInterface {
        return self::decodeMedia(
            $currentRequest->getGet()['requestedMedia']
            ??
            self::encodeMedia(self::defaultMedia())
        );
    }

    /**
     * Return the html for the requested Media.
     *
     * @return string
     */
    public static function getOutput(
        MediaCrud $mediaCrud,
        Request $currentRequest
    ): string {
        $requestedMedia = $mediaCrud->readMedia(
            self::getRequestedMedia($currentRequest)
        );
        if ($requestedMedia->mediaIsAccessible()) {
            switch($requestedMedia->getType()) {
            case Audio::class:
                /** @var Audio $requestedMedia */
                return self::audioView($requestedMedia);
            case Video::class:
                /** @var Video $requestedMedia */
                return self::videoView($requestedMedia);
            case Image::class:
                /** @var Image $requestedMedia */
                return self::imageView($requestedMedia);
            }
        }
        return self::mediaIsUnavailableMessage($requestedMedia);
    }

    /**
     * Generate a select form element for the $availableMedia.
     *
     * @param array <int, MediaInterface> $availableMedia
     *
     * @return string The html for the select form.
     */
    public static function generateMediaSelection(
        array $availableMedia,
        string $selectionType = 'select'
    ): string {
        if(empty($availableMedia)) {
            return '<p>There is no available Media.</p>';
        }
        $selectorHtml = '';
        switch($selectionType){
        case 'links':
                $selectorHtml .= '<ul name="requestedMedia">';
                foreach($availableMedia as $media) {
                    $selectorHtml .=
                        '<li>' .
                        '<a href="index.php?request=ViewMedia&requestedMedia=' .
                        self::encodeMedia($media) .
                        '">' .
                        $media->getName() .
                        '</a>' .
                        '</li>';
                }
                $selectorHtml .= '</ul>';
            break;
            default:
                $selectorHtml .= '<select class="roady-form-input" name="requestedMedia">';
                foreach($availableMedia as $media) {
                    $selectorHtml .=
                        '<option value="' .
                        self::encodeMedia($media) .
                        '">' .
                        $media->getName() .
                        '</option>';
                }
                $selectorHtml .= '</select>';
                break;
        }
        return $selectorHtml;
    }
}

