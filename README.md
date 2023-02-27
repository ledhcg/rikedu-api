## How to Install and Run the project

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
4. You can see:

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

## Outside the Laravel project

-   docker-compose.yaml
-   Dockerfile.api
-   README.md
-   .prettierrc.json

### Config file .gitignore (If reinstall Laravel project in this directory)

-   Add new line:

```sh
mqsql
```

### Config file .env (If reinstall Laravel project in this directory)

-   Add lines:

```env
PROJECT_NAME="BCSD"

MYSQL_DATABASE=bcsd
MYSQL_USER=bcsd
MYSQL_PASSWORD=secret
MYSQL_ROOT_PASSWORD=secret

PMA_HOST=db
PMA_USER=root
PMA_PASSWORD=secret
```

## Documentation

```
localhost:8000/api/v1/docs
```
