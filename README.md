# Wainwright Casino Tools: Heroku Skeleton 
This repository is to be the blank canvas for any casino project and serves as a good 1-click deploy starting point. 

Simply drop your development within the *.wainwright* folder and add to composer.json *wainwright/{your_package_tag}*.

All Wainwright related products are completely free of charge.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

### Prerequisites
+ PHP (and ideally some Laravel) knowledge.
+ A Heroku user account: [SignUp is free and instant](https://signup.heroku.com/signup/dc)
+ Familiarity with [getting started with PHP on Heroku](https://devcenter.heroku.com/articles/getting-started-with-php) guide, with the following things installed on your **local** machine:
+
    +PHP.
    +Composer.
    +Heroku CLI.

### Heroku CLI
Heroku offer cloud hosting in ephemeral form, basically being a pipeline for lazy/solo people. I'm not sure for productional if you want to run this over bare.
You can use Heroku totally free of charge: instant deploy applications, database and queues on this platform. 

As I'm not the best docs writer this allows me to cut down on explaining stuff and you can get straight to offer 2-4k+ slotmachines by single click instead and get used to project structures just by creating around. If you mess up because being ephemeral, you can simply just restart machine to restore the state.

Below installation explaination is in combination with Heroku CLI. To do that we need to run this set of commands in our command-line which will be found [here](https://cli.heroku.com/) from your dev/local environment.

__

## Install Laravel Application
First setup this repository on your local machine:
```bash 
$ git clone {this_repository_url}.git wainwright
$ cd wainwright
$ git init
$ git add .
$ git commit -a -m "new Wainwright project"
```

Update composer.lock (Heroku takes updates from composer.lock over composer.json):
```bash
$ composer update --ignore-platform-reqs
$ git add .
$ git commit -a -m "updating composer.lock"
```

Now we "attach" this repository on your local machine to a Heroku host using Heroku CLI:
```bash
$ heroku login
$ heroku create wainwright
```

Heroku automatically will add db credentials to the config variables. You can review these also by calling heroku pgsql:credentials. 
Create database for application:
```bash
$ heroku addons:create heroku-postgresql:hobby-dev
```

Update Laravel .env.heroku variables to your Heroku host (or by running *./push_env.sh*):
```bash
$ cp .env.heroku .env
$ <edit .env to your liking>
$ heroku config:set $(cat .env | sed '/^$/d; /#[[:print:]]*$/d')
```

Now we are ready to launch application:
```bash
$ git push heroku master
```

Generate application key & migrate database tables:
```bash
$ heroku run php artisan key:generate
$ heroku run php artisan migrate
```

Your application should now be running live. You can check if all is working correct:
```bash
$ heroku open
```



## Updating Heroku
To update host, all you do is commit and push:
```bash
$ git add .
$ git commit
$ git push heroku master
```

___

## Assigning Static IP to Dyno/Host
Static IP (outgoing traffic) is important if using IP filters within casino plugins as part of internal security. 

You can easily assign static/dedicated IP by using external addon:
```
heroku addons:create ipburger:free -a wainwright
```

You can find more of such (and most of time totally free) services within [Heroku's Marketplace](https://elements.heroku.com/addons).

___


## Wainwright Plugins
After having this base app live & functioning properly, you can add wainwright plugins contents within the .wainwright folder in this base app. 

You then proceed and load the actual plugins by adding running:
```bash
$ composer require wainwright/{plugin_tag}
$ composer update
$ git push heroku master
```

__


## Setting up to use _existing_ Heroku
To setup the remote link to existing Heroku host (for example after re-install PC or switching dev areas):
```bash
heroku git:remote -a wainwright
```

You can also clone the heroku app's running files:
```bash
$ heroku git:clone -a wainwright
```



## Pushing The Database
We have two ways of pushing the database.

### First Option
If you want to start a fresh without anything you may run the following command:

```bash
$ heroku run php /app/artisan migrate
```

### Second Option
This is done if you want to push your local db to the database in heroku:

```bash
heroku pg:push <The name of the db in the local psql> DATABASE_URL --app <heroku-app>
```

## Very Helpful Articles
+ [Configuring Postgre](https://mattstauffer.com/blog/laravel-on-heroku-using-a-postgresql-database/)
+ [Getting started with heroku laravel](https://devcenter.heroku.com/articles/getting-started-with-laravel)
+ [Best Practices](https://devcenter.heroku.com/articles/getting-started-with-laravel#best-practices)
+ [Further Reading](https://devcenter.heroku.com/articles/getting-started-with-laravel#further-reading)


## Footnote and goal of this project as a whole

All free casino plugins that will be released will be made to easily be run **ephemeral** within Heroku (and for that matter any similar cloud provider). 

Final goal is to be able to actually customize very specifically each host as a micro API service on it's own by click on button and that way scale exactly as you need with very specific services. Most services have been made already and now I will be working on making these into small one-click-launch services.

Meanwhile make sure to check in-to the main documentation (to be made) for actual thievery done by casino's like [Stake.com](Stake.com), [Superbet.com](Superbet.com), GiG.com, [777.nl](777.nl), Premiercasino.com, [MGMBets.com](https://mgmbets.com), MicroGaming and many more.

Chapters like Dutch [Mollie.nl](https://mollie.nl) laundry, stealing 300M as PayVision/SlotVision from ING Bank, [Telecom laundry](https://github.com/shlomoVIVO/telecom_centrifuge), offering in illegal gaming areas are orchistrated by people like David G. Wainwright (playtech/hollywoodtv/upgaming/softgaming/inbet/goldenrace/tvbet/gijabet), Vlad Suciu (playtech), Laurence Phillipe (theroyalcompany.nl), Ilya Koral (softswiss.com), Matteo Di Matteo(mondogaming.com/1xbet), Dejan Jovic(blueoceangaming/1xbet).

Much more indepth info to be relreased, such as bridging methods thoroughly explained, though to be hundreds of pages and is to be done in the end so I don't end up polluting tech docs (like I am doing now) of something I enjoy building to learn new skills.

