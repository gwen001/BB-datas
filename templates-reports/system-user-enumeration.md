System user enumeration



Hi,

Looks like there is something like userdir mod enabled on http://xxx.xxxxxxxxxxxx.xxx, that means it's possible to enumerate system user by calling the following url:  
`http://xxx.xxxxxxxxxxxx.xxx/~[USERNAME]`

If the user do exist the site returns a 301 status code.  
If the user doesn't exist the site returns a 404 status code.


## PoC

{}


## Risk

After getting some usernames, an attacker could try to brute force the password via an other service.


## Remediation

If possible disable any userdir mod.




Best regards,

Gwen

