# お問い合わせフォーム

## 環境構築

### Dockerビルド手順

1. git clone リンク
2. docker-compose up-d-build

* MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

## laravel環境構築
1. docker-compose exec php bash
2. composer install
3..env.exampleファイルから.envを作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed
   
## 使用技術
PHP 8.0

Laravel 10.0

MySQL 8.0

Docker / Docker Compose

## ER図

![drawio](https://github.com/user-attachments/assets/44ce3e9a-67cf-46ad-8a8d-fcbd5fa8c9d6)


## URL
開発環境: http:localhost/

phpMyAdmin: http://localhost:8080/
