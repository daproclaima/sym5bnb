# Sym5 BnB Application
Developer: Sébastien NOBOUR

Hosted on http://mowace-tech.com/

## What is this application ?
This is an AirBnB replica. With this application, you can book a reservation, become an host and propose your own rentings.
A system of rating is available, you can comment your host's real estate to give feedbacks to other people looking at this ad.
An admin can as well check the users, comments, ads, bookings to delete them if they do not respect common sense.

This is a not a real website, just a project I built to train myself with Symfony 5.
I could create this project thanks to Lior Chamla's course only available in FRENCH [here](https://learn.web-develop.me/symfony-4-les-fondamentaux-par-la-pratique/lu6zp)
I highly recommand it and especialy Lior's teaching way !


## Technologies used
This application is based on symfony 5. It uses as well webpack encore, bootstrap 4, jQuery, MySQL.

## How to install this application
First make sure you have on your computer:
 - php
 - composer
 - git
 - yarn or npm
 - node.js 
 - MySQL ( through MAMP, XAMP, LAMP, WAMP as long as it provides a MySQL Server)
Then follow the steps below:
- Find a directory and make a git clone of this project so:
> git clone https://github.com/DaProclaima/sym5bnb.git

- Then, install symfony and the php packages dependencies like this:
> composer install

-Then install the node.js dependencies like this:
> npm install 
or
> yarn install

## How to run this application
Before giving you the command steps, here is what we will do.
You need to enable MySQL server and symfony web server.
Although, as we use webpack, you ll need to create a compact build of the front files.
So here are the steps.

- Enable MySQL server through a (W/M/L/X)AMP application and enable mysql server
- build your front: 
> yarn build
- Run your symfony environment server:
> symfony server:start

Tadam, your app should be available at https://127.0.0.1:8000




