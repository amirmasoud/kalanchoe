yarn build:production

composer install --no-dev

zip $(git rev-parse --short HEAD).zip -q * -x node_modules/*
