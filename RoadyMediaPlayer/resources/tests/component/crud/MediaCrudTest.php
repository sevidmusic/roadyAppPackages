<?php

namespace Apps\RoadyMediaPlayer\resources\tests\component\crud;

use Apps\RoadyMediaPlayer\resources\classes\component\crud\MediaCrud;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Audio;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Image;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Media;
use Apps\RoadyMediaPlayer\resources\classes\component\media\Video;
use Apps\RoadyMediaPlayer\resources\interfaces\component\media\Media as MediaInterface;
use PHPUnit\Framework\TestCase;
use UnitTests\classes\component\Crud\ComponentCrudTest;
use roady\classes\component\Component;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use roady\classes\primary\Positionable;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\primary\Storable as StorableInteface;

/**
 * Defines tests for the MediaCrud class.
 */
class MediaCrudTest extends ComponentCrudTest 
{

    /** @var array<int, string> $validAudioUrls */
    private array $validAudioUrls = [
        'https://sevidmusic.us-east-1.linodeobjects.com/Lies_by_SeviD_20210902.mp3',
    ];

    /** @var array<int, string> $validImageUrls */
    private array $validImageUrls = [
        'https://ddmsmedia.us-east-1.linodeobjects.com/DDMSDemoImg4.png',
        'https://ddmsmedia.us-east-1.linodeobjects.com/READMEDemo.gif',
    ];

    /** @var array<int, string> $validVideoUrls */
    private array $validVideoUrls = [
        'https://roadydemos.us-east-1.linodeobjects.com/GettingStarted.webm',
        'https://roadydemos.us-east-1.linodeobjects.com/QuickInstallSetupHelloWorldFinal.webm',
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
     * @param array<int, MediaInterface> $media
     */
    private function removeMedia(array $media): void
    {
        $mediaCrud = $this->getTestMediaCrud();
        foreach($media as $component) {
            $mediaCrud->delete($component);
        }
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
     * Return an array of the meta data expected to be assigned
     * to the Media instance returned when the specified media
     * could not be read from stroage by of the readMedai()
     * method.
     *
     * @return array<string, string> 
     */
    public function expectedErrorMetaData(
        StorableInteface $storable
    ): array
    {
        return [
            'Error' => 'MEDIA_DOES_NOT_EXIST_IN_STORAGE',
            'MediaName' => $storable->getName(),
            'MediaUniqueId' => $storable->getUniqueId(),
            'MediaLocation' => $storable->getLocation(),
            'MediaContainer' => $storable->getContainer(),
        ];
    }

    public function setUp(): void
    {
        $this->setComponentCrud(
            $this->getTestMediaCrud()
        );
        $this->setComponentCrudParentTestInstances();
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

    /**
     * @param int $mediaCount The number of Media instances that the
     *                        array should contain.
     *
     * @param class-string<object>|object $mediaType A fully qualified
     *                                               class name, or an
     *                                               object instance
     *                                               that will be used
     *                                               to determine 
     *                                               what type of 
     *                                               Media to populate
     *                                               the array with.
     *
     * @return array<int, MediaInterface> An array of Media, the
     *                                    number of Media instances
     *                                    in the array will match
     *                                    the specified $mediaCount.
     */
    public function arrayOfMedia(
        int $mediaCount = 1, 
        string|object $mediaType = Media::class
    ): array
    {
        $media = [];
        $mediaType = explode(
            '\\', 
            (is_string($mediaType) ? $mediaType : $mediaType::class)
        );
        $mediaType = implode('\\', $mediaType);
        for($i=0; $i<=$mediaCount;$i++) {
            switch($mediaType) {
            case Media::class:
                array_push($media, $this->newMediaInstance());
                break;
            case Audio::class:
                array_push($media, $this->newAudioInstance());
                break;
            case Video::class:
                array_push($media, $this->newVideoInstance());
                break;
            case Image::class:
                array_push($media, $this->newImageInstance());
                break;
            }
        }
        return $media;
    }

    public function testReadAllMediaReturnsAllStoredMediaOfTheSpecifiedType(): void
    {
        $media = $this->arrayOfMedia(rand(1, 10), Media::class);
        $this->storeMedia($media);
        $audio = $this->arrayOfMedia(rand(1, 10), Audio::class);
        $this->storeMedia($audio);
        $videos = $this->arrayOfMedia(rand(1, 10), Video::class);
        $this->storeMedia($videos);
        $images = $this->arrayOfMedia(rand(1, 10), Image::class);
        $this->storeMedia($images);
        $mediaCrud = $this->getTestMediaCrud();
        $mediaTypes = [
            'media' => [Media::class, $media[array_rand($media)]],
            'audio' => [Audio::class, $audio[array_rand($audio)]],
            'videos' => [Video::class, $videos[array_rand($videos)]],
            'images' => [Image::class, $images[array_rand($images)]],
        ];
        foreach($mediaTypes as $mediaArrayVarName => $typeAndInstance) {
            foreach($typeAndInstance as $mediaType) {
                $this->assertEquals(
                    $$mediaArrayVarName,
                    $mediaCrud->readAllMedia($mediaType)
                );
            }
        }
        $this->removeMedia($media);
        $this->removeMedia($audio);
        $this->removeMedia($videos);
        $this->removeMedia($images);
    }

    public function testReadAllOnlyReturnsMediaComponentsFromStroage(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $component = new Component($media->export()['storable']);
        $mediaCrud->create($component);
        $media2 = $this->newMediaInstance();
        $mediaCrud->createMedia($media2);
        $storedMedia = $mediaCrud->readAllMedia(Media::class);
        $this->assertFalse(
            in_array($component, $storedMedia)
        );
        $this->assertTrue(
            in_array($media2, $storedMedia)
        );
        $mediaCrud->delete($component);
        $mediaCrud->deleteMedia($media2);
    }

    public function testReadAllMediaReturnsAnEmptyArrayIfThereIsNoStoredMediaOfTheSpecifiedType(): void
    {
        $media = $this->newMediaInstance();
        $mediaCrud = $this->getTestMediaCrud();
        $this->assertEmpty($mediaCrud->readAllMedia($media));
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

}
