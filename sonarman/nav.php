<?php
$user = 'admin';

$filename = '/home/sonarman/shells/dat/passwd';
$fp = fopen($filename, 'r');
$password = fread( $fp, filesize($filename) );

$flag = fclose($fp);


if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Private Page"');
    header('HTTP/1.0 401 Unauthorized');

    die('Authentication Failure');
} else {
    if ($_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $password) {

        header('WWW-Authenticate: Basic realm="Private Page"');
        header('HTTP/1.0 401 Unauthorized');
        die('Authentication Failure');
    }
}
?>
<!DOCTYPE sonarman>
<sonarman>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/sonarman/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/sonarman/css/style.css" />
        <script language="JavaScript">
            flag = false;
            function treeMenu(tName) {
                tMenu = document.all[tName].style;
                if (tMenu.display == 'none')
                    tMenu.display = "block";
                else
                    tMenu.display = "none";
            }
            function show_alert() {
                if(confirm("Do you want to restart？"))
                  document.restart.submit();
                else
                  return false;
            }
        </script>        
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li style="padding-top:2px;"><a href="http://develup-japan.co.jp/wp/" style="padding:0px;"><img src="/sonarman/img/image000.gif" width="40" height="40" ></a></li>
                <li><a href="#" onclick="show_alert()" >Restart</a></li>
            </ul>
        </nav>
            <form name="restart" method="POST" value="reboot" action="/sonarman/post/reboot.php">
                <input type=hidden name="reboot" value="reboot" >
            </form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="<?php if($_SERVER['PHP_SELF']=='/sonarman/index.php'){echo 'active';}else{echo 'list-group-item-info';} ?>">
                            <a href="/sonarman/index.php">Information</a></li>
                        <li class="<?php if(strpos($_SERVER['PHP_SELF'], "sonarman/download/")>=1){echo 'active';}else{echo 'list-group-item-info'  ;} ?>" style="margin-bottom:2px;">
                            <a href="javaScript:treeMenu('treeMenu1')">Capture</a></li>
                        <div id="treeMenu1" style="display:none">
                            <ul>                                
                                <li><a href="/sonarman/download/syslogcaplist.php">Archived capture Download</a></li>
                               <li><a href="/sonarman/download/ringcaplist.php">Capture Download</a></li>
                            </ul>   
                        </div>
                        <li class="<?php if(strpos($_SERVER['PHP_SELF'], 'sonarman/set/')>=1){echo 'active';}else{echo 'list-group-item-info';} ?>" style="margin-bottom:2px;">
                            <a href="javaScript:treeMenu('treeMenu2')">Settings</a></li>
                        <div id="treeMenu2" style="display:none">
                            <ul>                                
                               <li><a href="/sonarman/set/ip.php">IP settings</a></li>
                               <li><a href="/sonarman/set/capfile.php">Capture settings</a></li>
                               <li><a href="/sonarman/set/passwd.php">Password</a></li>
                            </ul>   
                        </div>
                    </ul>   
                </div>