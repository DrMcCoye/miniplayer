<?php

namespace Miniplayer\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Miniplayer\Domain\Playlist;

class ApiController {

    /**
     * API playlists controller.
     *
     * @param Application $app Silex application
     *
     * @return All playlists in JSON format
     */
    public function getPlaylistsAction(Application $app) {
        $playlists = $app['dao.playlist']->findAll();
        // Convert an array of objects ($playlists) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($playlists as $playlist) {
            $responseData[] = $this->buildPlaylistArray($playlist);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API playlist details controller.
     *
     * @param integer $id Playlist id
     * @param Application $app Silex application
     *
     * @return Article details in JSON format
     */
    public function getPlaylistAction($id, Application $app) {
        $playlist = $app['dao.playlist']->find($id);
        $responseData = $this->buildPlaylistArray($playlist);
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * Converts a Playlist object into an associative array for JSON encoding
     *
     * @param Playlist $playlist Article object
     *
     * @return array Associative array whose fields are the playlist properties.
     */
    private function buildPlaylistArray(Playlist $playlist) {
        $data  = array(
            'id' => $playlist->getId(),
            'title' => $playlist->getTitle(),
            'url' => $playlist->getUrl()
            );
        return $data;
    }
}