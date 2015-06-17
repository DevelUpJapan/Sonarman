<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
<?php

$qty = \filter_input(\INPUT_POST, 'qty');
$size = \filter_input(\INPUT_POST, 'size');
$eth2 = \filter_input(\INPUT_POST, 'eth2');
$option1 = \filter_input(\INPUT_POST, 'option1');
$option2 = \filter_input(\INPUT_POST, 'option2');

$intqty = intval($qty);
$intsize = intval($size);
$command = 'sudo fdisk -l /dev/sda | grep "Disk /dev/sda:" | cut -d" " -f5 | cut -d" " -f4';
$disk_size = array();
exec($command, $disk_size);
$intdisk_size = intval($disk_size[0]);
$diskcapacity = round(($intdisk_size * 0.8) / 1024);
$file_error = 0;

if ($intqty > 10 && $intqty < 100000 && $intsize > 1000 && $intsize < 2000000 && ($intqty * $intsize) < ($diskcapacity)) {
    $data = 'qty=' . $qty . " " . 'size=' . $size;
    $fp = fopen('/home/sonarman/shells/dat/capfile', 'wb');

    if ($fp) {
        if (flock($fp, LOCK_EX)) {
            if (fwrite($fp, $data) === FALSE) {
                print('write error<br>');
            }
            flock($fp, LOCK_UN);
        } else {
            $file_error++;
            $message = 'file lock error';
        }
    }
    $flag = fclose($fp);
} else {
    $message = 'input value is invalid';
}

//option1 saving
    $data_option1 = 'option1="' . $option1.'"';
    $fp_option1 = fopen('/home/sonarman/shells/dat/tsharkoption1', 'wb');

    if ($fp_option1) {
        if (flock($fp_option1, LOCK_EX)) {
            if (fwrite($fp_option1, $data_option1) === FALSE) {
                print('write error<br>');
            }
            flock($fp_option1, LOCK_UN);
        } else {
            $file_error++;
            $message = 'file lock error';
        }
    }
    $flag = fclose($fp_option1);

//option2 saving
//this is dead logic    
if ($eth2 == 'eth2') {
    $data_option2 = 'option2="' . $option2.'"';
    $fp_option2 = fopen('/home/sonarman/shells/dat/tsharkoption2', 'wb');

    if ($fp_option2) {
        if (flock($fp_option2, LOCK_EX)) {
            if (fwrite($fp_option2, $data_option2) === FALSE) {
                print('write error<br>');
            }
            flock($fp_option2, LOCK_UN);
        } else {
            $file_error++;
            $message = 'file lock error';
        }
    }
    $flag = fclose($fp_option2);
}

//eth2 setting saving
if ($eth2 == 'eth2') {
    $data_eth2 = 'interface=eth1 interface2=eth2';
} else {
    $data_eth2 = 'interface=eth1 interface2=0';
}
$fp_eth2 = fopen('/home/sonarman/shells/dat/capinterface', 'wb');

if ($fp_eth2) {
    if (flock($fp_eth2, LOCK_EX)) {
        if (fwrite($fp_eth2, $data_eth2) === FALSE) {
            print('write error<br>');
        }
        flock($fp_eth2, LOCK_UN);
    } else {
        $file_error++;
        $message = 'file lock error';
    }
}
$flag = fclose($fp_eth2);


if (empty($message)==true && $file_error == 0) {
    $message = 'Capture parameters have been updated successfully'; 
}



$str = <<< EOF
        <script type="text/javascript">
            function checkfunc() {
                for (i = 0; i < 3; i++) {
                    document.ipform.iptext[i].disabled = (document.ipform.dhcp.checked);
                }
            }
        </script>   
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Capture settings</div>
                </div>
                <div class="panel-body">
                    $message
                </div>
            </div>
        </div>
    </div>
</div>
EOF;
echo $str;
?>
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/footer.htm'); ?>