htaccess world readable



Hi,

It appears that there is a misconfiguration that is causing the contents of the `.htaccess` to become world readable. While this does not represent an immediate security issue, there is definitely a server misconfiguration/information leak that should be fixed.



## Vulnerable urls

http://xxx.xxxxxxxxxxxx.xxx/.htaccess


## Excerpt

```
...
```


## Remediation

Restrict access to files that begins by `.ht`

- Apache
<FilesMatch "^\.ht">
    Require all denied
</FilesMatch>

- Nginx
location ~/\.ht {
    deny all;
}




Best regards,

Gwen
