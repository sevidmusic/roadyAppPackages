<?php 

// This include will be replaces by a class
require_once('/home/darling/dev/php/roady/Apps/RoadyMediaPlayer/resources/includes/actions/SelectMedia.php'); 

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
