<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\primary\Positionable;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;

$media = new Media(
    'QuickInstallationSetupAndHelloWorld',
    new Positionable(),
    'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
    [
        'Title' => 'Quick Installation, Setup, And Hello World Video',
    ]
);

if ($media->mediaIsAccessible()) {
    echo '
    <video style="width: 50%; height: auto;" controls>
    <source src="' . $media->mediaUrl() . '" type="' . $media->mimeContentType() . '">
      Your browser does not support HTML video.
    </video>
    ';
} else {
    echo '
    <div class="roady-media-player-system-message-container">
    <p>The requested media is not available at the moment.</p>
    <ul>
        <li>Media Name: ' . $media->getName() . '</li>
        <li>Media Url: <a href="' . $media->mediaUrl() . '">' . $media->mediaUrl() . '</a></li>
    </ul>
    </div>
    ';
}
?>

<h1>Roady Media Player</h1>
