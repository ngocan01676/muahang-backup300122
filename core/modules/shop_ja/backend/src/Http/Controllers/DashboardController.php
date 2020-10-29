<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \PhpOffice\PhpSpreadsheet;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class DashboardController extends \Admin\Http\Controllers\DashboardController
{

    public function list(Request $request)
    {
        $this->breadcrumb(z_language("QL CTV"), route('backend:dashboard:list'));
        $this->breadcrumb(z_language("Thông tin"), "");
        $date_start = $request->get('date_start','');
        $date_end = $request->get('date_end','');
        $categorys = config_get("category", "shop-ja:product:category");
        $this->data['analytics']['category'] = [];
        $user_id = null;
        if(!is_null($request->id)){
            $user_id = base64_decode($request->id);
        }else if(!Auth::user()->IsAcl("dashboard:all")){
            $user_id = Auth::user()->id;
        }
        foreach($categorys as $category){

            $query = DB::table('shop_order_excel')
                ->where('fullname','!=','')
                ->where('company',$category['name']);
            if(!is_null($user_id)){
                $query->where('admin_id',$user_id);
            }
            if(!empty($date_start) && !empty($date_end)){
                $query->where('order_create_date','>=',$date_start." 00:00:00");
                $query->where('order_create_date','<=',$date_end." 23:59:59");
            }

            $this->data['analytics']['category'][$category['name']] = [];

            $this->data['analytics']['category'][$category['name']]['count'] = $query->count();

            if($category['name'] == "KOGYJA"){
                $price = DB::table('shop_order_excel')
                    ->where('fullname','!=','')
                    ->where('company',$category['name'])
                    ->where('type','Footer')
                    ->where('public','1')
                    ->where('success','1')
                    ->where('order_create_date','>=',$date_start." 00:00:00")
                    ->where('order_create_date','<=',$date_end." 23:59:59");
                if(!is_null($user_id)){
                    $price->where('admin_id',$user_id);
                }
            }else{
                $price = DB::table('shop_order_excel')
                    ->where('fullname','!=','')
                    ->where('company',$category['name'])
                    ->where('public','1')
                    ->where('success','1')
                    ->where('order_create_date','>=',$date_start." 00:00:00")
                    ->where('order_create_date','<=',$date_end." 23:59:59");
                if(!is_null($user_id)){
                    $price->where('admin_id',$user_id);
                }
            }
            $this->data['analytics']['category'][$category['name']]['price'] =  $price->sum('order_price');
        }

        $this->data['analytics']['total'] = DB::table('shop_order_excel')
            ->where('fullname','!=','');

        if(!is_null($user_id)){
            $this->data['analytics']['total']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)){
            $this->data['analytics']['total']->where('order_create_date','>=',$date_start." 00:00:00");
            $this->data['analytics']['total']->where('order_create_date','<=',$date_end." 23:59:59");
        }
        $this->data['analytics']['total'] = $this->data['analytics']['total']->count();

        $this->data['analytics']['success'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')->where('status',1);
        if(!is_null($user_id)){
            $this->data['analytics']['success']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)) {

            $this->data['analytics']['success']->where('order_create_date', '>=', $date_start . " 00:00:00");
            $this->data['analytics']['success']->where('order_create_date', '<=', $date_end . " 23:59:59");
        }
        $this->data['analytics']['success'] =  $this->data['analytics']['success']->where('status',1)->count();

        $this->data['analytics']['padding'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
           ;
        if(!is_null($user_id)){
            $this->data['analytics']['padding']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)) {

            $this->data['analytics']['padding']->where('order_create_date', '>=', $date_start . " 00:00:00");
            $this->data['analytics']['padding']->where('order_create_date', '<=', $date_end . " 23:59:59");
        }
        $this->data['analytics']['padding'] = $this->data['analytics']['padding']->where('status',2)->count();
        $this->data['analytics']['cancel'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
            ;
        if(!is_null($user_id)){
            $this->data['analytics']['cancel']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)) {
            $this->data['analytics']['cancel']->where('order_create_date', '>=', $date_start . " 00:00:00");
            $this->data['analytics']['cancel']->where('order_create_date', '<=', $date_end . " 23:59:59");
        }
        $this->data['analytics']['cancel'] = $this->data['analytics']['cancel']->where('status',2)->count();

        $this->data['analytics']['today'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
            ->where('updated_at','>=',$date_start." 00:00:00")
            ->where('updated_at','<=',$date_end." 23:59:59");
        if(!is_null($user_id)){
            $this->data['analytics']['today']->where('admin_id',$user_id);
        }
        $this->data['analytics']['today'] =  $this->data['analytics']['today']->count();

        $this->data['analytics']['price'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
            ->where('order_create_date','>=',$date_start." 00:00:00")
            ->where('order_create_date','<=',$date_end." 23:59:59");

        if(!is_null($user_id)){
            $this->data['analytics']['price']->where('admin_id',$user_id);
        }
        $this->data['analytics']['price'] =  $this->data['analytics']['price']->sum('order_price');

        return $this->render('dashboard.user',[]);
    }
    public function export(Request $request){
        $user_id = null;
        $this->file = new \Illuminate\Filesystem\Filesystem();
        if(!Auth::user()->IsAcl("dashboard:all")){
            $user_id = Auth::user()->id;
        }
        $data = $request->all();

        $date_start = "";
        $date_end = "";

        if($data['company'] == "YAMADA" || "FUKUI" == $data['company']  || "OHGA" == $data['company']){
            $date_end = $data['year'].'-'.$data['month'].'-20';
            $date_start = $data['year'].'-'.date('m',strtotime('-1 month',strtotime($date_end))).'-21';
        }else{
            $date_end = $data['year'].'-'.$data['month'].'-31';
            $date_start = $data['year'].'-'.$data['month'].'-01';
        }

        if($data['company'] == "KOGYJA"){
            $price = DB::table('shop_order_excel')
                ->where('fullname','!=','')
                ->where('company',$data['company'])
                ->where('public','1')
                ->where('success','0')
                ->where('type','Footer')
                ->where('order_create_date','>=',$date_start." 00:00:00")
                ->where('order_create_date','<=',$date_end." 23:59:59");
        }else{
            $price = DB::table('shop_order_excel')
                ->where('fullname','!=','')
                ->where('company',$data['company'])
                ->where('public','1')
                ->where('success','0')
                ->where('order_create_date','>=',$date_start." 00:00:00")
                ->where('order_create_date','<=',$date_end." 23:59:59");
        }
        if(!is_null($user_id)){
            $price->where('admin_id',$user_id);
        }

        $total_price = 0;
        $arr_prices = [];
        $results = $price->get()->all();

        foreach ($results as $key=>$value){
           $k = date('Y/m/d',strtotime($value->order_create_date));
           if(!isset($arr_prices[$k])){
               $arr_prices[$k] = 0;
           }
           if(is_null($user_id)){
               $total_price+= $value->order_price;
               $arr_prices[$k]+=$value->order_price;
           }else{
               if($data['company'] == "KOGYJA"){
                   $total_price+= $value->rate;
                   $arr_prices[$k]+=$value->rate;
               }else{
                   $total_price+= (int)$value->rate * (int)$value->count;
                   $arr_prices[$k]+=(int)$value->rate* (int)$value->count;
               }
           }
        }
        $json = [];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->createSheet();
        $spreadsheet->getSheet(1)->setTitle('Sheet2');

        $sheet->setTitle("Sheet1");
        $spreadsheet->getProperties()
            ->setTitle('PHP Download Example')
            ->setSubject('A PHPExcel example')
            ->setDescription('A simple example for PhpSpreadsheet. This class replaces the PHPExcel class')
            ->setCreator('php-download.com')
            ->setLastModifiedBy('php-download.com');
//                    $title1 = "株式会社ヤマダ 様 注文フォーマット";
//                    $title2 = "見本";
//                    $info = "依頼人名. VO HOANG 様 22日に 7410 円入金済み";
//                    $sheet->setCellValue('B1', $title1);
//                    $sheet->setCellValue('F2', $title2);
//                    $sheet->setCellValue('P2', $info);
//                    $styleArray = array(
//                        'font'  => array(
//                            'size'  => 9,
//                            'name' => 'Times New Roman'
//                        ));
        $style_header = array(
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb'=>'FFE100'),
            ),
            'borders' => [
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_DOTTED,
                    'color' => array('rgb'=>'000000')
                ),
            ],
            'font' => array(
                'size' => 10
            )
        );
//                    $sheet->getStyle('B1')->applyFromArray($styleArray);
//                    $sheet->getStyle('F2')->applyFromArray($styleArray);
        $sheet->getStyle('P2')->applyFromArray(array(
                'font'  => array(
                    'size'  => 9,
                    'name' => 'Times New Roman',
                    'color' => array('rgb' => '0070c0'),
                ),
            )
        );
        $sheet->getStyle('A3:T3')->applyFromArray( $style_header );

        $colums = [
            ["配送先電話番号",'status',10,9],//B1
            ["配送先住所",'order_link',10,9],//B2
            ["配送先氏名",'fullname',10,9],//B3
            ["品番",'address',10,9],//B4
            ["商品名",['product'=>['product_id','title']],18,9],//I5
            ["単価",'total_count',10,9],//B6
            ["数量",['callback'=>function($index,$date){return date("d-m-Y",strtotime($date));},'key'=>'order_date'],10,9],//B7
            ["配送希望日",['callback'=>function($index,$date){return date("d-m-Y",strtotime($date));},'key'=>'order_hours'],10,9],//B8
            ["配送希望時間帯",'notification',10,9],//B9
            ["別途送料",'0',10,9],//B10
            ["仕入金額",'id',10,9],//B11
            ["振込金額",'id',10,9],//B12
            ["余分金",'id',10,9],//B13
            ["追跡番号",'id',10,9],//B14
            ["振込み情報",'id',10,9],//B15
        ];

        $start=3;
        $nameColList  = [];

        foreach($colums as $key=>$value){
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
            if(is_array($value[1])){
                if(isset($value[1]['product'])){
                    $conf = $value[1]['product'];
                    $nameColList[$conf[0]] = $key;
                }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                    $nameColList[$value[1]['key']] = $key;
                }
            }else{
                $nameColList[$value[1]] = $key;
            }
            $sheet->setCellValue($nameCol.$start, $value[0])->getStyle($nameCol.$start)->applyFromArray(array(
                    'font'  => array(
                        'size'  => $value[3]
                    ),
                )
            );

            if($value[2] > 0){
                $spreadsheet->getActiveSheet()->getColumnDimension($nameCol)->setWidth($value[2]);
            }
        }
     //   $date_end = $data['year'].'-'.$data['month'].'-20';
      //  $date_start = $data['year'].'-'.date('m',strtotime('-1 month',strtotime($date_end))).'-21';
        $date_start1 = $date_start;
        $strtotime_date_start1 = strtotime($date_start1);
        while ($date_start1 != $date_end){
            $start++;
            $date = date('Y/m/d',$strtotime_date_start1);
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12);
            $sheet->getCell($nameCol.$start)->setDataType(PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue($nameCol.$start,$date);
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(13);
            $sheet->getCell($nameCol.$start)->setDataType(PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue($nameCol.$start,isset($arr_prices[$date])?$arr_prices[$date]:0);
            $date_start1 = date('Y-m-d',$strtotime_date_start1);
            $strtotime_date_start1 = strtotime('+1 day',$strtotime_date_start1);

        }
        $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12);
        $sheet->getCell($nameCol.$start)->setDataType(PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue($nameCol.$start,"合計");
        $sheet->getStyle($nameCol.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
            'font'  => array(

                'name' => 'Times New Roman',
                'color' => array('rgb' => 'ff0000'),
            ),
        ) );
        $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(13);
        $sheet->getStyle($nameCol.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
            'font'  => array(

                'name' => 'Times New Roman',
                'color' => array('rgb' => 'ff0000'),
            ),
        ) );
        $sheet->getCell($nameCol.$start)->setDataType(PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue($nameCol.$start,$total_price);



        $file = new \Illuminate\Filesystem\Filesystem();
        $date = time();
        $writer = new Xlsx($spreadsheet);
        if( !$file->isDirectory(public_path().'/uploads/dashboard')){
            $file->makeDirectory(public_path().'/uploads/dashboard');
        }
        $path = '/uploads/dashboard/'.str_replace(__CLASS__.'::',"",__METHOD__);
        if( !$file->isDirectory(public_path().$path)){
            $file->makeDirectory(public_path().$path);
        }

        $path = $path.'/'.date('Y-m-d',$date);
        if( !$file->isDirectory(public_path().$path)){
            $file->makeDirectory(public_path().$path);
        }
        $filename = $data['month'].'月の総合計 '.$total_price.'円';
        $path = $path.'/'.$filename;
        if( !$file->isDirectory(public_path().$path)){
            $file->makeDirectory(public_path().$path);
        }
        $path2 = $path.'/'.$filename.'.xlsx';
        $writer->save(public_path().$path2);
        $json['link'] = url($path2);



        return response()->json($json   );
    }

}