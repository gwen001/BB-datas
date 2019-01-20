Clickjacking



Hi,

The website http://xxx.xxxxxxxxxxxx.xxx is vulnerable to clickjacking. I won't create a report for every page because this is a general problem.


## PoC

{}


## Risk

An attacker could embed your website in an iframe and by tricking the UI, the user himself could unintentionally perform dangerous actions.
You may think that kind of attack is not so dangerous but combined with other vulnerabilities, it could be deadly.


## Remediation

- set a correct value to the HTTP header `X-Frame-Options`  
https://developer.mozilla.org/fr/docs/HTTP/Headers/Content-Security-Policy

- set a correct value to the HTTP header `Content-Security-Policy`  
https://developer.mozilla.org/fr/docs/HTTP/Headers/X-Frame-Options

- implement a frame breakder  
https://www.thesitewizard.com/archive/framebreak.shtml


## See also

https://www.owasp.org/index.php/Clickjacking




Best regards,

Gwen

