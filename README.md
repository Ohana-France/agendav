# agendav

Dockerized agendav.

## Build the image

1. Clone the repository and go to the new directory:

```bash
git clone git@gitlab.agence-ohana.fr:r-d/admin/agendav.git
cd agendav
```
2. Build 

Run the following command: 
```bash
docker build --build-arg AGENDAV_VERSION=<version> .
```

## Deploy using docker-compose

The full stack uses nginx to serve the application, mariadb as a database backend, and php-fpm to run the core of agendav.

1. Clone the repository and go to the new directory:

```bash
git clone git@gitlab.agence-ohana.fr:r-d/admin/agendav.git
cd agendav
```

2. Get the sample stack:
```bash
cp docker-compose/* .
```

3. Edit .env to configure the stack

Guidelines for configurations are in the .env file. 

For passwords and secrets generation, use this: 
```bash
< /dev/urandom tr -dc A-Za-z0-9 | head -c32; echo
```


4. Get the agendav image

You can fetch the image from a registry (ie. https://registry.agence-ohana.fr/internal/agendav) or build it locally. 

To get the image from the registry, adjust your service definiton:
```yml
# ...
  agendav: 
    # Remove this:
    # build:
    #   context: .
    #   args:
    #     AGENDAV_VERSION: ${AGENDAV_VERSION}

    # Set the full image path:
    image: https://registry.agence-ohana.fr/internal/agendav
# ...
```

To build the image locally, keep the build part in docker-compose.yml and run the following:
```bash
docker-compose build agendav
```

5. Setup the database

To set up the database, execute agendav migrations:
```bash
docker-compose run --rm agendav php agendavcli migrations:migrate --no-interaction -q
```

> IMPORTANT: Do NOT execute migrations:diff. The actual sources for agendav will generate a migration which breaks the application.

6. Run the stack

Finnaly up all your containers with:
```bash
docker-compose up -d
```

### Tips & tricks

#### Adminer

Simply take a look at your database with adminer, a simple, small and ready-to-use database web UI:

```yml
  adminer: 
    image: adminer
    ports: 
      - <expose_port>:8080
```