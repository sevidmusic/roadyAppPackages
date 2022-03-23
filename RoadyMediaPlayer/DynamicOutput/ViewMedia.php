<div class="roady-app-output-container">
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

    echo '<div class="roady-media-player-media-display">' . (
        isset($getOutput) && is_callable($getOutput)
        ? $getOutput($mediaCrud, $currentRequest)
        : ''
    ) . '</div>';
    ?>
</div>
