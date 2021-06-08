<?php
namespace BetoGaizinTheme\Lib;
use Illuminate\Support\Facades\DB;

class PriceAction{
    public $data = [];

    public function __construct()
    {
        $categorys = config_get("category", "shop-ja:product:category");
        $names  = [];
        foreach($categorys as $category){
            if(!empty($company) && $company !=$category['name']){
                continue;
            }
            $names[] = $category['name'];

            $this->data['cate_id_to_name'][$category['id']] = $category['name'];

            $shop_products = DB::table('shop_product')->where('category_id',$category['id'])->orderBy('order_index',"desc")->get()->all();

            $this->data['products'][$category['name']] = [];

            try{
                foreach($shop_products as $shop_product){

                    $this->data['products'][$category['name']][$shop_product->id] =
                        [
                            'id' => $shop_product->id,
                            'name'=>$shop_product->description,
                            'image'=>$shop_product->image,
                            'title'=>$shop_product->title,
                            'group'=>$category['name'],
                            'data'=>(array) $shop_product
                        ];
                }
            }catch (\Exception $ex){

            }

        }
        $shop_ship = DB::table('shop_ship')->orderBy('value_end', 'ASC')->get()->all();
        $arr_ship = [];
        foreach ($shop_ship as $k=>$v){
            if(!isset($arr_ship["cate_".$v->category_id])){
                $arr_ship["cate_".$v->category_id] = [];
            }
            $v->config = json_decode($v->config,true);
            $arr_ship["cate_".$v->category_id][] =$v;
        }
        $this->data['ships'] = $arr_ship;
        $this->data['categorys'] = get_category_type('shop-ja:product:category');
        $this->data['daibiki'] = get_category_type('shop-ja:japan:category:com-ship');
    }
    function getValuePayMethod($val) {
        if($val === "代金引換") return 1;
        if($val === "銀行振込") return 2;
        if($val === "決済不要") return 3;
        return 0;
    }
    private function IF_End($val,$conf){
        $conf = (array)$conf;
        if( $conf['equal_end'] === "<=" && $val <= $conf['value_end']){
            return true;
        }else if( $conf['equal_end'] === ">=" && $val >= $conf['value_end']){
            return true;
        }else if($conf['equal_end'] === ">" && $val > $conf['value_end']){
            return true;
        } else if($conf['equal_end'] === "<" && $val < $conf['value_end']){
            return true;
        }else if($conf['equal_end'] === "=" && $val === $conf['value_end']){
            return true;
        }
        return false;
    }

    private function IF_Start($val,$conf){
        try{
            $conf = (array)$conf;
            if( $conf['equal_start'] === "<=" && $val <= $conf['value_start']){
                return true;
            }else if( $conf['equal_start'] === ">=" && $val >= $conf['value_start']){
                return true;
            }else if($conf['equal_start'] === ">" && $val > $conf['value_start']){
                return true;
            } else if($conf['equal_start'] === "<" && $val < $conf['value_start']){
                return true;
            }else if($conf['equal_start'] === "=" && $val == $conf['value_start']){
                return true;
            }
        }catch (\Exception $ex){
            var_dump($conf);
            echo $ex->getMessage();
            die();
        }
        return false;
    }
    public function prices($datas,$province = "北海道",$payment =  "代金引換"){
        $products_group = [];

        foreach ($datas as $key=>$value){
            if(!isset($products_group[$value['cate']])){
                $products_group[$value['cate']] = [
                    'products'=>[],
                    'name'=>$this->data['cate_id_to_name'][$value['cate']]
                ];

            }
            $products_group[$value['cate']]['products'][$value['id']] = $value;
        }
        $results = [
            "total_sum"=>0,
            "total_price"=>0,
            "total_ship"=>0,
            "total_cou"=>0,
            "sale"=>0,
            "products"=>[]
        ];

        foreach ($products_group as $key => $value){
            $pro = [];
            if($value['name'] == "YAMADA"){
                $pro = $this->YAMADA($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "KOGYJA"){
                $pro = $this->KOGYJA($key,$value,$province,$this->getValuePayMethod($payment));

            }
            if($value['name'] == "KURICHIKU"){
                $pro = $this->KURICHIKU($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "FUKUI"){
                $pro = $this->FUKUI($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "OHGA"){
                $pro = $this->OHGA($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "AMAZON"){
                $pro = $this->AMAZON($key,$value,$province,$this->getValuePayMethod($payment));
            }

            $results['total_sum']+=$pro['web_total_sum'];
            $results['total_ship']+=$pro['web_total_ship'];
            $results['total_cou']+=$pro['web_total_cou'];
            $results['products'][$value['name']] = $pro;
        }
        return $results;
    }
    public function AMAZON($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_price_buy'] = 0;
        $products['total_sum'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;

        $products['web_total_cou'] = 0;
        $products['web_total_sum'] = 0;
        $products['web_total_ship'] = 0;

        $products['profit'] = 0;

        $row = array_values($products['products']);
        $n = count($row);
        for ($key = $n-1;$key >= 0; $key--){
            //$products['products'] as $key=>$product
            $product = $row[$key];
            $id = $product['id'];
            if(isset($this->data['products']['AMAZON'][$product['id']])){

                $data_product =  ($this->data['products']['AMAZON'][$product['id']]);
                $count = $product['count'];
                $total_price_buy = $count * $data_product['data']['price_buy'];
                $total_price = $count * $data_product['data']['price'];

                $products['products'][$id]['web_total_price_buy'] = $total_price_buy;

                if($key == 0){
                    $total_price_buy += 330;
                    $products['web_total_cou'] = 330;
                }

                $products['products'][$id]['total_price_buy'] = $total_price_buy;

                $products['products'][$id]['total_price'] = $total_price;

                $products['total_price_buy']+=$products['products'][$id]['total_price_buy'];

                $arr_ship = [];

                $configShip =  isset($this->data['ships']["cate_".$product['cate']])?$this->data['ships']["cate_".$product['cate']]:[];

                $ship =  $this->data['categorys'][$product['cate']]?($this->data['categorys'][$product['cate']]->data['ship'])? $this->data['categorys'][$product['cate']]->data['ship']:"-1":"-1";

                foreach($configShip as $i => $val){

                    $is_IF_Start = $this->IF_Start($count,$configShip[$i]);
                    $is_IF_End =  $this->IF_End($count,$configShip[$i]);

                    if($is_IF_Start && $is_IF_End){
                        $conf  =  $configShip[$i]->config;
                        foreach ($conf as $ii=>$_val){
                            $val = $conf[$ii];
                            $arr = explode('-',$val['text']);
                            foreach ($arr as $iii=>$__val){
                                $v = $arr[$iii];
                                if($province == $v){
                                    $arr_ship[] = [$configShip[$i],$val];
                                }
                            }
                        }
                    }
                }

                $price_ship_default  = -1;
                $price_ship  = -1;
                foreach ($arr_ship as $i=>$val){
                    if($val[0]->unit == 0 && $price_ship_default==-1){
                        $price_ship_default =  $val[1]['value'];
                    }else if($val[0]->unit == $product->unit && $price_ship == -1){
                        $price_ship = $val[1]['value'];
                    }
                }
                $ship_cou = -1;
                if($key == 0){
                    if( $type == 2 || $type == 3 ){
                        $ship_cou = 0;
                    }else{
                        $datadaibiki = $this->data['daibiki'];
                        foreach ($datadaibiki as $i=>$_val){
                            if($ship == $_val->id){
                                foreach($_val->data as $units){
                                    foreach($units as $_unit){
                                        if($_unit){

                                            $is_IF_Start = $this->IF_Start($products['total_price_buy'],$_unit);
                                            $is_IF_End = $this->IF_End($products['total_price_buy'],$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = (int)$_unit['value'];
                                            }
                                        }
                                    }
                                }
                            }
                            if($ship_cou != -1){
                                break;
                            }
                        }
                    }

                }else{
                    $ship_cou = 0;

                }
                $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
                $ship_cou = $ship_cou == -1?0:$ship_cou;




                $products['products'][$id]['ship'] = $price_ship > -1?$price_ship*$count:-1;
                $products['products'][$id]['cou'] = $ship_cou;
                $products['products'][$id]['total_ship'] = $products['products'][$id]['ship'];
                $products['products'][$id]['total_sum_price']= $products['products'][$id]['total_price_buy']  + $products['products'][$id]['total_ship'];

                $products['products'][$id]['web_total_ship'] = 0;
                $products['products'][$id]['web_total_sum_price']= $products['products'][$id]['web_total_price_buy'] ;

                if($key == 0){
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        ($products['products'][$id]['total_ship'] < 0 ?0:$products['products'][$id]['total_ship']) - $products['products'][$id]['cou'];
                }else{
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        $products['products'][$id]['total_ship'];
                }

                $products['total_cou']+= $products['products'][$id]['cou'];
                $products['profit']+=$products['products'][$id]['profit'];
                $products['total_price']+= $products['products'][$id]['total_price'];
                $products['total_sum']+= $products['products'][$id]['total_sum_price'];
                $products['total_ship']+=$products['products'][$id]['ship'];

                $products['web_total_sum']+= $products['products'][$id]['web_total_sum_price'];
                $products['web_total_ship']+= $products['products'][$id]['web_total_ship'] > 0?$products['products'][$id]['web_total_ship']:0;
            }
        }

        return $products;
    }
    public function YAMADA($cate,$products,$province = "北海道",$type = 1){

        $products['total_price'] = 0;
        $products['total_price_buy'] = 0;
        $products['total_sum'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;

        $products['web_total_cou'] = 0;
        $products['web_total_sum'] = 0;
        $products['web_total_ship'] = 0;

        $products['profit'] = 0;

        $row = array_values($products['products']);
        $n = count($row);
        for ($key = $n-1;$key >= 0; $key--){
            //$products['products'] as $key=>$product
            $product = $row[$key];
            $id = $product['id'];
            if(isset($this->data['products']['YAMADA'][$product['id']])){

                $data_product =  ($this->data['products']['YAMADA'][$product['id']]);
                $count = $product['count'];
                $total_price_buy = $count * $data_product['data']['price_buy'];
                $total_price = $count * $data_product['data']['price'];

                $products['products'][$id]['web_total_price_buy'] = $total_price_buy;

                if($key == 0){
                    $total_price_buy += 330;
                    $products['web_total_cou'] = 330;
                }

                $products['products'][$id]['total_price_buy'] = $total_price_buy;

                $products['products'][$id]['total_price'] = $total_price;

                $products['total_price_buy']+=$products['products'][$id]['total_price_buy'];

                $arr_ship = [];

                $configShip =  $this->data['ships']["cate_".$product['cate']]?$this->data['ships']["cate_".$product['cate']]:[];

                $ship =  $this->data['categorys'][$product['cate']]?($this->data['categorys'][$product['cate']]->data['ship'])? $this->data['categorys'][$product['cate']]->data['ship']:"-1":"-1";

                foreach($configShip as $i => $val){

                    $is_IF_Start = $this->IF_Start($count,$configShip[$i]);
                    $is_IF_End =  $this->IF_End($count,$configShip[$i]);

                    if($is_IF_Start && $is_IF_End){
                        $conf  =  $configShip[$i]->config;
                        foreach ($conf as $ii=>$_val){
                            $val = $conf[$ii];
                            $arr = explode('-',$val['text']);
                            foreach ($arr as $iii=>$__val){
                                $v = $arr[$iii];
                                if($province == $v){
                                    $arr_ship[] = [$configShip[$i],$val];
                                }
                            }
                        }
                    }
                }

                $price_ship_default  = -1;
                $price_ship  = -1;
                foreach ($arr_ship as $i=>$val){
                    if($val[0]->unit == 0 && $price_ship_default==-1){
                        $price_ship_default =  $val[1]['value'];
                    }else if($val[0]->unit == $product->unit && $price_ship == -1){
                        $price_ship = $val[1]['value'];
                    }
                }
                $ship_cou = -1;
                if($key == 0){
                    if( $type == 2 || $type == 3 ){
                        $ship_cou = 0;
                    }else{
                        $datadaibiki = $this->data['daibiki'];
                        foreach ($datadaibiki as $i=>$_val){
                            if($ship == $_val->id){
                                foreach($_val->data as $units){
                                    foreach($units as $_unit){
                                        if($_unit){

                                            $is_IF_Start = $this->IF_Start($products['total_price_buy'],$_unit);
                                            $is_IF_End = $this->IF_End($products['total_price_buy'],$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = (int)$_unit['value'];
                                            }
                                        }
                                    }
                                }
                            }
                            if($ship_cou != -1){
                                break;
                            }
                        }
                    }

                }else{
                    $ship_cou = 0;

                }
                $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
                $ship_cou = $ship_cou == -1?0:$ship_cou;




                $products['products'][$id]['ship'] = $price_ship > -1?$price_ship*$count:-1;
                $products['products'][$id]['cou'] = $ship_cou;
                $products['products'][$id]['total_ship'] = $products['products'][$id]['ship'];
                $products['products'][$id]['total_sum_price']= $products['products'][$id]['total_price_buy']  + $products['products'][$id]['total_ship'];

                $products['products'][$id]['web_total_ship'] = 0;
                $products['products'][$id]['web_total_sum_price']= $products['products'][$id]['web_total_price_buy']  + $products['products'][$id]['web_total_ship'];

                if($key == 0){
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        ($products['products'][$id]['total_ship'] < 0 ?0:$products['products'][$id]['total_ship']) - $products['products'][$id]['cou'];
                }else{
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        $products['products'][$id]['total_ship'];
                }

                $products['total_cou']+= $products['products'][$id]['cou'];
                $products['profit']+=$products['products'][$id]['profit'];
                $products['total_price']+= $products['products'][$id]['total_price'];
                $products['total_sum']+= $products['products'][$id]['total_sum_price'];
                $products['total_ship']+=$products['products'][$id]['ship'];

                $products['web_total_sum']+= $products['products'][$id]['web_total_sum_price'];
                $products['web_total_ship']+= $products['products'][$id]['web_total_ship'] > 0?$products['products'][$id]['web_total_ship']:0;
            }
        }

        return $products;
    }
    public function KOGYJA($cate,$products,$province = "北海道",$type = 1){

        $products['total_price'] = 0;
        $products['total_price_buy'] = 0;
        $products['total_sum'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;
        $products['profit'] = 0;

        $products['web_total_sum'] = 0;
        $products['web_total_ship'] = 0;
        $products['web_total_cou'] = 0;

        $row = array_values($products['products']);
        $n = count($row);

        $orders = [
            [
                "total_count"=>0,
                "total_price"=>0,
                "total_price_buy"=>0,
                "total_sum"=>0,
                "total_ship"=>0,
                "total_cou"=>0,
                "profit"=>0,
                "products"=>[],
                "web_total_sum"=>0,
                "web_total_ship"=>0,
                "web_total_profit"=>0,
            ]
        ];

        $i = 0;

        usort($row, function ($a,$b){
            return $a['time'] - $b['time'];
        });

        $kgs = [2,5,10,15];

        while (count($row)>0){
            if($orders[$i]['total_count'] <15){
                $val = array_shift($row);
                if($orders[$i]['total_count'] + (int)$val['count'] <= 15){
                    $orders[$i]['total_count']+=$val['count'];
                    $orders[$i]["products"][] = ['count'=>$val['count'],'id'=>$val['id'],'time'=>$val['time'],'cate'=>$val['cate']];
                }else{
                    $_count = (15 - $orders[$i]['total_count']);
                    $orders[$i]['total_count']+= $_count;
                    $orders[$i]["products"][] = ['count'=>$_count,'id'=>$val['id'],'time'=>$val['time'],'cate'=>$val['cate']];
                    $val['count'] = $val['count'] - $_count;
                    array_unshift($row,$val);
                }
            }else if(count($row)>0){
                $i++;
                $orders[$i] =   [
                    "total_count"=>0,
                    "total_price"=>0,
                    "total_price_buy"=>0,
                    "total_sum"=>0,
                    "total_ship"=>0,
                    "total_cou"=>0,
                    "profit"=>0,
                    "products"=>[],
                    "web_total_sum"=>0,
                    "web_total_ship"=>0,
                    "web_total_profit"=>0,
                ];
            }
        }
        foreach ($orders as $order_index=>$order){
            $totalCountAll = $order['total_count'];
            $row = $order['products'];

            usort($row, function ($a,$b){
                return $a['time'] - $b['time'];
            });

            $n = count($row);

            for ($key = $n-1;$key >= 0; $key--){
                $product = $row[$key];
                $id = $key;
                if(isset($this->data['products']['KOGYJA'][$product['id']])){
                    $data_product =  ($this->data['products']['KOGYJA'][$product['id']]);
                    $count = $product['count'];

                    $total_price_buy = $count * $data_product['data']['price_buy'];
                    $total_price = $count * $data_product['data']['price'];


//                    if($order_index == 0  && $key == 0){
//                      //  $total_price_buy += 330;
//                    }
                    $orders[$order_index]['products'][$id]['price_buy'] = $data_product['data']['price_buy'];
                    $orders[$order_index]['products'][$id]['price'] = $data_product['data']['price'];
                    $orders[$order_index]['products'][$id]['total_price_buy'] = $total_price_buy;

                    $orders[$order_index]['products'][$id]['web_total_price_buy'] = $total_price_buy;

                    $orders[$order_index]['products'][$id]['total_price'] = $total_price;

                    $orders[$order_index]['total_price_buy']+= $orders[$order_index]['products'][$id]['total_price_buy'];

                    $orders[$order_index]['total_price']+= $orders[$order_index]['products'][$id]['total_price'];



                    $arr_ship = [];

                    $configShip =  $this->data['ships']["cate_".$product['cate']]?$this->data['ships']["cate_".$product['cate']]:[];

                    $ship =  $this->data['categorys'][$product['cate']]?($this->data['categorys'][$product['cate']]->data['ship'])? $this->data['categorys'][$product['cate']]->data['ship']:"-1":"-1";

                    $ship_cou = -1;
                    if($key == 0){
                        foreach($configShip as $i => $val){

                            $is_IF_Start = $this->IF_Start($totalCountAll,$configShip[$i]);
                            $is_IF_End =  $this->IF_End($totalCountAll,$configShip[$i]);

                            if($is_IF_Start && $is_IF_End){
                                $conf  =  $configShip[$i]->config;
                                foreach ($conf as $ii=>$_val){
                                    $val = $conf[$ii];
                                    $arr = explode('-',$val['text']);
                                    foreach ($arr as $iii=>$__val){
                                        $v = $arr[$iii];
                                        if($province == $v){
                                            $arr_ship[] = [$configShip[$i],$val];
                                        }
                                    }
                                }
                            }
                        }
                        $price_ship_default  = -1;
                        $price_ship  = -1;
                        foreach ($arr_ship as $i=>$val){
                            if($val[0]->unit == 0 && $price_ship_default==-1){
                                $price_ship_default =  $val[1]['value'];
                            }else if($val[0]->unit == $product->unit && $price_ship == -1){
                                $price_ship = $val[1]['value'];
                            }
                        }
                        $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;

                        if( $type == 2 || $type == 3 ){
                            $ship_cou = 0;
                        }else{
                            $datadaibiki = $this->data['daibiki'];
                            foreach ($datadaibiki as $i=>$_val){
                                if($ship == $_val->id){
                                    foreach((array)$_val->data as $units){
                                        foreach($units as $_unit){
                                            if($_unit){

                                                $is_IF_Start = $this->IF_Start($orders[$order_index]['total_price_buy'],$_unit);
                                                $is_IF_End = $this->IF_End($orders[$order_index]['total_price_buy'],$_unit);
                                                if($is_IF_Start && $is_IF_End){
                                                    $ship_cou = (int)$_unit['value'];
                                                }
                                            }
                                        }
                                    }
                                }
                                if($ship_cou != -1){
                                    break;
                                }
                            }
                        }
                        $orders[$order_index]['web_total_ship'] = 0;
                        if($order_index == 0)
                            $orders[$order_index]['web_total_cou'] =  330;
                        else
                            $orders[$order_index]['web_total_cou'] =  0;
                    }else{
                        $ship_cou = 0;
                        $price_ship = 0;
                    }
                    $ship_cou = $ship_cou == -1?0:$ship_cou;
                    $orders[$order_index]['products'][$id]['ship'] = $price_ship > -1?$price_ship:-1;
                    $orders[$order_index]['products'][$id]['cou'] = $ship_cou;
                    $orders[$order_index]['total_cou']+=  $orders[$order_index]['products'][$id]['cou'];
                    $orders[$order_index]['products'][$id]['web_total_ship'] = 0;
                    $v = 0;
                    if($totalCountAll >=1 ){
                        if( $totalCountAll <= 5){
                            $v = 37;
                        }else if( $totalCountAll <= 10){
                            $v = 74;
                        }else if( $totalCountAll > 10){
                            $v = 142;
                        }
                    }
                    if( $key == 0){

                        if($type != 3){
                            $orders[$order_index]['total_price_buy'] =  $orders[$order_index]['total_price_buy']+ $orders[$order_index]['products'][$id]['cou'];
                            $orders[$order_index]['products'][$id]['total_price_buy'] = $orders[$order_index]['total_price_buy'];
                        }
                        $orders[$order_index]['total_sum'] =  $orders[$order_index]['products'][$id]['total_price_buy'];
                        $orders[$order_index]['products'][$id]['total_count'] = $v;
                        $orders[$order_index]['total_count_val'] = $v;
                        $orders[$order_index]['products'][$id]['profit'] =
                            $orders[$order_index]['products'][$id]['total_price_buy'] -
                            $orders[$order_index]['products'][$id]['total_price'] -
                            $orders[$order_index]['products'][$id]['ship'] - $orders[$order_index]['total_cou'] - $v ;
                    }else{
                        $orders[$order_index]['products'][$id]['profit'] = $orders[$order_index]['products'][$id]['total_price']*-1;
                    }
                    $orders[$order_index]['products'][$id]['web_total_sum_price'] = $orders[$order_index]['products'][$id]['web_total_price_buy'];
                    $orders[$order_index]['profit']+= $orders[$order_index]['products'][$id]['profit'];
                    $orders[$order_index]['web_total_sum']+=  $orders[$order_index]['products'][$id]['web_total_price_buy'];
                    if($orders[$order_index]['products'][$id]['profit'] < 0){
                        $orders[$order_index]['products'][$id]['web_total_profit'] = $orders[$order_index]['products'][$id]['profit']*-1 + 500;
                    }else{
                        $orders[$order_index]['products'][$id]['web_total_profit'] = 0;
                    }
                }
            }
        }
        $arrays = [
            "web_total_sum"=>0,
            "web_total_ship"=>0,
            "web_total_cou"=>0,
            "profit_total_cou"=>0,
            "web_total_profit"=>0,
            "products"=>$orders
        ];
        foreach ($orders as $order){
            $arrays['web_total_sum']+=$order['web_total_sum'];
            $arrays['web_total_ship']+=$order['web_total_ship'];
            $arrays['web_total_cou']+=$order['web_total_cou'];
            $arrays['web_total_profit']+=$order['web_total_profit'];
        }

        return $arrays;
    }
    public function KURICHIKU($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_price_buy'] = 0;
        $products['total_sum'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;

        $products['web_total_sum'] = 0;
        $products['web_total_ship'] = 0;
        $products['web_total_cou'] = 0;


        $products['profit'] = 0;

        $row = array_values($products['products']);
        $n = count($row);

        $orders = [
            [
                "total_count"=>0,
                "total_price"=>0,
                "total_price_buy"=>0,
                "total_sum"=>0,
                "total_ship"=>0,
                "total_cou"=>0,
                "profit"=>0,
                "products"=>[],
                "web_total_price_buy"=>0,
                "web_total_sum"=>0,
                "web_total_ship"=>0,
                "web_total_cou"=>0,
            ]
        ];

        $i = 0;

        usort($row, function ($a,$b){
            return $a['time'] - $b['time'];
        });

        $kgs = [2,5,10,15];

        while (count($row)>0){
            if($orders[$i]['total_count'] <10){
                $val = array_shift($row);
                if($orders[$i]['total_count'] + (int)$val['count'] <= 10){
                    $orders[$i]['total_count']+=$val['count'];
                    $orders[$i]["products"][] = ['count'=>$val['count'],'id'=>$val['id'],'time'=>$val['time'],'cate'=>$val['cate']];
                }else{
                    $_count = (10 - $orders[$i]['total_count']);
                    $orders[$i]['total_count']+= $_count;
                    $orders[$i]["products"][] = ['count'=>$_count,'id'=>$val['id'],'time'=>$val['time'],'cate'=>$val['cate']];
                    $val['count'] = $val['count'] - $_count;

                    array_unshift($row,$val);
                }
            }else if(count($row)>0){
                $i++;
                $orders[$i] =   [
                    "total_count"=>0,
                    "total_price"=>0,
                    "total_price_buy"=>0,
                    "total_sum"=>0,
                    "total_ship"=>0,
                    "total_cou"=>0,
                    "profit"=>0,
                    "products"=>[],
                    "web_total_price_buy"=>0,
                    "web_total_sum"=>0,
                    "web_total_ship"=>0,
                    "web_total_cou"=>0,
                ];
            }
        }
        foreach ($orders as $order_index=>$order){
            $totalCountAll = $order['total_count'];
            $row = $order['products'];

            usort($row, function ($a,$b){
                return $a['time'] - $b['time'];
            });

            $n = count($row);

            for ($key = $n-1;$key >= 0; $key--){
                $product = $row[$key];
                $id = $key;
                if(isset($this->data['products']['KURICHIKU'][$product['id']])){
                    $data_product =  ($this->data['products']['KURICHIKU'][$product['id']]);
                    $count = $product['count'];

                    $total_price_buy = $count * $data_product['data']['price_buy'];
                    $total_price = $count * $data_product['data']['price'];


                    $orders[$order_index]['products'][$id]['price_buy'] = $data_product['data']['price_buy'];
                    $orders[$order_index]['products'][$id]['price'] = $data_product['data']['price'];
                    $orders[$order_index]['products'][$id]['total_price_buy'] = $total_price_buy;
                    $orders[$order_index]['products'][$id]['web_total_price_buy'] = $total_price_buy;
                    $orders[$order_index]['products'][$id]['total_price'] = $total_price;

                    $orders[$order_index]['total_price_buy']+= $orders[$order_index]['products'][$id]['total_price_buy'];

                    $orders[$order_index]['total_price']+= $orders[$order_index]['products'][$id]['total_price'];



                    $arr_ship = [];

                    $configShip =  $this->data['ships']["cate_".$product['cate']]?$this->data['ships']["cate_".$product['cate']]:[];

                    $ship =  $this->data['categorys'][$product['cate']]?($this->data['categorys'][$product['cate']]->data['ship'])? $this->data['categorys'][$product['cate']]->data['ship']:"-1":"-1";

                    $ship_cou = -1;
                    if($key == 0){
                        foreach($configShip as $i => $val){

                            $is_IF_Start = $this->IF_Start($totalCountAll,$configShip[$i]);
                            $is_IF_End =  $this->IF_End($totalCountAll,$configShip[$i]);

                            if($is_IF_Start && $is_IF_End){
                                $conf  =  $configShip[$i]->config;
                                foreach ($conf as $ii=>$_val){
                                    $val = $conf[$ii];
                                    $arr = explode('-',$val['text']);
                                    foreach ($arr as $iii=>$__val){
                                        $v = $arr[$iii];
                                        if($province == $v){
                                            $arr_ship[] = [$configShip[$i],$val];
                                        }
                                    }
                                }
                            }
                        }
                        $price_ship_default  = -1;
                        $price_ship  = -1;
                        if($key == 0){
                            $orders[$order_index]['products'][$id]['total_price_buy']+=330;
                        }
                        foreach ($arr_ship as $i=>$val){
                            if($val[0]->unit == 0 && $price_ship_default==-1){
                                $price_ship_default =  $val[1]['value'];
                            }else if($val[0]->unit == $product->unit && $price_ship == -1){
                                $price_ship = $val[1]['value'];
                            }
                        }
                        $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;

                        if( $type == 2 || $type == 3 ){
                            $ship_cou = 0;
                        }else{
                            $datadaibiki = $this->data['daibiki'];
                            foreach ($datadaibiki as $i=>$_val){
                                if($ship == $_val->id){
                                    foreach((array)$_val->data as $units){
                                        foreach($units as $_unit){
                                            if($_unit){

                                                $is_IF_Start = $this->IF_Start($orders[$order_index]['total_price_buy'],$_unit);
                                                $is_IF_End = $this->IF_End($orders[$order_index]['total_price_buy'],$_unit);
                                                if($is_IF_Start && $is_IF_End){
                                                    $ship_cou = (int)$_unit['value'];
                                                }
                                            }
                                        }
                                    }
                                }
                                if($ship_cou != -1){
                                    break;
                                }
                            }
                        }

                    }else{
                        $ship_cou = 0;
                        $price_ship = 0;
                    }
                    $ship_cou = $ship_cou == -1?0:$ship_cou;
                    $orders[$order_index]['products'][$id]['ship'] = $price_ship > -1?$price_ship:-1;
                    $orders[$order_index]['products'][$id]['cou'] = $ship_cou;

                    $orders[$order_index]['total_cou']+=  $orders[$order_index]['products'][$id]['cou'];


                    if( $key == 0){
                        $orders[$order_index]['web_total_cou']+=330;
                        $orders[$order_index]['total_sum'] =  $orders[$order_index]['products'][$id]['total_price_buy'];



                        $orders[$order_index]['products'][$id]['web_total_sum']= $orders[$order_index]['products'][$id]['web_total_price_buy'];
                        $orders[$order_index]['products'][$id]['web_total_ship']= 0;
                            $orders[$order_index]['products'][$id]['profit'] =
                            $orders[$order_index]['products'][$id]['total_price_buy'] -
                            $orders[$order_index]['products'][$id]['total_price'] -
                            $orders[$order_index]['products'][$id]['ship'] - $orders[$order_index]['total_cou'];

                    }else{

                        $orders[$order_index]['products'][$id]['profit'] =
                            $orders[$order_index]['products'][$id]['total_price_buy'] - 330-
                            $orders[$order_index]['products'][$id]['total_price'] -
                            $orders[$order_index]['products'][$id]['ship'] - 330;


                    }

                    $orders[$order_index]['profit']+= $orders[$order_index]['products'][$id]['profit'];

                    $orders[$order_index]['total_ship']+= $orders[$order_index]['products'][$id]['ship'];

                    $orders[$order_index]['products'][$id]['web_total_ship']+= ($orders[$order_index]['products'][$id]['ship'] > 0 ?$orders[$order_index]['products'][$id]['ship']:0) * $count ;
                    $orders[$order_index]['products'][$id]['web_total_sum_price']= $orders[$order_index]['products'][$id]['web_total_price_buy'];

                    $orders[$order_index]['web_total_ship']+=($orders[$order_index]['products'][$id]['ship'] > 0 ?$orders[$order_index]['products'][$id]['ship']:0) ;
                    $orders[$order_index]['web_total_sum']+=$orders[$order_index]['products'][$id]['web_total_sum_price'] ;
                }
            }
        }
        $arrays = [
            "web_total_sum"=>0,
            "web_total_ship"=>0,
            "web_total_cou"=>0,
            "products"=>$orders
        ];

        foreach ($orders as $order){
            $arrays['web_total_sum']+=$order['web_total_sum'];
            $arrays['web_total_ship']+=$order['web_total_ship'];
            $arrays['web_total_cou']+=$order['web_total_cou'];
        }

        return $arrays;
    }
    public function FUKUI($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_price_buy'] = 0;
        $products['total_sum'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;

        $products['web_total_cou'] = 0;
        $products['web_total_sum'] = 0;
        $products['web_total_ship'] = 0;

        $products['profit'] = 0;

        $row = array_values($products['products']);
        $n = count($row);
        for ($key = $n-1;$key >= 0; $key--){
            //$products['products'] as $key=>$product
            $product = $row[$key];
            $id = $product['id'];
            if(isset($this->data['products']['FUKUI'][$product['id']])){

                $data_product =  ($this->data['products']['FUKUI'][$product['id']]);
                $count = $product['count'];
                $total_price_buy = $count * $data_product['data']['price_buy'];
                $total_price = $count * $data_product['data']['price'];

                $products['products'][$id]['web_total_price_buy'] = $total_price_buy;

                if($key == 0){
                    $total_price_buy += 330;
                    $products['web_total_cou'] = 330;
                }

                $products['products'][$id]['total_price_buy'] = $total_price_buy;

                $products['products'][$id]['total_price'] = $total_price;

                $products['total_price_buy']+=$products['products'][$id]['total_price_buy'];

                $arr_ship = [];

                $configShip =  $this->data['ships']["cate_".$product['cate']]?$this->data['ships']["cate_".$product['cate']]:[];

                $ship =  $this->data['categorys'][$product['cate']]?($this->data['categorys'][$product['cate']]->data['ship'])? $this->data['categorys'][$product['cate']]->data['ship']:"-1":"-1";

                foreach($configShip as $i => $val){

                    $is_IF_Start = $this->IF_Start($count,$configShip[$i]);
                    $is_IF_End =  $this->IF_End($count,$configShip[$i]);

                    if($is_IF_Start && $is_IF_End){
                        $conf  =  $configShip[$i]->config;
                        foreach ($conf as $ii=>$_val){
                            $val = $conf[$ii];
                            $arr = explode('-',$val['text']);
                            foreach ($arr as $iii=>$__val){
                                $v = $arr[$iii];
                                if($province == $v){
                                    $arr_ship[] = [$configShip[$i],$val];
                                }
                            }
                        }
                    }
                }

                $price_ship_default  = -1;
                $price_ship  = -1;
                foreach ($arr_ship as $i=>$val){
                    if($val[0]->unit == 0 && $price_ship_default==-1){
                        $price_ship_default =  $val[1]['value'];
                    }else if($val[0]->unit == $product->unit && $price_ship == -1){
                        $price_ship = $val[1]['value'];
                    }
                }
                $ship_cou = -1;
                if($key == 0){
                    if( $type == 2 || $type == 3 ){
                        $ship_cou = 0;
                    }else{
                        $datadaibiki = $this->data['daibiki'];
                        foreach ($datadaibiki as $i=>$_val){
                            if($ship == $_val->id){
                                foreach($_val->data as $units){
                                    foreach($units as $_unit){
                                        if($_unit){

                                            $is_IF_Start = $this->IF_Start($products['total_price_buy'],$_unit);
                                            $is_IF_End = $this->IF_End($products['total_price_buy'],$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = (int)$_unit['value'];
                                            }
                                        }
                                    }
                                }
                            }
                            if($ship_cou != -1){
                                break;
                            }
                        }
                    }

                }else{
                    $ship_cou = 0;

                }
                $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
                $ship_cou = $ship_cou == -1?0:$ship_cou;




                $products['products'][$id]['ship'] = $price_ship > -1?$price_ship*$count:-1;
                $products['products'][$id]['cou'] = $ship_cou;
                $products['products'][$id]['total_ship'] = $products['products'][$id]['ship'];
                $products['products'][$id]['total_sum_price']= $products['products'][$id]['total_price_buy']  + $products['products'][$id]['total_ship'];
                $products['products'][$id]['web_total_ship'] =0;
                $products['products'][$id]['web_total_sum_price']= $products['products'][$id]['web_total_price_buy'];

                if($key == 0){
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        ($products['products'][$id]['total_ship'] < 0 ?0:$products['products'][$id]['total_ship']) - $products['products'][$id]['cou'];
                }else{
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        $products['products'][$id]['total_ship'];
                }

                $products['total_cou']+= $products['products'][$id]['cou'];
                $products['profit']+=$products['products'][$id]['profit'];
                $products['total_price']+= $products['products'][$id]['total_price'];
                $products['total_sum']+= $products['products'][$id]['total_sum_price'];
                $products['total_ship']+=$products['products'][$id]['ship'];

                $products['web_total_sum']+= $products['products'][$id]['web_total_sum_price'];
                $products['web_total_ship']+= 0;
            }
        }

        return $products;
    }
    public function OHGA($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_price_buy'] = 0;
        $products['total_sum'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;

        $products['web_total_cou'] = 0;
        $products['web_total_sum'] = 0;
        $products['web_total_ship'] = 0;

        $products['profit'] = 0;

        $row = array_values($products['products']);
        $n = count($row);
        for ($key = $n-1;$key >= 0; $key--){
            //$products['products'] as $key=>$product
            $product = $row[$key];
            $id = $product['id'];
            if(isset($this->data['products']['OHGA'][$product['id']])){

                $data_product =  ($this->data['products']['OHGA'][$product['id']]);
                $count = $product['count'];
                $total_price_buy = $count * $data_product['data']['price_buy'];
                $total_price = $count * $data_product['data']['price'];

                $products['products'][$id]['web_total_price_buy'] = $total_price_buy;

                if($key == 0){
                    $total_price_buy += 330;
                    $products['web_total_cou'] = 330;
                }

                $products['products'][$id]['total_price_buy'] = $total_price_buy;

                $products['products'][$id]['total_price'] = $total_price;

                $products['total_price_buy']+=$products['products'][$id]['total_price_buy'];

                $arr_ship = [];

                $configShip =  $this->data['ships']["cate_".$product['cate']]?$this->data['ships']["cate_".$product['cate']]:[];

                $ship =  $this->data['categorys'][$product['cate']]?($this->data['categorys'][$product['cate']]->data['ship'])? $this->data['categorys'][$product['cate']]->data['ship']:"-1":"-1";

                foreach($configShip as $i => $val){

                    $is_IF_Start = $this->IF_Start($count,$configShip[$i]);
                    $is_IF_End =  $this->IF_End($count,$configShip[$i]);

                    if($is_IF_Start && $is_IF_End){
                        $conf  =  $configShip[$i]->config;
                        foreach ($conf as $ii=>$_val){
                            $val = $conf[$ii];
                            $arr = explode('-',$val['text']);
                            foreach ($arr as $iii=>$__val){
                                $v = $arr[$iii];
                                if($province == $v){
                                    $arr_ship[] = [$configShip[$i],$val];
                                }
                            }
                        }
                    }
                }

                $price_ship_default  = -1;
                $price_ship  = -1;
                foreach ($arr_ship as $i=>$val){
                    if($val[0]->unit == 0 && $price_ship_default==-1){
                        $price_ship_default =  $val[1]['value'];
                    }else if($val[0]->unit == $product->unit && $price_ship == -1){
                        $price_ship = $val[1]['value'];
                    }
                }
                $ship_cou = -1;
                if($key == 0){
                    if( $type == 2 || $type == 3 ){
                        $ship_cou = 0;
                    }else{
                        $datadaibiki = $this->data['daibiki'];
                        foreach ($datadaibiki as $i=>$_val){
                            if($ship == $_val->id){
                                foreach($_val->data as $units){
                                    foreach($units as $_unit){
                                        if($_unit){

                                            $is_IF_Start = $this->IF_Start($products['total_price_buy'],$_unit);
                                            $is_IF_End = $this->IF_End($products['total_price_buy'],$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = (int)$_unit['value'];
                                            }
                                        }
                                    }
                                }
                            }
                            if($ship_cou != -1){
                                break;
                            }
                        }
                    }

                }else{
                    $ship_cou = 0;

                }
                $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
                $ship_cou = $ship_cou == -1?0:$ship_cou;




                $products['products'][$id]['ship'] = $price_ship > -1?$price_ship*$count:-1;
                $products['products'][$id]['cou'] = $ship_cou;
                $products['products'][$id]['total_ship'] = $products['products'][$id]['ship'];
                $products['products'][$id]['total_sum_price']= $products['products'][$id]['total_price_buy']  + $products['products'][$id]['total_ship'];

                $products['products'][$id]['web_total_ship'] = $products['products'][$id]['ship'];
                $products['products'][$id]['web_total_sum_price']= $products['products'][$id]['web_total_price_buy'];

                if($key == 0){
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        ($products['products'][$id]['total_ship'] < 0 ?0:$products['products'][$id]['total_ship']) - $products['products'][$id]['cou'];
                }else{
                    $products['products'][$id]['profit'] =
                        $products['products'][$id]['total_sum_price'] -
                        $products['products'][$id]['total_price'] -
                        $products['products'][$id]['total_ship'];
                }

                $products['total_cou']+= $products['products'][$id]['cou'];
                $products['profit']+=$products['products'][$id]['profit'];
                $products['total_price']+= $products['products'][$id]['total_price'];
                $products['total_sum']+= $products['products'][$id]['total_sum_price'];
                $products['total_ship']+=$products['products'][$id]['ship'];

                $products['web_total_sum']+= $products['products'][$id]['web_total_sum_price'];
                $products['web_total_ship']+= 0;
            }
        }

        return $products;
    }
}