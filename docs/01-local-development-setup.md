# LOCAL DEVELOPMENT
## Requirements:
Note: This local setup was aimed at macOS, if you need to tweak it feel free to just point us to the changed configuration.

1. Have [Docker](https://docs.docker.com/get-docker/) installed
2. Have node installed in version 17 
   1. We suggest [n package](https://www.npmjs.com/package/n) to manage the node version (`npm install -g n && n 17`)
   
There is a Makefile in the root of the project to easier setup and run the project.

Note: if you don't use Chrome please add this to your `/etc/hosts` file:

* `127.0.0.1 coffee-shop.localhost`

## Setup compatibility

If you are running on architecture the docker setup image may not work, we tested with:
- Mac Intel (amd64) - Default configuration
- Mac M1 (arm64v8)

[List of available architectures](https://github.com/docker-library/official-images#architectures-other-than-amd64)

You can change the architecture use by updating `.env.example` `ARCHITECTURE` env variable before running `make install`

## Setup

**Application base URL:** `coffee-shop.localhost`

* `make install` - Only needs to run once to install everything
* `make start` - Run it after the installation to start the environment  

## Commands to interact with the environment

* `make start` - Starts your environment
* `make stop` - Stops the environment
* `make down`
* `make destroy`
* `make help` - Lists all available commands and the description for each

## Artisan and other commands
You can run the commands with:
* `docker-compose exec php-fpm php artisan`

## Database access
To access the local database you can connect to it from TablePlus and other software with:
- Host: 127.0.0.1
- Port: 33060
- user: root
- password: root
- database: project
