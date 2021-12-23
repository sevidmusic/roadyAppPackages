# RoadyMediaPlayer initial development notes:

This App will generate the html necessary to display the following
types of Media on a website:

    - Audio
    - Images
    - Video

Media will be organized into MediaPlaylists.

A MediaPlayer will be responsible for playing media assigned to a
MediaPlaylist.

# Interfaces (rough drafts, these still may change)

### Media

```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\media;

interface Media extends roady\interfaces\component\SwitchableComponent
{

    /** 
     * Return a single dimensional associative array of the 
     * Media's meta data. 
     * 
     * Note: Keys and values will be strings.
     *
     * @return array<string, string>
     */
    public function metaData(): array;

    /** 
     * Return the Media's url.
     * 
     * @return string 
     */
    public function mediaUrl(): string;

    /** 
     * Return true if the Media's is accessible, 
     * false otherwise. 
     * 
     * @return bool
     */
    public function mediaIsAccessible(): bool;

}
```
### Audio
```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\media;

Audio extends Media;
```

### Video 
```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\media;

Video extends Media;
```

### Image
```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\media;

Image extends Media;
```

### Media Playlist

```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\playlist;

MediaPlaylist extends roady\interfaces\component\Registry\Storage\StoredComponentRegistry
{
    /** 
     * Return an array of Media assigned to this playlist.
     *
     * @return array<Media>
     */
    public function getMedia(): array;
    
    /**
     * Add Media to the playlist.
     * @param Media The Media to add to the playlist.
     */
    public function addMedia(Media): void;

    /**
     * Remove Media from the playlist.
     * @param Media The Media to remove from the playlist.
     */
    public function removeMedia(Media): void;

}
```

### Audio Playlist
```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\playlist;

AudioPlaylist extends MediaPlaylist;
```
### Video Playlist
```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\playlist;

VideoPlaylist extends MediaPlaylist;
```

### Image Playlist
```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\playlist;

ImagePlaylist extends MediaPlaylist;
```

### MediaPlayer
```
<?php

namespace Apps\RoadyMediaPlayer\resources\components\player;

MediaPlayer extends roady\interfaces\components\OutputComponent
{
    /** 
     * Change the current MediaPlaylist.
     *
     * @param MediaPlaylist The new MediaPlaylist to use.
     */
    public function changePlaylist(MediaPlaylist): void;
    
    /**
     * Return the MediaPlaylist currently in use. 
     *
     * @return MediaPlaylist
     */
    public function currentPlaylist(): MediaPlaylist;

    /**
     * Return the currently selected Media.
     *
     * @return Media
     */
    public function currentMedia(): Media;

    /**
     * Return the html for the player
     * 
     * @return string The html for the player.
     */
     public function mediaPlayerHtml(): string;

     /** 
      * Return the html for the playlist.
      *
      * @return string The html for the playlist
      */
      public function playlistHtml(): string;
}
```

