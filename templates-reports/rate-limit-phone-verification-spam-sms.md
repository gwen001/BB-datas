Missing rate limit on phone verification function


Hi,


## Description

The functionnality "Phone verification" miss a human test, a captcha or rate limit.  
Vulnerable url: http://xxx.xxxxxxxxxxxx.xxx/...........


## PoC

{}


## Risk

The functionality can be used to SMS spam a known phone number.


## Remediation

- limit the functionality to x attempts in a predefined period before blocking the account
- set up a captcha to prevent robots.




Best regards,

Gwen
