The class that creates fully resolved addresses
### example:
if i have a page with the follwing links

| Link                              | References a File Located In .  |
|--------------------------------- | -----------------------------|
|` <a href="linked_page.html">`     | Same directory as web page |
|`<a href="../linked_page.html">`    |  The page’s parent directory (up one level) |
|`<a href="../../linked_page.html">` |  The page’s parent’s parent directory (up 2 levels) |
|`<a href="/linked_page.html"> `     |  The server’s root directory |

