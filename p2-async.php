<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require('phpQuery/phpQuery.php');
require('vendor/autoload.php');

$time_start = microtime(true);
$total_page = 200;

$loop = React\EventLoop\Factory::create();
 
$dnsResolverFactory = new React\Dns\Resolver\Factory();
$dnsResolver = $dnsResolverFactory->createCached('8.8.8.8', $loop);
 
$factory = new React\HttpClient\Factory();
$client = $factory->create($loop, $dnsResolver);


echo "Page number, Time taken";
for ($page = 1; $page <= $total_page; $page++) {

    $loop->addTimer(0.001, function($timer) use ($client, $page) {
        $buffer = '';
        $request = $client->request('GET', 'http://fantasy.premierleague.com/my-leagues/303/standings/?ls-page='.$page);
        $request->on('response', function($response) use (&$buffer) {
            $response->on('data', function($data) use (&$buffer) {
                $buffer .= $data;
            });
        });
        $request->on('end', function() use (&$buffer, $page) {

            \phpQuery::newDocument($buffer);

            foreach (pq('.ismStandingsTable tr') as $data) {
                foreach (pq('td', $data) as $key => $val) {
                    if ($key == 2) {
                        // print pq($val)->text();
                    }
                }
            }

            $time_end = microtime(true);
            $execution_time = $time_end - $GLOBALS['time_start'];
            echo ("\n".$page.", ".$execution_time);

        });
        $request->end();
    });
}

$loop->run();

