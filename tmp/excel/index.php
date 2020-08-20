<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
/** Include PHPExcel */
require_once 'PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel(); // Create new PHPExcel object
$objPHPExcel->getProperties()->setCreator("Sigit prasetya n")
 ->setLastModifiedBy("Sigit prasetya n")
 ->setTitle("Creating file excel with php Test Document")
 ->setSubject("Creating file excel with php Test Document")
 ->setDescription("How to Create Excel file from PHP with PHPExcel 1.8.0 Classes by seegatesite.com.")
 ->setKeywords("phpexcel")
 ->setCategory("Test result file");

$title1 = "株式会社ヤマダ 様 注文フォーマット";
$title2 = "見本";

$default_border = array(
    'style' => PHPExcel_Style_Border::BORDER_THIN,
    'color' => array('rgb'=>'1006A3')
);
$style_header = array(
    'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'FFFF00'),
    ),
    'font' => array(
		'size' => 10,
		'name' => 'Times New Roman'
    )
);
$style_content = array(
    'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'eeeeee'),
    ),
    'font' => array(
		'size' => 10,
		'name' => 'Times New Roman'
    )
);
$col = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
// Create Header
$colums = [
	"ngày đặt hàng",
	"Phương thức thanh toán",
	"Số điện thoại",
	"Mã bưu điện",
	"Tỉnh/TP",
	"Địa chỉ giao hàng",
	"Họ tên người nhận",
	"Mã SP",
	"Tên SP",
	"Giá nhập",
	"SL",
	"Ngày nhận",
	"Giờ nhận",
	"Phí ship",
	"Tổng giá nhập",
	"Giá bán",
	"Phí giao hàng",
	"Lợi nhuận",
	"Mã tracking",
	"Thông tin chuyển khoản"
];
$info = "依頼人名. VO HOANG 様 22日に 7410 円入金済み";

$ActiveSheetIndex = $objPHPExcel->setActiveSheetIndex(0);

$ActiveSheetIndex->setCellValue('B1', $title1);
$ActiveSheetIndex->setCellValue('F2', $title2);
$ActiveSheetIndex->setCellValue('P2', $info);

$styleArray = array(
    'font'  => array(
        'size'  => 9,
        'name' => 'Times New Roman'
    ));
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('P2')->applyFromArray(array(
    'font'  => array(
        'size'  => 9,
        'name' => 'Times New Roman',
		'color' => array('rgb' => '0070c0'),
)));
$i=0;
foreach($colums as $key=>$value){
	$ActiveSheetIndex->setCellValue($col[$i].'3', $colums[$i]);

	$i++;
}
$objPHPExcel->getActiveSheet()->getStyle('P3')->applyFromArray(array(
    'font'  => array(
		'color' => array('rgb' => 'FF0000'),
)));
$objPHPExcel->getActiveSheet()->getStyle('A3:V3')->applyFromArray( $style_header ); // give style to header


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
$i= $start;
$lastIndex = "";
foreach($datas as $key=>$values)
{
	$j = 0;
	foreach($values as $_key=>$value){
		if($_key=="sum_price"){
			$ActiveSheetIndex->setCellValue($col[$j].$i,$datas[$key]["price"]* $datas[$key]["count"]);
		}else if($_key=="sum_price_buy"){
			$ActiveSheetIndex->setCellValue($col[$j].$i,$datas[$key]["price"]* $datas[$key]["count"]);
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
			$ActiveSheetIndex->setCellValue($col[$j].$i,$_val);
		}else if($_key=="cash_win"){
			$cash_win = 0;
			$ActiveSheetIndex->setCellValue($col[$j].$i,'=IF(J'.$i.'="","",P'.$i.'-J'.$i.'*K'.$i.'-N'.$i.'-Q'.$i.')');
		}else{
			$ActiveSheetIndex->setCellValue($col[$j].$i, $value);
		}

		$j++;
	}
	$i++;
	$end = $i;
}
$ActiveSheetIndex->setCellValue("P".$end,'=SUM(P'.$start.':P'.($end-1).')');
$ActiveSheetIndex->setCellValue("K".$end,'=SUM(K'.$start.':K'.($end-1).')');
//$objPHPExcel->getActiveSheet()->getStyle($firststyle.':'.$laststyle)->applyFromArray( $style_content ); // give style to header

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Product');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="listproduct.xls"'); // file name of excel
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
