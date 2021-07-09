<?php
/**
 * Created by PhpStorm.
 * User: daotientu
 * Date: 11/3/2016
 * Time: 11:11 PM
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use MongoId;

class ProductController extends Controller
{
    public function createProduct()
    {
        $db = $this->connect();
        $collection = $db->product;
        $data = $collection->find();
        $collection = $db->website;
        $website = $collection->find()->sort(array('created_at' => -1));
        return view('product/product', array('data' => $data, 'website' => $website));
    }

    public function storeProduct()
    {
        $db = $this->connect();
        $collection = $db->product;

        $attr = Input::get('attr');
        $val = Input::get('val');
        $a = array();
        foreach ($attr as $key => $n) {
            $a[$attr[$key]] = $val[$key];
        }

        $dataProduct = array(
            'cate_id' => Input::get('cate_id'),
            'store' => Input::get('store'),
            'product_name' => Input::get('product_name'),
            'product_slug' => Input::get('product_slug'),
            'version' => Input::get('version'),
            'color' => Input::get('color'),
            /**
             * Mobile
             */
            'os' => Input::get('os'),
            'memory' => Input::get('memory'),
            'battery_capacity' => Input::get('battery_capacity'),
            /**
             * PC, Laptop, Tablet
             */
            'cpu_technology' => Input::get('cpu_technology'),
            'ram' => Input::get('ram'),
            'disk_type' => Input::get('disk_type'),
            'disk_capacity' => Input::get('disk_capacity'),
            /**
             * Other
             */
            'created_at' => time()
        );
        $dataProduct = array_merge($dataProduct, $a);
        $collection->insert($dataProduct);
        return redirect()->back();
    }

    public function getTagProduct()
    {
        include("../library/SimpleHtmlDOM/simple_html_dom.php");
        $db = $this->connect();
        $collection = $db->product;
        $product_url = Input::get('product_url');
        $html = file_get_html($product_url);
        if (is_object($html)) {

            $ts = $html->find('a.tagCloudTag');
            //foreach ($ts as $ti) {
            //$t = $ti->children();
            foreach ($ts as $s) {
                $tag_name = isset($s) ? $s->plaintext : '';
                $tag_slug = isset($s) ? $s->attr['href'] : '';
                $tag_slug = str_replace(array('t/', '/'), '', $tag_slug);
                $data = array(
                    'website_id' => Input::get('website_id'),
                    'product_name' => $tag_name,
                    'product_slug' => $tag_slug,
                    'created_at' => time(),
                );
                $collection->insert($data);
            }
            //}
        }
        $html->clear();
        unset($html);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $db = $this->connect();
        $collection = $db->product;
        $collection->remove(array(
            '_id' => new MongoId($id)
        ));
        return redirect()->back();
    }
}