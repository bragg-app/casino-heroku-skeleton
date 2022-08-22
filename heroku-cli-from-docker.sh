# https://github.com/wingrunr21/alpine-heroku-cli
# HEROKU_API_KEY could be get it from:
# https://dashboard.heroku.com/apps/laravel9-heroku/settings
# NOTE: this HEROKU_API_KEY is not real

# list apps:
docker run --rm -e HEROKU_API_KEY="2166781d2-42a5-4592-9cfe-44165442616d" wingrunr21/alpine-heroku-cli list

# BASH :
 docker run -ti -e HEROKU_API_KEY="2166781d2-42a5-4592-9cfe-44165442616d" wingrunr21/alpine-heroku-cli run bash -i -a laravel9-heroku

# add config var :
docker run --rm -e HEROKU_API_KEY="2166781d2-42a5-4592-9cfe-44165442616d" wingrunr21/alpine-heroku-cli config:set APP_DEBUG=true -a laravel9-heroku

# php version :
docker run --rm -e HEROKU_API_KEY="2166781d2-42a5-4592-9cfe-44165442616d" wingrunr21/alpine-heroku-cli run php -v -a laravel9-heroku 

# laraver generate key :
docker run --rm -e HEROKU_API_KEY="2166781d2-42a5-4592-9cfe-44165442616d" wingrunr21/alpine-heroku-cli run php artisan key:generate -a laravel9-heroku 

# create datbase ... resources tab > find postgress addon, and get the credentials via cli:
docker run --rm -e HEROKU_API_KEY="2166781d2-42a5-4592-9cfe-44165442616d" wingrunr21/alpine-heroku-cli pg:credentials:url -a laravel9-heroku

# Guides:
# https://devcenter.heroku.com/articles/getting-started-with-laravel
# https://betterprogramming.pub/hosting-your-laravel-app-on-heroku-198764167a85