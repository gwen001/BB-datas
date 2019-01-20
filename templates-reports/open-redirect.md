Open redirect on xxx.xxxxxxxxxxxx.xxx



Hi,

I would like to report an open redirect issue on `xxx.xxxxxxxxxxxx.xxx`.


## Description

An attacker can redirect a user to any external website using the parameter `yyyy`
The parameter seems to miss sanitization, some urls don't work but some other do.

`http://google.com` doesn't work
`http://google.com/` doesn't work
`http:/google.com` works
`http:google.com` works


## Steps to Reproduce

Visit the following url:
`https://xxx.xxxxxxxxxxxx.xxx/.....`  
This will redirect you to `http://google.com`

**Browsers Verified In:**
* Firefox 49.0.2, Ubuntu 16.04


## PoC

{}


## Risk

By modifying untrusted URL input to a malicious site, an attacker may successfully launch a phishing scam and steal user credentials. Because the server name in the modified link is identical to the original site, phishing attempts may have a more trustworthy appearance.


## See also

https://www.owasp.org/index.php/Unvalidated_Redirects_and_Forwards_Cheat_Sheet




Best regards,

Gwen

