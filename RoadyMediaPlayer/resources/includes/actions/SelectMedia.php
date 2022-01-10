<?php 

use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Audio;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Positionable;

$getOutput = function(
    MediaCrud $mediaCrud, 
    Request $currentRequest
): string {
    $defaultMedia = new Media(
        'MediaNotFound',
        new Positionable(rand(1, 10)),
        'http://localhost/media/not/found',
        []
    );
    $media = unserialize(
        base64_decode(
            (
                $currentRequest->getGet()['requestedMedia']
                ??
                base64_encode(serialize($defaultMedia))
            )
        )
    );
    $media = (is_bool($media) ? $defaultMedia : $media);
    $requestedMedia = $mediaCrud->readMedia($media);
    if ($requestedMedia->mediaIsAccessible()) {
        switch($requestedMedia->getType()) {
        case Audio::class:
            return '
                <audio controls>
                <source src="' . 
                $requestedMedia->mediaUrl() . 
                '" type="' . $requestedMedia->mimeContentType() . 
                '">' . 
                $requestedMedia->getName() . 
                ' is not available at the moment.</audio>
            ';
        case Video::class:
            return '
                <video controls>
                <source src="' . $requestedMedia->mediaUrl() . 
                '" type="' . 
                $requestedMedia->mimeContentType() . 
                '">' . $requestedMedia->getName() . 
                ' is not available at the moment.</video>
            ';
        case Image::class:
            return '<img src="' . 
                $requestedMedia->mediaUrl() . 
            '">';
        }
    } 
    return '
        <div class="roady-media-player-system-message-container">
        <p>The requested media is not available at the moment.</p>
        <ul>
            <li>Media Name: ' . 
                $requestedMedia->getName() . 
            '</li>' .
            '<li>Media Url: 
                <a href="' . $requestedMedia->mediaUrl() . '">' . 
                    $requestedMedia->mediaUrl() . 
                '</a>
            </li>
        </ul>
        </div>
    ';
};

/** 
 * Generate a select form element for the $availableMedia.
 * 
 * @param array <int, Media> $availableMedia
 *
 * @return string The html for the select form.
 */
$generateMediaSelection = function(
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
                    '<a href="index.php?request=ViewMedia&requestedMedia=' .  base64_encode(serialize($media))  . '">' . 
                        $media->getName() . 
                    '</a>' . 
                    '</li>';
            }
            $selectorHtml .= '</ul>';
        break;
        default:
            $selectorHtml .= '<select name="requestedMedia">';
            foreach($availableMedia as $media) {
                $selectorHtml .= '<option value="' .  base64_encode(serialize($media))  . '">' . 
                    $media->getName() . 
                '</option>';
            }
            $selectorHtml .= '</select>';
            break;
    }
    return $selectorHtml;
};

