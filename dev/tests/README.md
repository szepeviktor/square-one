# Tests for Square 1

## Setup

1. Create a database called `tribe_square1_tests` (you don't need to populate it with anything)
1. In the root of this whole repo, copy `tests-config-sample.php` to `tests-config.php`
1. Ensure that `dev/tests/.env` holds the correct values for connecting to your `tribe_square1_tests` database
1. Run `vendor/bin/codecept run integration` for integration tests

### Pro-tips

Set up an alias in your `.bashrc` or `.zshrc` file as follows: `alias tribetestintegration="dev/docker/exec.sh /application/www/dev/docker/codecept.sh run integration"`. Then you can do `tribetestintegration run`. This can be anything that makes your life easy, and you can create other commands for other test suites (such as `unit`)