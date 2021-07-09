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
use MongoClient;

class WebsiteController extends Controller {
    public function getCrawlerURL() {
        set_time_limit(600000);
        $this->crawl_page(Input::get('type_product'),Input::get('url'),Input::get('page'),Input::get('html_ext'),Input::get('max_page'));
    }
    function crawl_page($type_product, $url, $page = '', $html_ext = '', $max_page = 2)//$depth = 1)
    {
        // set timeout ???
        ini_set('max_execution_time', 300);// 5 minutes
        set_time_limit(300);
        $depth = 1;
        $parse_url = parse_url($url)['host'];
        $parse_url = str_replace('www', '', $parse_url);
        $db_name = 'db_'.str_replace('.', '', $parse_url); //echo $db_name;
        $m = $this->connectOthers();
//        $database = $m->db_fptshopcomvn;
//        $collection = $database->maytinhxachtay;
        $database = $m->$db_name;
        $collection = $database->$type_product;

        static $seen = array();
        if (isset($seen[$url]) || $depth === 0) {
            return;
        }

        $seen[$url] = true;
        // Tạo database
        $dataUrl = array(
            'url' => $url,
            'status' => 0
        );
        $collection->insert($dataUrl, array('w' => true));

        $dom = new DOMDocument('1.0');
        // max_page = 2 để mặc định ít nhất crawl page đầu tiên
        for ($i = 1; $i < $max_page; $i++) {
//            @$dom->loadHTMLFile($url . '/?trang=' . $i);
            //$page = '?p='
            if ($page !== '') { // TH có phân trang
                @$dom->loadHTMLFile($url . $page . $i);
            } elseif ($html_ext !== '') { // TH không phân trang
                @$dom->loadHTMLFile($url . $page . $i . $html_ext);
            } else {
                @$dom->loadHTMLFile($url);
            }
            $anchors = $dom->getElementsByTagName('a');
            foreach ($anchors as $element) {
                $href = $element->getAttribute('href');//echo $href.'<br/>';
                if (false == strpos($href, 'javascript:;')
                    && false == strpos($href, '__doPostBack')
                    && false == strpos($href, 'Sosanh()')
                    && false == strpos($href, 'tel:')
                ) {
                    //if (0 !== strpos($href, 'http') && strpos($href, '.htm') != false) { //adayroi.com,
                    //if (strpos($href, '.htm') != false) {//hc.com.vn
                        $path = '/' . ltrim($href, '/');
                        if (extension_loaded('http')) {
                            $href = http_build_url($url, array('path' => $path));
                        } else {
                            $parts = parse_url($url);
                            //$href = $parts['scheme'] . '://'; //hc.com.vn
                            if (isset($parts['user']) && isset($parts['pass'])) {
                                $href .= $parts['user'] . ':' . $parts['pass'] . '@';
                            }
                            //$href .= $parts['host']; //hc.com.vn
                            if (isset($parts['port'])) {
                                $href .= ':' . $parts['port'];
                            }
                            //$href .= $path; //hc.com.vn
                        }
                        // filter url
                        //if (strpos($href, 'fptshop.com.vn/may-tinh-xach-tay/') !== false) {
//            if (strpos($href, 'nhattao.com/threads/') !== false
//                && strpos($href, 'page') == false
//                && strpos($href, 'result') == false
//                && strpos($href, '#') == false
//                && strpos($href, 'social-shared') == false
//            ) {
                        //echo $href.'<br/>';

                        $collection->ensureIndex(array('url' => 1), array('unique' => true));

                        try {
                            $dataUrl = array(
                                'url' => $href,
                                'status' => 0
                            );
                            $collection->insert($dataUrl, array('w' => true));
                        } catch (\MongoCursorException $e) {

                        }
                        //$this->crawl_page($href, $depth - 1);
//            }

                        //if ($url !== 'http://fptshop.com.vn/may-tinh-xach-tay' && $url !== 'https://fptshop.com.vn/may-tinh-xach-tay') {
                        //if ($url !== 'https://nhattao.com/f/dien-thoai.543/' && $url !== 'https://nhattao.com/f/dien-thoai.543') {
                        //echo "URL: ", $url . '<br/>';//,"CONTENT:",PHP_EOL,$dom->saveHTML(),PHP_EOL,PHP_EOL; // 350 documents, 5 depths
//                        $dataUrl = array(
//                            'url' => $url,
//                            'status' => 0
//                        );
                        //$collection->insert($dataUrl);
                        //}
                    //}
                }
            }
        }

        echo 'Lấy URL thành công. <a href="/icrawler/public/">Quay lại</a>';
        return redirect()->back();
    }

    // GET website
    public function getWebsite() {
        $db = $this->connect();
        $collection = $db->website;
        $website = $collection->find();
        return view('website/website', array('website' => $website));
    }

    // POST website
    public function storeWebsite() {
        $db = $this->connect();

        // select a collection
        $collection = $db->website;

        $web = array(
            'type' => Input::get('type'),
            'language' => Input::get('language'),
            'name' => Input::get('name'),
            'url' => Input::get('url'),
            'database' => Input::get('database'),
            'status' => Input::get('status'),// Thêm trạng thái crawl dữ liệu website
            'created_at' => time()
        );
        $collection->insert($web);

        // Write Logs
        $m = $this->connectOthers();
        $database = Input::get('database');
        $db = $m->user;
        $col = $db->activity_log;
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

    // Edit website status from repository
    public function edit($id) {
        $db = $this->connect();
        $collection = $db->website;
        $web = $collection->findOne(
            array('_id' => new \MongoId($id))
        );
        $website = $collection->find();
        return view('website/website', array('web' => $web, 'website' => $website));
    }

    // Update website status from repository
    public function update($id) {
        $db = $this->connect();
        $collection = $db->website;
        $data = array(
            'type' => Input::get('type'),
            'language' => Input::get('language'),
            'name' => Input::get('name'),
            'url' => Input::get('url'),
            'database' => Input::get('database'),
            'status' => Input::get('status'),// Thêm trạng thái crawl dữ liệu website
            'updated_at' => time()
        );
        $collection->update(array('_id' => new MongoId($id)), array('$set' => $data));
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

    public function getFilterUrl($i) {
        include("../library/MongoPagination/MongoPagination.php");
        $db = $this->connect();
        $pagination = new \MongoPagination($db, $_SERVER['APP_URL'].'/icrawler/public/filter_url');
        $itemsPerPage = 10;
        $currentPage = $i;
        $pagination->setQuery(array(
            '#collection' => 'filter_url'
        ), $currentPage, $itemsPerPage);
        $dataSet = $pagination->Paginate();
        $page_links = $pagination->getPageLinks();
        $mongo = new MongoClient();
        $database = array();
        foreach ($mongo->listDBs()['databases'] as $db) {
            if (strpos($db['name'], 'db_') !== false) {
                $db['name'] = str_replace('db_', '', $db['name']);
                array_push($database, $db['name']);
            }
        }
        return view('url.filter_url', array('database' => $database, 'dataSet' => $dataSet, 'page_links' => $page_links));
    }

    public function postFilterUrl() {
        $website = Input::get('website');
        $database = 'db_'. Input::get('website');
        $filter_url = Input::get('filter_url');
        // insert into filter_url collection, crawler database
        $db = $this->connect();
        $collection = $db->filter_url;
        $collection->insert(array(
            'website' => $website,
            'filter_url' => $filter_url,
            'created_at' => time()
        ));
        // insert into filter_url collection, website database
        $m = $this->connectOthers();
        $db = $m->$database;
        $collection = $db->filter_url;
        $collection->insert(array(
            'filter_url' => $filter_url,
            'created_at' => time()
        ));
        return redirect()->back();
    }

    public function getExtractContent($i) {
        include('../library/MongoPagination/MongoPagination.php');
        $db = $this->connect();
        $pagination = new \MongoPagination($db, '/icrawler/public/extract_content');
        $itemsPerPage = 10;
        $currentpage = $i;
        $pagination->setQuery(
            array(
                '#collection' => 'content_tag'
            ), $currentpage, $itemsPerPage
        );
        $dataSet = $pagination->Paginate();
        $page_links = $pagination->getPageLinks();
        $collection = $db->product_category;
        $product_type = $collection->find();
        return view('extractor.content', array('dataSet' => $dataSet, 'page_links' => $page_links, 'currentpage' => $currentpage, 'product_type' => $product_type));
    }

    public function postExtractContent()
    {
        $db = $this->connect();
        $collection = $db->content_tag;
        $collection->insert(array(
            'website_domain' => Input::get('domain'),
            'intro' => Input::get('intro'),
            'database_name' => Input::get('database_name'),
            'title_tag' => Input::get('title_tag'),
            'content_tag' => Input::get('content_tag'),
            'price_tag' => Input::get('price_tag'),
            'telephone_tag' => Input::get('telephone_tag'),
            'info_tag' => Input::get('info_tag'),
            'contact_tag' => Input::get('contact_tag'),
            'publish_time_tag' => Input::get('publish_time_tag'),
            'website_type' => Input::get('website_type'),
            'product_type' => Input::get('product_type')
        ));
        return redirect()->back();
    }

    // Edit extract content
    public function editExtractContent($i, $id) {
        include('../library/MongoPagination/MongoPagination.php');
        $db = $this->connect();
        $pagination = new \MongoPagination($db, '/icrawler/public/extract_content');
        $itemsPerPage = 10;
        $currentpage = $i;
        $pagination->setQuery(
            array(
                '#collection' => 'content_tag'
            ), $currentpage, $itemsPerPage
        );
        $dataSet = $pagination->Paginate();
        $page_links = $pagination->getPageLinks();
        $collection = $db->product_category;
        $product_type = $collection->find();
        unset($collection);
        $collection = $db->content_tag;
        $content_tag = $collection->findOne(array('_id' => new MongoId($id)));
        return view('extractor.content', array('dataSet' => $dataSet, 'page_links' => $page_links, 'currentpage' => $currentpage, 'product_type' => $product_type, 'content_tag' => $content_tag));
    }

    public function updateExtractContent($id)
    {
        $db = $this->connect();
        $collection = $db->content_tag;
        $data = array(
            'intro' => Input::get('intro'),
            'website_domain' => Input::get('domain'),
            'title_tag' => Input::get('title_tag'),
            'content_tag' => Input::get('content_tag'),
            'price_tag' => Input::get('price_tag'),
            'telephone_tag' => Input::get('telephone_tag'),
            'info_tag' => Input::get('info_tag'),
            'contact_tag' => Input::get('contact_tag'),
            'publish_time_tag' => Input::get('publish_time_tag'),
            'website_type' => Input::get('website_type'),
            'product_type' => Input::get('product_type')
        );
        $collection->update(array('_id' => new MongoId($id)), array('$set' => $data));
//        $obj = $collection->findOne();
//        var_dump($obj);die();
        return redirect()->back();
    }

    // POST website category
    public function storeWebsiteCategory()
    {
        $db = $this->connect();

        // select a collection
        $collection = $db->website_category;

        $web = array(
            'website_type' => Input::get('website_type'),
            'slug' => $this->slugify(Input::get('website_type')),
            'created_at' => time()
        );
        $collection->insert($web);
        return redirect()->back();
    }

    // GET website category
    public function getWebsiteCategory()
    {
        $db = $this->connect();
        $collection = $db->website_category;
        $website_category = $collection->find();
        return view('website/website_category', array('website_category' => $website_category));
    }

    // Make slug from text (input): Version 1.0
    public function slugify($text)
    {
        // Replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // Transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // Remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // Trim
        $text = trim($text, '-');
        // Remove duplicate
        $text = preg_replace('~-+~', '-', $text);
        // Lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    // Lấy danh sách url all site
    public function getListUrlAllSite()
    {
        $m = $this->connect();
        $collect = $m->website;
        $data = $collect->find();
        return view('url/url', array('data' => $data));
    }

    // Lấy danh sách url của từng site
    public function getListUrl($database, $collection, $type, $domain, $page)
    {
        $m = $this->connectOthers();
        $db = $m->$database;
        $collect = $db->$collection;
        $page  = isset($page) ? (int) $page : 1;
        $limit = 20;
        $skip  = ($page - 1) * $limit;
        $next  = ($page + 1);
        $prev  = ($page - 1);
        $data = $collect->find()->skip($skip)->limit($limit);
        $total = $data->count();
        $url = '/icrawler/public/url/' . $database . '/' . $collection. '/' . $type . '/' . $domain;
        return view('url/url', array('database' => $database, 'collection' => $collection, 'type' => $type, 'domain' => $domain, 'data' => $data, 'page' => $page, 'next' => $next, 'prev' => $prev, 'limit' => $limit, 'total' => $total, 'url' => $url));
    }

    // Lọc url theo cơ chế bằng tay tùy theo shop hay forum
    public function filterUrl($database, $collection, $type, $domain)
    {
        // TH là diễn đàn (rao vặt)
        // Lọc các url có từ threads
        $m = $this->connectOthers();
        $db = $m->$database;
        $collect = $db->$collection;
        $document = $collect->find();

        // Cơ chế lọc bằng tay
        $i=0;
        foreach ($document as $doc) {$i++;
            // TH là website diễn đàn
			if ($type == 'forum') {	
				if (strpos($doc['url'], 'threads/') !== false ||
					strpos($doc['url'], 'page-') === false
				) {
					echo $doc['_id'] . ' ' . $doc['url'] . '<br/>';
				} else {
					echo $i.') '.$doc['_id']. '<br/>';
					// Xóa đi URL rác
					/*$collect->remove(array(
						'_id' => new MongoId($doc['_id'])
					));*/
				}
			} elseif ($type == 'shop') {
				if (strpos($doc['url'], '.html') !== false && strpos($doc['url'], '.html?') === false) {
					echo $doc['_id'] . ' ' . $doc['url'] . '<br/>';
				} else {
					echo $i.') '.$doc['_id'] . ' ' . $doc['url'] . '<br/>';
					// Xóa đi URL rác
					$collect->remove(array(
						'_id' => new MongoId($doc['_id'])
					));
				}
			}
        }
        return redirect()->back();
		$text = 'This is some text. This is some text. Vending Machines are great.';
		$words = $this->extractCommonWords($text);
		foreach ($words as $word => $count) {
			print ($word . ' was found ' . $count . ' time(s)<br/>');
		}
        die();
    }
	
	// Keyword extraction
	public function extractCommonWords($string)
	{
		$stopWords = array('i','a','about','an','and','are','as','at','be','by','com','de','en','for','from','how','in','is','it','la','of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www');
		$string = preg_replace('/ss+/i', '', $string);
		$string = trim($string);
		$string = preg_replace('/[^a-zA-Z0-9 -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too...
		$string = strtolower($string); // make it lowercase
		echo $string . '<br/>';
		preg_match_all('/\b.*?\b/i', $string, $matchWords);
		$matchWords = $matchWords[0];
		$totalWords = count($matchWords[0]);
		foreach ($matchWords as $key => $item) {
			if ($item == '' || in_array(strtolower($item), $stopWords) || strlen($item) <= 3) {
				unset($matchWords[$key]);
			}
		}
		$wordCountArr = array();
		if (is_array($matchWords)) {
			foreach ($matchWords as $key => $val) {
				$val = strtolower($val);
				if (isset($wordCountArr[$val])) {
					$wordCountArr[$val] += 1;
				} else {
					$wordCountArr[$val] = 1;
				}
			}
			arsort($wordCountArr);
		}
		return $wordCountArr;
	}
	
}
