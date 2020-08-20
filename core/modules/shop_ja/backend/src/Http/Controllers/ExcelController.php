<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\OrderModel;
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
        $sheet->getStyle('B1')->applyFromArray($styleArray);
        $sheet->getStyle('F2')->applyFromArray($styleArray);
        $sheet->getStyle('P2')->applyFromArray(array(
            'font'  => array(
                'size'  => 9,
                'name' => 'Times New Roman',
                'color' => array('rgb' => '0070c0'),
            )));
        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path().'/uploads/exports/hello-world.xlsx');
    }
}
