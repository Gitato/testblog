<?php

namespace App\Services\Parser;

use Symfony\Component\DomCrawler\Crawler;

class ParsePost
{
    public static function instance() : ParsePost
    {
        return app()->make(static::class);
    }

    public function parse()
    {
        $html = file_get_contents('https://habr.com/ru/');
        $crawler = new Crawler($html);

        $last_page = $crawler
            ->filter('a.toggle-menu__item-link.toggle-menu__item-link_pagination.toggle-menu__item-link_bordered')
            ->extract(['href']);
        $final_page = $last_page[0];
        $pages=array(
            0=>"https://habr.com/ru/page1/",
            1=>"https://habr.com/ru/page2/",
            2=>"https://habr.com/ru/page3/",
            3=>"https://habr.com/ru/page4/",
            4=>"https://habr.com/ru/page5/",);

        foreach ($pages as $page) {
            $html = file_get_contents($page);
            $crawler = new Crawler($html);
            $posts = $crawler
                ->filter('a.post__title_link')
                ->extract(['href']);
            foreach ($posts as $post) {

                $html = file_get_contents($post);
                $crawler = new Crawler($html);
                $tag=$crawler->filter('a.inline-list__item-link.hub-link')->each(function ($node)
                {
                    echo $node->html() . "<br>";
                });
                $crawler->filter('div.post__body.post__body_full')->each(function ($node,$id) {

//                    $fh = fopen("$id.txt",'a');
//                    $id++;
//                    fwrite($fh,$node->html());
//                    fclose($fh);
//                    echo $node->html();

                });
            }
        }
    }
}
