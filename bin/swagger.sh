#!/usr/bin/env bash

./bin/console app:generate-swagger-schemas
./bin/openapi --bootstrap vendor/autoload.php --output ./public/swagger ./config/routes.php
# python -c 'import yaml, sys; print(yaml.safe_load(sys.stdin))' < ./public/swagger/openapi.yaml
echo "Generated file in: ${PWD}/public/swagger/openapi.yaml"
echo "Documentation available in: http://localhost:8181/documentation"
