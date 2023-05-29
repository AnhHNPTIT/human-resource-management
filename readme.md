Require : <br />
    Git <br />
    Docker => 17.12 <br />

Install docker : <br />
        sudo apt-get update <br />
        sudo apt install docker.io <br />
    Docker service needs to be setup to run at startup : <br />
        sudo systemctl start docker <br />
        sudo systemctl enable docker <br /> 
    Check version : <br />
        docker --version <br />

Install docker-compose : <br />
    We’ll check the current release and if necessary, update it in the command below : <br />
        $ sudo curl -L https://github.com/docker/compose/releases/download/1.18.0/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
    <br />
    We’ll set permissions : <br />
        $ sudo chmod +x /usr/local/bin/docker-compose <br />
    Then we’ll verify that the installation was successful by checking the version: <br />
        $ docker-compose --version  <br />

Install laradock :<br />
        git clone https://github.com/laradock/laradock.git <br />
    Your folder structure should look like this : <br />
        + laradock <br />
        + my_project <br />
    Edit your web server sites configuration : <br />
        cp env-example .env <br />
    At the top, change the APP_CODE_PATH_HOST variable to your project path : <br /> 
        APP_CODE_PATH_HOST=../my_project <br />
    Chose databse is mysql <br />

Clone project on github : <br />
    git clone url_my_project <br />
    cd laradock <br />
    docker-compose build nginx mysql <br />
    docker-compose exec workspace bash <br />
    composer install <br />
    cp .env.example .env <br />
    php artisan key:generate <br />
    exit <br />
    cd my_project <br />
    sudo chmod -R 777 storage bootstrap/cache <br />

Reference : <br />
    https://laracasts.com/discuss/channels/guides/guide-set-up-laravel-with-docker-laradock-in-digital-ocean-with-5-minutes <br />


