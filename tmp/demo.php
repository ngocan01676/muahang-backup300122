<?php
$__env = null;
function tag_zlang($key, $__env)
{ ?>↵
    <?php
    return '<div class="___lang___">' . $key . ' </div >'
    ?>↵            <?php } ?>↵        <?php function func_1565491817_9783_9788($data, $__env)
{ ?>↵           ↵
    ↵
    <div><?php echo tag_zlang("Demo", $__env); ?></div>
    ↵
    <div><?php echo tag_zlang('Welcome to Website!', $__env); ?></div>
    ↵
    <div><?php echo tag_zlang("Game", $__env); ?></div>
    ↵
    <div><?php echo tag_zlang("Top", $__env); ?></div>
    ↵
    <div><?php echo tag_zlang("Event", $__env); ?></div>
    ↵<?php for ($i = 0; $i < 5; $i++): ?>
    ↵
    <div><?php echo tag_zlang("Event " . $i, $__env); ?></div>
    ↵<?php endfor; ?>↵        <?php } ?>↵
<?php func_1565491817_9783_9788(array('name' => 'Content Theme', 'count' => '5'), $__env); ?>
"
$str =  ("Comes with 5 color schemes and it's easy to make your own!");
$a = htmlspecialchars($str,ENT_QUOTES);
var_dump($str);
var_dump($a);
var_dump(htmlspecialchars_decode($a,ENT_QUOTES));