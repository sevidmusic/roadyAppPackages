<div class="roady-app-output-container">
    <?php

    use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
    use roady\classes\component\Web\Routing\Request;
    use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
    use Apps\RoadyMediaPlayer\resources\includes\actions\AddMedia;
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

    if(!AddMedia::addMedia($currentRequest, $mediaCrud)) {
        echo '<p>Use the form below to Add Media</p>';
    } else {
        echo '<p class="roady-success-message">Media Added</p>';
    }
    ?>

    <h1>Roady Media Player</h1>

    <!-- Begin Add Media Form -->
    <form class="roady-form" action="index.php?request=AddMedia" method="post">
        <label class="roady-form-input-label" for="name">Name:</label>
        <input class="roady-form-input" type="text" name="name" required>
        <label class="roady-form-input-label" class="roady-form-input" for="mediaUrl">Media Url:</label>
        <input class="roady-form-input" type="url" name="mediaUrl" required>
        <label class="roady-form-input-label" for="mediaPosition">Media Position: <span id="specifiedRange">0</span></label>
        <script>
            function getRangeFromInput() {
                var currentRange = document.getElementById("mediaPosition").value;
                document.getElementById("specifiedRange").innerHTML = currentRange;
            }
        </script>
        <input class="roady-form-input" id="mediaPosition" type="range" name="mediaPosition" min="-50" max="50" oninput="getRangeFromInput()">
        <br>
        <label class="roady-form-input-label" for="mediaType">Media Type:</label>
        <select class="roady-form-input" name="mediaType">
            <option selected value="Media">Media (Generic)</option>
            <option value="Audio">Audio</option>
            <option value="Video">Video</option>
            <option value="Image">Image</option>
        </select>
        <input type="hidden" name="request" value="AddMedia">
        <input class="roady-form-input" type="submit" name="addMedia" value="Add Media">
    </form>
    <!-- End Add Media Form -->
</div>
