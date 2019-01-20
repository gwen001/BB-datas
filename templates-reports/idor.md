IDOR in xxx.xxxxxxxxxxxx.xxx


Hi,

I found an Insecure Direct Object Reference issue in the functionnality xxxxx in `xxx.xxxxxxxxxxxx.xxx`


## Description

The function to xxxxx of a xxxxxx doesn't properly check the owner of xxxxxxx.
Because of that, another user could perform the action even if he doesn't own the concerned object.


## Step to reproduce

1/   
2/   
3/   


## PoC

{}


## Risk

Data compromise.


## Remediation

Check that the user who performs the action is the owner of the concerned object.



## See also

https://www.owasp.org/index.php/Top_10_2013-A4-Insecure_Direct_Object_References




Best regards,

Gwen


