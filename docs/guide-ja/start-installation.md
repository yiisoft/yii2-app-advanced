インストール
============

## 必要条件

このアプリケーション・テンプレートが要求する最低限の必要条件は、あなたのウェブ・サーバが PHP 5.4.0 をサポートしていることです。

## Composer を使ってインストールする

If you do not have [Composer](http:/[Composer](http://getcomposer.org/) を持っていない場合は、決定版ガイドの [Yii をインストールする](https://github.com/yiisoft/yii2/blob/master/docs/guide-ja/start-installation.md#installing-via-composer) の節の指示に従ってインストールしてください。

Composer がインストールされていれば、次のコマンドを使ってアプリケーションをインストールすることが出来ます。

    composer global require "fxp/composer-asset-plugin:1.0.0"
    composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application

最初のコマンドは [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/) をインストールします。
これにより、Composer を通じて bower と npm の依存パッケージを管理することが出来るようになります。
このコマンドは全体で一度だけ走らせれば十分です。
第二のコマンドは `yii-application` という名前のディレクトリにアドバンスト・アプリケーションをインストールします。
望むなら別のディレクトリ名を選ぶことも出来ます。


## アーカイブ・ファイルからインストールする

[yiiframework.com](http://www.yiiframework.com/download/) からダウンロードしたアーカイブ・ファイルをウェブ・ルートの直下、`advanced` と名付けられたディレクトリに解凍します。

その後は、次の項に記載されている指示に従ってください。


## アプリケーションを準備する

アプリケーションをインストールした後に、インストールされたアプリケーションの初期設定をするために、次の各ステップを実行しなければなりません。
これらは全体で一度だけやれば十分です。

1. `init` コマンドを実行して、環境として `dev` を選択します。

    ```
    php /path/to/yii-application/init
    ```

    あるいは、本番サーバで、非対話モードで `init` を実行します。

    ```
    php /path/to/yii-application/init --env=Production --overwrite=All
    ```

2. 新しいデータベースを作成し、それに従って `common/config/main-local.php` の `components['db']` の構成情報を修正します。
3. コンソールコマンド `yii migrate` でマイグレーションを適用します。
4. ウェブサーバのドキュメントルートを設定します。

- フロントエンドのパスは `/path/to/yii-application/frontend/web/`、URL は `http://frontend/` を使用
- バックエンドのパスは `/path/to/yii-application/backend/web/`、URL は `http://backend/` を使用

アプリケーションにログインするためには、最初にユーザ登録をする必要があります。
あなたの任意のメールアドレス、ユーザ名、パスワードを指定してください。
そうすれば、同じメールアドレスとパスワードを使って何時でもアプリケーションにログインすることが出来ます。
