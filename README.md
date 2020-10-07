
## Setup

I am using XAMPP for my development server and Postman for my api testing.

hello_database_world.sql is the empty database that is used for this program.
I copy the contents of the file and paste it into my shell and hit enter.  That builds the empty database needed for
this program.  I have listed below the way to get into the mysql shell using git-bash.

All the inputting of data is handled with postman.  I have no html for user input and rely on sending
raw json data via postman.  So, if you attemt to use this keep that in mind, it's a bare bones structure.
Using the database will rely on postman for setting the headers, adjusting the request type, and, if updating or creating, writing the json in the body section manually.  Be sure to look at the table keys and use those as needed for the create and update.

note:  
I have a port variable in my Database object set to a non default mysql port.  If you use this and need to run on the default mysql port or a different port, you'll have to adjust that in the Database.php file.  For reference, the default port is 3306.

##### ----------------------    Notes and Issues    ---------------------------------------

The root of the xampp project is under:  
```
C:\xampp\htdocs
```
That is the location where apache is serving the index file. You can create a folder inside htdocs that houses your project and navigate to that location in the url bar.  'localhost/project_folder/api/do_stuff.php' in this project an example url would be:  
```
localhost/hello_database_world/api/post/read.php
```

After installing xampp I ran into an issue where it was complaining about ports being blocked.  The problem is that I already have mysql installed and it's running on the default port. But since xampp also installed mysql, it's trying to run on the same port as the other version of mysql that is installed. Phew! It was a rather simple fix though. I had to change the port numbers in the xampp ini files for my.ini and php.ini.

Here is a stackoverflow [solution](https://stackoverflow.com/questions/18177148/xampp-mysql-does-not-start) to the port problem that explains what files you need to change and their locations.  

If you haven't installed mysql then all of the port comments can be ignored.  

Since I already have another instance of mysql, if i want to use the terminal, i have to specify the port to use for xampp, which in this case is 3307.  This can be done with the --port flag.  
I'm using git-bash for my terminal sessions.  So I need to run the following:  
```
winpty mysqlsh --port=3307 -u root
```
Otherwise I would use the command:  
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

Also, when creating a new PDO object to connect to the database, you will have to 
specify the port when creating the PDO if its not the default 3306.  

example:  
```
$connection = new PDO("mysql:host=hostname;port=3307;dbname=database", username, password);
```
This took me a bit of time to figure out because I didn't think the error was comming from my access to the database because it was throwing an error on the $connection->prepare() method, which led me in the wrong direction for a while.  

Another thing to note about passwords.  If you change the default password that XAMPP gives you for phpmyadmin you have to also change the password in your config.inc.php file.  Otherwise you'll be locked out of the database since it doesn't match.  This was a problem I ran into when trying to change my password with myphpadmin.  I had to find the config file with my stored password and change it there as well.  Just something to note.  Its in the file under the phpmyadmid folder called config.inc.php