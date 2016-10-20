<?php

namespace Miniplayer\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Miniplayer\Domain\Playlist;
use Miniplayer\Form\Type\PlaylistType;
use Miniplayer\Domain\User;
use Miniplayer\Form\Type\UserType;

class AdminController {

    /**
     * Admin home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $playlists = $app['dao.playlist']->findAll();
        $users = $app['dao.user']->findAll();
        return $app['twig']->render('admin.html.twig', array(
            'playlists' => $playlists,
            'users' => $users));
    }

    /**
     * Edit playlist controller.
     *
     * @param integer $id Playlist id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editPlaylistAction($id, Request $request, Application $app) {
        $playlist = $app['dao.playlist']->find($id);
        $playlistForm = $app['form.factory']->create(new PlaylistType(), $playlist);
        $playlistForm->handleRequest($request);
        if ($playlistForm->isSubmitted() && $playlistForm->isValid()) {
            $app['dao.playlist']->save($playlist);
            $app['session']->getFlashBag()->add('success', 'The playlist was succesfully updated.');
        }
        return $app['twig']->render('playlist_form.html.twig', array(
            'title' => 'Edit playlist',
            'playlistForm' => $playlistForm->createView()));
    }

    /**
     * Delete playlist controller.
     *
     * @param integer $id Playlist id
     * @param Application $app Silex application
     */
    public function deletePlaylistAction($id, Application $app) {
        $app['dao.playlist']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The playlist was succesfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    /**
     * Add user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addUserAction(Request $request, Application $app) {
        $user = new User();
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // generate a random salt value
            $salt = substr(md5(time()), 0, 23);
            $user->setSalt($salt);
            $plainPassword = $user->getPassword();
            // find the default encoder
            $encoder = $app['security.encoder.digest'];
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password); 
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'New user',
            'userForm' => $userForm->createView()));
    }

    /**
     * Edit user controller.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction($id, Request $request, Application $app) {
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $plainPassword = $user->getPassword();
            // find the encoder for the user
            $encoder = $app['security.encoder_factory']->getEncoder($user);
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password); 
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'Edit user',
            'userForm' => $userForm->createView()));
    }

    /**
     * Delete user controller.
     *
     * @param integer $id User id
     * @param Application $app Silex application
     */
    public function deleteUserAction($id, Application $app) {
        // Delete all associated comments
        $app['dao.playlist']->deleteAllByUser($id);
        // Delete the user
        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
    
}
