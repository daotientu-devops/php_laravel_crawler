<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/**
 * Crawler
 */
Route::get('/', function () {
    return view('welcome');
});
Route::post('/', 'WebsiteController@getCrawlerURL');
//Route::post('/', function () {
//    set_time_limit(900000);
//    $url = \Illuminate\Support\Facades\Input::get('url');
//    $url_path = str_replace(array('-', '/'), '', parse_url($url, PHP_URL_PATH));
//    $url_host = str_replace('.', '', parse_url($url, PHP_URL_HOST));
//
//    class MyCrawler extends PHPCrawler
//    {
//        function handleDocumentInfo(PHPCrawlerDocumentInfo $DocInfo)
//        {
//            $url = \Illuminate\Support\Facades\Input::get('url');
//            if (strpos($DocInfo->url, parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH) . '/') !== false ) {
//                echo "Page requested: " . $DocInfo->url . "<br/>";
//            }
//            flush();
//        }
//    }
//
//    $crawler = new MyCrawler();
//    $crawler->setURL($url);
//    $crawler->addContentTypeReceiveRule("#text/html#");
//    $crawler->addURLFilterRule("#(jpg|gif|png|pdf|jpeg|svg|css|js)$# i");
//
//    $crawler->setTrafficLimit(100000 * 1024);
//    $crawler->go();
//    $report = $crawler->getProcessReport();
//
//    if (PHP_SAPI == "cli")
//        $lb = "\n";
//    else
//        $lb = "<br/>";
//
//    echo "Summary:".$lb;
//    echo "Links followed: ".$report->links_followed.$lb;
//    echo "Documents received: ".$report->files_received.$lb;
//    echo "Bytes received: ".$report->bytes_received." bytes".$lb;
//    echo "Process runtime: ".$report->process_runtime." sec".$lb;

//});
Route::get('/website', function () {
    return view('website/website');
});
Route::get('/website_category', function () {
    return view('website/website_category');
});
Route::post('/website', 'WebsiteController@storeWebsite');
    // function () {
//    $input = new \Illuminate\Support\Facades\Input;
//    /** Create collection follow website */
//    // Connect to mongodb
//    $m = new MongoClient();
//    // select a database
//    // $db = $m->crawler;
//    // create collection
//    // $collection = $db->createCollection($input::get('collection'));
//    $databse = $input::get('collection');
//    $user = array(
//        'first_name' => 'MongoDB',
//        'last_name' => 'Fan',
//        'tags' => array('developer','user')
//    );
//
//    $db = $m->mydb; print_r($db);
//    // Get the users collection
//    $c_users = $db->users;
//
//    // Insert this new document into the users collection
//    $c_users->save($user);
//
//    /** Add user admin to database
//    // open connection
//    $mongo = new Mongo("mongodb://" . MONGO_USER . ":" . MONGO_PASS . "@" . MONGO_HOST, array("persist" => "abcd1234"));
//    $db = $mongo->selectDB("admin");
//
//    // user info to add
//    $username = "testUser";
//    $password = "testPassword";
//
//    // insert the user - note that the password gets hashed as 'username:mongo:password'
//    // set readOnly to true if user should not have insert/delete privs
//    $collection = $db->selectCollection("system.users");
//    $collection->insert(array('user' => $username, 'pwd' => md5($username . ":mongo:" . $password), 'readOnly' => false));
//     */
//});

Route::get('/product_category', function () {
    return view('product/product_category');
});
/**
 * Route: Product
 */
Route::get('/product', 'ProductController@createProduct');
Route::post('/product', 'ProductController@storeProduct');
Route::post('/get_tag_product', 'ProductController@getTagProduct');
// Delete product
Route::get('/product/delete/{id}', 'ProductController@destroy');
/**
 * Data Extractor
 *
 */
/** Tag */
Route::get('/content_tag', 'ContentController@createTag');
//    function () {
//    return view('extractor/tag');
//});
Route::post('/content_tag', 'ContentController@storeTag');

Route::get('/content_extractor', 'ContentController@createExtractor');
Route::post('/content_extractor', function () {
    //return view('extractor/content_extractor');
    include ("../library/SimpleHtmlDOM/simple_html_dom.php");
    $url = 'http://e.vnexpress.net/news/business/data-speaks/samsung-electronics-suspends-galaxy-note-7-production-yonhap-3481193.html';
    echo 'Page requested: ' . $url . '<br/>';
    $html = file_get_html($url);

    if (is_object($html)) {
        $t = $html->find('.main_fck_detail', 0);
        if ($t) {
            $content = $t->innertext;
            echo 'Content: ' . $content . '<br/>';
            echo '<br/>Tách từ tố <br/>';
            $content = strip_tags($content);
            //$content = html_entity_decode($content);
            $content = str_replace("nbsp", '', $content);
            echo $content;
            $result = preg_split('/\s+|\//', strtolower($content));
            echo 'Tổng số từ: ' . count($result) . '<br/>';
            foreach ($result as $re) {
                $re = preg_replace('/[^A-Za-z0-9$.\-]/', '', $re);
                if ($re != '') echo $re . '<br/>';
            }
        }
        $html->clear();
        unset($html);
    }
});
Route::get('/crawler_data', 'CrawlerController@createData');
Route::get('/crawler_data/{database}/{collection}', 'CrawlerController@postData');
/**
 * IRet Crawler Lite
 */
Route::get('/ic_lite', 'CrawlerController@createICLite');
Route::post('/ic_lite', 'CrawlerController@getResult');
Route::get('/result/{url}', 'CrawlerController@getResult');
/**
 * IRet Crawler Advance
 */
Route::get('/ic_lite_advance', 'CrawlerController@createICLiteAdvance');
Route::post('/website/create', 'WebsiteController@store');
Route::get('/website/delete/{id}', 'WebsiteController@destroy');
/**
 * B1
 */
Route::get('/crawl_data', 'CrawlerController@crawlData');
Route::get('/crawl_data/result', 'CrawlerController@crawlDataResult');
/**
 * B2
 */
Route::get('/extract_data', 'CrawlerController@extractData');
Route::get('/extract_data/result', 'CrawlerController@extractDataResult');
/**
 * B3
 */
Route::get('/extract_term', 'CrawlerController@extractTerm');
Route::get('/extract_term/result', 'CrawlerController@extractTermResult');
/**
 * B4
 */
Route::get('/term_standard', 'CrawlerController@termStandard');
Route::get('/term_standard/result', 'CrawlerController@termStandardResult');
/**
 * B5
 */
Route::get('/indexed', 'CrawlerController@indexed');
Route::get('/indexed/result', 'CrawlerController@indexedResult');
/**
 * B6
 */
Route::get('/search', 'CrawlerController@getSearch');
Route::post('/search', 'CrawlerController@postSearch');
Route::get('/data_result/{id}', 'CrawlerController@getDataResult');