## Prerequisites
+ PHP (and ideally some Laravel) knowledge.
+ A Heroku user account: [SignUp is free and instant](https://signup.heroku.com/signup/dc)
+ Familiarity with [getting started with PHP on Heroku](https://devcenter.heroku.com/articles/getting-started-with-php) guide, with the following things installed:
		+PHP.
		+Composer.
		+Heroku CLI.

#### Heroku CLI
Best is to use Heroku CLI to deploy and also develop Wainwright app.
To do that we need to run this set of commands in our command-line which will be found [here](https://cli.heroku.com/).


# About Laravel Application
Laravel powers base of all wainwright casino plugins. This repository is used for deploying a base laravel application, ready to be added Wainwright casino plugins.
You need PHP, Composer, Heroku CLI (optional yet preferable) and Heroku Account (free).

__

# Install Laravel Application
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



# Updating Heroku
To update host, all you do is commit and push:
```bash
$ git add .
$ git commit
$ git push heroku master
```



# Wainwright Plugins
After having this base app live & functioning properly, you can add wainwright plugins contents within the .wainwright folder in this base app. 

You then proceed and load the actual plugins by adding running:
```bash
$ composer require wainwright/{plugin_tag}
$ composer update
$ git push heroku master
```




# Setting up to use _existing_ Heroku
To setup the remote link to existing Heroku host (for example after re-install PC or switching dev areas):
```bash
heroku git:remote -a wainwright
```

You can also clone the heroku app's running files:
```bash
$ heroku git:clone -a wainwright
```



# Pushing The Database
We have two ways of pushing the database.

## First Option
If you want to start a fresh without anything you may run the following command:

```bash
$ heroku run php /app/artisan migrate
```

## Second Option
This is done if you want to push your local db to the database in heroku:

```bash
heroku pg:push <The name of the db in the local psql> DATABASE_URL --app <heroku-app>
```



# Very Helpful Articles
+ [Configuring Postgre](https://mattstauffer.com/blog/laravel-on-heroku-using-a-postgresql-database/)
+ [Getting started with heroku laravel](https://devcenter.heroku.com/articles/getting-started-with-laravel)
+ [Best Practices](https://devcenter.heroku.com/articles/getting-started-with-laravel#best-practices)
+ [Further Reading](https://devcenter.heroku.com/articles/getting-started-with-laravel#further-reading)
