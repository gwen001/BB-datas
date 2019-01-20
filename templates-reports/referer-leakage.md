Cross-domain Referer leakage leads to account takeover


Hi,


## Description

The functionality "Forgot Your Password?" send a link to the user in order to create a new password. This link looks like this:
https://xxx.xxxxxxxxxxxxxxxxxxx.xxx

When you reach this page, many external resources are loaded, but some of them receive the link as the Referer header. As you probably know this will be logged by the servers of those 3rd party services.


## PoC

{}
{}
{}



## Risk

The owner of the external resource could sniff the links to create new passwords and then takeover the accounts.

This is as more as dangerous that the user is connected immediately after changing his password without any confirmation.

The issue is mitigated by the fact that the link (and only this one) is expired after the user confirms the new password.


## Additional note

For instance some external resources that receive the link are:
```
xxx.xxxxxxxxxxxxxxxxxxx.xxx
xxx.xxxxxxxxxxxxxxxxxxx.xxx
xxx.xxxxxxxxxxxxxxxxxxx.xxx
```

Plus some of them receive thie link as a GET parameter, that means the external resource loaded by those pages will also get the email and the token, it simply spread the received Referer (so the link to create a new password) to other 3rd party services, there is no way for you to control how far this leak would go.


## Remediation

- add `<meta name="referrer" content="never">` in the email
- set the attribute `rel="noreferrer"` in the concerned link
- ask a confirmation to the user to avoid account takeover
- add a date/time limit to the links.
- disable all links when the user login whatever the way.


## See also

https://portswigger.net/kb/issues/00500400_cross-domain-referer-leakage




Best regards,

Gwen

