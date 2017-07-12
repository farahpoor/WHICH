# WHICH
Web Host Integrity Check : Open Source File Integrity Monitoring with specific aim on protecting PHP files against modification

File Integrity Monitoring(FIM) is a process which executes cryptographic hash functions to producing hash of each files that must be protected and automatically and periodically compares the hash of original file with calculated hash of the current state of the file and if it finds any contrariety it will send an email to administrator about this issue.

![alt text](http://www.onlinetech.com/images/diagrams/fim-diagram.png)

Image source: http://www.onlinetech.com

According to this topic there is a Trojan With name : [PHP.Anuna](https://www.symantec.com/security_response/writeup.jsp?docid=2015-111911-4342-99&tabid=2) . read about that in Symantec website.

attackers can inject a code to all PHP files in web host and by using that can compromises the website's visitors.

The aim of developing this project is providing a way for decreasing vulnerabilities of this attack, how ever this project can use for every website which want to protect itself against attacks which can compromise  integrity of web files by injecting our changing codes. this codes may change  website view or just be a Trojan.

by using this project owner of the website can automatically check the integrity of all PHP files in his/her website and if there is problem make an alarm and send it to owner by using email.

# Method
creating Md5 hash of each file of website in all directories and sub-directories of given path and insert them in a table(file_md5), after that by using cron job in Linux server it check the hash of all PHP files in the server repeatedly  base on cron job time, and if it detects  contrariety in any php file sends an email to the owner.

# Installation
this project has two main files: 

create_md5.php : for creating md5 hash of php files in specified path and insert them to the file_md5 table in database.
check_md5.php  : for checking integrity of php files by creating md5 hash of each file and comparing it with md5 hash of each file in the database, and if can detect contrariety, send an email to the owner.

1. create a table in your database : file_md5 with these 4 columns : ID,File_Name,Source_File_Path,MD5

  then update config.php  with your database credential.

  and 

  $web_path: address of your files on the server(such as "/public_html/").

  $from: email address of your website (such as: info@example.com).

  $to: email of yours (such as : me@gmail.com).

  $subject: subject of email

2. run create_md5.php once which creates md5 hash for all files in provided directories.

3. by using this [tutorial](https://www.cyberciti.biz/faq/how-do-i-add-jobs-to-cron-under-linux-or-unix-oses/) create cron job for running check_md5.php periodically. or if your website has cpanel use cron jobs on that.

# Maintenance
when you change any php files of your website you must run create_md5.php for updating md5 hashes.

# Future
I am trying to provide an option to this project which can replace tampered files with original files automatically at any time it finds contrariety.

#Disclaimer
there is no responsibility for any loss or damage suffered as a result of using this script, always backup your stuff first.
