<?php
namespace BetoGaizinTheme\Lib;
use Illuminate\Support\Facades\DB;

class Price{
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
            if( $conf['equal_start'] === "<=" && $val <= $conf-['value_start']){
                return true;
            }else if( $conf['equal_start'] === ">=" && $val >= $conf->value_start){
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
        $results = [];
        foreach ($products_group as $key => $value){
            if($value['name'] == "YAMADA"){
                $results[$value['name']] = $this->YAMADA($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "KOGYJA"){
                $results[$value['name']] = $this->KOGYJA($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "KURICHIKU"){
                $results[$value['name']] = $this->KURICHIKU($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "FUKUI"){
                $results[$value['name']] = $this->FUKUI($key,$value,$province,$this->getValuePayMethod($payment));
            }
            if($value['name'] == "OHGA"){
                $results[$value['name']] = $this->OHGA($key,$value,$province,$this->getValuePayMethod($payment));
            }
        }
        return $results;
    }

    public function YAMADA($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;
         foreach ($products['products'] as $key=>$product){

             if(isset($this->data['products']['YAMADA'][$product['id']])){

                 $data_product =  ($this->data['products']['YAMADA'][$product['id']]);
                 $count = $product['count'];
                 $total_price = $count * $data_product['data']['price_buy'];

                 if($key == 0){
                     $total_price+=330;
                 }

                 $products['total_price']+= $total_price;
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

                                             $is_IF_Start = $this->IF_Start($total_price,$_unit);
                                             $is_IF_End = $this->IF_End($total_price,$_unit);
                                             if($is_IF_Start && $is_IF_End){
                                                 $ship_cou = $_unit['value'];
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

                  if($key == 0){
                     $products['cou'] = $ship_cou;
                  }
                  $products['total_ship']+=$price_ship;
                  $products['products'][$key]['cou'] = $ship_cou;
                  $products['products'][$key]['ship'] = $price_ship > -1?$price_ship*$count:-1;

             }
         }

//        $arr_ship = [];
//        $configShip =  $this->data['ships']["cate_".$cate]?$this->data['ships']["cate_".$cate]:[];
//        $ship =  $this->data['categorys'][$cate]?($this->data['categorys'][$cate]->data['ship'])? $this->data['categorys'][$cate]->data['ship']:"-1":"-1";
//        foreach($configShip as $i => $val){
//            $is_IF_Start = $this->IF_Start($count,$configShip[$i]);
//            $is_IF_End =  $this->IF_End($count,$configShip[$i]);
//            if($is_IF_Start && $is_IF_End){
//                $conf  =  $configShip[$i]->config;
//                foreach ($conf as $ii=>$_val){
//                    $val = $conf[$ii];
//                    $arr = explode('-',$val['text']);
//                    foreach ($arr as $iii=>$__val){
//                        $v = $arr[$iii];
//                        if($province == $v){
//                            $arr_ship[] = [$configShip[$i],$val];
//                        }
//                    }
//                }
//            }
//        }
//        $price_ship_default  = -1;
//        $price_ship  = -1;
//        $ship_cou = -1;
//        foreach ($arr_ship as $i=>$val){
//            if($val[0]->unit == 0 && $price_ship_default==-1){
//                $price_ship_default =  $val[1]['value'];
//            }else if($val[0]->unit == $product->unit && $price_ship == -1){
//                $price_ship = $val[1]['value'];
//            }
//        }
//        if( $type == 2 || $type == 3 ){
//            $ship_cou = 0;
//        }else{
//            $datadaibiki = $this->data['daibiki'];
//            foreach ($datadaibiki as $i=>$_val){
//                if($ship == $_val->id){
//                    foreach($_val->data as $units){
//                        foreach($units as $_unit){
//                            if($_unit){
//
//                                $is_IF_Start = $this->IF_Start($products['total_price'],$_unit);
//                                $is_IF_End = $this->IF_End($products['total_price'],$_unit);
//                                if($is_IF_Start && $is_IF_End){
//                                    $ship_cou = $_unit['value'];
//                                }
//                            }
//                        }
//                    }
//                }
//                if($ship_cou != -1){
//                    break;
//                }
//            }
//        }
//
//        $price_ship =  $price_ship!=-1?$price_ship:$price_ship_default;
//        $ship_cou = $ship_cou == -1?0:$ship_cou;
//        $products['cou'] = $ship_cou;
//        $products['ship'] = $price_ship;
        return $products;
    }
    public function KOGYJA($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;
        foreach ($products['products'] as $key=>$product){

            if(isset($this->data['products']['YAMADA'][$product['id']])){

                $data_product =  ($this->data['products']['YAMADA'][$product['id']]);
                $count = $product['count'];
                $total_price = $count * $data_product['data']['price_buy'];

                if($key == 0){
                    $total_price+=330;
                }

                $products['total_price']+= $total_price;
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

                                            $is_IF_Start = $this->IF_Start($total_price,$_unit);
                                            $is_IF_End = $this->IF_End($total_price,$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = $_unit['value'];
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
                if($key == 0){
                    $products['cou'] = $ship_cou;
                }
                $products['total_ship']+=$price_ship;
                $products['products'][$key]['cou'] = $ship_cou;
                $products['products'][$key]['ship'] = $price_ship > -1?$price_ship*$count:-1;
            }
        }
        return $products;
    }
    public function KURICHIKU($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;
        foreach ($products['products'] as $key=>$product){

            if(isset($this->data['products']['YAMADA'][$product['id']])){

                $data_product =  ($this->data['products']['YAMADA'][$product['id']]);
                $count = $product['count'];
                $total_price = $count * $data_product['data']['price_buy'];

                if($key == 0){
                    $total_price+=330;
                }

                $products['total_price']+= $total_price;
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

                                            $is_IF_Start = $this->IF_Start($total_price,$_unit);
                                            $is_IF_End = $this->IF_End($total_price,$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = $_unit['value'];
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
                $products['products'][$key]['cou'] = $ship_cou;
                if($key == 0){
                    $products['cou'] = $ship_cou;
                }
                $products['total_ship']+=$price_ship;
                $products['products'][$key]['ship'] = $price_ship > -1?$price_ship*$count:-1;
            }
        }
        return $products;
    }
    public function FUKUI($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;
        foreach ($products['products'] as $key=>$product){

            if(isset($this->data['products']['YAMADA'][$product['id']])){

                $data_product =  ($this->data['products']['YAMADA'][$product['id']]);
                $count = $product['count'];
                $total_price = $count * $data_product['data']['price_buy'];

                if($key == 0){
                    $total_price+=330;
                }

                $products['total_price']+= $total_price;
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

                                            $is_IF_Start = $this->IF_Start($total_price,$_unit);
                                            $is_IF_End = $this->IF_End($total_price,$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = $_unit['value'];
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
                $products['products'][$key]['cou'] = $ship_cou;
                if($key == 0){
                    $products['cou'] = $ship_cou;
                }
                $products['total_ship']+=$price_ship;
                $products['products'][$key]['ship'] = $price_ship > -1?$price_ship*$count:-1;
            }
        }
        return $products;
    }
    public function OHGA($cate,$products,$province = "北海道",$type = 1){
        $products['total_price'] = 0;
        $products['total_ship'] = 0;
        $products['total_cou'] = 0;
        foreach ($products['products'] as $key=>$product){

            if(isset($this->data['products']['YAMADA'][$product['id']])){

                $data_product =  ($this->data['products']['YAMADA'][$product['id']]);
                $count = $product['count'];
                $total_price = $count * $data_product['data']['price_buy'];

                if($key == 0){
                    $total_price+=330;
                }

                $products['total_price']+= $total_price;
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

                                            $is_IF_Start = $this->IF_Start($total_price,$_unit);
                                            $is_IF_End = $this->IF_End($total_price,$_unit);
                                            if($is_IF_Start && $is_IF_End){
                                                $ship_cou = $_unit['value'];
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
                if($key == 0){
                    $products['cou'] = $ship_cou;
                }
                $products['total_ship']+=$price_ship;
                $products['products'][$key]['cou'] = $ship_cou;
                $products['products'][$key]['ship'] = $price_ship > -1?$price_ship*$count:-1;
            }
        }
        return $products;
    }
}