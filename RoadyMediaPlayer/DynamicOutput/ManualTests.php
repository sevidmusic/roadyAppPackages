<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\primary\Positionable;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;

$storable = new Storable('fd', 'df', 'sf');
$switchable = new Switchable();
$positionble = new Positionable();
$media = new Media(
    'Media',
    $positionble,
    'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
    [
        'Title' => 'Quick Installation, Setup, And Hello World Video',
    ]
);

?>

<video style="width: 50%; height: auto;" controls>
<source src="<?php echo $media->mediaUrl(); ?>" type="video/webm">
  Your browser does not support HTML video.
</video>
