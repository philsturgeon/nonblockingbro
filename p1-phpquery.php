<?php
require('phpQuery/phpQuery.php');
 
$time_start = microtime(true);
$total_page = 200;
$page = 1;
$header = array('', 'Rank', 'Team', 'Name', 'Point', 'Total');
 
echo ("Page number, Time taken");
while($page <= $total_page) {
    $doc = phpQuery::newDocumentFileHTML('http://fantasy.premierleague.com/my-leagues/303/standings/?ls-page='.$page);
    foreach (pq('.ismStandingsTable tr') as $data) {
        foreach (pq('td', $data) as $key => $val) {
            if ($key == 2) {
                //print pq($val)->text();
            }
        }
    }
    $time_end = microtime(true);
    $execution_time = $time_end - $time_start;
    echo ("\n".$page.", ".$execution_time);
    $page++;
}
