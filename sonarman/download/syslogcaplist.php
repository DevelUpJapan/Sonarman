<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
<?php

$str = <<< EOF
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Archived capture Download<br>
                    </div>
                </div>
                <div class="panel-body">
EOF;
echo $str;
?>
<?php
function paging($limit, $page, $disp=5){
    //$disp is max Pages
    $next = $page+1;
    $prev = $page-1;
     
    $start =  ($page-floor($disp/2) > 0) ? ($page-floor($disp/2)) : 1;//Start
    $end =  ($start > 1) ? ($page+floor($disp/2)) : $disp;//End
    $start = ($limit < $end)? $start-($end-$limit):$start;//Start re-calc
     
    if($page != 1 ) {
         print '<a href="?page='.$prev.'">&laquo; Back</a>';
    }
     
    //Link for first page
    if($start >= floor($disp/2)){
        print '<a href="?page=1">1</a>';
        if($start > floor($disp/2)) print "..."; //Display dot
    }
     
     
    for($i=$start; $i <= $end ; $i++){//Loop for pagelink
         
        $class = ($page == $i) ? ' class="current"':"";
         
        if($i <= $limit && $i > 0 )
            print '<a href="?page='.$i.'"'.$class.'>'.$i.'</a>';
         
    }
     
    //Link for last page
    if($limit > $end){
        if($limit-1 > $end ) print "...";
        print '<a href="?page='.$limit.'">'.$limit.'</a>';
    }
         
    if($page < $limit){
        print '<a href="?page='.$next.'">Next &raquo;</a>';
    }
     
    /*Debug
    print "<p>current:".$page."<br>";
    print "next:".$next."<br>";
    print "prev:".$prev."<br>";
    print "limit:".$limit."<br>";
    print "start:".$start."<br>";
    print "end:".$end."</p>";*/
     
}

function disp_log($page,$page,$max){
     
    global $logdata,$count;
     
    $start = ($page == 1)? 0 : ($page-1) * $max;
    $end   = ($page * $max);
     
    /*Debug
    print "<p>";
    print "count:".$count."<br>";
    print "max:".$max."<br>";
    print "start:".$start."<br>";
    print "end:".$end."</p>";*/
     
    print "<p>";
 
    for($i=$start;$i<$end;$i++){
        if($i >= $count){break;}
         
        //print $logdata[$i][0]."<br>";
          print('<li><a href=/sonarman/capbackup/'.$logdata[$i][0].'>'.$logdata[$i][0]."</a><font size='-1'>");
          echo'&nbsp'.$logdata[$i][1].'&nbsp;&nbsp;';  
          echo round(filesize('/var/www/sonarman/capbackup/'.$logdata[$i][0]) / 1024) . "KB &nbsp;";
          print('</font> </li>');
         
    }
    print "</p>";
}

$dirnm="../capbackup/";
$dir_h = opendir( $dirnm ) ;
 
while (false !== ($file_list[] = readdir($dir_h))) ;
closedir( $dir_h ) ;
 
$file_list2 = array() ;
 
$i = 0 ;
foreach ( $file_list as $file_name )
{
 //Display only file
 if( is_file( $dirnm . $file_name) )
 {
  $file_list2[$i][0] = $file_name ;
  $file_upd_time = filemtime( $dirnm . $file_name );
  $file_list2[$i][1] =  date("Y/m/d H:i:s", $file_upd_time) ;
  $i++ ;
  
 }
}
 
foreach($file_list2 as $key=>$value){
            $time[$key]=$value[1];    
        }
array_multisort($time,SORT_DESC,$file_list2);


$logdata = $file_list2;
$count = count($logdata);
$max = 10;
$limit = ceil($count/$max);
 
$page = empty($_GET["page"])? 1:$_GET["page"];
disp_log($page,$page,$max); 
paging($limit,$page);

?>
<?php
$str2 = <<< EOF2
                </div>
            </div>
        </div>
    </div>
</div>
EOF2;
echo $str2;
?>
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/footer.htm'); ?>

