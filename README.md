## プロジェクトのセットアップ手順

### Dockerイメージの構築

```bash
docker-compose build
```

### Dockerコンテナの構築&起動

#### 通常の起動

```bash
docker-compose up
```

#### バックグラウンドで起動
```bash
docker-compose up -d
```

### Dockerコンテナを終了する

```bash
docker-compose down
```

### データベースの作成

```bash
docker-compose run app php artisan migrate
```

## Dockerを使う上での注意点

### Gemfileを編集したらDockerイメージに変更を反映させる

#### composer installする

```bash
docker-compose run web composer install
```

#### GemfileとGemfile.lockを反映する

```bash
docker-compose build --force-rm
```

### デバッグツールを使うときは

#### nginxサーバーを立ち上げているコンテナのIDを確認する

```bash
docker-compose exec app bash
```
