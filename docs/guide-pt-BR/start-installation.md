Instalação
==========

## Pré-Requisitos

O único requisito deste template de projetos é que seu servidor Web suporte PHP 5.4.0.

## Instalação utilizando Vagrant

Esta é a forma mais simples porém, mais longa (~20 min).

**Esta forma de instalação não necessita de nenhum software pré-instalado (como um web-server, PHP, MySQL, etc.)** - basta apenas seguir as etapas!

#### Manual para usuários Linux/Unix

1. Instale o [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Instale o [Vagrant](https://www.vagrantup.com/downloads.html)
3. Crie um [token de API pessoal](https://github.com/blog/1509-personal-api-tokens) do GitHub
4. Prepare o projeto:
   
   ```bash
   git clone https://github.com/yiisoft/yii2-app-advanced.git
   cd yii2-app-advanced/vagrant/config
   cp vagrant-local.example.yml vagrant-local.yml
   ```
   
4. Introduza seu token de API pessoal no arquivo `vagrant-local.yml`
5. Entre no diretório raiz do projeto:

   ```bash
   cd yii2-app-advanced
   ```

5. Execute os comandos:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
Isso é tudo. Basta aguardar a conclusão! Após isso você pode acessar o projeto localmente pelas URLs:
* frontend: http://y2aa-frontend.dev
* backend: http://y2aa-backend.dev

#### Manual para usuários Windows

1. Instale o [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Instale o [Vagrant](https://www.vagrantup.com/downloads.html)
3. Reinicie
4. Crie um [token de API pessoal](https://github.com/blog/1509-personal-api-tokens) do GitHub
5. Prepare o projeto:
   * faça do download do repositório [yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced/archive/master.zip)
   * descompacte o arquivo
   * entre no diretório `yii2-app-advanced-master/vagrant/config`
   * copie o arquivo `vagrant-local.example.yml` para `vagrant-local.yml`
   
6. Introduza seu token de API pessoal no arquivo `vagrant-local.yml`
7. Adicione as seguintes linhas no [arquivo de hosts](https://pt.wikipedia.org/wiki/Hosts_(arquivo)):
   
   ```
   192.168.83.137 y2aa-frontend.dev
   192.168.83.137 y2aa-backend.dev
   ```
   
8. Abre o terminal (`cmd.exe`), **entre no diretório raiz do projeto** e execute os comandos:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
   (Você pode ler [aqui](http://pt.wikihow.com/Alterar-Diret%C3%B3rios-no-Prompt-de-Comandos) como alterar diretórios no prompt de comando) 

