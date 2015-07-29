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


