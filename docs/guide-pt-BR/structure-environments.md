Configurações e ambientes
=========================

Existem diversos problemas com a abordagem típica para a configuração:

- Cada membro da equipe possui suas próprias opções de configurações. Commitar essas configurações irá afetar a configuração de outros membros da equipe.
- Senhas do banco de dados de produção e chaves de API não devem estar presentes no repositório.
- Existem diversos ambientes: desenvolvimento, homologação, produção. Cada um deve possuir sua própria configuração.
- Definir todas as configurações para cada caso é muito repetitivo e é muito custoso para se manter.

Para resolver estes problemas Yii introduz conceito simples de ambientes. Cada ambiente é representado por uma série
de arquivos presentes no diretório `environments`. O comando `init` é usado para inicializar um ambiente. O papel deste comando
é copiar todo o conteúdo presente no diretório do ambiente para a raíz do projeto onde todas as aplicações residem.

Por padrão existem dois ambientes: `dev` e `prod`. O primeiro é utilizado para desenvolvimento. Ele possui todas as ferramentas
de desenvolvimento e depuração habilitadas. O segundo é utilizado para deploy de produção. Todas as ferramentas de
desenvolvimento e depuração estão desabilitadas.

Tipicamente, diretórios de ambiente contém arquivos de inicialização como o `index.php` e arquivos de configuração
com o sufixo de `-local.php`. Estes são ou arquivos de configuração pessoal de membros da equipe que geralmente
estão localizados no diretório `dev` ou configurações específicas de servidor. Por exemplo: configurações de conexão
do banco de dados de produção estaria no arquivo de configuração `-local.php` dentro do diretório de ambiente `prod`.
Os arquivos de configuração local são adicionados ao `.gitignore` e nunca são enviados para o repositório de versionamento de código.

Para evitar a duplicação de configurações, as mesmas se sobrescrevem. Por exemplo, a aplicação frontend lê as configurações
na seguinte ordem:

- `common/config/main.php`
- `common/config/main-local.php`
- `frontend/config/main.php`
- `frontend/config/main-local.php`

Parâmetros são lidos na seguinte ordem:

- `common/config/params.php`
- `common/config/params-local.php`
- `frontend/config/params.php`
- `frontend/config/params-local.php`

O arquivo de configuração posterior sobrescreve o anterior.

Aqui está o esquema completo:

![Configurações da aplicação avançada](images/advanced-app-configs.png)