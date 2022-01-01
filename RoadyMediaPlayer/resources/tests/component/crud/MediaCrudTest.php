<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\crud;

use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use PHPUnit\Framework\TestCase;
use roady\classes\component\Component;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\primary\Storable as StorableInteface;

/**
 * Defines tests for the MediaCrud class.
 *
 * - Methods - 
 *
 * private function getTestMediaCrud(): MediaCrud
 * protected function newMediaInstance(): MediaInterface 
 * public function testCreateMediaSavesMediaToStorage(): void
 *
 */
class MediaCrudTest extends TestCase 
{

    /**
     * Return a MediaCrud instance that can be used for testing.
     */
    private function getTestMediaCrud(): MediaCrud
    {
        return new MediaCrud(
            new Storable(
                'TestMediaCrud',
                'TestComponents',
                'Cruds'
            ),
            new Switchable(),
            new JsonStorageDriver(
                new Storable(
                    'TestJsonStorageDriver',
                    'TestComponents',
                    'StorageDrivers'
                ),
                new Switchable()
            )
        );
    }

    /**
     * Return a new Media instance that can be used for testing.
     */
    protected function newMediaInstance(): MediaInterface 
    {
        $mediaUrls = [
            'https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg4.png',
            'https://ddmsmedia.us-east-1.linodeobjects.com/READMEDemo.gif',
            'https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm',
            'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
            'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3',
        ];
        return new Media(
            'name',
            new Positionable(rand(0, 1000)),
            $mediaUrls[array_rand($mediaUrls)],
            [
                'Artist' => 'Foo' . rand(0, 1000),
                'Title' => 'Bar' . rand(0, 1000),
                'Description' => 'Lorem ' . rand(0, 87) . 'ipsum',
                'Added' => date('YmdHms'),
            ]
        );
    }


    /**
     * Return an array of the meta data expected to be assigned
     * to the Media instance returned when the specified media
     * could not be read from stroage by of the readMedai()
     * method.
     *
     * @return array<string, string> 
     */
    public function expectedErrorMetaData(StorableInteface $storable): array
    {
        return [
            'Error' => 'MEDIA_DOES_NOT_EXIST_IN_STORAGE',
            'MediaName' => $storable->getName(),
            'MediaUniqueId' => $storable->getUniqueId(),
            'MediaLocation' => $storable->getLocation(),
            'MediaContainer' => $storable->getContainer(),
        ];
    }

    /**
     * The createMedia() method must save the Media to storage.
     *
     * After createMedia() is called, the Media must be able to
     * be retrieved from storage by the read() method. 
     */
    public function testCreateMediaSavesMediaToStorage(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $mediaCrud->createMedia($media);
        $this->assertEquals(
            $media,
            $mediaCrud->read($media)
        );
    }

    public function testReadMediaReturnsMediaWhoseMediaIsAccessibleMethodReturnsFalseIfSpecifiedMediaDoesNotExistInStorage(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $storedMedia = $mediaCrud->readMedia($media);
        $this->assertFalse(
            $storedMedia->mediaIsAccessible()
        );
    }

    public function testReadMediaReturnsMediaWhoseNameMatchesTheSpecifiedMediasNameIfSpecifiedMediaDoesNotExistInStorage(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $storedMedia = $mediaCrud->readMedia($media);
        $this->assertEquals(
            $media->getName(),
            $storedMedia->getName()
        );
    }

    public function testReadMediaReturnsMediaWhoseMetaDataMatchesTheExpectedErrorMetaDataThatShouldBeAssignedWhenMediaCantBeReadFromStorage(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $storedMedia = $mediaCrud->readMedia($media);
        $this->assertEquals(
            $this->expectedErrorMetaData($media),
            $storedMedia->metaData()
        );
    }

    public function testReadMediaReturnsMediaWhoseMediaIsAccessibleMethodReturnsFalseIfSpecifiedMediaMatchesAStoredComponentThatIsNotAMediaComponent(): void
    {
        $media = $this->newMediaInstance();
        $component = new Component(
            $media->export()['storable']
        );
        $mediaCrud = $this->getTestMediaCrud();
        $mediaCrud->create($component);
        $storedCompnent = $mediaCrud->readMedia($media);
        $this->assertFalse(
            $storedCompnent->mediaIsAccessible()
        );
    }

    public function testReadMediaReturnsSpecifiedMediaIfSpecifiedMediaExistsInStorage(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $mediaCrud->createMedia($media);
        $storedMedia = $mediaCrud->readMedia($media);
        $this->assertEquals(
            $media,
            $storedMedia
        );
    }
}
