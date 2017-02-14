
This is the test project of the board game called Codenames. The game is written in PHP (Laravel framework), Vue.JS, SCSS. You can load it from any number of different browsers even from different device. The game support the websocket based real time synchronization between them. Due the usage of websocket the game needs installed Node.JS too.
 
There are two screens in the game. This is for everyone: 
 
![Screen for everyone](https://raw.githubusercontent.com/ivanszkypeter/codenames/master/resources/assets/img/1.png)

And this screen for the leaders:

![Screen for the leaders](https://raw.githubusercontent.com/ivanszkypeter/codenames/master/resources/assets/img/2.png)

## Install guide (Linux: Ubuntu)

Before starting the install guide be sure that PHP with sqlite support, Node.JS is intalled, and Redis server is running on your computer.

Clone the repository:
```sh
git clone https://github.com/ivanszkypeter/codenames.git
```

> If you want to skip the following steps, do all the steps of the install with only one command:
> ```sh
> ./linux-install.sh
> ```

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

## Install guide (Windows 10)

Before starting the install guide be sure that XAMPP, Composer, Node.JS is intalled on your computer.

> If you want to skip the following steps, do all the steps of the install with only one command:
> ```sh
> ./windows-install.sh
> ```

Open a Git Bash, do all the steps from the linux installation guide and continue with these steps:

Downloaded the latest version of redis:

```sh
curl https://raw.githubusercontent.com/ServiceStack/redis-windows/master/downloads/redis-latest.zip > redis-latest.zip
```

Unzip the downloaded file:

```sh
unzip redis-latest -d redis
```

## Run the application

Now the game is ready to start. The following command will start a PHP server and the same time a Node.JS server. You can specify the IP adress with the host caption, this will allow you to run your server in the local network area.
```sh
php artisan serve --host 192.168.x.x
```

Navigate in your favourite browser to the screen for everyone: http://192.168.x.x:8000/game/room/1

Navigate in your favourite browser to the screen for leaders: http://192.168.x.x:8000/game/room/1?role=boss


## Issues in the game

This is a test project, so there are some known - planned - security issue in the game, which would cause problems in a real game :

- Every action in any room are immediately sent to all other room (included the colors of the card), then the room check is it recipient or not.
- Everybody can easily cheat in the game by modifying the url of the room. When you add the ?role=boss ending to the url, you will see the colors of the cards without any permission check. 

## License

The original board game is designed by Vladimír Chvátil, Czech Games Edition, so you are not allowed to host this application publicly. 

The repository is under the license of Creative Commons. 

<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/"><img src="https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png" /></a>
