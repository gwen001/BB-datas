Full Path Disclosure in xxx.xxxxxxxxxxxx.xxx


Hi,

I found some PHP errors that contains the full path of your scripts in `xxx.xxxxxxxxxxxx.xxx`.


## Vulnerable url

http://xxx.xxxxxxxxxxxx.xxx/..............


## PoC

```
xxxxx
xxxxx
xxxxx
```
{}


## Risk

This issue is not critical by itself but it can help for further attacks that require the attacker to have the full path, for example to upload a file on the server.


## Remediation

- fix/update/remove the vulnerable script
- disable PHP errors in the `php.ini` -> `display_errors: Off`


## See also

https://www.owasp.org/index.php/Full_Path_Disclosure




Best regards,

Gwen

