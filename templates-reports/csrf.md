CSRF in xxx.xxxxxxxxxxxx.xxx


Hi,


## Description

I have found a CSRF issue in `xxx` tab thats allows an attacker to change a user datas whithout his permission.


## Steps to reproduce

1/ Save the following code in `.html` file
```html
<html>
  <body>
    <form action="https://xxx.xxxxxxxxxxxx.xxx" method="POST" target="_blank">
      <input type="submit" value="Submit request" />
    </form>
  </body>
</html>
```
2/ Log on your account  
3/ open another tab  
4/ execute the scrip previously created  


## Risk

- make the user perform unexpected requests
- updating account details, making purchases, logout and even login


## Remediation

- add an unpredictable token in each HTTP request
- add a captcha
- ask user confirmation before performing any action
- ask user his password before performing any action


## See also

https://www.owasp.org/index.php/Top_10_2013-A8-Cross-Site_Request_Forgery_(CSRF)




Best regards,

Gwen

