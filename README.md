# open-food-facts-example
PHP Laravel Curl API Request with CSS Flex Front-end
1. Video footage: https://youtu.be/3i52ROduyes
2. Small screenshot: https://github.com/giantpanda9/open-food-facts-example/blob/master/PreviewVideoScreenshots/OpenFoodFactsSocialScreenshot.png
3. Large screenshot: https://github.com/giantpanda9/open-food-facts-example/blob/master/PreviewVideoScreenshots/OpenFoodFactsSocialScreenshotBig.png
# Description
This project is implemented using Laravel as basis so the file must be copied into corresponding directory created as a Laravel project with the file contents update
# Notes
1. The project implemented without any front-end API or even JavaScript, because it was not stated in the intial Technical Requirements
2. I can implement the front-end for the project using plain JavaScript, JQuery or React.JS if so requested 
# Requirements
1. PHP 7.2
2. Laravel (the latest version being installed from Ubuntu 18.04 repositories)
3. php-curl
# Short installation instructions
1. create laravel project with name open-food-facts-example
2. git clone / copy this project files into open-food-facts-example directory created by laravel
3. cd open-food-facts-example / php artisan migrate
# Long installation instructions (approximate, not the last ones to follow):
1. Ubuntu mini.iso installed without any components in VirtualBox is required
2. Please set Adapter 1 in VirtualBox Guest settings to NAT value, and Adapter 2 to Network Bridge value
3. Set port redirection for Adapter one as follows(Name, Protocol, Host Address, Host port, Guest Address, Guest Port)
A. SSH, TCP, 127.0.0.1, 2222, , 22
B. WWW, TCP, , 8080, , 80
4 Need to isntall SSH server inside VirtualBox Guest to access console (sudo apt-get install openssh-server)
5 sudo apt-get update
6 sudo apt-get upgrade
7 sudo apt-get install software-properties-common (on some distros could be sudo apt-get install software-properties-common python-software-properties)
8 sudo add-apt-repository ppa:ondrej/php
9 sudo apt install php-7.2
10  sudo apt-get install php7.2-curl
11  sudo apt install mysql-server
12 sudo mysql_secure_installation 
13 sudo mysql 
14 setup mysql from secure perspective
15 create database laravel
16 setup .env file for password to mysql
17 php artisan migrate
10. sudo apt-get install php7.2-mysql php7.2-soap (for proper PHP 7.2 installetion on Ubuntu 18.04 - technically not required for the project to work)
11. sudo pecl channel-update pecl.php.net
12. sudo pecl install mcrypt-1.0.1 (required for Laravel to work properly)
13. [May not be required] sudo nano /etc/php/7.2/cli/php.ini and then add extension=mcrypt.so and extension=zip.so to the list of extensions
14. Install composer by the point 14A-14D or by point 15 (on some distros work either the first or the second):
A. php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
B. php -r "if (hash_file('sha384', 'composer-setup.php') === '8a6138e2a05a8c28539c9f0fb361159823655d7ad2deecb371b04a83966c61223adc522b0189079e3e9e277cd72b8897') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
C. php composer-setup.php
D. php -r "unlink('composer-setup.php');"
15. sudo apt-get install php7.2-zip and edit the php.ini to add zip extension if needed (see above point 13)
16. sudo apt install composer
17. composer global require laravel/installer
18. sudo apt-get install php7.2-mbstring
19. sudo composer create-project --prefer-dist laravel/laravel test1 in the directory you wish to store your laravel project
20. copy the test1 dir from the GitHub project to the laravel project directory you have created in point 19 with overwriting (cp test1(from github) to test1(on your localhost))
21. cd /path/to/test1/
22. [optional] sudo apt-get install net-tools , ifconfig and check address on the Network Bridge net card
23. [optional, if installed] sudo service apache2 stop as it will use the port 80 we want to use for artisan
24. sudo php artisan serve --host=<ip_address_from_point 22>  --port=80
25. [if you wish to test in guest os] sudo apt-get install lynx and lynx http://127.0.0.1:80

# How to run?
1. on your Host OS, in browser, please populate address line as follows:
2. http://127.0.0.1:8080/openFoodFacts
