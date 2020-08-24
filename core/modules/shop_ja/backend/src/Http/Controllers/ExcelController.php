<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\OrderModel;
use \PhpOffice\PhpSpreadsheet;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ExcelController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {

    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý đơn hàng"), route('backend:shop_ja:order:list'));
        return $this;
    }
    public function list(){
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

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
            ["注文日",'dateCreate',10,9],
            ["支払区分",'payMethod',10,9],
            ["配送先電話番号",'phone',10,9],
            ["配送先郵便番号",'postal_code',9,9],
            ["配送先都道府県",'city',14,9],
            ["配送先住所",'address',18,9],
            ["配送先氏名",'fullname',18,9],
            ["品番",['product_id','code'],10,9],
            ["商品名",['product_id','title'],18,9],
            ["単価",['product_id','price'],15,9],
            ["数量",'count',15,9],
            ["到着希望日",'day_ship',15,9],
            ["配送希望時間帯",'time_ship',15,9],
            ["別途送料",'phone',15,9],
            ["仕入金額",'phone',15,9],
            ["代引き請求金額",'phone',15,9],
            ["代引き手数料",'phone',15,9],
            ["紹介料",'phone',15,9],
            ["追跡番号",'phone',15,9],
            ["振込み情報",'phone',15,9],
        ];
        $start=3;
        foreach($colums as $key=>$value){
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);

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
        $lastIndex = "";
        $datas = [];
        $ship = "Yamato";
        $orders = [

        ];
        $products =  DB::table('shop_product')->get()->keyBy('id')->all();
        $results =  DB::table('shop_order')->where('status',2)->get()->all();
            foreach ($results as $result){
               $row = [
                   'info'=>$result
               ];
               $row['detail'] =  DB::table('shop_order_detail')
                   ->where('order_id',$result->id)->where('ship',$ship)->get()->toArray();
               if(count($row['detail']) > 0 ){
                   $datas[] = $row;
                   $orders[$result->id] = count($row['detail']);
               }
            }
        echo "<pre>";

            print_r($products);
        print_r($orders);
        print_r($datas);

        //支払い方法 Phương thức thanh toán
        //代金引換 Thanh toán khi giao hàng 1
        // 銀行振込 Chuyển khoản ngân hàng 2
        // 決済不要 Không cần thanh toán 3
        $category = config_get("category", "shop-ja:japan:category");
        print_r($category);
        foreach ($datas as $info){
            $j = 1;
            $_tmpData = [
                'dateCreate'=>date('d',strtotime($info['info']->created_at))."日",
                'payMethod'=>$info['info']->pay_method,
                'phone'=>$info['info']->phone,
                'postal_code'=>$info['info']->postal_code,
                'city'=>$info['info']->city,
                'address'=>$info['info']->address,
                'fullname'=>$info['info']->fullname,
                'day_ship'=>date('d/m/Y',strtotime($info['info']->day_ship)) ,
                'time_ship'=>$info['info']->time_ship,
            ];
            if($info['info']->pay_method == 1){
                $_tmpData['payMethod'] = '代金引換';
            }else  if($info['info']->pay_method == 2){
                $_tmpData['payMethod'] = '銀行振込';
            }else{
                $_tmpData['payMethod'] = '決済不要';
            }
            foreach ($category as $_category){
                if($_category['id'] ==$info['info']->city ){
                    $_tmpData['city'] =$_category['name']; break;
                }
            }
            foreach($info['detail'] as $_=>$_value){
                foreach($colums as $key=>$value){
                    $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);
                    if(is_array($value[1])){
                        if(property_exists($_value,$value[1][0])){
                            $_val  = "";
                            if("product_id" == $value[1][0]){
                                $_key = $_value->{$value[1][0]};
                                if(isset($products[$_key]) && property_exists($products[$_key],$value[1][1])){
                                    $_val =$products[$_key]->{$value[1][1]};

                                }
                            }else{

                            }
                            $sheet->setCellValue($nameCol.$start,$_val);
                        }
                    }else{
                        if(isset($_tmpData[$value[1]])){
                            $sheet->setCellValue($nameCol.$start,$_tmpData[$value[1]]);
                        }else{
                            $val = $_value->{$value[1]};

                            $sheet->setCellValue($nameCol.$start, $val);
                        }
                    }
                }
                $start++;
            }
        }
//        foreach($datas as $key=>$values)
//        {
//            $j = 0;
//            foreach($values as $_key=>$value){
//                $j++;
//                $_key =  PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($j);
//
////                if($_key=="sum_price"){
////                    $sheet->setCellValue($_key.$i,$datas[$key]["price"] * $datas[$key]["count"]);
////                }else if($_key=="sum_price_buy"){
////                    $sheet->setCellValue($_key.$i,$datas[$key]["price"] * $datas[$key]["count"]);
////                }else if($_key=="shipping_fee2"){
////                    $_val = 0;
////                    if($datas[$key]["price"]<10000){
////                        $_val = 330;
////                    }else if($datas[$key]["price"]>=10000 && $datas[$key]["price"]<30000){
////                        $_val = 440;
////                    }else if( $datas[$key]["price"]>=30000){
////                        $_val = 660;
////                    }else if( $datas[$key]["price"]>=100000){
////                        $_val = 1080;
////                    }
////                    $sheet->setCellValue($_key.$i,$_val);
////                }else if($_key=="cash_win"){
////                    $cash_win = 0;
////                    $sheet->setCellValue($_key.$i,'=IF(J'.$i.'="","",P'.$i.'-J'.$i.'*K'.$i.'-N'.$i.'-Q'.$i.')');
////                }else{
////                    $sheet->setCellValue($_key.$i, $value);
////                }
//            }
//            $sheet->getStyle('A'.$i.':'.PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).$i)->applyFromArray(array(
//                    'font'  => array(
//                        'size'  => 9
//                    ),
//                )
//            );
//            $end = $i;
//            $i++;
//        }

       $writer = new Xlsx($spreadsheet);
       $writer->save(public_path().'/uploads/exports/hello-world.xlsx');
    }
}
