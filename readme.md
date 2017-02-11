
This is the test project of the board game called Codenames. The game is written in PHP (Laravel framework), Vue.JS, SCSS. You can load it from any number of different browsers even from different device. The game support the websocket based real time synchronization between them. Due the usage of websocket the game needs installed Node.JS too.
 
There are two screens in the game. This is for everyone: 
 
![Screen for everyone](https://raw.githubusercontent.com/ivanszkypeter/codenames/master/resources/assets/img/1.png)

And this screen for the leaders:

![Screen for the leaders](https://raw.githubusercontent.com/ivanszkypeter/codenames/master/resources/assets/img/2.png)

## Install guide (Linux: Ubuntu)

Before starting the install guide be sure that PHP with sqlite support and Node.JS is intalled in your computer.

Clone the repository:
```sh
git clone https://github.com/ivanszkypeter/codenames.git
```
Navigate into the downloaded folder:
```sh
cd codenames
```
Install the required PHP packages:
```sh
composer install
```
Install the required Node.JS packages:
```sh
npm install --only=production
```
Create you own environment description file for Laravel:
```sh
cp .env.example .env
```
Generate application key for the Laravel based app:
```sh
php artisan key:generate 
```
Create an empty file for the sqlite database:
```sh
touch database/database.sqlite
```
Create the databases tables:
```sh
php artisan migrate
```
Put some predefined words into them:
```sh
php artisan db:seed --class=WordsTableSeeder
```
Now the game is ready to start. The following command will start a PHP server and the same time a Node.JS server. You can specify the IP adress with the host caption, this will allow you to run your server in the local network area. 
```sh
php artisan serve --host 192.168.x.x
```

Navigate in your favourite browser to the screen for everyone: http://192.168.x.x:80/api/game/1/state

Navigate in your favourite browser to the screen for leaders: http://192.168.x.x:80/api/game/1/state?role=boss

## Issues in the game

This is a test project, so there are some known - planned - security issue in the game, which would cause problems in a real game :

- Every action in any room are immediately sent to all other room (included the colors of the card), then the room check is it recipient or not.
- Everybody can easily cheat in the game by modifying the url of the room. When you add the ?role=boss ending to the url, you will see the colors of the cards without any permission check. 

## License

The original board game is designed by Vladimír Chvátil, Czech Games Edition, so you are not allowed to host this application publicly. 

The repository is under the license of Creative Commons. 

<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/"><img src="https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png" /></a>