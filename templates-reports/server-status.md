server-status on xxx.xxxxxxxxxxxx.xxx



Hi,


I found some dangerous urls on your servers that reveal informations about the servers configuration that could be very interesting from a hacker point of view. While it appears to be no sensitive information here, there is definitely a server misconfiguration/information leak that should be fixed.


## Vulnerable url

http://xxx.xxxxxxxxxxxx.xxx/server-status


## PoC

{}


## Risk

Even if it's not security issue, this reveal important informations about your system and could be used by a malicious user for a future attack. A hacker could retrieve private urls like internal admin panel.


## Remediation

- disable that kind of function on production server
- protect them with strong credentials
- use ip restriction




Best regards,

Gwen

