<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
<?php

$passwd = \filter_input(\INPUT_POST, 'passwd');

$data = $passwd;
if (strlen($passwd) > 1) {
    $fp = fopen('/home/sonarman/shells/dat/passwd', 'wb');

    if ($fp) {
        if (flock($fp, LOCK_EX)) {
            if (fwrite($fp, $data) === FALSE) {
                print('write error<br>');
            } else {
                $message = 'Password has been updated successfully';
            }

            flock($fp, LOCK_UN);
        } else {
            $message='file lock error';
        }
    }

    $flag = fclose($fp);
} else {
    $message='Password is too short';
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
                    <div class="panel-title">Password</div>
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