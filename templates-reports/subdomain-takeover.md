Subdomain take over (xxx.xxxxxxxxxxxx.xxx)



Hi,


## Description

You have a subdomain aka `xxx.xxxxxxxxxxxx.xxx` that point to a third party service hosted on XXX: `www.XXX.com`. The nslookup command shows the DNS configuration.

```
$ nslookup xxx.xxxxxxxxxxxx.xxx 8.8.8.8
```

However it seems that your didn't own/claim the name `YYY` on XXX. That means an attacker could take it and trick your users/staff by copying your primary website and design.


## PoC

{}


## Risk

- fake website
- malicious code injection
- users tricking
- company impersonation

This issue can have really huge impact on the companies reputation someone could post malicious content on the compromised site and then your users will think it's official but it's not.


## Remediation

Remove the cname entry or claim the subdomain `YYY` on XXX.


## See also

https://labs.detectify.com/2014/10/21/hostile-subdomain-takeover-using-herokugithubdesk-more/  
https://0xpatrik.com/subdomain-takeover/  
https://medium.com/@ajdumanhug/subdomain-takeover-through-external-services-f0f7ee2b93bd  
http://yassineaboukir.com/blog/neglected-dns-records-exploited-to-takeover-subdomains/  


## Additional note

I claimed the domain on XXX, let me know if you want to get it back, I'll delete it soon.



Best regards,

Gwen

