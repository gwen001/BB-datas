SVN repository & source code disclosure


Hi,


I found the following SVN repository available on your servers:

http://xxx.xxxxxxxxxxxx.xxx

As you probably know, when a .svn directory is available, it's possible to download all files managed by the repository.


## PoC

http://xxx.xxxxxxxxxxxx.xxx/.svn/text-base/xxx.svn-base

{}


## Risk

An attacker could extract files that contain credentials and then get access to another part of your system, like database. Also he could find vulnerabilities in the code, like XSS or SQL injection, and exploit it to get acccess to more datas.


## Remediation

Remove dangerous files/directories from production server.



Best regards,

Gwen


