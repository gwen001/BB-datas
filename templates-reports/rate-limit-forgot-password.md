Missing rate limit on password reset function


Hi,


## Description

Password reset functionality can be brute forced  due to lack of captcha or rate limit. Plus, depending if the account exist or not, the website displays different messages.

Email found:
"xxxxxxxxxxxxxxx"
  
Email not found:
"xxxxxxxxxxxxxxx"


## Steps to Reproduce

1/ Visit `https://xxx.xxxxxxxxxxxx.xxx`  
2/ Enter an email  
3/ Intercept the request with a proxy tool like Burp Suite  
4/ Replay the request, again and again  


## PoC

{}


## Risk

The functionality can be used to email spam a known user.
And because of the verbosity of the confirm/error message it allows an attacker to check whether an email address is really associated with an account or not.


## Remediation

- limit the functionality to x attempts in a predefined period before blocking the account
- set up a captcha to prevent robots.




Best regards,

Gwen

