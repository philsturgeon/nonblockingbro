var start = +new Date();
var request = require('request');
var cheerio = require('cheerio');
var total_page = 200;
var page = 1;
var header = ['', 'Rank', 'Team', 'Name', 'Point', 'Total'];

require('http').globalAgent.maxSockets = 64;

console.log("Page number, Time taken");
 
while (page <= total_page) {
    var url = 'http://fantasy.premierleague.com/my-leagues/303/standings/?ls-page='+page;
    request(url, (function(i) {
        return function (error, response, body) {
            $ = cheerio.load(body);
            $('.ismStandingsTable').find('tr').each(function(index, elem){
                $(this).find('td').each(function(head){
                    if (head == 2) {
                        //console.log(header[head]+ ' : '+$(this).text());
                        //console.log($(this).text());
                    }
                });
            });
            var end = +new Date();
            console.log(i +", "+(end-start)/1000);
        }
    })(page)); //bind everything with page number
    page++;
}