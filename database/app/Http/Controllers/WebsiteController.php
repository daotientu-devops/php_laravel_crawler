<?php
/**
 * Created by PhpStorm.
 * User: daotientu
 * Date: 10/22/2016
 * Time: 9:42 AM
 */
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use DOMDocument;
use MongoId;

class WebsiteController extends Controller {
    public function getCrawlerURL() {
        set_time_limit(600000);
        $this->crawl_page(Input::get('url'));
    }
    function crawl_page($url, $depth = 3)
    {
        $m = $this->connectOthers();
//        $database = $m->db_fptshopcomvn;
//        $collection = $database->maytinhxachtay;
        $database = $m->db_nhattaocom;
        $collection = $database->dienthoai;

        static $seen = array();
        if (isset($seen[$url]) || $depth === 0) {
            return;
        }

        $seen[$url] = true;

        $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile($url);

        $anchors = $dom->getElementsByTagName('a');
        foreach ($anchors as $element) {
            $href = $element->getAttribute('href');
            if (0 !== strpos($href, 'http')) {
                $path = '/' . ltrim($href, '/');
                if (extension_loaded('http')) {
                    $href = http_build_url($url, array('path' => $path));
                } else {
                    $parts = parse_url($url);
                    $href = $parts['scheme'] . '://';
                    if (isset($parts['user']) && isset($parts['pass'])) {
                        $href .= $parts['user'] . ':' . $parts['pass'] . '@';
                    }
                    $href .= $parts['host'];
                    if (isset($parts['port'])) {
                        $href .= ':' . $parts['port'];
                    }
                    $href .= $path;
                }
            }
            // filter url
            //if (strpos($href, 'fptshop.com.vn/may-tinh-xach-tay/') !== false) {
            if (strpos($href, 'nhattao.com/threads/') !== false
                && strpos($href, 'page') == false
                && strpos($href, 'result') == false
                && strpos($href, '#') == false
                && strpos($href, 'social-shared') == false
            ) {
                $this->crawl_page($href, $depth - 1);
            }
        }
        //if ($url !== 'http://fptshop.com.vn/may-tinh-xach-tay' && $url !== 'https://fptshop.com.vn/may-tinh-xach-tay') {
        if ($url !== 'https://nhattao.com/f/dien-thoai.543/' && $url !== 'https://nhattao.com/f/dien-thoai.543') {
            //echo "URL: ", $url . '<br/>';//,"CONTENT:",PHP_EOL,$dom->saveHTML(),PHP_EOL,PHP_EOL; // 350 documents, 5 depths
            $dataUrl = array(
                'url' => $url,
                'status' => 0
            );
            $collection->insert($dataUrl);
        }
        echo 'Done !!!';
        return redirect()->back();
    }

    public function storeWebsite() {
        $db = $this->connect();

        // select a collection
        $collection = $db->website;

        $web = array(
            'type' => Input::get('type'),
            'language' => Input::get('language'),
            'name' => Input::get('name'),
            'url' => Input::get('url')
        );
        $collection->insert($web);

        $m = $this->connectOthers();
        $database = Input::get('database');
        $db = $m->$database;
        $col = $db->user_log;
        $log = array(
            'title' => 'Quản trị viên tạo database ' . $database,
            'created_at' => time()
        );
        $col->insert($log);

        return redirect()->back();
    }

    public function store() {
        $website_name = Input::get('website_name');
        $website_url = Input::get('website_url');
        $db = $this->connect();
        $collection = $db->website;
        $collection->insert(array(
            'name' => $website_name,
            'url' => $website_url,
            'created_at' => time()
        ));
        return redirect()->back();
    }

    public function destroy($id) {
        $db = $this->connect();
        $collection = $db->website;
        $collection->remove(array(
            '_id' => new MongoId($id)
        ));
        return redirect()->back();
    }
}