# お問い合わせフォームアプリケーション

## 環境構築

以下の手順で環境構築を行ってください。

```bash
# Dockerイメージのビルド
docker-compose build

# コンテナの起動
docker-compose up -d

# Laravelの依存関係をインストール
docker-compose exec app composer install

# .envファイルの作成とAPP_KEYの生成
cp .env.example .env
docker-compose exec app php artisan key:generate

# マイグレーションとシーディング
docker-compose exec app php artisan migrate:fresh --seed

# フロントエンドのビルド
docker-compose exec app npm install
docker-compose exec app npm run dev
