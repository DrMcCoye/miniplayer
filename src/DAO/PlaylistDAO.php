<?php

namespace Miniplayer\DAO;

use Miniplayer\Domain\Playlist;

class PlaylistDAO extends DAO 
{

    /**
     * @var \Miniplayer\DAO\UserDAO
     */
    private $userDAO;

    public function setUserDAO(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    /**
     * Returns a list of all playlists, sorted by id.
     *
     * @return array A list of all playlists.
     */
    public function findAll() {
        $sql = "select * from t_playlist order by media_id desc";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $entities = array();
        foreach ($result as $row) {
            $id = $row['media_id'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
    }

    /**
     * Creates an Playlist object based on a DB row.
     *
     * @param array $row The DB row containing Playlist data.
     * @return \Miniplayer\Domain\Playlist
     */
    protected function buildDomainObject($row) {
        $playlist = new Playlist();
        $playlist->setId($row['media_id']);
        $playlist->setName($row['media_name']);
        $playlist->setDeezer($row['deezer_id']);
        $playlist->setImage($row['mini_image_url']);

        if (array_key_exists('user_id', $row)) {
            // Find and set the associated author
            $userId = $row['user_id'];
            $user = $this->userDAO->find($userId);
            $playlist->setAuthor($user);
        }

        return $playlist;
    }
    
    /**
     * Saves a playlist into the database.
     *
     * @param \Miniplayer\Domain\Playlist playlist The playlist to save
     */
    public function save(Playlist $playlist) {
        $playlistData = array(
            'user_id' => $playlist->getAuthor()->getId(),
            'media_name' => $playlist->getName(),
            'deezer_id' => $playlist->getDeezer(),
            'mini_image_url' => $playlist->getImage()
            );

        if ($playlist->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('t_playlist', $playlistData, array('media_id' => $playlist->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('t_playlist', $playlistData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $playlist->setId($id);
        }
    }

    /**
     * Returns a playlist matching the supplied id.
     *
     * @param integer $id The playlist id
     *
     * @return \Miniplayer\Domain\Playlist|throws an exception if no matching comment is found
     */
    public function find($id) {
        $sql = "select * from t_playlist where media_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No playlist matching id " . $id);
        }
    }

    /**
     * Removes a playlist from the database.
     *
     * @param @param integer $id The playlist id
     */
    public function delete($id) {
        // Delete the comment
        $this->getDb()->delete('t_playlist', array('media_id' => $id));
    }

    /**
     * Removes all playlists for a user
     *
     * @param integer $userId The id of the user
     */
    public function deleteAllByUser($userId) {
        $this->getDb()->delete('t_playlist', array('user_id' => $userId));
    }
  

}
