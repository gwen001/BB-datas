Cross Site Scripting aka XSS


Hi,

I found a reflected XSS on `xxx.xxxxxxxxxxxx.xxx`.


## Description

The parameter `yyy` is missing sanitization in the following url:  
`http://xxx.xxxxxxxxxxxx.xxx/............`

Payload:  
`.......`

Which render the following code:  
`......`


## PoC

{}


## Risk

- hostile code insertion
- session hijacking
- user browser corruption


## Remediation

- encode special characters like `'` `"` `<` `>`


## See also

https://www.owasp.org/index.php/Top_10_2013-A3-Cross-Site_Scripting_(XSS)




Best regards,

Gwen
