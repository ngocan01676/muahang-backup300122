<?php
namespace BetoGaizinTheme\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Mail;
use BetoGaizinTheme\Mail\MyEmail;
class HomeController extends \Zoe\Http\ControllerFront
{
    public $config_language = [];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->config_language = app()->config_language;
    }

    public function getHome()
    {

    }
    public function getCategoryGroupProduct($slug,$id){
        $total_records = DB::table('shop_product')->where('group_id',$id)->count();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $results = DB::table('shop_product')->where('status',1)->where('group_id',$id)->offset($start)->limit($limit)->get()->all();
        $cate = [];
        $config_language = app()->config_language;
        $name = "";
        if(isset($config_language['lang'])){

            $cate =(array) DB::table('categories_translation')
                ->select(['slug','name'])
                ->where('lang_code',$config_language['lang'])
                ->where('_id',$id)
                ->get()->first();
            $cate['id'] = $id;
            $name = $cate['name'];
            unset($cate['name']);
        }

        return $this->render('home.category-product', [
            'results'=>$results,
            'current_page'=>$current_page,
            'total_page'=>$total_page,
            'cate'=>[
                'router'=>$cate,
                'name'=>$name
            ]
        ]);
    }
    public function getCategoryProduct($slug,$id){
        $total_records = DB::table('shop_product')->where('status',1)->where('category_id',$id)->count();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $results = DB::table('shop_product')->where('status',1)->where('category_id',$id)->offset($start)->limit($limit)->get()->all();

        return $this->render('home.category-product', [
            'results'=>$results,
            'current_page'=>$current_page,
            'total_page'=>$total_page,
            'cate'=>(array)DB::table('categories')->select(['id','slug'])->where('id',$id)->get()->first()
        ]);
    }
    public function getSearchProduct(Request $request){
        $kw = $request->keyword;
        $model = DB::table('shop_product')->where('status',1)->where('title', 'like', '%'.$kw.'%');
        $total_records = $model->count();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $results = $model->offset($start)->limit($limit)->get()->all();

        return $this->render('home.search-product', [
            'results'=>$results,
            'current_page'=>$current_page,
            'total_page'=>$total_page,
            'keyword'=>$kw
        ]);
    }
    public function getItemProduct($slug,$id){
        $result = DB::table('shop_product')->where('status',1)->where('id',$id)->get()->all();
        $item = isset($result[0])?$result[0]:null;

        $config_language = app()->config_language;

        //$db = DB::table('blog_post_translation')->where('slug',$slug)->where('lang_code',$config_language['lang'])->get()->all();


        $array = array_merge([$item->image],\PluginGallery\Views\GalleryComposer::get($id,"shop_ja::form.product"));
        return $this->render('home.item-product', [
            'item'=>$item,
            'categorys'=>$item != null ?DB::table('shop_product')->where('category_id',$item->category_id)->orderByRaw('RAND()')->limit(10)->get()->all():[],
            'gallerys'=>$array
        ]);
    }
    public function getCart(Request $request){


        $carts = $request->session()->get(WidgetController::$keyCart,[]);
        $ids = array_keys($carts);
        $_products = DB::table('shop_product')->whereIn('id',$ids)->get()->keyBy('id')->all();
        $configs = new \BetoGaizinTheme\Lib\Price();
        foreach ($_products as $key=>$product){
            $_products[$key]->count = $carts[$product->id]['count'];
            $_products[$key]->price_total = $_products[$key]->count * $product->price_buy;
            $_products[$key]->order_index = $carts[$product->id]['time'];
        }
        usort($_products, function($a,$b){
            return $a->order_index - $b->order_index;
        });

        if(auth('frontend')
            ->user() == null){
            return redirect(route('login'));
        }
        $address = DB::table('shop_adresss')
            ->where('user_id',auth('frontend')
                ->user()->id)->where('active',1)
            ->orderBy('active','desc')->get()->all();
        return $this->render('home.step.step1', [
            'counts'=>count($ids),
            'products'=>$_products,
            'prices'=> $configs->prices($carts),
            'address'=> $address
        ]);
    }
    public function getchangeInfoaddress(){
        $lists = DB::table('shop_adresss')->where('user_id',auth('frontend')->user()->id)->orderBy('active','desc')->get()->all();
        return $this->render(
            'home.address.lists',[
                'lists'=>$lists
            ]
        );
    }
    public function getchangeEditaddress(Request $request){
        $id = $request->id;

        $model = \BetoGaizinTheme\Http\Model\AddressModel::find($id);

        return $this->render('home.address.edit',[
            'model'=>$model
        ]);
    }
    public function getchangeCreateaddress(Request $request){
        return $this->render('home.address.edit');
    }
    public function get_order_oke(){

    }
}