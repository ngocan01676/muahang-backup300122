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
            ["注文日",0,9],
            ["支払区分",15,9],
            ["配送先電話番号",15,9],
            ["配送先郵便番号",15,9],
            ["配送先都道府県",40,9],
            ["配送先住所",18,9],
            ["配送先氏名",18,9],
            ["品番",15,9],
            ["商品名",18,9],
            ["単価",15,9],
            ["数量",15,9],
            ["到着希望日",15,9],
            ["配送希望時間帯",15,9],
            ["別途送料",15,9],
            ["仕入金額",15,9],
            ["代引き請求金額",15,9],
            ["代引き手数料",15,9],
            ["紹介料",15,9],
            ["追跡番号",15,9],
            ["振込み情報",15,9],
        ];
        foreach($colums as $key=>$value){
            $nameCol = PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key+1);

            $sheet->setCellValue($nameCol.'3', $value[0])->getStyle($nameCol.'3')->applyFromArray(array(
                    'font'  => array(
                        'size'  => $value[2]
                    ),
                )
            );
            if($value[1] > 0){
                $spreadsheet->getActiveSheet()->getColumnDimension($nameCol)->setWidth($value[1]);
            }
        }
        $datas = [
            [
                "date"=>"23日",
                "payment"=>"Thanh toán khi giao hàng",
                "phone"=>"070-1398-2234",
                "code"=>"733-0012",
                "noun"=>"広島県",
                "address"=>"広島市西区中広町３丁目１−４０-404号",
                "fullname"=>"VUONG VAN NGHI",
                "product_id"=>"ヤマダ 03",
                "product_name"=>"新米入り業務用精白米近江ブレンド25 kg",
                "price"=>7000,
                "count"=>2,
                "receive_date"=>"3/25/2020",
                "receive_hour"=>"19:00～21:00",
                "shipping_fee1"=>"",
                "sum_price"=>"",
                "sum_price_buy"=>"",
                "shipping_fee2"=>"",
                "cash_win"=>"",
                "tracking"=>"",
                "info"=>""
            ],
            [
                "date"=>"23日",
                "payment"=>"Thanh toán khi giao hàng",
                "phone"=>"070-1398-2234",
                "code"=>"733-0012",
                "noun"=>"広島県",
                "address"=>"広島市西区中広町３丁目１−４０-404号",
                "fullname"=>"VUONG VAN NGHI",
                "product_id"=>"ヤマダ 03",
                "product_name"=>"新米入り業務用精白米近江ブレンド25 kg",
                "price"=>7000,
                "count"=>1,
                "receive_date"=>"3/25/2020",
                "receive_hour"=>"19:00～21:00",
                "shipping_fee1"=>"",
                "sum_price"=>"",
                "sum_price_buy"=>"",
                "shipping_fee2"=>"",
                "cash_win"=>"",
                "tracking"=>"",
                "info"=>""
            ]
        ];

        $start=4;
        $i = $start;
        $lastIndex = "";

        foreach($datas as $key=>$values)
        {
            $j = 0;
            foreach($values as $_key=>$value){
                $j++;
               $_key =  PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($j);
                if($_key=="sum_price"){
                    $sheet->setCellValue($_key.$i,$datas[$key]["price"] * $datas[$key]["count"]);
                }else if($_key=="sum_price_buy"){
                    $sheet->setCellValue($_key.$i,$datas[$key]["price"] * $datas[$key]["count"]);
                }else if($_key=="shipping_fee2"){
                    $_val = 0;
                    if($datas[$key]["price"]<10000){
                        $_val = 330;
                    }else if($datas[$key]["price"]>=10000 && $datas[$key]["price"]<30000){
                        $_val = 440;
                    }else if( $datas[$key]["price"]>=30000){
                        $_val = 660;
                    }else if( $datas[$key]["price"]>=100000){
                        $_val = 1080;
                    }
                    $sheet->setCellValue($_key.$i,$_val);
                }else if($_key=="cash_win"){
                    $cash_win = 0;
                    $sheet->setCellValue($_key.$i,'=IF(J'.$i.'="","",P'.$i.'-J'.$i.'*K'.$i.'-N'.$i.'-Q'.$i.')');
                }else{
                    $sheet->setCellValue($_key.$i, $value);
                }
            }
            $sheet->getStyle('A'.$i.':'.PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colums)).$i)->applyFromArray(array(
                    'font'  => array(
                        'size'  => 9
                    ),
                )
            );
            $end = $i;
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path().'/uploads/exports/hello-world.xlsx');
    }
}
