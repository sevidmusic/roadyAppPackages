<?php 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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

$addMedia = function(Request $currentRequest, MediaCrud $mediaCrud): bool {
    if(
        isset($currentRequest->getPost()['name']) 
        &&
        isset($currentRequest->getPost()['mediaUrl']) 
        &&
        isset($currentRequest->getPost()['mediaType']) 
        &&
        isset($currentRequest->getPost()['mediaPosition']) 
    ) {
    
        switch($currentRequest->getPost()['mediaType'])
        {
        case 'Image':
            $media = new Image(
                $currentRequest->getPost()['name'],
                new Positionable($currentRequest->getPost()['mediaPosition']),
                $currentRequest->getPost()['mediaUrl'],
                []
            );
            break;
        case 'Video':
            $media = new Video(
                $currentRequest->getPost()['name'],
                new Positionable($currentRequest->getPost()['mediaPosition']),
                $currentRequest->getPost()['mediaUrl'],
                []
            );
            break;
        case 'Audio':
            $media = new Audio(
                $currentRequest->getPost()['name'],
                new Positionable($currentRequest->getPost()['mediaPosition']),
                $currentRequest->getPost()['mediaUrl'],
                []
            );
            break;
        default:
            $media = new Media(
                $currentRequest->getPost()['name'],
                new Positionable($currentRequest->getPost()['mediaPosition']),
                $currentRequest->getPost()['mediaUrl'],
                []
            );
        }
        return $mediaCrud->create($media);
    }
    return false;
};

