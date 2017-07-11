# WHICH
Web Host Integrity Check 

There is Trojan In the Internet With name : [PHP.Anuna](https://www.symantec.com/security_response/writeup.jsp?docid=2015-111911-4342-99&tabid=2) . read about that in Symantec website.

attackers can inject a code to all PHP files in web host and by using that can compromises the website's visitors.

The aim of developing this project is providing a way for decreasing vulnerabilities of this attack, how ever this project can use for every website which want to protect itself against attacks which can compromise  integrity of web files by injecting our changing codes. this codes may change  website view or just be a Trojan.

by using this project owner of the website can automatically check the integrity of all PHP files in his/her website and if there is problem make an alarm and send it to owner by using email.

The method is :  creating Md5 hash of each file of website in all directories and sub-directories of given path and insert them in a table(file_md5), after that by using cron job in Linux server it check the hash of all PHP files in the server repeatedly  base on cron job time, and if it detects  contrariety in any php file sends an email to the owner.

this project has two main files: 

create_md5.php : for creating md5 hash of php files in specified path and insert them to the file_md5 table in database.
check_md5.php  : for checking integrity of php files by creating md5 hash of each file and comparing it with md5 hash of each file in the database, and if can detect contrariety, send an email to the owner.
