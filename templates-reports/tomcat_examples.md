Cookies and session injection




Hi,


On the server xxx.xxx.xxx.xxx that host xxx.xxxxxxxxxxxx.xxx, Tomcat examples have been installed  and they are reachable by anybody at the following url:  
https://xxx.xxxxxxxxxxxx.xxx/examples/

One of the example allows to create cookies and one other allows to inject datas in session.  
If cookie injection is not a big deal since they can be created in many other ways, session injection can be dangerous.


## PoC

https://xxx.xxxxxxxxxxxx.xxx/examples/servlets/servlet/SessionExample
{}

I intentionnaly change the value of JSESSIONID to show you that everything is possible, even trick an existing valid session.


## Risk

Gain unexpected access/privileges in webapps hosted on the same Tomcat server.


## Remediation

Disable public access to /examples directory or delete it.




Best regards

Gwen

