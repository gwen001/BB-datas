Missing session invalidation after password change




Hi,


## Description

After a successfull password change via the two functionnalities reset password and regular password change, I'm still connected to my account, on the main browser I'm connected with but on all others opened sessions on different browsers as well.


## Risk

If I decide to change my password because I suspect that someone else is currently connected to my account, 
or if I receive the confirmation mail about a password change and I didn't do this action by myself, I would probably like to change my password as fast as possible.
For that I could use the classic way or perform a reset password if the hacker already change it. Both way if the hacker is already connected to my account then it will not be disconnected and can still use my account.


## Remediation

Invalidate all sessions after password successfully change or at least all sessions that are not responsible of the action.


## See also

https://www.owasp.org/index.php/Forgot_Password_Cheat_Sheet#Other_Considerations





Best regards,

Gwen

