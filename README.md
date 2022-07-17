# BARD ERP
ERP Project for BARD

# Prerequisites
- [docker](https://www.docker.com/)
    - [Installation Guideline](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04)
- [docker-compose](https://docs.docker.com/compose/) 
    ```
    sudo apt install docker-compose
    ```

# Installation
#### Run commands after initial pull

```
composer install
chmod -R o+rw bootstrap/ storage/ 
```  

*To build and run docker image*
```
docker-compose up --build
```

*To run docker image*
```
docker-compose up
```

*To run docker image in background*
```
docker-compose up -d
```


# Developement Resources
#### MySql
```
mysql -u bard -P 3307 -h 127.0.0.1 -p
```

## Package Details

- [Nicolas Widart - Laravel Module](https://github.com/nWidart/laravel-modules)
