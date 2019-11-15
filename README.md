# php-gam
This project uses Apache\PHP and Google Apps Manager to offer information 
to those users who do not have direct access to Google Apps Manager, or any Admin Roles.

Note: There are probably many ways to optimize this code, as well as better was to do this...
 This is just the way I chose.  If you have any ideas or comments on how it could be done 
 better, quicker, stronger, faster, please let me know.

index.php - this is used to load the header, main, and footer.  I decided to use main just
 in case there were other features I wanted to add other than the current use.  
 There is a very simple login.php check done here just to stop ANYONE from being able to 
 request this info.  It isn't too secure, and if you need it removed, just remove the entire
 line. 
 
header.php - set up some information such as page and site titles, and some CSS.  Not really
 mandatory, but if you want a bit of formatting, this is where you can do it.
 
main.php - The main menu, you can modify it to include more features, or eliminate it if you
 only need to offer access to 1 thing.
 
footer.php - Close all tags, include bottom banner if needed.

email.php - This is the first menu item on main.php.  It asks for an email address than does
 processing on that email address.  Determines if it is a group or account, then returns 
 needed information based on that.  This calls functions in functions.php to get things done.
 
functions.php - The meat of this script.  It calls gam from a secure directory, and returns the
 needed results so that the email.php page can display them.
 
If an email address is a group it will return the managers and members for the group.
If an email address is an account it will return the delegates to the account as well as the
 vacation responder.
