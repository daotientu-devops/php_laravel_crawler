<?php
/**
 * Created by PhpStorm.
 * User: daotientu
 * Date: 10/30/2016
 * Time: 1:48 AM
 */
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use DOMDocument;

class ContentController extends Controller
{
    public function createTag()
    {
        $db = $this->connect();

        // select a collection
        $collection = $db->website;
        $website = $collection->find();
        return view('extractor/tag', array('website' => $website));
    }

    public function storeTag()
    {
        $db = $this->connect();

        // select a collection
        $collection = $db->html_tag;

        $tag = array(
            'website_id' => Input::get('website_id'),
            'title_tag' => Input::get('title_tag'),
            'summary_tag' => Input::get('summary_tag'),
            'content_tag' => Input::get('content_tag'),
            'created_at' => time(),
            'updated_at' => time()
        );

        $collection->insert($tag);
        return redirect()->back();
    }

    public function createExtractor()
    {
        $db = $this->connect();

        // select a collection
        $collection = $db->website;
        $website = $collection->find();
        return view('extractor/data', array('website' => $website));
    }
}