User enumeration via SMTP server


Hi,

Some of your mail servers seems to be vulnerable to SMTP user enumeration via VRFY/RCPT/EXPN command.


## Vulnerable servers

xxx.xxx.xxx.xxx


## PoC

{}


## Risk

An attacker could guess the services running on the server and obtain usernames for future attacks.


## Remediation

If possible disable the commands VRFY, RCPT and EXPN.




Best regards,

Gwen

