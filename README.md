
## Setup

I am using XAMPP for my development server and Postman for my api testing.

hello_database_world.sql is the empty database that is used for this program.
I copy the contents of the file and paste it into my shell (in my case it's git-bash) and hit enter.  That builds the empty database needed for
this program.


#### ----------------------    Notes and Issues    ---------------------------------------

I have a port variable in my Database object set to a non default mysql port (3307).  If you use this and need to run on the default mysql port or a different port, you'll have to adjust that in the Database.php file.  You will need to remove, comment out or edit lines 5 and 18.  Or the lines that say
```
private $port = "3307";
";port=" . $this->port .
```
This is because when creating a new PDO object to connect to the database, you need to specify the port if it's not the default 3306.
example:  
```
$connection = new PDO("mysql:host=hostname;port=3307;dbname=database", username, password);
```
Which is why I added the port variable to my Database.php.

I realized the ports were going to be a problem because after installing xampp I ran into an issue where it was complaining about ports being blocked.  The problem was that I already had mysql installed and running on the default port. But since xampp also installed mysql, it was trying to run on the same port as the other version of mysql.  
Simply chaning the PDO port wasn't the entire solution. I also had to change the port numbers in the xampp ini files for my.ini and php.ini.

Here is a stackoverflow [solution](https://stackoverflow.com/questions/18177148/xampp-mysql-does-not-start) to the port problem that explains what files you need to change and their locations.  

If you haven't previously installed mysql before installing xampp then all of the port comments can be ignored aside from needing to handle them in the Database.php file.  
  
  
  
The root of the xampp project is under:  
```
C:\xampp\htdocs
```
That is the location where apache is serving the index file. You can create a folder inside htdocs that houses your project and navigate to that location in the url bar.  
```
'localhost/project_folder/' 
```
and it will serve the index file from the project_folder.  In this project an example url would be:  
```
localhost/hello_database_world/api/post/read.php
```

I'm using git-bash for my terminal sessions.
Since I already have another instance of mysql, if i want to use the terminal, i have to specify the port to use for xampp, which in this case is 3307.  This can be done with the --port flag.  
I need to run the following:  
```
winpty mysqlsh --port=3307 -u root
```
Otherwise, without any port issues, I would use the command:  
```
winpty mysqlsh -u root
```
xampp by default doesnt add a password, so just send an empty password.  
further documentation can be found on the [mysql](https://dev.mysql.com/doc/refman/8.0/en/multiple-servers.html) docs.  
After opening the database in the shell type:  
```
\sql
```
to switch it from js to sql.  

This should have the database connection that you will be using with xampp.  At this point you can copy paste the contents of hello_database_world.sql into the terminal and execute them to create the database used for this project.  


Another thing to note about passwords.  If you change the default password that XAMPP gives you for phpmyadmin you have to also change the password in your config.inc.php file.  Otherwise you'll be locked out of the database since it doesn't match.  This was a problem I ran into when trying to change my password with myphpadmin.  I had to find the config file with my stored password and change it there as well.  Just something to note.  Its in the file under the phpmyadmin folder called config.inc.php Search for password and change it to what you set as the phpmyadmin password.