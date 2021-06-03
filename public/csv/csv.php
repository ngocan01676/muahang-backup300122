
<?php
include "db.php";
function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;
    $header = null;
    $data = array();

    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000000, $delimiter)) !== false)
        {
            $row[1] = mb_convert_encoding($row[1], 'UTF-8', array('EUC-JP', 'SHIFT-JIS', 'AUTO'));
            $row[2] = mb_convert_encoding($row[2], 'UTF-8', array('EUC-JP', 'SHIFT-JIS', 'AUTO'));
            $row[3] = mb_convert_encoding($row[3], 'UTF-8', array('EUC-JP', 'SHIFT-JIS', 'AUTO'));

            echo $row['0']."\n";
            $rs = ORM::for_table('cms_shop_postcode_jp')->where('0',$row[0])->count();
            if($rs == 0){
                ORM::for_table('cms_shop_postcode_jp')->create($row)->save();
            }

        }
        fclose($handle);
    }

}
csvToArray(__DIR__.'/file.csv');
