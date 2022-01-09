<?php 

require_once('/home/darling/dev/php/roady/Apps/RoadyMediaPlayer/resources/includes/actions/SelectMedia.php'); 

// Replace with SelectMediaForm::generateMediaSelection() once it is implemented
$selectMediaForm = (
    isset($generateMediaSelection) 
    ? $generateMediaSelection(
        array_merge(
            ($storedAudio ?? []),
            ($storedImages ?? []),
            ($storedMedia ?? []),
            ($storedVideos ?? []),
        )
    ) : ''
); 

$mediaOutput = (
    isset($getOutput) 
    &&
    isset($mediaCrud)
    &&
    isset($currentRequest)
    ? $getOutput($mediaCrud, $currentRequest) 
    : ''
);

?>

<h3>Select Media</h3>
<!-- Begin Select Media Form -->
<form action="index.php">
<?php echo $selectMediaForm; ?> 
<input type="hidden" name="request" value="SelectMedia">
<input type="submit">
</form>
<!-- End Select Media Form -->
<?php echo $mediaOutput; ?>

