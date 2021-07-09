<?php
/**
 * Created by PhpStorm.
 * User: daotientu
 * Date: 10/30/2016
 * Time: 4:47 PM
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use MongoClient;
use DOMDocument;

class CrawlerController extends Controller
{
    public function createData()
    {   $mongo = new MongoClient();
        $database = array();
        foreach ($mongo->listDBs()['databases'] as $db) {
            if (strpos($db['name'], 'db_') !== false) {
                array_push($database, $db['name']);
            }
        }
        return view('crawler/data', array('database' => $database));
    }

    public function postData($database, $collection)
    {
        include("../library/SimpleHtmlDOM/simple_html_dom.php");

        $m = $this->connectOthers();
        $db = $m->$database;
        $collection = $db->$collection;
        $col = $collection->find(array('status' => 0));

        foreach ($col as $c) {
            $url = $c['url'];
            $html = file_get_html($c['url']);
            if (is_object($html)) {
//                $t = $html->find('.detail-name', 0);
//                $title = isset($t) ? $t->innertext : '';
//
//                $p = $html->find('.detail-current-price', 0);
//                $price = isset($p) ? $p->attr['data-price'] : '';
//
//                $c = $html->find('.detail-col-left53', 0);
//                $content = isset($c) ? $c->innertext : '';

                /**
                 * Nhật tảo.com
                 */
//                $t = $html->find('div.titleBar h1', 0);
//                $title = isset($t) ? $t->innertext : '';
//
//                $p = $html->find('#pageDescription .DateTime', 0);
//                $published_at = isset($p) ? $p->plaintext : '';
//
//                try {
//                    $c = $html->find('#messageList .messageContent', 0);
//                    $content = isset($c) ? $c->innertext : '';
//                } catch (\Exception $e) {
//                    $content = '';
//                }

                /**
                 * Rao vặt.com
                 */
//                $t = $html->find('.tinrao_list_chitiet_title', 0);
//                $title = isset($t) ? $t->innertext : '';
//
//                try {
//                    $c = $html->find('#tinrao_chitiet_tinrao', 0);
//                    $content = isset($c) ? $c->innertext : '';
//                } catch (\Exception $e) {
//                    $content = '';
//                }

                /**
                 * Mua bán.net
                 */
                // Title
//                $t = $html->find('.cl-title h1', 0);
//                $title = isset($t) ? $t->innertext : '';
//                // Content
//                try {
//                    $c = $html->find('.ct-body', 0);
//                    $content = isset($c) ? $c->innertext : '';
//                } catch (\Exception $e) {
//                    $content = '';
//                }
//                // Price
//                try {
//                    $p = $html->find('.price-value', 0);
//                    $price = isset($p) ? $p->innertext : '';
//                } catch (\Exception $e) {
//                    $price = '';
//                }
//                // Telephone
//                try {
//                    $m = $html->find('.contact-mobile span', 0);
//                    $telephone = isset($m) ? $m->innertext : '';
//                } catch (\Exception $e) {
//                    $telephone = '';
//                }

                /**
                 * Rao vặt.net
                 */
//                // Title
//                $t = $html->find('h4.site-title', 0);
//                $title = isset($t) ? $t->innertext : '';
//                // Content
//                try {
//                    $c = $html->find('.page-content', 0);
//                    $content = isset($c) ? $c->innertext : '';
//                } catch (\Exception $e) {
//                    $content = '';
//                }

                // Rồng bay.com
                // Title
                $t = $html->find('h1.detail_title ', 0);
                $title = isset($t) ? $t->innertext : '';
                // Content
                try {
                    $c = $html->find('.content_input_editior', 0);
                    $content = isset($c) ? $c->innertext : '';
                } catch (\Exception $e) {
                    $content = '';
                }
                // Telephone
                try {
                    $m = $html->find('.user_phone p', 0);
                    $telephone = isset($m) ? $m->innertext : '';
                } catch (\Exception $e) {
                    $telephone = '';
                }

                $data = array(
                    'url' => $url,
                    'title' => $title,
                    //'published_at' => $published_at,
                    'content' => $content,
                    //'price' => $price,
                    'telephone' => $telephone,
                    'status' => 1,
                );
                $collection->update(array('status' => 0), $data);
                $html->clear();
                unset($html);
            }
        } die();
        return redirect()->back();
    }

    /**
     * IC Lite
     */
    public function createICLite()
    {
        $db = $this->connect();
        $collection = $db->website;
        $website = $collection->find();
        return view('crawler/ic_lite', array('website' => $website));
    }

    public function storeICLite()
    {
        $url_crawler = Input::get('url_crawler');
        return redirect()->to('/result/' . $url_crawler);
    }

    public function getResult()
    {
        $website_id = Input::get('website_id');
        $url_crawler = Input::get('url_crawler');
        $db = $this->connect();
        $t = $db->html_tag;
        $dt = $t->find(array('website_id' => $website_id));
        foreach ($dt as $d) {
            $content_tag = $d['content_tag'];
        }
        include("../library/SimpleHtmlDOM/simple_html_dom.php");
        $html = file_get_html($url_crawler);

        if (is_object($html)) {
            $c = $html->find("$content_tag", 0);
            if ($c) {
                $content = $c->innertext;
                $str_content = strip_tags($content);
            }
            $html->clear();
            unset($html);
        }
        return view('crawler/result', array(
            'url_crawler' => $url_crawler,
            'content' => $content,
            'str_content' => $str_content
        ));
    }

    public function createICLiteAdvance()
    {
        $db = $this->connect();
        $collection = $db->website;
        $website = $collection->find();
        return view('crawler/ic_lite_advance', array('website' => $website));
    }

    public function crawl_page($url, $depth = 2)
    {
        $db = $this->connect();
        $collection = $db->website_data;
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
            $this->crawl_page($href, $depth - 1);
        }
        $dataUrl = array(
            'url' => $url,
            'created_at' => time(),
            'status' => 0
        );
        $collection->insert($dataUrl);
    }

    public function crawlData()
    {
        $db = $this->connect();
        $collection = $db->website;
        $website = $collection->find();
        include("../library/SimpleHtmlDOM/simple_html_dom.php");
        $col = $db->website_data;
        $col->remove(array());
        set_time_limit(600000);
        foreach ($website as $web) {
            $this->crawl_page($web['url']);
        }
        return redirect()->back();
    }

    public function extractData()
    {
        // include("../library/Readability/Readability.inc.php");

        $db = $this->connect();
        $collection = $db->website_data;
        $col = $collection->find(array('status' => 0));
        $i = 1;
        foreach ($col as $c) {
            $request_url = $c['url'];

            if (!preg_match('/^http:\/\//i', $request_url) ||
                !filter_var($request_url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)
            ) {
                // exit;
            }

            $handle = curl_init();
            curl_setopt_array($handle, array(
                // CURLOPT_USERAGENT => USER_AGENT,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPGET => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_URL => $request_url
            ));

            $source = curl_exec($handle);
            curl_close($handle);

            preg_match("/charset=([\w|\-]+);?/", $source, $match);
            $charset = isset($match[1]) ? $match[1] : 'utf-8';

            $Readability = new \Readability($source, $charset);
            if ($Readability->getContent()) {
                $Data = $Readability->getContent();

                // header("Content-type: text/html;charset=utf-8");
                $title = $Data['title'];
                $content = $Data['content'];
                $str_content = strip_tags($title);
                $data = array(
                    'id' => $i,
                    'title' => $title,
                    'content' => $content,
                    'str_content' => $str_content,
                    'updated_at' => time(),
                    'status' => 1,
                );
                $collection->update(array('_id' => $c['_id'], 'status' => 0), array('$set' => $data));
                // sleep(2);
                $i++;
            }
        }
        return redirect()->back();
    }

    public function extractTerm()
    {
        $db = $this->connect();
        $collection = $db->website_data;
        $col = $collection->find(array('status' => 1));
        foreach ($col as $c) {
            // $nbsp_content = str_replace(" ", '', $c['str_content']);
            $nbsp_content = str_replace("nbsp", '', $c['str_content']);
            $nbsp_content = str_replace("\t", '', $nbsp_content);
            $nbsp_content = str_replace("\r", '', $nbsp_content);
            $nbsp_content = str_replace("\n", '', $nbsp_content);
            $result = preg_split('/\s+|\//', $nbsp_content);
            $term = '';
            foreach ($result as $re) {
                $re = preg_replace('/[^A-Za-z0-9$.\-,]/', '', $re);
                if ($re != '') {
                    $term .= $re . ' ';
                }
            }
            $collection->update(array('_id' => $c['_id']), array('$set' => array('term' => $term)));
        }
        return redirect()->back();
    }

    public function termStandard()
    {
        $db = $this->connect();
        $collection = $db->website_data;
        $col = $collection->find(array('status' => 1));
        foreach ($col as $c) {
            $str = '';
            $term = $c['term'];
            $str .= strtolower($term);
            $collection->update(array('_id' => $c['_id']), array('$set' => array('term' => $str)));
        }
        return redirect()->back();
    }

    public function indexed()
    {
        $db = $this->connect();

        $indexed = $db->index;
        $index = $indexed->remove(array());

        $collection = $db->website_data;
        $col = $collection->find(array('status' => 1));
        // $file_path = $_SERVER['DOCUMENT_ROOT'] . '/icrawler/public/files/';
        foreach ($col as $c) {
            $doc_id = $c['id'];
            $str_content = explode(' ', $c['str_content']);

            //$d = array();
            foreach ($str_content as $term_id) {
                if ($term_id != '') {

//                    $cont = $doc_id . "\t";
//                    $word = preg_replace('/[^A-Za-z0-9$.\-,]/', '', $word);
//                    $file = $file_path . strtolower($word) . '.txt'; //strtolower($word[0]) . '/' .
//                    $fp = fopen($file, 'w') or die('Cannot open file:  ' . $file);
//                    if ($fp) {
//                        fwrite($fp, $cont);
//                    }

                    //array_push($d, $doc_id);
                    $ind = $indexed->find(array('term_id' => $term_id));
                    $in = $indexed->findOne(array('term_id' => $term_id));

                    if (!empty($in)) { //print_r($in['doc_id']); die();
                        $data = array(
                            'doc_id' => $in['doc_id'] . ' ' . $doc_id
                        );
                        $indexed->update(array('term_id' => $term_id), array('$set' => $data));
                    } else {
                        $data = array(
                            'term_id' => $term_id,
                            'doc_id' => strval($doc_id)
                        );
                        $indexed->insert($data);
                    }
                }
            }
        }
        //return redirect()->back();
    }

    /**
     * Hiển thị kết quả
     */

    public function crawlDataResult()
    {
        $db = $this->connect();
        $collection = $db->website_data;
        $website_data = $collection->find(array());
        return view('result/crawl_data', array('website_data' => $website_data));
    }

    public function extractDataResult()
    {
        $db = $this->connect();
        $collection = $db->website_data;
        $website_data = $collection->find(array('status' => 1));
        return view('result/extract_data', array('website_data' => $website_data));
    }

    public function extractTermResult()
    {
        $db = $this->connect();
        $collection = $db->website_data;
        $website_data = $collection->find(array('status' => 1));
        return view('result/extract_term', array('website_data' => $website_data));
    }

    public function termStandardResult()
    {
        $db = $this->connect();
        $collection = $db->website_data;
        $website_data = $collection->find(array('status' => 1));
        return view('result/term_standard', array('website_data' => $website_data));
    }

    public function indexedResult()
    {
        $db = $this->connect();
        $collection = $db->index;
        $indexed = $collection->find();
        return view('result/indexed', array('indexed' => $indexed));
    }

    public function getSearch()
    {
        return view('result/search');
    }

    public function postSearch()
    {
        $db = $this->connect();
        $collection = $db->index;
        $keyword = Input::get('keyword');
        $str_keyword = explode(' ', $keyword);

        $s = '';
        foreach ($str_keyword as $k) {
            $couple = $collection->find(array('term_id' => $k));
            foreach ($couple as $c) {
                $s .= $c['doc_id'] . ' ';
            }
        }
        // echo gettype($s);
        $cp = array();
        $sk = explode(' ', $s);
        foreach ($sk as $k) {
            if ($k != '') {
                $k = (int)$k;
                array_push($cp, $k);
            }
        }
        print_r($cp);
        //$cp = array('17', '26', '28', '18', '34', '40');
        $col = $db->website_data;
        $data = $col->find(array('id' => array('$in' => $cp)));
        foreach ($data as $d) {
            echo '<p><strong>URL:</strong> <a href="' . $d['url'] . '" target="_blank">' . $d['url'] . '</a></p>';
            echo '<p><strong>Title: </strong>' . $d['title'] . '</p>';
            echo '<p><strong>Created at: </strong>' . date('d/m/Y H:i', $d['created_at']) . '</p><hr/>';
        }
        //return view('result/search', array('data' => $data));
    }

    public function getDataResult($id)
    {
        $db = $this->connect();
        $collection = $db->website_data;
        $website_data = $collection->find(array('_id' => new \MongoId($id)));
        return view('result/result', array('website_data' => $website_data));
    }
}
