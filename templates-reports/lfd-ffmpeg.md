Local File Disclosure in xxx.xxxxxxxxxxxx.xxx




Hi,


While testing the media upload thing on `xxx.xxxxxxxxxxxx.xxx`, I found a way to display the content of local file of the server.


## Description

It seems that you use the library `FFmpeg` to deal with videos on your system. FFmpeg is usually use to convert or encode videos. However, in January 2016 a researcher found an important issue in this library when HLS (HTTP Live Streaming) is enable. 

Since HLS playlist can handle files as an external resource, it's possible to create a specially crafted video to include local file. After FFmpeg finish his job, the content of the file is displayed in the video.


## PoC

{}

Don't waste your time trying to play the video, it doesn't work :)


## Step to reproduce

1/ Download the attached file `gen_avi.py`  
2/ Execute the following command `python3 gen_avi.py /etc/passwd lfi.avi.mp4`  
3/ Create a video media in your account here:  
https://xxx.xxxxxxxxxxxx.xxx  
4/ Upload the video generated with the media uploader at the following url  
https://xxx.xxxxxxxxxxxx.xxx  
5/ Wait for a minute, the system is generating the thumbnail and probably encoding stuff  
6/ Refresh your media list  

The content of the local file will be displayed in the thumbnail and the bigger format of the video.


## Risk

Sensitive information leakage (usernames, package installed, service running...).


## Remediation

Update your FFmpeg package or recompile the package and disable HLS.


## See also

https://en.wikipedia.org/wiki/File_inclusion_vulnerability  
http://news.softpedia.com/news/zero-day-ffmpeg-vulnerability-lets-anyone-steal-files-from-remote-machines-498880.shtml  
https://docs.google.com/presentation/d/1yqWy_aE3dQNXAhW8kxMxRqtP7qMHaIfMzUDpEqFneos/edit  


__Special thanks to Neex and Cdl for their public disclosure__

https://hackerone.com/reports/243470
https://hackerone.com/reports/242831




Best regards,

Gwen

