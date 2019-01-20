VPN key hash disclosure



Hi,

One of your server that you use as a VPN gateway leaks his key.


## Description

Your vpn gateway on `xxx.xxx.xxx.xxx` uses the IKE protocol for authentification. This server deals with aggressive mode so we can retrieve the authentification hash in clear text. Then it would be possible to crack this key to and gain an authorized access to the VPN.


## PoC

```sh
$ nmap 
.....
.....
.....
.....
.....
```

{}


## Risk

A hacker could crack the password and then access to your internal network.


## Remediation

Disable the Aggressive mode and switch to Main mode.


## Additional note

A real motivated attacker would run a program like John the Ripper for days and days until he find it.


## See also

https://blog.silentsignal.eu/2014/04/17/isakmp-aggressive-psk-tools/  
http://carnal0wnage.attackresearch.com/2011/12/aggressive-mode-vpn-ike-scan-psk-crack.html



Best regards,

Gwen

