<?php 

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

// This include will be replaces by a class
require_once('/home/darling/dev/php/roady/Apps/RoadyMediaPlayer/resources/includes/actions/SelectMedia.php'); 

if(
    isset($generateMediaSelection) 
) {
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
}

?>

<h3>Select Media</h3>
<!-- Begin Select Media Form -->
<form action="index.php">
<?php echo ($selectMediaForm ?? ''); ?> 
<input type="hidden" name="request" value="ViewMedia">
<input type="submit" value="Select Media">
</form>
<!-- End Select Media Form -->
<?php echo ($mediaLinks ?? ''); ?> 
