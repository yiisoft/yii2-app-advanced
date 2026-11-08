#!/usr/bin/env bash

set -eu

php init --env=Development --overwrite=All
vendor/bin/codecept build
