Missing rate limit on login function


Hi,


## Description

Login functionality can be brute forced  due to lack of captcha or rate limit.


## Steps to Reproduce

1/ Visit `https://xxx.xxxxxxxxxxxx.xxx`  
2/ Enter bad credentials  
3/ Intercept the request with a proxy tool like Burp Suite  
4/ Replay the request, again and again  


## PoC

{}


## Risk

The functionality can be used to brute force any user account.


## Remediation

- limit the functionality to x attempts in a predefined period before blocking the account
- set up a captcha to prevent robots.




Best regards,

Gwen
