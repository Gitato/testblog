<?php

namespace App\Http\Controllers;

use Symfony\Component\DomCrawler\Crawler;
use App\ParsedPost;
use App\ParsedTag;
use Illuminate\Http\Request;

class ParseController extends Controller
{
    public function index()
    {
//        $parser = new ParsedPost();
//        $parser->parsePost();
        $posts = ParsedPost::all();
        $tags = ParsedTag::all();
        return view('parsed_posts')->withPosts($posts)->withTags($tags);
    }
    public function show($id)
    {
        $post=ParsedPost::find($id);

        return view('show_parsed_post')
            ->withPost($post);
    }

    public function search_parsed_tag(Request $request)
    {
        $posts=ParsedPost::join('parsed_tags_relationship','parsed_posts.id','=','parsed_tags_relationship.parsed_post_id')
            ->join('parsed_tags','parsed_tags_relationship.parsed_tag_id','=','parsed_tags.id')
            ->whereIn('parsed_tags.id',$request->tag_id)
            ->groupBy('parsed_posts.id')
            ->selectRaw("parsed_tags.id as tag_id, parsed_tags.parsed_tag, parsed_posts.*")
            ->paginate(15);

        $tags=ParsedTag::all();
        return view('parsed_posts')->withPosts($posts)->withTags($tags);
    }





//        $parser->parsePosts()->save();


}

//
//            $crawler->filter('a.inline-list__item-link.hub-link')->each(function ($node)
//            {
//                echo $node->html() . "<br>";
//            });

//            div#post-content-body.post__text.post__text-html.post__text_v1
//            div.post__body.post__body_full
//            $fh = fopen("test.txt","a");
//            foreach ($crawler->filter('div.post__text.post__text-html.post__text_v1') as $body) {
//                fwrite($fh, $body->textContent . "\n");
//            }
//            fclose($fh);
//        }



//        foreach ($crawler->filter('a.post__title_link') as $title) {
//            echo $title->textContent . '<br>';
//        }
//        foreach ($crawler->filter('a.toggle-menu__item-link.toggle-menu__item-link_pagination') as $tag) {
//            echo $tag->textContent . '<br>';
//        }





//        $dom= new \DOMDocument();
//        @ $dom->loadHTML($html);
//        $finder= new \DOMXPath($dom);
//        $title_class= "post__title_link";
//        $tag_class= "inline-list__item-link";
//        $titles = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $title_class ' )]");
//        $tags = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $tag_class ' )]");
//        foreach ($titles as $title) {
//            $title_text = $title->textContent;
//            echo $title_text . '<br>';
//        }
//        foreach ($tags as $tag)
//        {
//            $tag_text = $tag->textContent;
//            echo $tag_text . '<br>'. '<br>';
//        }
//        $fh = fopen("test.txt","a");
//        foreach ($tags as $tag)
//        {
//            fwrite($fh, $tag->textContent . "\n");
//        }
//        fclose($fh);



//        do
//        {
//
//            $i++;
//            $b[] = array_push($pages,"/ru/page$i/");
//            print_r($pages);
//        }
//        while(array_pop($pages)!==$final_page);
//        print_r($b);


//        $last_page = $crawler
//            ->filter('a.toggle-menu__item-link.toggle-menu__item-link_pagination.toggle-menu__item-link_bordered')
//            ->extract(['href']);
//        $final_page = $last_page[0];
