<?php

namespace Miniplayer\Domain;

class Playlist 
{
    /**
     * Playlist id.
     *
     * @var integer
     */
    private $id;

    /**
     * Playlist name.
     *
     * @var string
     */
    private $name;

    /**
     * Playlist deezer.
     *
     * @var string
     */
    private $deezer;

    /**
     * Playlist image url.
     *
     * @var string
     */
    private $image;

    /**
     * Playlist author.
     *
     * @var \WebPlaylists\Domain\User
     */
    private $author;



    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDeezer($deezer) {
        $this->deezer = $deezer;
    }

    public function getDeezer() {
        return $this->deezer;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
    
    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
    }
}
