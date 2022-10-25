#!/bin/bash

heroku config:set $(cat .env.heroku | sed '/^$/d; /#[[:print:]]*$/d')
