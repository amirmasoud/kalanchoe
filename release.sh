yarn build:production

composer install --no-dev

zip -r9 kalanchoe.zip . -x .git/\* node_modules/\*
