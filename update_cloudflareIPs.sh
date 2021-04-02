#!/bin/sh
set -eu

CF_IPS=$(curl -s "https://api.cloudflare.com/client/v4/ips" | jq -r '.result | [.ipv4_cidrs,.ipv6_cidrs] | map(.[]) | join(",")')

sed -i "s#\(\"--entryPoints.websecure.forwardedHeaders.trustedIPs=\).*\(\"\)#\1${CF_IPS}\2#" docker-compose.traefik.yaml
