<?php

##################################################
# Created by Abdul Ibrahim
# Jul 29, 2015 3:02:34 AM
# website http://www.abdulibrahim.com/
##################################################
include 'resolve.class.php';
$resolve = new resolve() ;
$url = 'graphs';
$page_url = 'https://github.com/abdul202php-cURL-class';
$resove_add = $resolve->resolve_address($url, $page_url);


$target = "http://www.WebbotsSpidersScreenScrapers.com/page_with_broken_links.php";
$page_base = "http://www.WebbotsSpidersScreenScrapers.com/";
# Download the web page
$downloaded_page = file_get_contents($target);
//$fully_resolved_link_address = resolve_address($link, $page_base);
preg_match_all('/<a href="(.*)">/',$downloaded_page,$links);
$count = count($links[1]);
echo "<b>Number of Urls</b> = " .$count."<p>";
for ($row = 0; $row < $count ; $row++) {
echo $links[1]["$row"]."<br />";
echo $fully_resolved_link_address = $resolve->resolve_address($links[1]["$row"], $page_base);
}

        