<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
<?php
$str = <<< EOF
                <div class="col-xs-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Top</div>
                        </div>
                        <div class="panel-body">
                            <p>Infomation</p>
                            <ul class="list-group">
                                <li class="list-group-item">Model Number：SMV-001</li>
                                <li class="list-group-item">Firmware version：ver 1.01</li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                </div>
EOF;
echo $str;
?>
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/footer.htm'); ?>