
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
<?php


    $getdhcp = 'sudo /home/sonarman/shells/get/isdhcp.sh';
    $isdhcp = array();
    exec($getdhcp, $isdhcp);
    if($isdhcp[0]==='dhcp'){
        $dhcpcheck='checked';
    }
    else{
        $getgw = 'sudo /home/sonarman/shells/get/gateway.sh';
        $gateway = array();
        exec($getgw, $gateway);
        
        $getmask = 'sudo /home/sonarman/shells/get/netmask.sh';
        $netmask = array();
        exec($getmask, $netmask);

        $getadress = 'sudo /home/sonarman/shells/get/ipaddress.sh';
        $ipaddress = array();
        exec($getadress, $ipaddress);
    }


?>  

<?php
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
                    <div class="panel-title">IP settings</div>
                </div>
                <div class="panel-body">
                    <form action="/sonarman/post/ipaddress.php" method="post" name="ipform">
                        <table style="border-style: none;">
                            <tr>
                                <td>IP address</td>
                                <td><input type="text" name="ip" id="iptext" value=$ipaddress[0]></td>
                            </tr>
                            <tr>
                                <td>Netmask</td>
                                <td ><input type="text" name="mask" id="iptext" value=$netmask[0]></td>
                            </tr>
                            <tr>
                                <td>Gateway &nbsp;</td>
                                <td><input type="text" name="gateway" id="iptext" value=$gateway[0]></td>
                            </tr>
                            <tr>
                                <td>DHCP</td>
                                <td><input type="checkbox" name="dhcp" value="dhcp" onClick="checkfunc();" $dhcpcheck></td>
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
