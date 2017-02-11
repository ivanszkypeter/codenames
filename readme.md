
This is the electronical version of the board game called Codenames. 

## Install guide (Linux: Ubuntu)

Before starting the install guide be sure that PHP with sqlite support and Node.JS is intalled in your computer.

Clone the repository:
```sh
git clone git@bitbucket.org:ivanszkypeter/codenames.git
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

Navigate in your favourite browser to: http://192.168.x.x:80/

## Issues in the game

This is a test project, so there are some known - planned - security issue in the game, which would cause problems in a real game :

- Every action in any room are immediately sent to all other room (included the colors of the card), then the room check is it recipient or not.
- Everybody can easily cheat in the game by modifying the url of the room. When you add the ?role=boss ending to the url, you will see the colors of the cards without any permission check. 

## License

The original board game is designed by Vladimír Chvátil, Czech Games Edition, so you are not allowed to host this application publicly. 

The repository is under the license of Creative Commons. 

<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/"><img src="https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png" /></a>