RCE on xxx.xxxxxxxxxxxx.xxx (Drupalgeddon2)


Hi,

I found that one of your website is using the famous CMS Drupal, unfortunately this version is prone to CVE-2018-7600 also called Drupalgeddon2.


## Description

The Drupal vulnerability (CVE-2018-7600), dubbed Drupalgeddon2 allows attackers to completely take over vulnerable websites.
Drupal before 7.58, 8.x before 8.3.9, 8.4.x before 8.4.6, and 8.5.x before 8.5.1 allows remote attackers to execute arbitrary code because of an issue affecting multiple subsystems with default or common module configurations.


## PoC

For the purpose of the test, I used the following script:  
https://github.com/dreadlocked/Drupalgeddon2

{}


## Risk

Remote command execution.


## Remediation

Update your Drupal install to the last version.


## See also

https://www.drupal.org/sa-core-2018-002  
https://groups.drupal.org/security/faq-2018-002




Best regards,

Gwen
