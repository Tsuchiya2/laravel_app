## プロジェクトのセットアップ手順

### ディレクトリ構成
```
docker-laravel
  |- src                  Laravel プロジェクトデプロイ先（build すると自動で作成されます）
  |- docker
  |- app                  PHP コンテナ
  |    |- Dockerfile
  |    |- php.ini
  |- db                   MySQL コンテナ
  |    |- Dockerfile
  |    |- my.conf
  |- web                  nginx コンテナ
  |    |- Dockerfile
  |    |- default.conf
  |- .env                 環境変数定義
  |- docker-compose.yml   全コンテナの管理
```
src ディレクトリはコンテナ内では「/app」になります

### Docker イメージの構築
```bash
docker-compose build
```

### Docker コンテナの構築 & 起動

#### 通常の起動
```bash
docker-compose up
```

#### バックグラウンドで起動
```bash
docker-compose up -d
```

### Docker コンテナを終了する
```bash
docker-compose down
```

### Docker コンテナを確認する
```bash
docker ps
```
下記のようにコンテナ情報が表示される
```
CONTAINER ID   IMAGE                COMMAND                ...
a947c233e89a   docker-laravel_web   "/docker-entrypoint.…" ...
1eef95331950   docker-laravel_app   "docker-php-entrypoi…" ...
845f45351d5e   mysql:8.0            "docker-entrypoint.s…" ...
```

### Docker コンテナにログインする
```bash
docker exec -it 1eef95331950 /bin/bash
```
docker exec -it コンテナ ID /bin/bash

ログインすると以下のように表示されます
```
root@1eef95331950:/app#
```

### Laravel プロジェクトの作成（Inside Container）
```bash
composer create-project --prefer-dist laravel/laravel .
```
「/app」の直下に Laravel プロジェクトが作成されます
