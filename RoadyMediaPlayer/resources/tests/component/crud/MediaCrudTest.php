<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\crud;

use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Audio;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use PHPUnit\Framework\TestCase;
use roady\classes\component\Component;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\primary\Storable as StorableInteface;
use UnitTests\classes\component\Crud\ComponentCrudTest;

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
class MediaCrudTest extends ComponentCrudTest 
{

    public function setUp(): void
    {
        $this->setComponentCrud(
            $this->getTestMediaCrud()
        );
        $this->setComponentCrudParentTestInstances();
    }

    /** @var array<int, string> $validAudioUrls */
    private array $validAudioUrls = [
        'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3',
    ];
    /** @var array<int, string> $validVideoUrls */
    private array $validVideoUrls = [
        'https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm',
        'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
    ];
    /** @var array<int, string> $validImageUrls */
    private array $validImageUrls = [
        'https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg4.png',
        'https://ddmsmedia.us-east-1.linodeobjects.com/READMEDemo.gif',
    ];

    /**
     * Return a MediaCrud instance that can be used for testing.
     */
    private function getTestMediaCrud(): MediaCrud
    {
        return new MediaCrud(
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
    }

    /**
     * Return a new Media instance that can be used for testing.
     */
    protected function newMediaInstance(): MediaInterface 
    {
        $mediaUrls = array_merge(
            $this->validAudioUrls,
            $this->validVideoUrls,
            $this->validImageUrls
        );
        return new Media(
            'Media' . rand(0, 1000),
            new Positionable(rand(0, 1000)),
            $mediaUrls[array_rand($mediaUrls)],
            $this->mockMetatData()
        );
    }

    /**
     * Return a new Audio instance that can be used for testing.
     */
    protected function newAudioInstance(): Audio 
    {
        return new Audio(
            'Audio' . rand(0, 1000),
            new Positionable(rand(0, 1000)),
            $this->validAudioUrls[array_rand($this->validAudioUrls)],
            $this->mockMetatData()
        );
    }

    /**
     * Return a new Video instance that can be used for testing.
     */
    protected function newVideoInstance(): Video 
    {
        return new Video(
            'Video' . rand(0, 1000),
            new Positionable(rand(0, 1000)),
            $this->validVideoUrls[array_rand($this->validVideoUrls)],
            $this->mockMetatData()
        );
    }

    /**
     * Return a new Image instance that can be used for testing.
     */
    protected function newImageInstance(): Image 
    {
        return new Image(
            'Image' . rand(0, 1000),
            new Positionable(rand(0, 1000)),
            $this->validImageUrls[array_rand($this->validImageUrls)],
            $this->mockMetatData()
        );
    }

    /**
     * Return an array of mock meta data that can be used
     * for testing.
     *
     * @return array<string, string> 
     */
    private function mockMetatData(): array
    {
        return [
            'Artist' => 'Foo' . rand(0, 1000),
            'Title' => 'Bar' . rand(0, 1000),
            'Description' => 'Lorem ' . rand(0, 87) . 'ipsum',
            'Added' => date('YmdHms'),
        ];
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

    public function testCreateMediaSavesMediaToStorage(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $mediaCrud->createMedia($media);
        $this->assertEquals(
            $media,
            $mediaCrud->read($media)
        );
        $mediaCrud->delete($media);
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
        $mediaCrud->delete($component);
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
        $mediaCrud->delete($media);
    }

    public function testUpdateMediaUpdateSpecifiedMedia(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $mediaCrud->createMedia($media);
        $newMedia = $this->newMediaInstance();
        $mediaCrud->updateMedia($media, $newMedia);
        $this->assertEquals(
            $newMedia,
            $mediaCrud->readMedia($newMedia)
        );
        $mediaCrud->delete($newMedia);
    }

    public function testReadAllMediaReturnsAnEmptyArrayIfThereIsNoStoredMediaOfTheSpecifiedType(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $this->assertEmpty($mediaCrud->readAllMedia($media));
    }

    public function testReadAllMediaReturnsAllStoredMediaOfSpecifiedType(): void
    {
        $media = [
            $this->newMediaInstance(),
            $this->newMediaInstance(),
            $this->newMediaInstance(),
        ];
        $this->storeMedia($media);
        $audio = [
            $this->newAudioInstance(),
        ];
        $this->storeMedia($audio);
        $videos = [
            $this->newVideoInstance(),
            $this->newVideoInstance(),
            $this->newVideoInstance(),
            $this->newVideoInstance(),
            $this->newVideoInstance(),
        ];
        $this->storeMedia($videos);
        $images = [
            $this->newImageInstance(),
            $this->newImageInstance(),
            $this->newImageInstance(),
            $this->newImageInstance(),
        ];
        $this->storeMedia($images);
        $mediaCrud = $this->getTestMediaCrud();
        $this->assertEquals(
            $media,
            $mediaCrud->readAllMedia(Media::class)
        );
        $this->assertEquals(
            $audio,
            $mediaCrud->readAllMedia(Audio::class)
        );
        $this->assertEquals(
            $videos,
            $mediaCrud->readAllMedia(Video::class)
        );
        $this->assertEquals(
            $images,
            $mediaCrud->readAllMedia(Image::class)
        );
        $this->removeMedia($media);
        $this->removeMedia($audio);
        $this->removeMedia($videos);
        $this->removeMedia($images);
    }

    /**
     * @param array<int, MediaInterface> $media
     */
    private function storeMedia(array $media): void
    {
        $mediaCrud = $this->getTestMediaCrud();
        foreach($media as $component) {
            $mediaCrud->create($component);
        }
    }

    /**
     * @param array<int, MediaInterface> $media
     */
    private function removeMedia(array $media): void
    {
        $mediaCrud = $this->getTestMediaCrud();
        foreach($media as $component) {
            $mediaCrud->delete($component);
        }
    }

    public function testDeleteMediaDeletesSpecifiedMedia(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $mediaCrud->createMedia($media);
        $mediaCrud->deleteMedia($media);
        $this->assertNotEquals(
            $media,
            $mediaCrud->readMedia($media)
        );
        $mediaCrud->delete($media);
    }

}
