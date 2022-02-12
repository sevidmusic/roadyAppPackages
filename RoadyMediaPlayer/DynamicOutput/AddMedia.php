<?php 

use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\component\Web\Routing\Request;
use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

// This include will be replaces by a class
require_once('/home/darling/dev/php/roady/Apps/RoadyMediaPlayer/resources/includes/actions/AddMedia.php'); 

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

if(isset($addMedia) && is_callable($addMedia)) {
    if(!$addMedia($currentRequest, $mediaCrud)) {
        echo '<p>Use the form below to Add Media</p>';
    } else {
        echo '<p class="roady-success-message">Media Added</p>';
    }
}
?>

<h1>Roady Media Player</h1>

<!-- Begin Add Media Form -->
<form action="index.php?request=AddMedia" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <label for="mediaUrl">Media Url:</label>
    <input type="url" name="mediaUrl" required>
    <label for="mediaPosition">Media Position: <span id="specifiedRange">0</span></label>
    <script>
        function getRangeFromInput() {
            var currentRange = document.getElementById("mediaPosition").value;
            document.getElementById("specifiedRange").innerHTML = currentRange;
        }
    </script>
    <input id="mediaPosition" type="range" name="mediaPosition" min="-50" max="50" oninput="getRangeFromInput()">
    <br>
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

