# WHICH
Web Host Integrity Check 

There is Trojan In the Internet With name : [PHP.Anuna](https://www.symantec.com/security_response/writeup.jsp?docid=2015-111911-4342-99&tabid=2) . read about that in Symantec website.
attackers can inject a code to all PHP files in web host and by using that can compromises the website's visitors.
The aim of developing this project is providing a way for decreasing vulnerabilities of this attack, how ever this project can use for every website which want to protect itself against attacks which can compromise  integrity of web files by injecting our changing codes. this codes may change  website view or just be a Trojan.
by using this project owner of the website can automatically check the integrity of all PHP files in his/her website and if there is problem make an alarm and send it to owner by using email.
The method is :  using MD5 hash for finding hash of each file of website and insert it in a database, after that by using cron jobs in Linux server it check the hash of all PHP files in the server base on cron job time, and if it detects a contrariety in any file sends an email to the owner.
