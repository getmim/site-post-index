<?php
/**
 * PostController
 * @package site-post-index
 * @version 0.0.1
 */

namespace SitePostIndex\Controller;

use Post\Model\Post;
use SitePostIndex\Library\Meta;
use LibFormatter\Library\Formatter;

class PostController extends \Site\Controller
{
	public function indexAction(){
		$posts = Post::get(['status'=>3], 12, 1, ['created'=>false]);
		if($posts)
			$posts = Formatter::formatMany('post', $posts, ['user']);
        
        $params = [
            'meta'    => Meta::single(),
            'posts'   => $posts
        ];

        $this->res->render('post/index', $params);
        $this->res->setCache(86400);
        $this->res->send();
	}
}