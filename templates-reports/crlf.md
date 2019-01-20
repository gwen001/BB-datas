CRLF & cookie injection


Hi,


## Summary

The following url/server are vulnerable to CRLF attack aka Carriage Return Line Feed injection.
http://xxx.xxxxxxxxxxxx.xxx


## Description

When adding the characters `%0D%0A` in the url, it's possible to inject headers in the returned response, this leads to:

__Cookie injection__  
An attacker can inject cookies with the desired name and value and even overwrite existing cookies.

__HTTP response splitting__  
An attacker could alter the content of the page served and trick users with a corrupted url.
(not reproductible, Firefox returns an error "Corrupted Content Error")


## Steps to Reproduce

`curl -i -s "http://xxx.xxxxxxxxxxxx.xxx/%0D%0A..."`


## PoC

{}


## See also

https://www.owasp.org/index.php/CRLF_Injection  
https://www.owasp.org/index.php/HTTP_Response_Splitting  
https://www.outpost24.com/crlf-attacks  




Best regards,

Gwen

