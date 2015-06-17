<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
<?php

$fp = fopen('/home/sonarman/shells/dat/capfile', 'rb');

if ($fp) {
    $line = fgets($fp);
}

fclose($fp);
$keywords = preg_split('/ /', $line);
//print_r($keywords);
$qty = preg_split('/\=/', $keywords[0]);
$size = preg_split('/\=/', $keywords[1]);


$fp_option1 = fopen('/home/sonarman/shells/dat/tsharkoption1', 'rb');

if ($fp_option1) {
    $line_option1 = fgets($fp_option1);
}

fclose($fp_option1);
$option1 = str_replace('option1=', '', $line_option1);
$option1 = preg_replace('/^"|"$/',"",$option1);

$fp_option2 = fopen('/home/sonarman/shells/dat/tsharkoption2', 'rb');

if ($fp_option2) {
    $line_option2 = fgets($fp_option2);
}

fclose($fp_option2);
$option2 = str_replace('option2=', '', $line_option2);
$option2 = preg_replace('/^"|"$/',"",$option2);


//check eth2 status
$input_disable = 'disabled';
$geteth2 = 'sudo /home/sonarman/shells/get/eth2status.sh';
$eth2status = array();
exec($geteth2, $eth2status);
if ($eth2status[0] === 'eth2') {
    $eth2check = 'checked';
    $input_disable = '';
}


$str = <<< EOF
        <script type="text/javascript">
            function checkfunc() {
                    if (document.capform.eth2.checked == false){
                        document.capform.option_for_eth2.disabled = true;
                    }
                    else{
                        document.capform.option_for_eth2.disabled = false;
                    }
            }
        </script>  
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Capture settings</div>
                </div>
                <div class="panel-body">
                    <form action="../post/capsetting.php" method="post" name="capform">
                        <table style="border-style: none;">
                            <tr>
                                <td>File Quantity</td>
                                <td><input type="text" name="qty" size="20" value=$qty[1]></td>
                            </tr>
                            <tr>
                                <td>File Size</td>
                                <td ><input type="text" name="size" size="20" value=$size[1]></td>
                            </tr>
                            <tr>
                                <td>Enable capture on eth2 &nbsp;</td>
                                <td><input type="checkbox" name="eth2" value="eth2" onClick="checkfunc();" $eth2check></td>
                            </tr>
                            <tr>
                                <td>Option for eth1</td>
                                <td ><input type="text" name="option1" size="40" value="$option1"></td>
                            </tr>        
                            <tr>
                                <td>Option for eth2</td>
                                <td ><input type="text" name="option2" size="40" id="option_for_eth2" $input_disable value="$option2"] ></td>
                            </tr>                                
                            <tr>                            
                                <td colspan="2" align="center">
                                    <input type="submit" value="set">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
EOF;
echo $str;
?>
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/footer.htm'); ?>