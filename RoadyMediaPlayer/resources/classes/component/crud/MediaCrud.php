<?php

namespace Apps\RoadyMediaPlayer\resources\classes\component\crud;

use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media;
use roady\classes\component\Crud\ComponentCrud;
use roady\interfaces\component\Component;

class MediaCrud extends ComponentCrud 
{

    public function createMedia(Media $media): bool 
    {
        return parent::create($media);
    }    

}
