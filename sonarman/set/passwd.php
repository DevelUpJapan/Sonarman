
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/sonarman/nav.php'); ?>
<?php
$str = <<< EOF
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>
      $(function() {
          var changeMaskPasswd = function() {
              $('.passwd')[0].type =
                  $('.mask-passwd')[0].checked ? 'password' :'text';
          }
          $('.mask-passwd').click(function() {
              changeMaskPasswd();
          });
          changeMaskPasswd();
      });
    </script>
      
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Password</div>
                </div>
                <div class="panel-body">
                    <form action="../post/passwd.php" method="post">
                        <table style="border-style: none;">
                            <tr>
                                <td>NewPassword &nbsp;</td>
                                <td><input class="passwd" type="password" name="passwd" autocomplete="off">
                                          <label><input type="checkbox" checked="checked" class="mask-passwd">
                                          Mask password</label>
                                </td>
                            </tr>
                            <tr>
                                 <td colspan="2" align="center">
                                 <br><input type="submit" value="set">
                                </td>
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

