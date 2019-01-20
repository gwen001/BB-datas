Session never expire



Hi,

I had notice that session never expire even after closing the browser.


## Description

When a user close his browser and reopen it later (after hours) he is still connected. The session never expires even when no action are performed.


## Step to reproduce

1/ log in to your xxx account  
2/ close your browser  
3/ wait some hours  
4/ reopen your browser  
5/ go to https://xxx.xxxxxxxxxxxx.xxx, you are already connected  


## PoC

It's hard to proof that kind of issue, you can only trust me or test by yourself.  The only thing I can do is to show you screenshots with the current date.


## Risk

- session hijacking
- not having a secure session termination increases the attack surface for XSS, CSRF

For instance if a user use his account in a place that shares computers for customers, an arbritary user that would use your website could find an session opened by another member.
From here, many actions could be performed, grab personal informations, order and so on...


## Remediation

Destroy session datas on the server (db, files, cache...) after a certain amount of time of inactivity.


## See also

https://www.owasp.org/index.php/Session_Management_Cheat_Sheet  
https://www.owasp.org/index.php/Test_Session_Timeout_(OTG-SESS-007)  




Best regards,

Gwen

