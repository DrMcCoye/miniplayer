<?php

namespace Miniplayer\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Miniplayer\Domain\Playlist;
use Miniplayer\Form\Type\PlaylistType;

class HomeController {

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $playlists = $app['dao.playlist']->findAll();
        return $app['twig']->render('index.html.twig', array('playlists' => $playlists));
    }

    /**
     * Add playlist controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addPlaylistAction(Request $request, Application $app) {
        $playlistFormView = null;
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
            // A user is fully authenticated : he can add playlists
            $playlist = new Playlist();
            $user = $app['user'];
            $playlist->setAuthor($user);
            $playlistForm = $app['form.factory']->create(new PlaylistType(), $playlist);
            $playlistForm->handleRequest($request);
            if ($playlistForm->isSubmitted() && $playlistForm->isValid()) {
                $app['dao.playlist']->save($playlist);
                $app['session']->getFlashBag()->add('success', 'The playlist was successfully created.');
            }
            $playlistFormView = $playlistForm->createView();
        }
        
        return $app['twig']->render('playlist_form.html.twig', array(
            'title' => 'New playlist',
            'playlistForm' => $playlistFormView));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            ));
    }


    /**
     * Play media controller.
     *
     * @param integer $id Deezer media id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function playAction($id, Request $request, Application $app) {
      
        return $app['twig']->render('player.html.twig', array(
            'title' => 'MINIPLAYER',
            'deezerid' => $id ));
    }
}