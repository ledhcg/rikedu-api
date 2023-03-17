## How to Install and Run the project on Docker

1. Clone the repo
    ```sh
    git clone https://github.com/bcsdlbnga/website-backend.git
    ```
2. Go to folder
    ```sh
    cd website-backend
    ```
3. Build and run with docker
    ```sh
    docker-compose --env-file .env.docker up --build
    ```
4. Running Seeders

    ```sh
    docker-compose exec api php artisan migrate:fresh --seed
    ```

5. You can use:

-   [API] on `127.0.0.1:8000` or `localhost:8000`

## How to Install and Run the project on local

1. Clone the repo
    ```sh
    git clone https://github.com/bcsdlbnga/website-backend.git
    ```
2. Go to folder
    ```sh
    cd website-backend/src
    ```
3. Copy ".env.example" to ".env"
4. Install package
    ```sh
    composer install
    ```
5. Generate key

    ```sh
    php artisan key:generate
    ```
6. Link storage

    ```sh
    php artisan storage:link
    ```
7. Running Seeders
- Active XAMPP Apache and MySQL

    ```sh
    php artisan migrate:fresh --seed
    ```
8. You can use:

    ```sh
    php artisan serve
    ```
-   [API] on `127.0.0.1:8000` or `localhost:8000`

## How to use Prettier

Using Command Palette (CMD/CTRL + Shift + P)

```sh
CMD/CTRL + Shift + P -> Format Document
```

OR

```sh
1. Select the text you want to Prettify
2. CMD/CTRL + Shift + P -> Format Selection
```

Install dev package

```sh
npm install
```

## Outside the Laravel project

-   docker-compose.yaml
-   Dockerfile.api
-   .env.docker
-   package.json
-   README.md
-   .prettierrc.json

### Config file .gitignore (If reinstall Laravel project in this directory)

-   Add lines:

```sh
/node_modules
/.fleet
/.idea
/.vscode
# ignore lock file
package-lock.json
# docker
/mysql

```

### Config file .env (If reinstall Laravel project in this directory)

-   Add lines:

```env
PROJECT_NAME=BCSD

MYSQL_DATABASE=bcsd
MYSQL_USER=bcsd
MYSQL_PASSWORD=secret
MYSQL_ROOT_PASSWORD=secret

PMA_HOST=db
PMA_USER=root
PMA_PASSWORD=secret
```

## Documentation

-   Open the Postman app and select the collection "BCSD".
-   Click on the "..." button next to the collection name and select "View Documentation".
-   The documentation will be displayed in a new tab in the Postman app.
