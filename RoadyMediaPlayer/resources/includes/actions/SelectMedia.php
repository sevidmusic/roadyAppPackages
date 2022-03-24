<?php

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

$defaultMedia = function(): Media {
    return new Media(
        'MediaNotFound',
        new Positionable(rand(1, 10)),
        'http://localhost/media/not/found',
        []
    );
};

/**
 * Encode a Media object as a string.
 *
 * @return string
 */
$encodeMedia = function(MediaInterface $media): string {
    return urlencode(base64_encode(serialize($media)));
};

/**
 * Decode a string encoded with the $encodeMedia function.
 *
 * @return string
 */
$decodeMedia = function(string $encodedString) use ($defaultMedia): MediaInterface {
    $decodedMedia = unserialize(
        base64_decode(
            urldecode($encodedString)
        )
    );
    $implements = (
        is_object($decodedMedia)
        ? class_implements($decodedMedia)
        : new StdClass()
    );
    return (
        !in_array(
            MediaInterface::class,
            (is_array($implements) ? $implements : [])
        )
        ? $defaultMedia()
        /** @var MediaInterface $decodedMedia */
        : $decodedMedia
    );
};

$mediaIsUnavailableMessage = function(MediaInterface $media): string {
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
};


$imageView = function(Image $image): string {
    return '<img src="' .
    $image->mediaUrl() .
    '">';
};

$videoView = function(Video $video): string {
    return
        '<video controls>' .
        '<source src="' . $video->mediaUrl() .
        '" type="' . $video->mimeContentType() .
        '">' . $video->getName() .
        ' is not available at the moment.</video>';
};

$audioView = function(Audio $audio): string {
    return
        '<audio controls>' .
        '<source src="' .
        $audio->mediaUrl() .
        '" type="' .
        $audio->mimeContentType() .
        '">' .
        $audio->getName() .
        ' is not available at the moment.</audio>';
};

$getRequestedMedia = function(Request $currentRequest) use ($defaultMedia, $encodeMedia, $decodeMedia): MediaInterface {
    return $decodeMedia(
        $currentRequest->getGet()['requestedMedia']
        ??
        $encodeMedia($defaultMedia())
    );
};

/**
 * Return the html for the requested Media.
 *
 * @return string
 */
$getOutput = function(
    MediaCrud $mediaCrud,
    Request $currentRequest
) use (
    $mediaIsUnavailableMessage,
    $imageView,
    $videoView,
    $audioView,
    $getRequestedMedia
): string {
    $requestedMedia = $mediaCrud->readMedia(
        $getRequestedMedia($currentRequest)
    );
    if ($requestedMedia->mediaIsAccessible()) {
        switch($requestedMedia->getType()) {
        case Audio::class:
            /** @var Audio $requestedMedia */
            return $audioView($requestedMedia);
        case Video::class:
            /** @var Video $requestedMedia */
            return $videoView($requestedMedia);
        case Image::class:
            /** @var Image $requestedMedia */
            return $imageView($requestedMedia);
        }
    }
    return $mediaIsUnavailableMessage($requestedMedia);
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
) use ($encodeMedia): string {
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
                    $encodeMedia($media) .
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
                    $encodeMedia($media) .
                    '">' .
                    $media->getName() .
                    '</option>';
            }
            $selectorHtml .= '</select>';
            break;
    }
    return $selectorHtml;
};

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'Requests',
        'Index'
    ),
    new Switchable()
);

$mediaCrud = new MediaCrud(
    new Storable(
        'TestMediaCrud' . rand(0, 1000),
        'TestComponents',
        'Cruds'
    ),
    new Switchable(),
    new JsonStorageDriver(
        new Storable(
            'TestJsonStorageDriver' . rand(0, 1000),
            'TestComponents',
            'StorageDrivers'
        ),
        new Switchable()
    )
);

$storedAudio = $mediaCrud->readAllMedia(Audio::class);
$storedImages = $mediaCrud->readAllMedia(Image::class);
$storedMedia = $mediaCrud->readAllMedia(Media::class);
$storedVideos = $mediaCrud->readAllMedia(Video::class);
$selectMediaForm = $generateMediaSelection(
    availableMedia: array_merge(
        ($storedAudio ?? []),
        ($storedImages ?? []),
        ($storedMedia ?? []),
        ($storedVideos ?? []),
    ),
    selectionType: 'select'
);

$mediaLinks = $generateMediaSelection(
    availableMedia: array_merge(
        ($storedAudio ?? []),
        ($storedImages ?? []),
        ($storedMedia ?? []),
        ($storedVideos ?? []),
    ),
    selectionType: 'links'
);

