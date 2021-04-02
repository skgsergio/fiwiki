#!/bin/sh

docker-compose --file docker-compose.traefik.yaml --project-name traefik up --detach

docker-compose --file docker-compose.fiwiki.yaml --project-name fiwiki up --detach --build
