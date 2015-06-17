<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
        <?php
        $ip = filter_input(\INPUT_POST, 'ip');
        $mask = filter_input(\INPUT_POST, 'mask');
        $gateway = filter_input(\INPUT_POST, 'gateway');
        $dhcp = filter_input(\INPUT_POST, 'dhcp');

        if ($dhcp === 'dhcp') {
            exec('sudo /home/sonarman/shells/set/dhcp.sh');
            $message= "DHCP is enable";
        } else {
            if (filter_var($ip, FILTER_VALIDATE_IP) && $intmask >= 0 && filter_var($mask, FILTER_VALIDATE_IP) && filter_var($gateway, FILTER_VALIDATE_IP)) {
                $command = 'sudo /home/sonarman/shells/set/ipaddress.sh ' . $ip . ' ' . $mask . ' ' . $gateway;
                exec($command);
                $message= "IP address have been changed";
            } else {
                $message= "Wrong value";
            }
        }
        $str = <<< EOF
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">IP settings</div>
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