## Diploma-Project-Math-Site
# Glorified geometry calculator, but with a twist.

1. Логин и регистрация; 
2. Решения за прости типове задачи свързани с триъгълници, четириъгълници и кръгове; 
3. Решения на задачи, включващи допълнителни построения към фигурите; 
4. Избор за запазване на задачи към профила на потребителя; 
5. Генериране на текстово обяснение как е била решена задачата, с линкове към използваните формули на сайта;
6. Графично изобразяване на математически подобна фигура на тази зададена от потребителя; 
7. Генериране на задачи по образец;
8. Възможност за водено създаване на задачи;
9. Генериране на print friendly страница / pdf за изпитни работи;
10. Блог за задачи, които сайта не може да реши(видим за всички) с опция за коментиране. 

#How to build the project:
1.Install XAMPP for Linux or WAMPP for Windows(both work).
2.Place the project folder Diploma-Project-Math-Site from github in the
(LAMPP or WAMPP installation folder)/htdocs folder.
3.Use the command composer install in the command line (from the same directory where composer.json is located). If you don't have an installed composer yet, first install it.
    For linux users:https://www.osradar.com/how-to-install-composer-on-linux/
    For windows users:https://www.javatpoint.com/how-to-install-composer-on-windows
4.Install THREE.js: https://threejs.org/docs/#manual/en/introduction/Installation
5.Add a /Model/Repository/config.php file:
    <?php
define('DB_HOST', 'localhost');
define('DB_PORT', '3307');
define('DB_NAME', 'Math Diploma Project');
define('DB_USER', 'root');
define('DB_PASS', '');
6.Run XAMPP with at least the Apache and MySQL options turned on.
7.Go to http://localhost/Diploma-Project-Math-Site/View/main.php to access the site.
