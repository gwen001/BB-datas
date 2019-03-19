
By EdOverflow:
```
Hi everyone,

Here are some ways to gather domains belonging to a particular target.

- Crawl the site and grep for URLs;
- Search through various Internet archives;
- Look up the target's IP ranges;
- Check the CSP header and other similar headers for trusted domains, some of these might belong to the target;
- Services such as https://www.crunchbase.com/ list out various brands and projects that belong to a specific company;
- Check DNS records, they often list other domains that belong to the company;
- SAN certificates can contain a nice collection of domains belonging to the same company;
- Sieve through Git(Hub|Lab) to find references of other domains;
- Check rapid7's FDNS dataset for domains;
- The builtwith browser extension shows related domains;
- Do a reverse WHOIS lookup and look for domains registered under the same email address.

I am sure there are plenty of further ways of finding more assets, 
so please feel free to expand the list in response to this email.

- Ed

P.S.: Remember to always remain in scope while testing though. ;)
```

<hr />

By EdOverflow:
```
Hi everyone,

Kacper Szurek has publicly-disclosed an unauthenticated remote code execution in Gitea, a self-hosted GIT client.

The exploit code can be found here: https://github.com/kacperszurek/exploits/tree/master/Gitea
Google dork: "Gitea Version:" "Page:" "Template:" inurl:/explore/repos

Make sure to add /explore/repos to your path-bruteforce list. You could easily use meg to find Gitea instances in the wild.

$ meg -d 100 -c 200 /explore/repos list.txt
$ grep -Hnri "gitea" out/

You can read up about this issue in more detail here: https://security.szurek.pl/gitea-1-4-0-unauthenticated-rce.html.

- Ed
```


<blockquote class="twitter-tweet" data-lang="fr"><p lang="en" dir="ltr">bug bounty tip: Use commoncrawl for finding subdomains and endpoints. Sometimes you find endpoints that can&#39;t directly be visited from the UI but has been indexed from other sites- <br>curl -sX GET &quot;<a href="https://t.co/kqLsJP6iVe">https://t.co/kqLsJP6iVe</a>&quot; | jq -r .url | sort -u <a href="https://twitter.com/hashtag/bugbounty?src=hash&amp;ref_src=twsrc%5Etfw">#bugbounty</a> <a href="https://twitter.com/hashtag/bugbountytip?src=hash&amp;ref_src=twsrc%5Etfw">#bugbountytip</a></p>&mdash; Streaak2 (@streaak) <a href="https://twitter.com/streaak/status/1015236009993203712?ref_src=twsrc%5Etfw">6 juillet 2018</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>



By Karel Origin:
```
You can get HTML documents from wayback without the toolbar (the junk wayback adds to the page) by adding 
"id_" after the timestamp, example:

https://web.archive.org/web/20180224111037id_/http://example.com/

Compared to the 'usual' page:

https://web.archive.org/web/20180224111037/http://example.com/

Karel.
```


By EdOverflow:
```
Hey everyone,

Here is a basic script that finds (sub)domain takeovers from the CSP header that I wrote quite a while ago. 
Admittedly, I haven't tested this script in a little while, but it might come in handy for some of you. By the way, 
you will need to install meg [1] in order to use this little script.

----------------------------------------------------------------------

#!/bin/bash

searches=(
    "There is no app configured at that hostname"
    "NoSuchBucket"
    "No Such Account"
    "You're Almost There"
    "a GitHub Pages site here"
    "this shop is currently unavailable"
    "There's nothing here"
    "The site you were looking for couldn't be found"
    "The request could not be satisfied"
    "project not found"
    "Your CNAME settings"
    "The resource that you are attempting to access does not exist or you don't have the necessary permissions to view it."
    "Domain mapping upgrade for this domain not found"
    "The feed has not been found"
    "This UserVoice subdomain is currently available!"
)

curl -LIs "$1" | 
grep -i "Content-Security-Policy" | 
sed 's/\( \|;\)/\n/g' | 
grep -E '[^.]+\.[^.]+$' | 
sed -E 's#https?://##I' | 
sed -E 's#/.*##' | 
sed -E 's#^\*\.?##' | 
sed -E 's#,#\n#g' | 
tr '[:upper:]' '[:lower:]' | 
sort | 
uniq > cspchecker.txt

if [[ -s "cspchecker.txt" ]]; then
    wh ile read host; do
    echo "- Checking $host."
    meg --delay 100 / $host 2> /dev/null
    done < cspchecker.txt

    for str in "${searches[@]}"; do
        grep --color -Hnri "$str" out/
    done

    echo " You can delete out/ now."

    echo "[+] Done."
else
    echo "No CSP header found on $1."
fi

----------------------------------------------------------------------

Have fun!

- Ed

[1]: https://github.com/tomnomnom/meg
```

By EdOverflow:
```
Something along these lines should do the job of automating the www trick.

  #!/bin/bash

  # ./script list.txt
  
  sed 's/^/http:\/\//g' "$1" > list-http.txt
  meg -d 10 -c 200 / list-http.txt

  sed -e 's/^/www./g' -e 's/^/http:\/\//g' "$1" > list-www.txt
  meg -d 10 -c 200 / list-www.txt

  cd out/
  wget https://raw.githubusercontent.com/tomnomnom/dotfiles/master/scripts/findtakeovers
  chmod +x findtakeovers
  ./findtakeovers

- Ed
```

By Justin Gardner:
```
Another cool thing you can do to find some nice subdomain takeovers is: 
1. Enumerate subdomains
2. Check {Subdomain}.s3.amazonaws.com for takeover-ability. 

The problem, then, becomes if you can prove that the s3 bucket belongs to the company or not. 
However, most of the time it does. 

-Justin
```


By EdOverflow:
```
Bonjour,

This is one of my favourite tricks of all time and is one that I use time and time again. While chatting with 
Frans Rosén, I misunderstood something that he was explaining and in doing so, came up with a silly trick to increase 
the number of valid subdomain takovers that I find. The trick is so simple, yet very affective in practice as 
demonstrated in https://hackerone.com/reports/312118. What you do is when scanning for subdomain takeovers always 
check www. (www.example.com) vs the basename (example.com). In my experience, the most widespread misconfiguration 
is where the developer picks one of the two to serve their page and leave the other option with dangling DNS record.

So one quick task I suggest adding to your workflow, is scanning all in scope domains and comparing www. to 
the basename. This can easily be achieved as follows:

1. Grab all domains and put them into a text file;
2. sed 's/^/www./g' list.txt;
3. sed 's#^#http://#g' list.txt;
4. meg / list.txt;
5. Finally, run TomNomNom's https://github.com/tomnomnom/dotfiles/blob/master/scripts/findtakeovers 
against the out/ directory.

You could also just run a screenshot script such as EyeWitness against the list and manually inspect the results.

Moral of the story, even misunderstanding Frans can end up uncovering valid issues. Thank you, Frans. :D

- Ed
```

By EdOverflow:
```
Hola,

If you have found an authenticated stored XSS vulnerability that requires specific permissions to exploit 
— say administrator-level access — always check to see if the POST request that transmitts the payload is 
vulnerable to CSRF or an IDOR. This will increase the impact, since as an attacker you no longer need an 
account with certain permissions to exploit the issue.

I cannot count the number of times that I have received reports and the hacker hadn't verified this. 
In two cases recently, I helped escalate the reports from $300 to $1.5k.

- Ed
```



By EdOverflow:
```
Hey everyone,

If you submit a report and want the triage team to quickly triage your report, include your test credenetials 
in the report. This is especially useful if user permissions and roles are involved.

Here is an example:

---------------------------------------------------------------------------

Hi team,

I discovered an insecure direct object reference in example.com via the id parameter on /account/settings.

## Steps to reproduce

1. Sign in using user@example.com:password1234;
2. Navigate to /account/settings;
3. Save the user details and intercept the POST request with your proxy of choice;
4. Modify the id parameter to 1337 — this id belongs to admin@example.com;
5. Forward the request and then sign in as admin@example.com:password1234;
6. You should see that admin@example.com's settings have been modified to ...

---------------------------------------------------------------------------

I think you all get the idea now. Basically, as a triager what this allows me to do, is quickly replicate the exact 
steps that you took. This is also particularly useful if you have stored XSS or an issue that we can no longer 
reproduce, but see the payload fire using your account.

Hope that helps some of you out, please feel free to submit questions to this thread and suggestions for future tips.

- Ed
```

