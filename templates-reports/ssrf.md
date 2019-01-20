Server Side Request Forgery aka SSRF
Cross Site Port attack aka XSPA


Hi,

I found a Server Side Request Forgery in `xxx.xxxxxxxxxxxx.xxx` in the xxxxxxx functionnality.


## Description

...............................................


## Step to reproduce

1/  
2/  
3/  


## PoC

{}


## Risk

- scan random target machine on the internet
- scan systems from the internal network that are not normally accessible
- enumerate and attack services that are running on these hosts


## Remediation

- return response as similar as possible whatever the user input
- use blacklist approach to forbid internal networks (localhost, 0.0.0.0, 10.*, 127.*, 172.16.*, 192.168.*) and protocols (file, gopher, ftp...)


## See also

https://www.owasp.org/index.php/Server_Side_Request_Forgery  
https://medium.com/@auxy233/the-design-and-implementation-of-ssrf-attack-framework-550e9fda16ea




Best regards,

Gwen

