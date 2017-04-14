#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
ROOT_DIR=$(cd ${SCRIPT_DIR}/..; pwd)

source ${SCRIPT_DIR}/common.sh
trap "Exiting" SIGUSR1

cd ${ROOT_DIR} && docker-compose stop
