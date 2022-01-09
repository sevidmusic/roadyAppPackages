<?php 
/*
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

if(
    isset($currentRequest->getPost()['name']) 
    &&
    isset($currentRequest->getPost()['mediaUrl']) 
    &&
    isset($currentRequest->getPost()['mediaType']) 
) {

    switch($currentRequest->getPost()['mediaType'])
    {
    case 'Image':
        $media = new Image(
            $currentRequest->getPost()['name'],
            new Positionable(rand(1, 10)),
            $currentRequest->getPost()['mediaUrl'],
            []
        );
        break;
    case 'Video':
        $media = new Video(
            $currentRequest->getPost()['name'],
            new Positionable(rand(1, 10)),
            $currentRequest->getPost()['mediaUrl'],
            []
        );
        break;
    case 'Audio':
        $media = new Audio(
            $currentRequest->getPost()['name'],
            new Positionable(rand(1, 10)),
            $currentRequest->getPost()['mediaUrl'],
            []
        );
        break;
    default:
        $media = new Media(
            $currentRequest->getPost()['name'],
            new Positionable(rand(1, 10)),
            $currentRequest->getPost()['mediaUrl'],
            []
        );
    }
    $mediaCrud->create($media);
    echo '<p>Created ' . $media->getName() . ' with unique id ' . 
        $media->getUniqueId();
}

?>

<h1>Roady Media Player</h1>

<!-- Begin Add Media Form -->
<form action="index.php?request=AddMedia" method="post">
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

    <input type="hidden" name="request" value="AddMedia">
    <input type="submit" name="addMedia" value="Add Media">
</form>
<!-- End Add Media Form -->

