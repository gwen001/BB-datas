Directory listing on xxx.xxxxxxxxxxxx.xxx



Hi,


I found that one of your server that host at least one of your subdomain suffers of directory indexing.


## PoC

https://xxx.xxxxxxxxxxxx.xxx/xxxxxxxxxxxxxxxx
{}


## Risk

While this does not represent a real security issue, this reveal important informations about your system and could be used by a malicious user for a future attack.

- provide useful information for the attacker about server configuration
- gain access to source code
- compromise private or confidential data


## Remediation

- create a file named index.html in those folders
- disable directory index in Apache configuration: "Options -Indexes"


## See also

http://projects.webappsec.org/w/page/13246922/Directory%20Indexing




Best regards,

Gwen