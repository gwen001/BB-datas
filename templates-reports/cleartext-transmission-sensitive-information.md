
## Description

One of your web application (http://xxx.xxxxxxxxxxxx.xxx) has login form and posting submitting datas to server over insecure medium in clear text as the submitted data containing users credentials which is sensitive information should not be transmitted over HTTP.


## Steps to reproduce

1/ Visit http://xxx.xxxxxxxxxxxx.xxx  
2/ Submit login details  
3/ Check the request history  


## Request dump

** burp dump**


## Impact

Attacker can actively sniff the network and capture the submitted credentials of the victim and others users.


## Possible fix

Move the application over HTTPS.




Best regards,

Gwen
