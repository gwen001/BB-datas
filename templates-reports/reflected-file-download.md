Reflected File Download



Hi,


I discovered an endpoints that allows command execution on a victim machine through an unsanitized parameter.


## Description

Reflected File Download is a web attack vector that enables attackers to gain complete control over a victim’s machine. In an RFD attack, the user follows a malicious link to a trusted domain resulting in a file download from that domain. Once executed, the attacker can execute commands on the client’s computer.

The value of the parameter `xxxxxxxxxx` in the endpoint below is echoed back in the response without any sanitization.
```
https://xxx.xxxxxxxxxxxx.xxx/....................
```

From here, it's possible for an attacker to create a malicious link in order to trick his victim and then gain remote access to his computer.


## PoC

{}

Check the HTML file in copy, links number 2 work perfect for me on Windows 7, Internet Explorer 8.


## Risk

- malicious file download by the victim
- arbitrary code execution on the victim machine
- full compromission of the victim machine


## Remediation

- Use exact URL mapping, no permissive url
- Sanitize user input by encoding special characters instead of escaping
- Add Content-Disposition with a “filename” attribute for APIs endpoints that are not supposed to be directly called by the user
- Whitelist Callbacks
- Require custom headers
- Require CSRF tokens when possible
- Avoid user input in API usage errors 
- Add the header `X-Content-Type-Options: nosniff` to API responses


## See also

https://www.owasp.org/index.php/Reflected_File_Download  
https://drive.google.com/file/d/0B0KLoHg_gR_XQnV4RVhlNl96MHM/view  
https://www.davidsopas.com/acunetix-got-rfded/  
https://www.trustwave.com/Resources/SpiderLabs-Blog/Reflected-File-Download---A-New-Web-Attack-Vector/  





Best regards,

Gwen

