<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use \ShopJa\Http\Models\ProductModel;
use File;


use \PhpOffice\PhpSpreadsheet;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ProductController extends \Zoe\Http\ControllerBackend
{

    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "shop-ja:product:category");
        $this->data['configs'] = config_get("config", "shopja");
        $this->data['cate_group'] = config_get("category", "beto_gaizin:category");
        $this->data['configs'] = config_get("config", "system");
        $this->data['current_language'] =
            isset($this->data['configs']['core']['site_language']) ?
                $this->data['configs']['core']['site_language'] :
                config('zoe.default_lang');
    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý sản phẩm"), ('backend:shop_ja:product:list'));
        return $this;
    }
    public function ajax(Request $request){
        $id = $request->all();
        $lists = DB::table('shop_product')->where('category_id',$id['cate'])->get()->all();
        $data = [];
        foreach ( $lists as $row){
            $data[] = ['id'=>$row->id,'title'=>$row->title,'description'=>$row->description];
        }
        return response()->json($data);
    }



    public function list(Request $request)
    {
        $this->getcrumb();

        $filter = $request->query('filter', []);



        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");

        $config = config_get('option', "module:shop_ja:product");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('shop_product');
        if(isset($filter['search'])){
            $search = $filter['search'];
        }else {
            $filter_search = $request->query('filter_search', "");
            if(!empty($filter_search)){
                $search = $filter_search;
            }
        }
        if(isset($filter['code'])){
            $models->where('code', 'like', '%' . $filter['code'].'%');
        }
        if(isset($filter['cate'])){
            $models->where('category_id', '=',$filter['cate'] );
        }
        if (!empty($search)) {
            $models->where('title', 'like', '%' . $search.'%');
        }
        if(isset($filter['des'])){
            $models->where('description', 'like', '%' . $filter['des'].'%');
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('order_index', 'desc');

        return $this->render('product.list', [
            'models' => $models->paginate($item),
            'callback' => [
                "GetHtmlConfigShip" => function ($model){
                    $html = "<a href='".route('backend:shop_ja:japan:category:show',['product_id' => $model->id])."'><button type=\"button\" class=\"btn btn-primary btn-xs\">Click</button></a>";
                    return $html;
                },
                "GetButtonEdit"=>function($model){
                    return  $html = "<a href='".route('backend:shop_ja:product:edit',['id' => $model->id])."'><button type=\"button\" class=\"btn btn-primary btn-xs\">".z_language('Sửa')."</button></a>";
                }
            ]
        ]);
    }
    public function create()
    {
        $this->getCrumb()->breadcrumb(z_language("Tạo mới"), route('backend:shop_ja:product:create'));
        $model = new ProductModel();
        return $this->render('product.create', ["tag_all"=>$model->allTag(),'item' => []], 'blog');
    }

    public function edit($id)
    {
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $model = ProductModel::find($id);
        $model->offsetSet("tag", implode( ',',$model->getTag()));
        if (isset($this->data['configs']['core']['language']['multiple'])) {
            $trans = $model->table_translation_model()->where(['_id' => $id])->get();
            $table = $model->table_translation_columns();

            foreach ($trans as $tran) {
                foreach ($table as $val){

                    $model->offsetSet($val."_" . $tran->lang_code, $tran->{$val});
                }
            }
        }
        return $this->render('product.edit', ["tag_all"=>$model->allTag(),"model" => $model]);
    }

    public function delete($id)
    {
        $model = ProductModel::find($id);
        if($model){
            $model->delete();
        }
        return redirect()->route('backend:shop_ja:product:list', []);
    }

    public function status()
    {

    }

    public function store(Request $request){

        $data = $request->all();

        $filter = [
        ];
        $langs_key = isset($data['_keys'])?json_decode(base64_decode($data['_keys']),true):[];

        foreach ($langs_key as $key=>$_filter){
            if(is_numeric($key)){
                $filter[$_filter] = "required";
            }else{
                $filter[$key] ="required";
            }
        }
        $newFilter = [];
        foreach ($this->data['language'] as $lang => $_language) {
            if(
                isset($this->data['configs']['core']['language']['lists']) &&
                (is_string($this->data['configs']['core']['language']['lists']) &&
                    $this->data['configs']['core']['language']['lists'] == $_language['lang']||
                    is_array($this->data['configs']['core']['language']['lists']) &&  in_array($_language['lang'],$this->data['configs']['core']['language']['lists'])) ){
                foreach ($filter as $col=>$value){
                    if(isset($langs_key[$col]['default'])){
                        if($lang == $langs_key[$col]['default']){
                            $newFilter[$col.'_'.$lang] = $value;
                        }
                    }else{

                        $newFilter[$col.'_'.$lang] = $value;
                    }
                }
            }

        }
        $newFilter = array_merge( [
//            'body' => 'required',
            'group_id' => 'required',
            'title' => 'required',
//            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|integer',
            'price_buy' => 'required|integer',
        ],$newFilter);
        $validator = Validator::make($data, $newFilter, [

            'title.required' => z_language('Tên khi xuất file không được phép bỏ trống.'),
            'name.required' => z_language('Tên hiển thị trên Website không được phép bỏ trống.'),
            'group_id.required' => z_language('Chuyên mục không được phép bỏ trống.'),
            'body.required' => z_language('Nội dung được phép bỏ trống.'),
            'category_id.required' => z_language('Chuyên mục không được phép bỏ trống.'),
            'price.required' => z_language('Giá nhập không được bỏ trống.'),
            'price.integer' => z_language('Giá nhập phải là giá trị số.'),
            'price_buy.required' => z_language('Giá bán không được bỏ trống.'),
            'price_buy.integer' => z_language('Giá bán phải là giá trị số.'),
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $type = 'create';
        if (isset($data['id']) && !empty($data['id'])) {
            $model = ProductModel::find($data['id']);
            $type = 'edit';
        } else {
            $model = new ProductModel();
        }
        $imageUp  = $data['image'];
        if($request->hasfile('image_up'))
        {
            $files = $request->file('image_up');

            $allowedfileExtension=['jpg','png','gif','jpeg'];

            $exe_flg = true;
            foreach([$files] as $file) {
                $extension = $file->getClientOriginalExtension();
                $check= in_array($extension,$allowedfileExtension);
                if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                    $exe_flg = false;
                    break;
                }
            }

            $fileSys = new \Illuminate\Filesystem\Filesystem();
            if(!$fileSys->isDirectory(public_path().'/uploads/thumbs')){

                $fileSys->makeDirectory(public_path().'/uploads/thumbs', 0777, true, true);

            }
            if($exe_flg) {
                $name =rand(100000,900000).'-'.rand(100000,900000).'-'.Str::slug($files->getClientOriginalName(), '-');
                $files->move(public_path().'/uploads/thumbs/', $name);
                $imageUp= '/uploads/thumbs/'.$name;
            }

        }
        try {
            $model->title = $data['title'];
            $model->slug = Str::slug(isset($data['name_' . config('zoe.default_lang')])?$data['name_' . config('zoe.default_lang')]:"", '-');

            $model->description = $data['description'];

            $model->group_id = $data['group_id'];
            $model->category_id = $data['category_id'];
            $model->image =  $imageUp;
            $model->price = $data['price'];
            $model->price_buy_km = isset($data['price_buy_km'])?$data['price_buy_km']:0;
            $model->code = $data['code'];
            $model->unit = $data['unit'];
            $model->status = $data['status'];
            $model->count = isset($data['count'])?$data['count']:1;
            $model->value = $data['value'];
            $model->price_buy = $data['price_buy'];
            $model->type_excel = $data['type_excel'];
            $model->order_index = isset($data['order_index'])?$data['order_index']:0;

            $this->log('shop_js:product',$type,['id'=>$model->id]);



            $model->save();

            foreach ($this->data['language'] as $lang => $_language) {
                $data_save = [];
                $langs_key['slug'] = ['default'=>'vi','slug'=>'name'];
                foreach ($langs_key as $k=>$val){
                    $conf = [];
                    if(is_numeric($k)){
                        $col = $val;
                        $data_save[$col] = isset($data[$col.'_' . $lang])?$data[$col.'_' . $lang]:"";
                    }else{
                        $col = $k;
                        if(isset($val['slug'])){
                            $data_save[$col] = isset($data[$val['slug'].'_vi'])?Str::slug($data[$val['slug'].'_vi'], '-','ja'):"";
                        }else{
                            $data_save[$col] = isset($data[$col.'_' . $lang])?$data[$col.'_' . $lang]:"";
                        }
                        $conf = $val;
                    }
                    if(empty($data_save[$col]) && isset($conf['default'])){
                        $data_save[$col] = isset($data[$col.'_' . $conf['default']])?$data[$col.'_' . $conf['default']]:"";
                    }
                }

                $model->table_translation_model("_")->updateOrInsert(
                    [
                        '_id' => $model->id,
                        'lang_code' => $lang
                    ],
                    $data_save
                );

            }

            \Actions::do_action("tag_add", "shopja:product", $model->id, $data['tag'], $model->getTag());


            $request->session()->flash('success',z_language('Cập nhật thông tin thành công'));
            return redirect(route('backend:shop_ja:product:edit', ['id' => $model->id]));
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('id', $ex->getMessage());

        }


        return back();



    }
    public function export(Request $request){




        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->createSheet();
        $sheet1 = $spreadsheet->getSheet(1);
        $sheet1->setTitle('Sheet2');

        $sheet->setTitle("Sheet1");
        $spreadsheet->getProperties()
            ->setTitle('PHP Download Example')
            ->setSubject('A PHPExcel example')
            ->setDescription('A simple example for PhpSpreadsheet. This class replaces the PHPExcel class')
            ->setCreator('php-download.com')
            ->setLastModifiedBy('php-download.com');


        $titles = [
            'id',
            'title',
            'description',
            'availability',
            'condition',
            'price',
            'link',
            'image_link',
            'brand',
            'google_product_category',
            'fb_product_category',
            'quantity_to_sell_on_facebook',
            'sale_price',
            'sale_price_effective_date',
            'item_group_id',
            'gender',
            'color',
            'size',
            'age_group',
            'material',
            'pattern',
            'shipping',
            'shipping_weight',
            'style[0]',
        ];
        $index = 1;

        foreach ($titles as $num=>$title) {

            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($num+1);
            $sheet->setCellValue($nameCol.$index,$title);

        }

        $cates = $request->cates;
        \DB::enableQueryLog();
       // $shop_product = DB::table('shop_product')->whereIn('category_id',$cates)->join('')->get()->all();
        $shop_product = DB::table('shop_product as p')->where('p.status',1)
            ->join('shop_product_translation as t','t._id','=','p.id')
            ->select('p.id','p.image','p.price_buy','p.price','p.category_id','t.name','t.slug as slug','t.content','p.price_buy_km')
            ->whereIn('p.category_id',$cates)
            ->where('lang_code','vi')->get()->all();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml.= '<feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0">';
        $xml.='<title>Betogaizin</title>';
        $xml.='<link href="https://muahang.tokyo" rel="self"/>';



        foreach ($shop_product as $k=>$v){
            $array = array_merge([$v->image],\PluginGallery\Views\GalleryComposer::get($v->id,"shop_ja::form.product"));
            $xml.='<entry>';
                $xml.='<g:id>'.$v->id.'</g:id>';
                $xml.='<g:title>'.$v->name.'</g:title>';
                $xml.='<g:description>'.$v->content.'</g:description>';
                $xml.='<g:link>'.router_frontend_lang('home:item-product',['id'=>$v->id,'slug'=>$v->slug]).'</g:link>';
                $xml.='<g:image_link>'.$v->image.'</g:image_link>';
                $xml.='<g:brand>betogaizin</g:brand>';
                $xml.='<g:condition>New</g:condition>';
                $xml.='<g:availability>in stock</g:availability>';
                $xml.='<g:price>'.$v->price_buy.'</g:price>';
            $xml.='</entry>';
            $indexName = 1;
            $index++;
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,$v->id);
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,$v->name);
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,strip_tags(html_entity_decode ($v->content)));
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,'in stock');
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,'New');
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,$v->price_buy_km > 0?$v->price_buy_km:$v->price_buy);
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,router_frontend_lang('home:item-product',['id'=>$v->id,'slug'=>$v->slug]));
            foreach($array as $_k=>$_v ){
                $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,$_v);
            }


            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,'Betogaizin');
            $indexName+=3;
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,$v->price_buy);
            $sheet->setCellValue(PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexName++).''.$index,$v->price);


        }
        $xml.='</feed>';
        File::put(public_path('uploads/xml/FB_export_product_xml_for_facebook.xml'),$xml);

        $pathZip = '/uploads/xml';
        $filename = 'FB_export_product_xml_for_facebook';
        $writer = new Xlsx($spreadsheet);
        $path2 = $pathZip . '/' . $filename . '.xlsx';
        $writer->save(public_path() . $path2);
        $file = new \Illuminate\Filesystem\Filesystem();

        $zipFileName =  'FB_export_product_xml_for_facebook.zip';
        $zip = new \ZipArchive();
        if ($file->exists(public_path() . '/uploads/xml/' . $zipFileName)) {
            $file->delete(public_path() . '/uploads/xml/' . $zipFileName);
        }
        if ($zip->open(public_path() . '/uploads/xml/' . $zipFileName, \ZipArchive::CREATE) === TRUE) {
            $zip->addFile( public_path('uploads/xml/FB_export_product_xml_for_facebook.xml'),'FB_export_product_xml_for_facebook.xml');
            $zip->addFile( public_path($path2),'FB_export_product_xml_for_facebook.xlsx');
            $zip->close();
        }
        return response()->json(['url'=>'uploads/xml/FB_export_product_xml_for_facebook.zip']);
    }
}
