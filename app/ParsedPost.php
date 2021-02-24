<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Static_;
use Symfony\Component\DomCrawler\Crawler;

class ParsedPost extends Model
{
    protected $fillable= ['title','parsed_body'];

    public function parsedTags()
    {
        return $this->belongsToMany('App\ParsedTag', 'parsed_tags_relationship');
    }

    public function parsePost()
    {
        $pages = config('pages.pages');
        foreach ($pages as $page) {
            $html = file_get_contents($page);

            $crawler = new Crawler($html);

            $posts = $crawler
                ->filter('a.post__title_link')
                ->extract(['href']);
            foreach ($posts as $post) {
                $html = file_get_contents($post);
                $crawler = new Crawler($html);
//                div.post__body.post__body_full
                $body = $crawler->filter('div.post__body.post__body_full')->each(function ($node) {
                    return $node->html();
                });
                $tags = $crawler->filter('a.inline-list__item-link.hub-link')->each(function ($node) {
                    return $node->html();
                });
                $titles = $crawler->filter('span.post__title-text')->each(function ($node){
                   return $node->html();
                });
//                return $array = array("body"=>$body,"tags"=>$tags);
//                dd($titles);
                $title = array_pop($titles);

                $body = str_replace('"""', '', $body[0]);
                $post = ParsedPost::firstOrNew(['title'=>$title]);
                $post-> parsed_body = $body;
                $post->title = $title;
                $post->save();
                foreach ($tags as $tag) {

                    $tags=ParsedTag::firstOrCreate(['parsed_tag'=>$tag],['parsed_tag'=>$tag]);
                    $post->parsedTags()->attach($tags);

                }



//                print_r($arrays);
//                foreach ($arrays as $array) {
//                    print_r($array);
////                    $post = new ParsedPost();
//////                    dd($array);
////                    $post->parsed_body = $array['body'];
////                    $post->save();
//
//
//                }
//                print_r($tag);
//                $post = new ParsedPost();
//                $post->parsed_body = $body;
//                $post->save();
//                $tags=Tag::firstOrCreate(['parsed_tag'=>$tag],['parsed_tag'=>$tag]);
//                $post->parsedTags()->attach($tags);

            }

        }

    }











//
//
//    public function FileManager($i)
//    {
//        $path = "uploads/posts/id{$i}";
//        mkdir($path, '0777', 'true');
//        return "/$path/";
//
//    }
//
//    public function parsePages()
//    {
//        $pages = config('pages.pages');
//        file_put_contents('tags.txt', '');
//
//        foreach ($pages as $page) {
//
//            $html = file_get_contents($page);
//            $crawler = new Crawler($html);
//
//
//            return $crawler
//                ->filter('a.post__title_link')
//                ->extract(['href']);
//
//        }
//    }
//
//    public function parsePosts()
//    {
//
//        $posts=$this->parsePages();
//        dump($posts);
//
//        foreach ($posts as $post) {
//
//            $html = file_get_contents($post);
//            $crawler = new Crawler($html);
//
//            $crawler->filter('div.post__wrapper')->each(function ($node) {
////                 div.post__body.post__body_full
//                echo $node->html();
////                $parsed_post = new ParsedPost();
////                $parsed_post = $node->html();
////                $parsed_post->save();
//
////                $crawler = new Crawler($node);
////                $crawler->filter('a.inline-list__item-link.hub-link')->each(function ($node) {
////
////                    $parsed_tag = new ParsedTags();
////                    $parsed_tag->parsed_tag = $node->html();
////                    $parsed_tag->firstorCreate(['parsed_tag' => $parsed_tag], ['parsed_tag' => $parsed_tag]);
////                    $parsed_tag;
////                });
//            });
//        }
//    }
}
