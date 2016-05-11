ディレクトリ
============

ルートディレクトリは次のサブディレクトリを含みます。

- `backend` - [バックエンドのウェブアプリケーション](structure-applications.md)
- `common` - [全てのアプリケーションに共通なファイル](structure-applications.md)
- `console` - [コンソールアプリケーション](structure-applications.md)
- `environments` - [環境設定](structure-applications.md)
- `frontend` - [フロントエンドのウェブアプリケーション](structure-applications.md)

ルートディレクトリは次の一群のファイルを含みます。

- `.gitignore` - git バージョン管理システムによって無視されるディレクトリの一覧を含みます。
  ソースコードのレポジトリに決して入れたくないものがあれば、それをこれに追加してください。
- `composer.json` - Composer の構成。[Composer を構成する](start-composer.md) を参照 。
- `init` - 初期化スクリプト。[構成情報と環境](structure-environments.md) を参照。
- `init.bat` - 同上 (Windows 用)。
- `LICENSE.md` - ライセンス情報。プロジェクトのライセンスを置きます。特にオープンソースにする場合。
- `README.md` - テンプレートのインストールに関する基本的な情報。
  あなたのプロジェクトとそのインストールに関する情報に置き換えることを検討してください。
- `requirements.php` - Yii 必要条件チェッカ。
- `yii` - コンソールアプリケーションのブートストラップスクリプト。
- `yii.bat` - 同上 (Windows 用)。
