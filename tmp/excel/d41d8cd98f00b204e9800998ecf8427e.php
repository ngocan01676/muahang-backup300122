<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Ho_Chi_Minh"); 
$card_oke = [];
$card_exits = [];
$info = [];
include __DIR__."/../db.php";
function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}
if(isset($_POST["submit"])){
 
	$filename = "";
	if($_FILES['file']['name'] != NULL){ // Đã chọn file
			$path = "data/"; // file sẽ lưu vào thư mục data
			$tmp_name = $_FILES['file']['tmp_name'];
			$name = $_FILES['file']['name'];
			$name = preg_replace('/\s+/', '_', $name);
			$type = $_FILES['file']['type']; 
			$size = $_FILES['file']['size']; 
			$filename = $path.time()."-".$name;
			move_uploaded_file($tmp_name,$filename);
	   }else{
			echo "Vui lòng chọn file";
	   }
	if(file_exists($filename)){
		require_once 'PHPExcel/Classes/PHPExcel.php';
		
		//$filename = 'data/50_THE_VTEL_50K_1_04_04.xls';
		$inputFileType = PHPExcel_IOFactory::identify($filename);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		 
		$objReader->setReadDataOnly(true);
		 
		/**  Load $inputFileName to a PHPExcel Object  **/
		$objPHPExcel = $objReader->load("$filename");
		 
		$total_sheets=$objPHPExcel->getSheetCount();
		 
		$allSheetName=$objPHPExcel->getSheetNames();
		$objWorksheet  = $objPHPExcel->setActiveSheetIndex(0);
		$highestRow    = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		$arraydata = array();
		for ($row = 2; $row <= $highestRow;++$row)
		{
			if(($row-2)==0){
				continue;
			}
			for ($col = 0; $col <$highestColumnIndex;++$col)
			{
				$value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
				$arraydata[$row-2][$col]=$value;
			}
			$Card = ORM::forTable("Card");
			$a = $Card->where("seri",trim($arraydata[$row-2][3]))
					  ->where("code",trim($arraydata[$row-2][2]))
					  ->where("telco",trim($arraydata[$row-2][0]))
					  ->where("price",trim($arraydata[$row-2][1]))
					  ->findMany();
			if($a){
				$card_exits[] = $arraydata[$row-2];
			}else{
				$card_oke[] = $arraydata[$row-2];
				$Card = ORM::forTable("Card")->create();
				$Card->set([
					"seri"=>trim($arraydata[$row-2][3]),
					"code"=>trim($arraydata[$row-2][2]),
					"telco"=>trim($arraydata[$row-2][0]),
					"price"=>trim($arraydata[$row-2][1]),
					"card_date"=>$arraydata[$row-2][4],
					"pay_name"=>$filename,
					"status"=>1,
					"tran_id"=>($row-2),
					"create_time"=>date("Y-m-d H:i:s"),
				]);
				$Card->save();
			}
		}
		header('Location: '.full_url($_SERVER));die;
	}
}else if(isset($_POST["check"])){
	$Card = ORM::forTable("Card");
	
	if(isset($_POST['seri']) && !empty($_POST['seri'])){
		$Card = $Card->where("seri",trim($_POST['seri']));
	}
	if(isset($_POST['number']) && !empty($_POST['number'])){
		$Card = $Card->where("code",trim($_POST['number']));

	}
	$info = [];
	if(isset($_POST['number']) && !empty($_POST['number']) || isset($_POST['seri']) && !empty($_POST['seri']) ){
		$info = $Card->findMany();
	}
}else if(isset($_POST["delete"])){
	 
	$Card = ORM::forTable("Card");
	$Card = $Card->where("id",trim($_POST['id']));
	$info = $Card->findMany();
	if(isset($info[0]) && count($info) == 1){
		$person = ORM::for_table('Card')
			->where_equal('pay_name', $info[0]['pay_name'])
			->delete_many(); 
	}
}
 $array = ["10000","20000","50000","100000","200000","500000"];
 $telcos = ["VTT","VMS","VNP"];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>BomH</title>
  </head>
  <body>
  <div class="container1" style="padding:10px">
  <BR>
	<BR>
	<form action="" method="post" enctype="multipart/form-data">
		Select file card:
		<input type="file" name="file" id="file">
		<input type="submit" value="Upload File" name="submit">
	</form>
	<BR>
	
	<form action="" method="post">
		Seri:
		<input type="text" name="seri" >
		Number:
		<input type="text" name="number" >
		<input type="submit" value="Kiểm tra" name="check">
	</form>
	
	<?php if(isset($info[0]) && count($info) >0):?>
		<table style="width:100%">
		  <tr>
			<th>seri</th>
			<th>code</th>
			<th>telco</th>
			<th>price</th>
			<th>file name</th>
			<th>status</th> 
			<th>create_time</th>
			<th>pay_tran_id</th>
			<th>time_approval</th>
			<th>Action</th>
		  </tr>
		  <?php foreach($info as $value): ?>
		  <tr>
			<td><?php echo $value['seri']; ?></td>
			<td>********<?php echo substr($value['code'],8); ?></td>
			<td><?php echo $value['telco']; ?></td>
			<td><?php echo $value['price']; ?></td>
			<td><?php echo $value['pay_name']; ?></td>
			<td><?php echo $value['status']; ?></td>
			<td><?php echo $value['create_time']; ?></td>
			<td><?php echo $value['pay_tran_id']; ?></td>
			<td><?php echo $value['time_approval']; ?></td>
			<td>
			<?php if(isset($_POST['seri']) && !empty($_POST['seri']) &&isset($_POST['number']) && !empty($_POST['number'])):  ?>
				<form action="" method="post"><input type="hidden" value="<?php echo $value['id'] ?>" name="id"/> <button type="submit" name="delete">Xóa file thẻ</button></form>
			<?php else:?>
				
			<?php endif;?>	
			</td>
		  </tr>
		 <?php endforeach;?>
		</table>
		<?php  elseif(isset($_POST["check"])):?>
		không tồn tại seri này ở kho
	<?php endif;?>
	<BR>
	
	<?php $date =  date("Y-m-d"); ?>
	<div class="row">
		<div class="col col-md-12">
				<table class="table table-striped">
				<?php foreach($telcos as $val): ?>
				<tr>
					<td class="text-center"><?php echo $val; ?> Bomh</td>
				</tr>
				<tr>
					<td>
					<table class="table table-striped">
						<tr>
							<td>Mệnh giá</td>
							<td>Chưa dùng</td>
							<td>Đã dùng</td>
							<td>Tổng</td>
							
							
						</tr>
						<?php foreach($array as $price): 
						 $Card_1 = ORM::forTable("Card")->where("telco",$val)->where("price",$price)->where("status",1)->count();
						 $Card_0 = ORM::forTable("Card")->where("telco",$val)->where("price",$price)->where("status",0)->count();
						 //where_gte >= where_lte <=
						 $Card_Count = ORM::forTable("Card")
						 ->where("telco",$val)
						 ->where("price",$price)
						 ->where_gte("create_time",$date." 00:00:00")
						 ->where_lte("create_time",$date." 23:59:59")
						 ->count();
						 		
						 
						?>
						<tr>
							<td><?php echo number_format($price); ?></td>
							<td><?php echo $Card_1; ?></td>
							<td><?php echo $Card_0; ?></td>
							<td><?php echo ($Card_1+$Card_0); ?></td>
							<td><?php echo $Card_Count; ?></td>
						</tr>
						<?php endforeach; ?>
					 </table>
					</td>
				</tr>
				<?php endforeach; ?>
			 </table>
		</div>
	</div>
	</div>
	<?php 
	/*echo "<pre>";
	 echo "Thêm thành công!";
	 print_r($card_oke);
	 echo "</pre>";
	 echo "<pre>";
	 echo "đã tồn tại!";
	 print_r($card_exits);
	 echo "</pre>";*/
	?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
 
