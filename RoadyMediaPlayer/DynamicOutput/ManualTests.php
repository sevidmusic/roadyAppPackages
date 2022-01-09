<?php 
/**
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 */

use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Audio;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

$currentRequest = new Request(new Storable('CurrentRequest', 'Requests', 'Index'), new Switchable());

// $currentRequest->getPost(),
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

if(
    isset($currentRequest->getPost()['name']) 
    &&
    isset($currentRequest->getPost()['mediaUrl']) 
    &&
    isset($currentRequest->getPost()['mediaType']) 
) {

    $media = new Media(
        $currentRequest->getPost()['name'],
        new Positionable(rand(1, 10)),
        $currentRequest->getPost()['mediaUrl'],
        []
    );
    $mediaCrud->create($media);
    echo '<p>Created ' . 
        $media->getName() . 
        ' with unique id ' . 
        $media->getUniqueId();
}
/*
 *

    new Media(
        'QuickInstallationSetupAndHelloWorld',
        new Positionable(rand(1, 10)),
        'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
        [
            'Title' => 'Quick Installation, Setup, And Hello World Video',
        ]
    ),
    new Audio(
        'Lies',
        new Positionable(rand(1, 10)),
        'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3',
        [
            'Title' => 'Lies',
            'Album' => 'Sketches',
            'Artist' => 'Sevi D',
        ]
    ),
    new Video(
        'GettingStartedWithRoady',
        new Positionable(rand(1, 10)),
        'https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm',
        [
            'Title' => 'Getting Started',
            'Category' => 'roady demos'
        ]
    ),
    new Image(
        'RoadyLogo',
        new Positionable(rand(1, 10)),
        'https://roady.tech/roadyLogo.png',
        [
            'Title' => 'Roady Logo',
            'Category' => 'roady media'
        ]
    ),
 */

/** Functions */
$getOutput = function(MediaCrud $mediaCrud, Request $currentRequest): string {
    $media = unserialize(
        base64_decode(
            (
                $currentRequest->getGet()['requestedMedia']
                ??
                base64_encode(
                    serialize(
                        new Storable('MEDIA_IS_UNAVAILABLE', Media::MEDIA_LOCATION, 'Media')
                    )
                )
            )
        )
    );
    $requestedMedia = $mediaCrud->readMedia($media);
    if ($requestedMedia->mediaIsAccessible()) {
        switch($requestedMedia->getType()) {
        case Audio::class:
            return '
                <audio controls>
                <source src="' . $requestedMedia->mediaUrl() . '" type="' . $requestedMedia->mimeContentType() . '">
                    ' . $requestedMedia->getName() . ' is not available at the moment.
                </audio>
            ';
        case Video::class:
            return '
                <video controls>
                <source src="' . $requestedMedia->mediaUrl() . '" type="' . $requestedMedia->mimeContentType() . '">
                    ' . $requestedMedia->getName() . ' is not available at the moment.
                </video>
            ';
        case Image::class:
            return '<img src="' . $requestedMedia->mediaUrl() . '">';
        }
    } 
    return '
        <div class="roady-media-player-system-message-container">
        <p>The requested media is not available at the moment.</p>
        <ul>
            <li>Media Name: ' . $requestedMedia->getName() . '</li>
            <li>Media Url: 
                <a href="' . $requestedMedia->mediaUrl() . '">' . 
                    $requestedMedia->mediaUrl() . 
                '</a>
            </li>
        </ul>
        </div>
    ';
};

var_dump(
    $currentRequest->getPost(),
    $currentRequest->getGet()
);
?>

<h1>Roady Media Player</h1>

<!-- Begin Add Media Form -->
<form 
 action="index.php?request=<?php echo (isset($this) ? $this->getName() : 'Unknown'); ?>" 
 method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <label for="mediaUrl">Media Url:</label>
    <input type="url" name="mediaUrl" required>
    <label for="mediaType">Media Type:</label>
    <select name="mediaType">
        <option selected value="Media">Media (Generic)</option>
        <option value="Audio">Audio</option>
        <option value="Video">Video</option>
        <option value="Image">Image</option>
    </select>

    <input type="submit" name="addMedia" value="Add Media">
</form>
<!-- End Add Media Form -->

<!-- Begin Select Media Form -->
<?php

$storedMedia = $mediaCrud->readAllMedia(Media::class);
$storedAudio = $mediaCrud->readAllMedia(Audio::class);
$storedVideos = $mediaCrud->readAllMedia(Video::class);
$storedImages = $mediaCrud->readAllMedia(Image::class);

$generateMediaSelection = function(array $availableMedia): string {
    $select = '<select name="requestedMedia">';
    foreach($availableMedia as $media) {
        $select .= '<option value="' .  base64_encode(serialize($media))  . '">' . 
            $media->getName() . 
        '</option>';
    }
    $select .= '</select>';
    return $select;
};

echo '<form action="index.php?request=ManualTests">' . 
    $generateMediaSelection(
        array_merge(
            $storedMedia,
            $storedAudio,
            $storedVideos,
            $storedImages,
        )
    ) . 
    '<input type="submit"></form>' .
    '<!-- End Select Media Form -->' .
    $getOutput($mediaCrud, $currentRequest)
;

/*
$media = [
    new Media(
        'QuickInstallationSetupAndHelloWorld',
        new Positionable(rand(1, 10)),
        'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
        [
            'Title' => 'Quick Installation, Setup, And Hello World Video',
        ]
    ),
    new Audio(
        'Lies',
        new Positionable(rand(1, 10)),
        'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3',
        [
            'Title' => 'Lies',
            'Album' => 'Sketches',
            'Artist' => 'Sevi D',
        ]
    ),
    new Video(
        'GettingStartedWithRoady',
        new Positionable(rand(1, 10)),
        'https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm',
        [
            'Title' => 'Getting Started',
            'Category' => 'roady demos'
        ]
    ),
    new Image(
        'RoadyLogo',
        new Positionable(rand(1, 10)),
        'https://roady.tech/roadyLogo.png',
        [
            'Title' => 'Roady Logo',
            'Category' => 'roady media'
        ]
    ),
];

foreach($media as $testMedia) {
    if(($currentRequest->getGet()['createTestMedia'] ?? '') === 'true') {
        $mediaCrud->createMedia($testMedia);
    }
}
 */
