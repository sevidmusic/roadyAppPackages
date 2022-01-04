<?php 

use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\primary\Positionable;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Audio;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;

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
    if($mediaCrud->readMedia($testMedia)->mediaUrl() !== $testMedia->mediaUrl()) {
        $mediaCrud->createMedia($testMedia);
    }
}

$getOutput = function(): string {
    // $this->>requestedMedia()
    $requestedMedia = new Media(
        'QuickInstallationSetupAndHelloWorld',
        new Positionable(),
        'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
        [
            'Title' => 'Quick Installation, Setup, And Hello World Video',
        ]
    );
    //
    if ($requestedMedia->mediaIsAccessible()) {
        return '
        <video controls>
        <source src="' . $requestedMedia->mediaUrl() . '" type="' . $requestedMedia->mimeContentType() . '">
            ' . $requestedMedia->getName() . ' is not available at the moment.
        </video>
        ';
    } else {
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
    }
};
?>

<h1>Roady Media Player</h1>
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

echo '<form action="index.php?request=ManualTests">' . $generateMediaSelection(
    array_merge(
        $storedMedia,
        $storedAudio,
        $storedVideos,
        $storedImages,
    )
) . '<input type="submit"></form>';
echo $getOutput();
var_dump(
    $_GET, 
    unserialize(
        base64_decode(
            $_GET['requestedMedia']
        )
    )
);
