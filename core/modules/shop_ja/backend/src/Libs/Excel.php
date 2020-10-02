<?php
namespace  ShopJa\Libs;
use \PhpOffice\PhpSpreadsheet;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
class Excel{
    protected $file;
    public $DataCol = [

    ];
    public $date = 0;
    public function __construct($date)
    {
        $this->file = new \Illuminate\Filesystem\Filesystem();
        $this->date = strtotime($date);

        $this->DataCol = [
            "FUKUI"=>[
                    ["支払区分",'payMethod',10,9],//A Phương thức thanh toán
                    ["到着希望日",'order_date1',15,9],//B ngày giao hàng
                    ["配送希望時間帯",'order_hours',15,9],//C Giờ nhận
                    ["配送先氏名",'fullname',18,9],//D Họ và tên khách hàng
                    ["配送先郵便番号",'zipcode',9,9],// E Mã bưu điện
                    ["配送先都道府県",'province',14,9], // F Tỉnh
                    ["配送先住所",'address',18,9], // G Địa chỉ giao hàng
                    ["配送先電話番号",'phone',10,9], // H Số điện thoại
                    ["別途送料",'order_ship',15,9], //I Phí Ship
                    ["紹介料",['callback'=>function($index,$value){return (int)$value;},'key'=>'order_price'],15,9],// Lợi nhuận J
                    ["仕入金額",'order_total_price_buy',15,9], // Tổng giá đơn hàng K
                    ["品番",['product'=>['product_id','code']],10,9], // Mã sản phẩm L
                    ["商品名",['product'=>['product_name','title']],18,9], // Tên sản phẩm M
                    ["単価",'order_total_price',15,9], // Giá nhập N
                    ["数量",'count',15,9], // Số lượng O
                    ["",'order_tracking',15,9],
            ],
            "OHGA"=>[
                ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
                ["支払区分",'payMethod',10,9],//B
                ["配送先電話番号",'phone',10,9],//C
                ["配送先郵便番号",'zipcode',9,9],//D
                ["配送先都道府県",'province',14,9],//E
                ["配送先住所",'address',18,9],//F
                ["配送先氏名",'fullname',18,9],//G
                ["品番",['product'=>['product_id','code']],10,9],//H
                ["商品名",['product'=>['product_name','title']],18,9],//I
                ["単価",'price',15,9],//J
                ["数量",'count',15,9],//K
                ["到着希望日",'order_date',15,9],//L
                ["配送希望時間帯",'order_hours',15,9],//M
                ["別途送料",'order_ship',15,9],//N
                ["仕入金額",'order_total_price',15,9],//O
                ["代引き請求金額",'order_total_price_buy',15,9],//P
                ["代引き手数料",'order_ship_cou',15,9],//Q
                ["紹介料",'order_price',15,9],//R
                ["追跡番号",'order_tracking',15,9],//S
                ["振込み情報",'order_info',25,9],//T
                ["",'order_link',25,9],//U
            ],
            "YAMADA"=>[
                ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
                ["支払区分",'payMethod',10,9],//B
                ["配送先電話番号",'phone',10,9],//C
                ["配送先郵便番号",'zipcode',9,9],//D
                ["配送先都道府県",'province',14,9],//E
                ["配送先住所",'address',18,9],//F
                ["配送先氏名",'fullname',18,9],//G
                ["品番",['product'=>['product_id','code']],10,9],//H
                ["商品名",['product'=>['product_name','title']],18,9],//I
                ["単価",'price',15,9],//J
                ["数量",'count',15,9],//K
                ["到着希望日",'order_date',15,9],//L
                ["配送希望時間帯",'order_hours',15,9],//M
                ["別途送料",'order_ship',15,9],//N
                ["仕入金額",'order_total_price',15,9],//O
                ["代引き請求金額",'order_total_price_buy',15,9],//P
                ["代引き手数料",'order_ship_cou',15,9],//Q
                ["紹介料",'order_price',15,9],//R
                ["追跡番号",'order_tracking',15,9],//S
                ["振込み情報",'order_info',25,9],//T
                ["",'order_link',25,9],//U
            ],
            "KOGYJA"=>[
                ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
                ["支払区分",'payMethod',10,9],//Phương thức thanh toán
                ["配送先電話番号",'phone',10,9],//Số điện thoại
                ["郵便番号",'zipcode',9,9],//Mã bưu điện
                ["配送先都道府県",'province',14,9],//Tỉnh/TP
                ["配送先住所",'address',18,9],//Địa chỉ giao hàng
                ["配送先氏名",'fullname',18,9],//Họ tên người nhận
                ["品番",['product'=>['product_id','code']],10,9],//H
                ["商品名",['product'=>['product_name','title']],18,9],//I
                ["単価",'price',15,9],//Giá nhập
                ["数量",'count',15,9],//SL
                ["到着希望日",'order_date',15,9],//Ngày nhận
                ["配送希望時間帯",'order_hours',15,9],//Giờ nhận
                ["送料",'order_ship',15,9],//Phí ship
                ["梱包材",'total_count',15,9],//Tổng giá nhập
                ["仕入金額",'order_total_price',15,9],//Giá bán
                ["振込み金額",'order_total_price_buy',15,9],//Giá bán
                ["手数料",'order_ship_cou',15,9],
                ["余分金",'order_price',15,9],
                ["追跡番号",'order_tracking',15,9],
                ["振込み情報",'order_info',25,9],
            ],
            'KURICHIKU'=> [
                ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
                ["支払区分",'payMethod',10,9],//Phương thức thanh toán
                ["配送先電話番号",'phone',10,9],//Số điện thoại
                ["郵便番号",'zipcode',9,9],//Mã bưu điện
                ["配送先都道府県",'province',14,9],//Tỉnh/TP
                ["配送先住所",'address',18,9],//Địa chỉ giao hàng
                ["配送先氏名",'fullname',18,9],//Họ tên người nhận
                ["品番",['product'=>['product_id','code']],10,9],//H
                ["商品名",['product'=>['product_name','title']],18,9],//I
                ["単価",'price',15,9],//Giá nhập
                ["数量",'count',15,9],//SL
                ["到着希望日",'order_date',15,9],//Ngày nhận
                ["配送希望時間帯",'order_hours',15,9],//Giờ nhận
                ["送料",'order_ship',15,9],//Phí ship

                ["仕入金額",'order_total_price',15,9],//Giá bán
                ["振込み金額",'order_total_price_buy',15,9],//Giá bán
                ["手数料",'order_ship_cou',15,9],
                ["余分金",'order_price',15,9],
                ["追跡番号",'order_tracking',15,9],
                ["振込み情報",'order_info',25,9],
            ]
        ];
    }

    function getValuePayMethod($val) {
        if($val === "代金引換") return 1;
        if($val === "銀行振込") return 2;
        if($val === "決済不要") return 3;
        return 0;
    }
    public function Read($OriginalName,$inputFileName,$inputFileType){
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheet = $spreadsheet->getActiveSheet();
        $datas =  $sheet->toArray();

        $type = $this->checkTypeCom($OriginalName);

        $html = "";
        if(isset($this->DataCol[$type])){
            $colums = $this->DataCol[$type];
            foreach($colums as $key=>$value){
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
            }

            $n = count($datas);
            $html = "";
            $results = [];

            if($type == "YAMADA" || $type == "FUKUI" || $type == "OHGA" || $type == "KOGYJA" || $type == "KURICHIKU"){
                $i = 3;
                if($type == "FUKUI"){
                    $i = 6;
                }
                for ( ; $i < $n ;$i++){

                    $order_tracking = trim(rtrim($datas[$i][$nameColList['order_tracking']]));

                    $count = (int)trim(rtrim($datas[$i][$nameColList['count']]));

                    if(!empty($order_tracking)){
                        $fullname = trim(rtrim($datas[$i][$nameColList['fullname']]));
                        if(!empty($fullname) && $fullname != "配送先氏名"){
                            $item = [
                                'data'=>$datas[$i],
                                'checking'=>[$order_tracking],
                            ];
                            for($j = $i+1;$j<$count+$i; $j++){
                                $order_tracking =  trim(rtrim($datas[$j][$nameColList['order_tracking']]));
                                $item['checking'][] = $order_tracking;
                            }
                            $results[] = $item;
                        }
                    }
                }

                $html = "<table>";
                $html.="<tr>";
                $html.="<td class='text-center' colspan='".(count($colums)+1)."'><h2>".$type."</h2></td>";
                $html.="</tr>";
                foreach ($results as $key=>$value){
                    $fullname = trim(rtrim($value['data'][$nameColList['fullname']]));

                    $where = [
                        'fullname'=> trim(rtrim($value['data'][$nameColList['fullname']])),
                        'address'=> trim(rtrim($value['data'][$nameColList['address']])),
                        'company'=>$type,
                        'phone'=>trim(rtrim($value['data'][$nameColList['phone']])),
                        'zipcode'=>trim(rtrim($value['data'][$nameColList['zipcode']])),
                        'province'=>trim(rtrim($value['data'][$nameColList['province']])),
                        'product_code'=>trim(rtrim($value['data'][$nameColList['product_id']])),
                        'product_title'=>trim(rtrim($value['data'][$nameColList['product_name']])),
                        'pay_method'=>$this->getValuePayMethod(trim(rtrim($value['data'][$nameColList['payMethod']]))),

                    ];

                    $_result = DB::table('shop_order_excel')->where($where)->get()->all();
                    $count = count($_result);
                    $class = ($count==1?'update':(($count==0)?'empty':'two'));

                    if($class == "update"){
                        if(!empty($_result[0]->order_tracking)){
                            if(json_encode($value['checking']) == $_result[0]->order_tracking){
                                $class = 'oke';
                            }else{
                                $class = 'conflict';
                            }
                        }
                    }
                    $html.="<tr class='".$class ."'>";
                    if($class=="update"){
                        $html.="<td>[".$count."]<div style='display: none'><textarea class='value'>".json_encode(['id'=>$_result[0]->id,'checking'=>$value['checking']])."</textarea></div></td>";
                    }else{
                        $html.="<td>[".$count."]</td>";
                    }
//                    $html.="<td>".json_encode($where)."</td>";
                    foreach ($value['data'] as $k=>$val){
                        $html.="<td>".$val."</td>";
                    }
                    $html.="</tr>";
                }
                $html.= "</table>";
            }
        }
        return $html;
    }
    public function checkTypeCom($name){
        if( strpos($name,"大賀商店のお米の注文分") !== false){
            return "OHGA";
        }else  if( strpos($name,"株式会社クリチク") !== false){
            return "KURICHIKU";
        }else  if( strpos($name,"株式会社コギ家-様" ) !== false){
            return "KOGYJA";
        }else  if( strpos($name,"株式会社ヤマダ-様-のお米の注文分" ) !== false){
            return "YAMADA";
        }else if(strpos($name,'の注文分-福井精米様御中')){
            return "FUKUI";
        }
    }
    public function FUKUI($datas){

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


        $titles = [
            ['A1','グエン様専用注文フォーマット'],
            ['G2','別途送料'],
            ['H2','北海道：800円'],
            ['H2','沖縄：1200円'],
            ['N5','VU THI 様 14 日に 6250  円入金済み'],
        ];
        foreach ($titles as $title){
            $sheet->setCellValue($title[0], $title[1]);
        }
        $titles = [
            '選択','入力','選択','入力','入力','入力','入力','入力','入力','不要','入力','入力','不要','不要','入力'
        ];
        $start = 6;
        foreach($titles as $key=>$value){
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
            $sheet->setCellValue($nameCol.$start, $value);
        }

        $styleArray = array(
            'font'  => array(
                'size'  => 9,
                'name' => 'Times New Roman'
            ));
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
        $sheet->getStyle('B1')->applyFromArray($styleArray);
        $sheet->getStyle('F2')->applyFromArray($styleArray);
        $sheet->getStyle('P2')->applyFromArray(array(
                'font'  => array(
                    'size'  => 9,
                    'name' => 'Times New Roman',
                    'color' => array('rgb' => '0070c0'),
                ),
            )
        );
        $colums = [
            ["支払区分",'payMethod',10,9],//A Phương thức thanh toán
            ["到着希望日",'order_date1',15,9],//B ngày giao hàng
            ["配送希望時間帯",'order_hours',15,9],//C Giờ nhận
            ["配送先氏名",'fullname',18,9],//D Họ và tên khách hàng
            ["配送先郵便番号",'zipcode',9,9],// E Mã bưu điện
            ["配送先都道府県",'province',14,9], // F Tỉnh
            ["配送先住所",'address',18,9], // G Địa chỉ giao hàng
            ["配送先電話番号",'phone1',10,9], // H Số điện thoại
            ["別途送料",'order_ship',15,9], //I Phí Ship
            ["紹介料",['callback'=>function($index,$value){return (int)$value;},'key'=>'order_price'],15,9],// Lợi nhuận J
            ["仕入金額",'order_total_price_buy',15,9], // Tổng giá đơn hàng K
            ["品番",['product'=>['product_id','code']],10,9], // Mã sản phẩm L
            ["商品名",['product'=>['product_id','title']],18,9], // Tên sản phẩm M
            ["単価",'order_total_price',15,9], // Giá nhập N
            ["数量",'count',15,9], // Số lượng O
        ];
        $start=7;
        $sheet->getStyle('A'.$start.':'.PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).$start)->applyFromArray( $style_header );
        $nameColList = [];
        foreach($colums as $key=>$value){
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
            $sheet->setCellValue($nameCol.$start, $value[0])->getStyle($nameCol.$start)->applyFromArray(array(
                    'font'  => array(
                        'size'  => $value[3]
                    ),
                )
            );
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
            if($value[2] > 0){
                $spreadsheet->getActiveSheet()->getColumnDimension($nameCol)->setWidth($value[2]);
            }
        }
        $start++;
        $defaultStart = $start;
        $lastIndex = "";
        $company = "36";

        $orders = [

        ];
        $columns_value = array_flip($datas['columns']);
        $products =  DB::table('shop_product')->get()->keyBy('id')->all();
        $images = [];
        foreach ($datas['datas'] as $key=>$values){
            $payMethod = "";

            if(empty($values[$nameColList['fullname']])){
                continue;
            }

            $image =  (isset($columns_value['image'])?$values[$columns_value['image']]:"");

            $order_info =  (isset($columns_value['order_info'])?$values[$columns_value['order_info']]:"");
            $images[] = [$image,$order_info];
            foreach($colums as $key=>$value){
                $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
                if(is_array($value[1])){
                    if(isset($value[1]['product'])){
                        $conf = $value[1]['product'];
                        $id = (isset($columns_value[$conf[0]])?$values[$columns_value[$conf[0]]]:"");
                        $_val = "";
                        if(isset($products[$id]) && property_exists($products[$id],$conf[1])){
                            $_val = $products[$id]->{$conf[1]};
                        }
                        $sheet->setCellValue($nameCol.$start,$_val);
                    }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                        $conf = $value[1]['callback'];
                        $_val = call_user_func_array($conf,[$start,(isset($columns_value[$value[1]['key']])?$values[$columns_value[$value[1]['key']]]:""),$nameCol.$start]);
                        $sheet->setCellValue($nameCol.$start,$_val);
                    }
                }else{
                    $v = (isset($columns_value[$value[1]])?$values[$columns_value[$value[1]]]:"");
                    $sheet->setCellValue($nameCol.$start,$v);
                    if($value[1] == "payMethod"){
                        $payMethod = $v;
                    }
                }
            }
            if($payMethod == "銀行振込"){
                $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                    'font'  => array(

                        'name' => 'Times New Roman',
                        'color' => array('rgb' => '0070c0'),
                    ),
                ) );
            }else  if($payMethod == "決済不要"){
                $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                    'font'  => array(

                        'name' => 'Times New Roman',
                        'color' => array('rgb' => 'ff0000'),
                    ),
                ) );
            }
            $start++;
        }

        $sheet->getStyle('K6:K'.$start)->applyFromArray(array(
                'font'  => array(
                    'color' => array('rgb' => 'ff0000'),
                ),
            )
        );
//        $sheet->getStyle('K6:K'.$start)->getStyleArray(array(
//                'fill' => array(
//                    'fillType' => Fill::FILL_SOLID,
//                    'color' => array('rgb'=>'c00010'),
//                ),
//            )
//        );
        // $sheet->setCellValue("J".$start, "=SUM(K".$defaultStart.":K".($start-1).")");
//        $sheet->setCellValue("P".$start, "=SUM(P".$defaultStart.":P".($start-1).")");
//        $sheet->setCellValue("R".$start, "=SUM(R".$defaultStart.":R".($start-1).")");
//        $sheet->setCellValue("Q".$start, "=SUM(Q".$defaultStart.":Q".($start-1).")");

        $writer = new Xlsx($spreadsheet);
        $path = '/uploads/exports/'.str_replace(__CLASS__.'::',"",__METHOD__);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path = $path.'/'.date('Y-m-d', $this->date);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }

        $filename = date('m',$this->date).'月'.date('d',$this->date).'日の注文分-福井精米様御中';


        $path = $path.'/'.$filename;
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path2 = $path.'/'.$filename.'.xlsx';

        $writer->save(public_path().$path2);

        $files = [
            [$filename.'.xlsx',public_path().$path2]
        ];

        foreach ($images as $image){

            if(!empty($image[0]) && file_exists(public_path()."/".$image[0])){

                $pathinfo = pathinfo(public_path()."/".$image[0]);

                if(empty($image[1])){
                    $file_image = $pathinfo['filename'].'.'.$pathinfo['extension'];
                }else{
                    $file_image = $image[1].'.'.$pathinfo['extension'];
                }
                $newName = $path .'/'. $file_image;
                $this->file->copy(public_path()."/".$image[0],public_path().'/'.$newName );
                $files[] = [
                    $file_image,public_path().'/'.$newName
                ];
            }
        }
        $zipFileName = $filename.'.zip';
        $zip = new \ZipArchive();
        if($this->file->exists(public_path().'/'.$path . '/' . $zipFileName)){
            $this->file->delete(public_path().'/'.$path . '/' . $zipFileName);
        }
        if ($zip->open(public_path().'/'.$path . '/' . $zipFileName, \ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file){
                $zip->addFile($file[1],$file[0]);
            }

            $zip->close();
        }
        return ['link'=>url($path . '/' . $zipFileName),'images'=>$images];

    }
    public function OHGA($datas){

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

        $title1 = "株式会社ヤマダ 様 注文フォーマット";
        $title2 = "見本";

        $info = "依頼人名. VO HOANG 様 22日に 7410 円入金済み";

        $sheet->setCellValue('B1', $title1);
        $sheet->setCellValue('F2', $title2);
        $sheet->setCellValue('P2', $info);

        $styleArray = array(
            'font'  => array(
                'size'  => 9,
                'name' => 'Times New Roman'
            ));
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
        $sheet->getStyle('B1')->applyFromArray($styleArray);
        $sheet->getStyle('F2')->applyFromArray($styleArray);
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
            ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
            ["支払区分",'payMethod',10,9],//B
            ["配送先電話番号",'phone',10,9],//C
            ["配送先郵便番号",'zipcode',9,9],//D
            ["配送先都道府県",'province',14,9],//E
            ["配送先住所",'address',18,9],//F
            ["配送先氏名",'fullname',18,9],//G
            ["品番",['product'=>['product_id','code']],10,9],//H
            ["商品名",['product'=>['product_name','title']],18,9],//I
            ["単価",'price',15,9],//J
            ["数量",'count',15,9],//K
            ["到着希望日",'order_date',15,9],//L
            ["配送希望時間帯",'order_hours',15,9],//M
            ["別途送料",'order_ship',15,9],//N
            ["仕入金額",'order_total_price',15,9],//O
            ["代引き請求金額",'order_total_price_buy',15,9],//P
            ["代引き手数料",'order_ship_cou',15,9],//Q
            ["紹介料",'order_price',15,9],//R
            ["追跡番号",'order_tracking',15,9],//S
            ["振込み情報",'order_info',25,9],//T
            ["",'order_link',25,9],//U
        ];
        $start=3;
        $nameColList = [];
        foreach($colums as $key=>$value){
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
            $sheet->setCellValue($nameCol.$start, $value[0])->getStyle($nameCol.$start)->applyFromArray(array(
                    'font'  => array(
                        'size'  => $value[3]
                    ),
                )
            );
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
            if($value[2] > 0){
                $spreadsheet->getActiveSheet()->getColumnDimension($nameCol)->setWidth($value[2]);
            }
        }
        $start++;
        $defaultStart = $start;
        $lastIndex = "";

        $company = "37";

        $orders = [

        ];

        $products =  DB::table('shop_product')->get()->keyBy('id')->all();

        $category = config_get("category", "shop-ja:japan:category");
        $category_ship = get_category_type('shop-ja:japan:category:com-ship');

        $columns_value = array_flip($datas['columns']);
        $products =  DB::table('shop_product')->get()->keyBy('id')->all();
        $images = [];
        foreach ($datas['datas'] as $key=>$values){
            $payMethod = "";
            if(empty($values[$nameColList['fullname']])){
                continue;
            }

            $image =  (isset($columns_value['image'])?$values[$columns_value['image']]:"");

            $order_info =  (isset($columns_value['order_info'])?$values[$columns_value['order_info']]:"");
            $images[] = [$image,$order_info];
            foreach($colums as $key=>$value){
                $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
                if(is_array($value[1])){
                    if(isset($value[1]['product'])){
                        $conf = $value[1]['product'];
                        $id = (isset($columns_value[$conf[0]])?$values[$columns_value[$conf[0]]]:"");
                        $_val = "";
                        if(isset($products[$id]) && property_exists($products[$id],$conf[1])){
                            $_val = $products[$id]->{$conf[1]};
                        }
                        $sheet->setCellValue($nameCol.$start,$_val);
                    }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                        $conf = $value[1]['callback'];
                        $_val = call_user_func_array($conf,[$start,(isset($columns_value[$value[1]['key']])?$values[$columns_value[$value[1]['key']]]:""),$nameCol.$start]);
                        $sheet->setCellValue($nameCol.$start,$_val);
                    }
                }else{
                    $v = (isset($columns_value[$value[1]])?$values[$columns_value[$value[1]]]:"");
                    $sheet->setCellValue($nameCol.$start,$v);
                    if($value[1] == "payMethod"){
                        $payMethod = $v;
                    }
                }
            }
            if($payMethod == "銀行振込"){
                $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                    'font'  => array(
                        'size'  => 9,
                        'name' => 'Times New Roman',
                        'color' => array('rgb' => '0070c0'),
                    ),
                ) );
            }else  if($payMethod == "決済不要"){
                $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                    'font'  => array(
                        'size'  => 9,
                        'name' => 'Times New Roman',
                        'color' => array('rgb' => 'ff0000'),
                    ),
                ) );
            }
            $start++;
        }

        $sheet->setCellValue("K".$start, "=SUM(K".$defaultStart.":K".($start-1).")");
        $sheet->setCellValue("P".$start, "=SUM(P".$defaultStart.":P".($start-1).")");
        $sheet->setCellValue("R".$start, "=SUM(R".$defaultStart.":R".($start-1).")");
        $sheet->setCellValue("Q".$start, "=SUM(Q".$defaultStart.":Q".($start-1).")");
        $writer = new Xlsx($spreadsheet);
        $path = '/uploads/exports/'.str_replace(__CLASS__.'::',"",__METHOD__);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path = $path.'/'.date('Y-m-d',$this->date);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }

        $filename = '大賀商店のお米の注文分'.date('m',$this->date).'月'.date('d',$this->date).'日';


        $path = $path.'/'.$filename;
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path2 = $path.'/'.$filename.'.xlsx';

        $writer->save(public_path().$path2);

        $files = [
            [$filename.'.xlsx',public_path().$path2]
        ];

        foreach ($images as $image){

            if(!empty($image[0]) && file_exists(public_path()."/".$image[0])){

                $pathinfo = pathinfo(public_path()."/".$image[0]);

                if(empty($image[1])){
                    $file_image = $pathinfo['filename'].'.'.$pathinfo['extension'];
                }else{
                    $file_image = $image[1].'.'.$pathinfo['extension'];
                }
                $newName = $path .'/'. $file_image;
                $this->file->copy(public_path()."/".$image[0],public_path().'/'.$newName );
                $files[] = [
                    $file_image,public_path().'/'.$newName
                ];
            }
        }
        $zipFileName = $filename.'.zip';
        $zip = new \ZipArchive();
        if($this->file->exists(public_path().'/'.$path . '/' . $zipFileName)){
            $this->file->delete(public_path().'/'.$path . '/' . $zipFileName);
        }
        if ($zip->open(public_path().'/'.$path . '/' . $zipFileName, \ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file){
                $zip->addFile($file[1],$file[0]);
            }

            $zip->close();
        }
        return ['link'=>url($path . '/' . $zipFileName),'images'=>$images];

    }
    public function YAMADA($datas,$name){
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
        $title1 = "株式会社ヤマダ 様 注文フォーマット";
        $title2 = "見本";
        $info = "依頼人名. VO HOANG 様 22日に 7410 円入金済み";
        $sheet->setCellValue('B1', $title1);
        $sheet->setCellValue('F2', $title2);
        $sheet->setCellValue('P2', $info);
        $styleArray = array(
            'font'  => array(
                'size'  => 9,
                'name' => 'Times New Roman'
            ));
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
        $sheet->getStyle('B1')->applyFromArray($styleArray);
        $sheet->getStyle('F2')->applyFromArray($styleArray);
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
            ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
            ["支払区分",'payMethod',10,9],//B
            ["配送先電話番号",'phone',10,9],//C
            ["配送先郵便番号",'zipcode',9,9],//D
            ["配送先都道府県",'province',14,9],//E
            ["配送先住所",'address',18,9],//F
            ["配送先氏名",'fullname',18,9],//G
            ["品番",['product'=>['product_id','code']],10,9],//H
            ["商品名",['product'=>['product_name','title']],18,9],//I
            ["単価",'price',15,9],//J
            ["数量",'count',15,9],//K
            ["到着希望日",['callback'=>function($index,$date){return date("m/d/Y", strtotime($date));},'key'=>'order_date'],15,9],//L
            ["配送希望時間帯",'order_hours',15,9],//M
            ["別途送料",'order_ship',15,9],//N
            ["仕入金額",'order_total_price',15,9],//O
            ["代引き請求金額",'order_total_price_buy',15,9],//P
            ["代引き手数料",'order_ship_cou',15,9],//Q
            ["紹介料",'order_price',15,9],//R
            ["追跡番号",'order_tracking',15,9],//S
            ["振込み情報",'order_info',25,9],//T
            ["",'order_link',25,9],//U
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
        $start++;
        $defaultStart = $start;
        $lastIndex = "";

        $company = "22";
        $orders = [

        ];

        $columns_value = array_flip($datas['columns']);
        $products =  DB::table('shop_product')->get()->keyBy('id')->all();
        $images = [];
        foreach ($datas['datas'] as $key=>$values){
            $payMethod = "";
            if(empty($values[$nameColList['fullname']])){
                continue;
            }
            $image =  (isset($columns_value['image'])?$values[$columns_value['image']]:"");

            $order_info =  (isset($columns_value['order_info'])?$values[$columns_value['order_info']]:"");
            $images[] = [$image,$order_info];
            foreach($colums as $key=>$value){

                $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);

                if(is_array($value[1])){
                    if(isset($value[1]['product'])){
                        $conf = $value[1]['product'];
                        $id = (isset($columns_value[$conf[0]])?$values[$columns_value[$conf[0]]]:"");
                        $_val = "";
                        if(isset($products[$id]) && property_exists($products[$id],$conf[1])){
                            $_val = $products[$id]->{$conf[1]};
                        }
                        $sheet->setCellValue($nameCol.$start,$_val);
                    }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                        $conf = $value[1]['callback'];
                        $_val = call_user_func_array($conf,[$start,(isset($columns_value[$value[1]['key']])?$values[$columns_value[$value[1]['key']]]:""),$nameCol.$start]);
                        $sheet->setCellValue($nameCol.$start,$_val);
                    }
                }else{
                    $v = (isset($columns_value[$value[1]])?$values[$columns_value[$value[1]]]:"");
                    $sheet->setCellValue($nameCol.$start,$v);
                    if($value[1] == "payMethod"){
                        $payMethod = $v;
                    }
                }
            }
            if($payMethod == "銀行振込"){
                $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                    'font'  => array(
//                        'size'  => 9,
                        'name' => 'Times New Roman',
                        'color' => array('rgb' => '0070c0'),
                    ),
                ) );
            }else  if($payMethod == "決済不要"){
                $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                    'font'  => array(
//                        'size'  => 9,
                        'name' => 'Times New Roman',
                        'color' => array('rgb' => 'ff0000'),
                    ),
                ) );
            }
            $start++;
        }
        $sheet->setCellValue("K".$start, "=SUM(K".$defaultStart.":K".($start-1).")");
        $sheet->setCellValue("P".$start, "=SUM(P".$defaultStart.":P".($start-1).")");
        $sheet->setCellValue("R".$start, "=SUM(R".$defaultStart.":R".($start-1).")");
        $sheet->setCellValue("Q".$start, "=SUM(Q".$defaultStart.":Q".($start-1).")");
        $writer = new Xlsx($spreadsheet);
        $path = '/uploads/exports/'.str_replace(__CLASS__.'::',"",__METHOD__);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path = $path.'/'.date('Y-m-d',$this->date);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }


        $filename = '株式会社ヤマダ-様-のお米の注文分'.date('m',$this->date).'月'.date('d',$this->date).'日';


        $path = $path.'/'.$filename;
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path2 = $path.'/'.$filename.'.xlsx';
        $writer->save(public_path().$path2);
        $files = [
            [$filename.'.xlsx',public_path().$path2]
        ];
        foreach ($images as $image){

            if(!empty($image[0]) && file_exists(public_path()."/".$image[0])){

                $pathinfo = pathinfo(public_path()."/".$image[0]);

                if(empty($image[1])){
                    $file_image = $pathinfo['filename'].'.'.$pathinfo['extension'];
                }else{
                    $file_image = $image[1].'.'.$pathinfo['extension'];
                }
                $newName = $path .'/'. $file_image;
                $this->file->copy(public_path()."/".$image[0],public_path().'/'.$newName );
                $files[] = [
                    $file_image,public_path().'/'.$newName
                ];
            }
        }
        $zipFileName = $filename.'.zip';
        $zip = new \ZipArchive();
        if($this->file->exists(public_path().'/'.$path . '/' . $zipFileName)){
            $this->file->delete(public_path().'/'.$path . '/' . $zipFileName);
        }
        if ($zip->open(public_path().'/'.$path . '/' . $zipFileName, \ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file){
                $zip->addFile($file[1],$file[0]);
            }

            $zip->close();
        }
        return ['link'=>url($path . '/' . $zipFileName),'images'=>$images];

    }
    public function KURICHIKU($datas){
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

        $sheet->setCellValue('B1', '株式会社コギ家　様 注文フォーマット');


        $styleArray = array(
            'font'  => array(
                'size'  => 9,
                'name' => 'Times New Roman'
            ));
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
        $sheet->getStyle('B1')->applyFromArray($styleArray);
        $start=2;
        $products =  DB::table('shop_product')->get()->keyBy('id')->all();
        $images = [];
        for($typeMethod = 1; $typeMethod < 3 ; $typeMethod++){
            $colums = [
                ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
                ["支払区分",'payMethod',10,9],//Phương thức thanh toán
                ["配送先電話番号",'phone',10,9],//Số điện thoại
                ["郵便番号",'zipcode',9,9],//Mã bưu điện
                ["配送先都道府県",'province',14,9],//Tỉnh/TP
                ["配送先住所",'address',18,9],//Địa chỉ giao hàng
                ["配送先氏名",'fullname',18,9],//Họ tên người nhận
                ["品番",['product'=>['product_id','code']],10,9],//H
                ["商品名",['product'=>['product_name','title']],18,9],//I
                ["単価",'price',15,9],//Giá nhập
                ["数量",'count',15,9],//SL
                ["到着希望日",'order_date',15,9],//Ngày nhận
                ["配送希望時間帯",'order_hours',15,9],//Giờ nhận
                ["送料",'order_ship',15,9],//Phí ship
                ["仕入金額",'order_total_price',15,9],//Giá bán
                ["振込み金額",'order_total_price_buy',15,9],//Giá bán
                ["手数料",'order_ship_cou',15,9],
                ["余分金",'order_price',15,9],
                ["追跡番号",'order_tracking',15,9],
                ["振込み情報",'order_info',25,9],
            ];
            $nameColList = [];

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

            $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).$start)->applyFromArray( $style_header );
//            $ship = 34;
//            $datas = [];
//            $company = "22";
//            $orders = [
//
//            ];
            $start++;
            $columns_value = array_flip($datas['columns']);
            $products =  DB::table('shop_product')->get()->keyBy('id')->all();

            foreach ($datas['datas'] as $key=>$values){
                $payMethod = (isset($columns_value['payMethod'])?$values[$columns_value['payMethod']]:"");

                if(empty($values[$nameColList['fullname']])){
                    continue;
                }
                if($typeMethod != $this->getValuePayMethod($payMethod)){
                    continue;
                }

                $image =  (isset($columns_value['image'])?$values[$columns_value['image']]:"");

                $order_info =  (isset($columns_value['order_info'])?$values[$columns_value['order_info']]:"");
                $images[] = [$image,$order_info];

                foreach($colums as $key1=>$value){
                    $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key1+1);
                    if(is_array($value[1])){
                        if(isset($value[1]['product'])){
                            $conf = $value[1]['product'];
                            $id = (isset($columns_value[$conf[0]])?$values[$columns_value[$conf[0]]]:"");
                            $_val = "";
                            if(isset($products[$id]) && property_exists($products[$id],$conf[1])){
                                $_val = $products[$id]->{$conf[1]};
                            }
                            $sheet->setCellValue($nameCol.$start,$_val);
                        }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                            $conf = $value[1]['callback'];
                            $_val = call_user_func_array($conf,[$start,(isset($columns_value[$value[1]['key']])?$values[$columns_value[$value[1]['key']]]:""),$nameCol.$start]);
                            $sheet->setCellValue($nameCol.$start,$_val);
                        }
                    }else{
                        $v = (isset($columns_value[$value[1]])?$values[$columns_value[$value[1]]]:"");
                        $sheet->setCellValue($nameCol.$start,$v);
                        if($value[1] == "payMethod"){
                            $payMethod = $v;
                        }
                    }
                }
                if($payMethod == "銀行振込"){
                    $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                        'font'  => array(
//                        'size'  => 9,
                            'name' => 'Times New Roman',
                            'color' => array('rgb' => '0070c0'),
                        ),
                    ) );
                }else  if($payMethod == "決済不要"){
                    $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                        'font'  => array(
//                        'size'  => 9,
                            'name' => 'Times New Roman',
                            'color' => array('rgb' => 'ff0000'),
                        ),
                    ) );
                }
                $start++;
            }
            if($typeMethod == 0){
//                $start+=2;
//                $sheet->setCellValue('N'.$start, '合計');
//                $sheet->setCellValue('P'.$start, '合計代引き金額：　19330');

//                $sheet->getStyle('N'.$start)->applyFromArray(array(
//                        'font'  => array(
//                            'size'  => 9,
//                            'name' => 'Times New Roman',
//                            'color' => array('rgb' => 'ff1100'),
//                        ),
//                    )
//                );
//                $sheet->getStyle('P'.$start)->applyFromArray(array(
//                        'font'  => array(
//                            'size'  => 9,
//                            'name' => 'Times New Roman',
//                            'color' => array('rgb' => 'ff1100'),
//                        ),
//                    )
//                );
                $start++;
                $sheet->setCellValue('I'.$start, '※1キロずつの小分けをお願いします。');
                $sheet->getStyle('I'.$start)->applyFromArray(array(
                        'font'  => array(
                            'size'  => 9,
                            'name' => 'Times New Roman',
                            'color' => array('rgb' => 'ff1100'),
                        ),
                    )
                );
            }
            $start+=1;
            $dataRow = [];
        }

        $writer = new Xlsx($spreadsheet);

        $path = '/uploads/exports/'.str_replace(__CLASS__.'::',"",__METHOD__);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }

        $path = $path.'/'.date('Y-m-d',$this->date);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }

        $filename ='株式会社コギ家-様-'.date('m',$this->date).'月'.date('d',$this->date).'日注文分';

        $path = $path.'/'.$filename;
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path2 = $path.'/'.$filename.'.xlsx';
        $writer->save(public_path().$path2);
        $files = [
            [$filename.'.xlsx',public_path().$path2]
        ];
        foreach ($images as $image){

            if(!empty($image[0]) && file_exists(public_path()."/".$image[0])){

                $pathinfo = pathinfo(public_path()."/".$image[0]);

                if(empty($image[1])){
                    $file_image = $pathinfo['filename'].'.'.$pathinfo['extension'];
                }else{
                    $file_image = $image[1].'.'.$pathinfo['extension'];
                }
                $newName = $path .'/'. $file_image;
                $this->file->copy(public_path()."/".$image[0],public_path().'/'.$newName );
                $files[] = [
                    $file_image,public_path().'/'.$newName
                ];
            }
        }
        $zipFileName = $filename.'.zip';
        $zip = new \ZipArchive();
        if($this->file->exists(public_path().'/'.$path . '/' . $zipFileName)){
            $this->file->delete(public_path().'/'.$path . '/' . $zipFileName);
        }
        if ($zip->open(public_path().'/'.$path . '/' . $zipFileName, \ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file){
                $zip->addFile($file[1],$file[0]);
            }

            $zip->close();
        }
        return ['link'=>url($path . '/' . $zipFileName),'images'=>$images];



    }
    public function KOGYJA($datas){

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

        $sheet->setCellValue('B1', '株式会社コギ家　様 注文フォーマット');


        $styleArray = array(
            'font'  => array(
                'size'  => 9,
                'name' => 'Times New Roman'
            ));
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
        $sheet->getStyle('B1')->applyFromArray($styleArray);
        $start=2;
        $products =  DB::table('shop_product')->get()->keyBy('id')->all();
        for($typeMethod = 1; $typeMethod < 3 ; $typeMethod++){
            $colums = [
                ["注文日",['callback'=>function($index,$date){return date("d", strtotime($date)).'日';},'key'=>'timeCreate'],10,9],//A
                ["支払区分",'payMethod',10,9],//Phương thức thanh toán
                ["配送先電話番号",'phone',10,9],//Số điện thoại
                ["郵便番号",'zipcode',9,9],//Mã bưu điện
                ["配送先都道府県",'province',14,9],//Tỉnh/TP
                ["配送先住所",'address',18,9],//Địa chỉ giao hàng
                ["配送先氏名",'fullname',18,9],//Họ tên người nhận
                ["品番",['product'=>['product_id','code']],10,9],//H
                ["商品名",['product'=>['product_name','title']],18,9],//I
                ["単価",'price',15,9],//Giá nhập
                ["数量",'count',15,9],//SL
                ["到着希望日",'order_date',15,9],//Ngày nhận
                ["配送希望時間帯",'order_hours',15,9],//Giờ nhận
                ["送料",'order_ship',15,9],//Phí ship
                ["梱包材",'total_count',15,9],//Tổng giá nhập
                ["仕入金額",'order_total_price',15,9],//Giá bán
                ["振込み金額",'order_total_price_buy',15,9],//Giá bán
                ["手数料",'order_ship_cou',15,9],
                ["余分金",'order_price',15,9],
                ["追跡番号",'order_tracking',15,9],
                ["振込み情報",'order_info',25,9],
            ];
            $nameColList = [];
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

            $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).$start)->applyFromArray( $style_header );
//            $ship = 34;
//            $datas = [];
//            $company = "22";
//            $orders = [
//
//            ];
            $start++;
            $columns_value = array_flip($datas['columns']);
            $images = [];
            foreach ($datas['datas'] as $key=>$_values){
                $type = ((isset($columns_value['type'])?$_values[$columns_value['type']]:""));

                if($type == "Info"){
                    $pay_Method = $this->getValuePayMethod(isset($columns_value['payMethod'])?$_values[$columns_value['payMethod']]:"");
                    $image =  (isset($columns_value['image'])?$_values[$columns_value['image']]:"");
                    $order_info =  (isset($columns_value['order_info'])?$_values[$columns_value['order_info']]:"");
                    $images[] = [$image,$order_info];
                    if($pay_Method == $typeMethod){

                        $startRow = $start;
                        $endRow = $key;
                        $count = 0;
                        for($i = $key ; $i<count($datas['datas']) ; $i++){
                            $count++;
                            $values = $datas['datas'][$i];
                            $oke = true;
                            $type =  (isset($columns_value['type'])?$values[$columns_value['type']]:"");



                            foreach($colums as $key1=>$value){
                                $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key1+1);
                                $oke  = true;
                                if(false) {
                                    $oke = false;
                                }else{
                                    if(is_array($value[1])){
                                        if(isset($value[1]['product'])){
                                            $conf = $value[1]['product'];
                                            $id = (isset($columns_value[$conf[0]])?$values[$columns_value[$conf[0]]]:"");
                                            $_val = "";
                                            if(isset($products[$id]) && property_exists($products[$id],$conf[1])){
                                                $_val = $products[$id]->{$conf[1]};
                                            }
                                        }else if(isset($value[1]['callback']) && isset($value[1]['key'])){
                                            $conf = $value[1]['callback'];
                                            $_val = call_user_func_array($conf,[$start,(isset($columns_value[$value[1]['key']])?$values[$columns_value[$value[1]['key']]]:""),$nameCol.$start]);
                                            if($value[1]['key'] == "timeCreate" && $type != "Info"){
                                                $_val = "";
                                            }
                                        }

                                        $sheet->setCellValue($nameCol.$start,$_val);
                                    }else{
                                        if($type == "Footer"){
                                            if(!($value[1]=="count" || $value[1]=="order_price" || $value[1] == "order_total_price") ) continue;
                                            $sheet->getStyle($nameCol.$start)->applyFromArray( array(
                                                'font'  => array(
                                                    'size'  => 9,
                                                    'name' => 'Times New Roman',
                                                    'color' => array('rgb' => 'ff0000'),
                                                ),
                                            ) );
                                        }

                                        $v = (isset($columns_value[$value[1]])?$values[$columns_value[$value[1]]]:"");

                                        if($value[1] == "payMethod"){
                                            $payMethod = $v;
                                        }

                                        $sheet->setCellValue($nameCol.$start,$v);
                                    }
                                }
                            }
                            if($oke){
                                if($pay_Method == "銀行振込"){
                                    $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                                        'font'  => array(

                                            'name' => 'Times New Roman',
                                            'color' => array('rgb' => '0070c0'),
                                        ),
                                    ) );
                                }else  if($payMethod == "決済不要"){
                                    $sheet->getStyle('A'.$start.':'. PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).''.$start)->applyFromArray( array(
                                        'font'  => array(

                                            'name' => 'Times New Roman',
                                            'color' => array('rgb' => 'ff0000'),
                                        ),
                                    ) );
                                }
                                $start++;
                            }
                            if($type == "Footer"){
                                break;
                            }
                        }
                        if($startRow != $start){
                            $_1 = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($nameColList["product_id"]+1).$startRow;
                            $_2 =  PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($nameColList["count"]+1).($start-2);
                            $sheet->getStyle($_1.':'.$_2)->applyFromArray(   array(

                                'borders' => [
                                    'allBorders' => array(
                                        'borderStyle' => Border::BORDER_DOTTED,
                                        'color' => array('rgb'=>'000000')
                                    ),
                                ],
                                'font' => array(
                                    'color' => array('rgb' => '0070c0'),
                                )
                            ) );
                            foreach (["timeCreate","fullname","payMethod",'zipcode','province','address','phone','order_date','order_hours'] as $col){
                                $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($nameColList[$col]+1);
                                $spreadsheet->getActiveSheet()->mergeCells($nameCol.$startRow.":".$nameCol.($start-2));
                                $styleArray = [
                                    'alignment' => [
                                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                    ],
                                ];
                                $spreadsheet->getActiveSheet()->getStyle($nameCol.$startRow)->applyFromArray($styleArray);
                            }
                        }
                    }
                }
            }
            if($typeMethod == 0){
//                $start+=2;
//                $sheet->setCellValue('N'.$start, '合計');
//                $sheet->setCellValue('P'.$start, '合計代引き金額：　19330');

//                $sheet->getStyle('N'.$start)->applyFromArray(array(
//                        'font'  => array(
//                            'size'  => 9,
//                            'name' => 'Times New Roman',
//                            'color' => array('rgb' => 'ff1100'),
//                        ),
//                    )
//                );
//                $sheet->getStyle('P'.$start)->applyFromArray(array(
//                        'font'  => array(
//                            'size'  => 9,
//                            'name' => 'Times New Roman',
//                            'color' => array('rgb' => 'ff1100'),
//                        ),
//                    )
//                );
                $start++;
                $sheet->setCellValue('I'.$start, '※1キロずつの小分けをお願いします。');
                $sheet->getStyle('I'.$start)->applyFromArray(array(
                        'font'  => array(

                            'name' => 'Times New Roman',
                            'color' => array('rgb' => 'ff1100'),
                        ),
                    )
                );
            }
            $start+=1;
            $dataRow = [];
        }
        $writer = new Xlsx($spreadsheet);

        $path = '/uploads/exports/'.str_replace(__CLASS__.'::',"",__METHOD__);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path = $path.'/'.date('Y-m-d',$this->date);
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $filename = '株式会社クリチク-様-'.date('m',$this->date).'月'.date('d',$this->date).'日注文分';


        $path = $path.'/'.$filename;
        if( !$this->file->isDirectory(public_path().$path)){
            $this->file->makeDirectory(public_path().$path);
        }
        $path2 = $path.'/'.$filename.'.xlsx';
        $writer->save(public_path().$path2);
        $files = [
            [$filename.'.xlsx',public_path().$path2]
        ];
        foreach ($images as $image){

            if(!empty($image[0]) && file_exists(public_path()."/".$image[0])){

                $pathinfo = pathinfo(public_path()."/".$image[0]);

                if(empty($image[1])){
                    $file_image = $pathinfo['filename'].'.'.$pathinfo['extension'];
                }else{
                    $file_image = $image[1].'.'.$pathinfo['extension'];
                }
                $newName = $path .'/'. $file_image;
                $this->file->copy(public_path()."/".$image[0],public_path().'/'.$newName );
                $files[] = [
                    $file_image,public_path().'/'.$newName
                ];
            }
        }
        $zipFileName = $filename.'.zip';
        $zip = new \ZipArchive();
        if($this->file->exists(public_path().'/'.$path . '/' . $zipFileName)){
            $this->file->delete(public_path().'/'.$path . '/' . $zipFileName);
        }
        if ($zip->open(public_path().'/'.$path . '/' . $zipFileName, \ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file){
                $zip->addFile($file[1],$file[0]);
            }

            $zip->close();
        }
        return ['link'=>url($path . '/' . $zipFileName),'images'=>$images];
    }
}