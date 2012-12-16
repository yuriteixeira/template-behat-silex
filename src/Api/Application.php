<?php

namespace Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Application extends \Silex\Application
{
    public $storage;

    public function __construct()
    {
        parent::__construct();

        $this->storage = array('users' => array());

        $app = $this;

        $this->get('/', function() {
            return new Response('Welcome!');
        });

        $this->get('/user/{userId}', function($userId) use ($app) {
            foreach ($app->storage['users'] as $user) {
                if ($user['login'] == $userId) {
                    return new Response(json_encode($user));
                }
            }

            return new Response('', 404);
        });

        $this->post('/user', function(Request $request) use ($app) {
            $login = $request->request->get('login');
            $name = $request->request->get('name');

            foreach ($app->storage['users'] as $user) {
                if ($user['login'] == $login) {
                    return new Response('', 400);
                }
            }

            $app->storage['users'][] = array('login' => $login, 'name' => $name);
            return new Response();
        });
    }
}