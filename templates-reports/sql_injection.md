SQL injection in xxx.xxxxxxxxxxxx.xxx



Hi,

I found a SQL Injection at the following url:  
`http://xxx.xxxxxxxxxxxx.xxx/.................`


## PoC

Visit the following url:  
`http://xxx.xxxxxxxxxxxx.xxx/...........`
{}


## Risk

- database export
- user/admin account takeover
- defacement (data loss, seo loss)
- phishing
- code corruption, malware injection
- file upload
- remote command execution


## Remediation

- sanitize input parameters
- use sql prepared statement


## See also

https://www.owasp.org/index.php/Top_10_2013-A1-Injection



Best regards,

Gwen

