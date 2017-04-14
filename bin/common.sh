#!/bin/bash

COLOR="\e[34m"

USER=$(whoami)

if [[ ${USER} =~ .*_prod$ ]]; then
    COLOR="\e[31m"
fi;

echo -e ""
echo -e "\e[1m${COLOR}##############################################################"
echo -e "\e[1m${COLOR}#                 _      _  _          __                    #"
echo -e "\e[1m${COLOR}#   /\/\    ___  | |__  (_)| |  ___    \ \   __ _  ____ ____ #"
echo -e "\e[1m${COLOR}#  /    \  / _ \ | '_ \ | || | / _ \    \ \ / _\` ||_  /|_  / #"
echo -e "\e[1m${COLOR}# / /\/\ \| (_) || |_) || || ||  __/ /\_/ /| (_| | / /  / /  #"
echo -e "\e[1m${COLOR}# \/    \/ \___/ |_.__/ |_||_| \___| \___/  \__,_|/___|/___| #"
echo -e "\e[1m${COLOR}#                                                            #"
echo -e "\e[1m${COLOR}# The #1 Boutique App & Web Development Company              #"
echo -e "\e[1m${COLOR}#                                                            #"
echo -e "\e[1m${COLOR}##############################################################"
echo -e "\e[0m\e[39m"

if [[ ${USER} == 'root' ]]; then

    FORMATTING="\e[31m"
    echo -e "${FORMATTING}You are running as root. This will mess up file permissions. Do not run these scripts as root."
    kill -SIGUSR1 `ps --pid $$ -oppid=`
    exit

fi;



