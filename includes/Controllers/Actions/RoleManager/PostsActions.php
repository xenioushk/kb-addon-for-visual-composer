<?php
namespace KAFWPB\Controllers\Actions\RoleManager;

use BwlPetitionsManager\Api\Actions\ActionsApi;
use BwlPetitionsManager\Callbacks\Actions\RoleManager\PostsActionsCb;

/**
 * Class for Role manager posts actions.
 *
 * @since: 1.1.5
 * @package BwlPetitionsManager
 */
class PostsActions {

    /**
     *  Instance of the actions API.
     *
     * @var object $actions_api
     */
    private $actions_api;

    /**
     *  Instance of the posts actions callback.
     *
     * @var object $posts_actions_cb
     */
    private $posts_actions_cb;

    /**
	 * Register actions.
	 */
    public function register() {

        // Initialize API.
        $this->actions_api = new ActionsApi();

        // Initialize callbacks.
        $this->posts_actions_cb = new PostsActionsCb();

        // Add actions.
        $actions = [
            [
                'tag'      => 'load-post-new.php',
                'callback' => [ $this->posts_actions_cb, 'limit_users_posts' ],
            ],
            [
                'tag'      => 'draft_to_pending',
                'callback' => [ $this->posts_actions_cb, 'notify_new_petition' ],
            ],
            [
                'tag'      => 'pending_to_publish',
                'callback' => [ $this->posts_actions_cb, 'notify_published_petition' ],
            ],
        ];

        $this->actions_api->add_actions( $actions )->register();
    }
}
