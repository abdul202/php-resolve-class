The class creates fully resolved addresses
### resolve_address
This is the main method <br>
```php
resolve_address($link, $page_base) 
```
$link the link found in the page <br>
$page_base the page base from which you found the above link <br>

### example:
if i have a page with the follwing links

| Link                              | References a File Located In .  |
|--------------------------------- | -----------------------------|
|` <a href="linked_page.html">`     | Same directory as web page |
|`<a href="../linked_page.html">`    |  The page’s parent directory (up one level) |
|`<a href="../../linked_page.html">` |  The page’s parent’s parent directory (up 2 levels) |
|`<a href="/linked_page.html"> `     |  The server’s root directory |

if those links are found in a page and you want to extract them and resolve them to get fully correct address<br>
```php
include 'resolve.class.php';
$resolve = new resolve() ;
$target = "https://raw.githubusercontent.com/abdul202/php-resolve-class/master/examples/page_with_links.html";
# get the page base
$page_base = $resolve->getBasePage($target);
# Download the web page
$downloaded_page = file_get_contents($target);
# exreact all links
preg_match_all('/<a href="(.*)">/',$downloaded_page,$links);
$count = count($links[1]);
for ($row = 0; $row < $count ; $row++) {
# resolve the links   
$fully_resolved_link_address = $resolve->resolve_address($links[1]["$row"], $page_base);
# echo all the fully resolved links
echo $fully_resolved_link_address .'<br>';
}
```
you will get this result
```html
https://raw.githubusercontent.com/abdul202/php-resolve-class/master/examples/linked_page.html
https://raw.githubusercontent.com/abdul202/php-resolve-class/master/linked_page.html
https://raw.githubusercontent.com/abdul202/php-resolve-class/linked_page.html
https://raw.githubusercontent.com/linked_page.html
```
### check for the base tag
before you use this class to resolve the links in pages you must check for the base tag in the source code
```html
<base href="http://www.satfrequencies.com/vb/" />
```
you need to extract this link value to resolve all page links to this base tag
to do so use the fowllwing function
in whcih i use my curl class https://github.com/abdul202/php-cURL-class
```php
include 'inc/curl.class.php';
$curl = new Curl();
/**
 * Get page base tag value if we found it or false otherwise
 * @global Curl $curl using https://github.com/abdul202/php-cURL-class
 * @param type $url the page url to check for the base tag
 * @return the base tag value or false in not found
 */
function get_base_tag ($url) {
    global  $curl;
    $curl->getFile($url);
    $page  = $curl->file;
    $doc = new DOMDocument;
    // suppress errors
    libxml_use_internal_errors(true);
    $doc->loadHTML($page);
    $xpath = new DOMXPath($doc);
    $nodeList = $xpath->query('//base/@href');
    $lenght = $nodeList->length;
    if ($lenght) {
        return $nodeList->item(0)->nodeValue;
    } else {
        return FALSE;
    }  
}
$url = 'http://www.satfrequencies.com/vb/showthread.php/-646563.html';
$paeg_base_tag = get_base_tag ($url);
if ($paeg_base_tag) {
    echo $paeg_base_tag;
} else {
    echo 'NO page base found';
}
```
