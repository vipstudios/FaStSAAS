# FaStSAAS
PHP Session Management Framework

FaStSAAS v.3.1*"#HaulsAas!"

*FaStSAAS By James Schulze 06-06-2016 ;{>
"Fast Software as a Service"

Dynamic Objects allow you to do anything w/PHP 
Create a login form object d01 on page vu=1:1 and a signup form d02 on page 1:2
Create a data loop on 2:1 that allows logged in members a home page or redirected to login
Pages are dynamic and can go up to vu=9999:9999:9999:9999:9999
Drop fastsaas.php into a folder that can be protected from the www with mod_rewrite or rename index.php
Then make Jquery Ajax calls to include dynamic content into @ny div
Imagine making a virtual website with no template like so:

./www-cgi/fastsaas.php?vu=1:1     =d04=   Home Page
./www-cgi/fastsaas.php?vu=2:1     =d01=   Account Page
./www-cgi/fastsaas.php?vu=2:1     =d02=   Signup Page
./www-cgi/fastsaas.php?vu=3:1     = =     Directory Page
./www-cgi/fastsaas.php?vu=4:1     =d03=   Auctions Page
./www-cgi/fastsaas.php?vu=5:1     = =     Classifieds Page
./www-cgi/fastsaas.php?vu=6:1     = =     Networking Page
./www-cgi/fastsaas.php?vu=7:1     = =     Games Page
./www-cgi/fastsaas.php?vu=8:1     = =     Events Page
./www-cgi/fastsaas.php?vu=9999    =d9999= Logout Page

Now to create content for these pages just decide what you need to do. For example,
Let's say on the Home Page we only need to create a data loop to get a html layout from a db, well, then
create a data loop. It's up to you to track dynamic objects and what you've used and what you havn't. You
can also have multiple objects per page (ie. d04,d05,d06 all exist on Home Page). If you create a form
it will NOT hit the dynamic object loop until all form elements pass their reg expression patterns. Data
Objects test true and will go straight into executing code in whatever loop you create.
I used d01 as a login form, d02 for a signup form, d03 for a data loop for the Account Page so we could
use d04 on index and if the goal is to query a db table and get a html template for advertising then we
would do this like so:
