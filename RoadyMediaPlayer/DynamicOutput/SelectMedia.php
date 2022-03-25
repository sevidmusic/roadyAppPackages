<div class="roady-app-output-container">
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

    use Apps\RoadyMediaPlayer\resources\includes\actions\SelectMedia;

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
    $selectMediaForm = SelectMedia::generateMediaSelection(
        availableMedia: array_merge(
            ($storedAudio ?? []),
            ($storedImages ?? []),
            ($storedMedia ?? []),
            ($storedVideos ?? []),
        ),
        selectionType: 'select'
    );

    $mediaLinks = SelectMedia::generateMediaSelection(
        availableMedia: array_merge(
            ($storedAudio ?? []),
            ($storedImages ?? []),
            ($storedMedia ?? []),
            ($storedVideos ?? []),
        ),
        selectionType: 'links'
    );

    ?>

    <h3>Select A Track To Listen To</h3>
    <!-- Begin Select Media Form -->
    <form class="roady-form" action="index.php">
    <?php echo ($selectMediaForm ?? ''); ?>
    <input class="roady-form-input" type="hidden" name="request" value="ViewMedia">
    <input class="roady-form-input" type="submit" value="Select Media">
    </form>
    <!-- End Select Media Form -->
    <!-- <?php echo ($mediaLinks ?? ''); ?> -->
</div>
