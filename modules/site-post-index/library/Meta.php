<?php
/**
 * Meta
 * @package site-post-index
 * @version 0.0.3
 */

namespace SitePostIndex\Library;


class Meta
{
	static function single(){
        $result = [
            'head' => [],
            'foot' => []
        ];

        $deff = \Mim::$app->config->name;

        $site_setting = module_exists('site-setting');

        $std_metas = ['title','description','keywords'];
        $meta = (object)[];
        foreach($std_metas as $name)
            $meta->$name = ($site_setting?\Mim::$app->setting->{'post_index_'.$name}:NULL) ?? $deff;

        $page = \Mim::$app->req->getQuery('page', 1);
        if($page > 1) {
            $meta->title .= ' Page ' . $page;
            $meta->description .= ' Page ' . $page;
        }

        $result['head'] = [
            'description'       => $meta->description,
            'schema.org'        => [],
            'type'              => 'website',
            'title'             => $meta->title,
            'url'               => \Mim::$app->router->to('sitePostIndex'),
            'metas'             => []
        ];

        return $result;
    }
}
