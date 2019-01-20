Local file inclusion on xxx.xxxxxxxxxxxx.xxx




Hi,


## Description

The parameter `xxxxxx` at the following url is vulnerable to Local File Inclusion:
```
https://xxx.xxxxxxxxxxxx.xxx
```


## PoC

Click on one of the following link:
https://xxx.xxxxxxxxxxxx.xxx

{}


## Risk

- sensitive information leakage (usernames, package installed, service running...)
- remote command execution


## Remediation

- sanitize all input parameters to disallow directory traversal
- create a whitelist of files that can be included


## See also

https://www.owasp.org/index.php/Testing_Directory_traversal/file_include_(OTG-AUTHZ-001)




Best regards,

Gwen

