Invalidated Cookies



Hi,

I notice that cookies are not invalidated after logout.


## Description

When a user ask to logout, the following url is called:  
`https://xxx.xxxxxxxxxxxx.xxx`

The cookie is deleted in the client side but it seems to persist on the server, that means the session is still valid.


## Step to reproduce

1/ log in to your account  
2/ visit an url with personal infos like `https://xxx.xxxxxxxxxxxx.xxx/............`  
3/ intercept the request with a local proxy like Burp Suite  
4/ logout in your browser  
5/ replay the request catched in step 3  
6/ take a look at the response, you can still see your personal infos  


## PoC

{}


## Risk

- session hijacking
- not having a secure session termination increases the attack surface for xss, csrf


## Remediation

Destroy session datas on the server (db, files, cache...).


## See also

https://www.owasp.org/index.php/Session_Management_Cheat_Sheet  
https://www.owasp.org/index.php/Testing_for_logout_functionality_(OTG-SESS-006)



Best regards,

Gwen

