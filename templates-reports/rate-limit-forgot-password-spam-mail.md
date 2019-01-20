Missing rate limit on password reset function


Hi,


## Description

The functionnality "Forgot your password ?" miss a human test, a captcha or rate limit.  
Vulnerable url: http://xxx.xxxxxxxxxxxx.xxx/............


## PoC

{}


## Risk

The functionality can be used to email spam a known user.


## Remediation

- limit the functionality to x attempts in a predefined period before blocking the account
- set up a captcha to prevent robots




Best regards,

Gwen
