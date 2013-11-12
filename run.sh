echo NodeJS `node -v` "+ Cheerio"
time nodejs ./n2-cheerio.js > ./results/n2-cheerio.csv
echo `php -v | grep "PHP 5" | sed -E 's/-(.*)$//'` "+ phpQuery"
time php ./p1-phpquery.php > ./results/p1-phpquery.csv
echo `php -v | grep "PHP 5" | sed -E 's/-(.*)$//'` "+ ReactPHP + phpQuery"
time php ./p2-async.php > ./results/p2-async.csv
echo "== Complete =="
