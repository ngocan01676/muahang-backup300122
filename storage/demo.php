
            <?php function zoe_lang ( $key ,   $__env ) { ?>
                <?php 
                    return "<div class=\"___lang___\">".$key."</div>";
                ?>
            <?php } ?>
        <?php function func_1565529174_8679_2270 ( $data ,   $__env ) { ?>
           
            
<div><?php echo zoe_lang(["Demo avc"],$__env); ?></div>
<div><?php echo zoe_lang(['Welcome to Website!'],$__env); ?></div>
<div><?php echo zoe_lang(["Game"],$__env); ?></div>
<div><?php echo zoe_lang(["Top Event"],$__env); ?></div>
<div><?php echo zoe_lang(["Event"],$__env); ?></div>
<?php for($i=0;$i<5;$i++): ?>
  <div><?php echo zoe_lang(["Top ".$i],$__env); ?></div>                   
<?php endfor; ?>
<?php for($i=0;$i<5;$i++): ?>
  <div><?php echo zoe_lang(["STT :stt",["stt"=>$i]],$__env); ?></div>
<?php endfor; ?>
        <?php } ?>
         <?php func_1565529174_8679_2270 (array (
  'name' => 'Content Theme',
  'count' => '5',
) ,  $__env); ?>