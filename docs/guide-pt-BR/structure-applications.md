Aplicações
==========

O template avançado de projetos possui três aplicações: frontend, backend e console. Frontend é, geralmente, o que é 
apresentado ao usuário final. Backend é o painel administrativo, e contém dados de análise da aplicação e outras funcionalidades do tipo.
Console é geralmente utilizado para execução de tarefas cron e gerenciamento do servidor. É também utilizado 
durante o deploy da aplicação para gerenciar migrações de dados e assets.

Há também um diretório `common` que contém arquivos não exclusivos e que são utilizados por mais de uma aplicação.
Por exemplo, o model `User`.

Ambos frontend e backend são aplicações web e contem o diretório `web`. Esta é a raíz dos diretórios acessíveis pela web, o 
qual seu servidor deve apontar.

Cada aplicação possui seu próprio namespace e um alias correspondendo ao seu nome. O mesmo se aplica para o diretório "common". 