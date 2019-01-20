Amazon S3 bucket misconfiguration



Hi,


## Description

I have discovered one of your Amazon S3 bucket and tested it via the AWS command line tool on Linux. It looks like permissions are not well configured and allow dangerous actions to everyone.

The vulnerable bucket is: `xxxxxxxxxxxxxxxxx`


## PoC

{}


## Risk

- company impersonation, serve datas using your name
- illegal file hosting (like movies, mp3 or whatever...)
- files could be deleted
- files could be overwritten by shitty content (like porn)
- files could be infected by malicious content in an attempt to infect users or staff


## Remediation

Check all buckets owned by your company and the ACL to avoid dangerous actions to unauthorized users.


## Additional note

Since there is no way to check the owner of a bucket, it's possible that this bucket doesn't belong to you. In that case, I strongly apologize for any inconvenience.





Best regards,

Gwen

