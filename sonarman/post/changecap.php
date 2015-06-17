<?php

$changecap = \filter_input(\INPUT_POST, 'changecap');
$url = \filter_input(\INPUT_POST, 'frompage');

if ($changecap === 'changecap') {
     exec('sudo /home/sonarman/shells/cap_change.sh');
}
sleep(1);
header("Location: $url");

?>
