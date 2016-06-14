Diretórios
==========

O diretório raiz contém os seguintes subdiretórios:

- `backend` - [aplicação web backend](structure-applications.md).
- `common` - [arquivos comuns para todas as aplicações](structure-applications.md).
- `console` - [aplicação de console](structure-applications.md).
- `environments` - [configurações de ambiente](structure-environments.md).
- `frontend` - [aplicação web frontend](structure-applications.md).

O diretório raiz contém uma série de arquivos.

- `.gitignore` contém uma lista de diretórios que deve ser ignorado pelo sistema de versionamento git. Caso você precise que 
algo não seja enviado ao repositório, basta adicioná-lo aqui.
- `composer.json` - Configuração do Composer descrito em [Configurando o Composer](start-composer.md).
- `init` - script de inicialização descrito em [Configurações e ambientes](structure-environments.md).
- `init.bat` - script de inicialização para Windows.
- `LICENSE.md` - informações de licença. Adicione os termos de licença aqui. Especialmente se o projeto for de código aberto.
- `README.md` - informações básicas de como instalar o template. Considere substituí-lo com informações sobre seu projeto
e sua instalação.
- `requirements.php` - verificador de requisitos Yii.
- `yii` - inicializador da aplicação de console.
- `yii.bat` - inicializador da aplicação de console para Windows.