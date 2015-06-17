<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
        <?php
        $reboot = filter_input(\INPUT_POST, 'reboot');

        if ($reboot === 'reboot') {
            exec('sudo /home/sonarman/shells/reboot.sh');
            $message= "Restarting...";
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
                    <div class="panel-title">Restart</div>
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