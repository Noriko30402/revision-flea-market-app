#  フリマアプリ

## 1. Dockerの設定

1. coachtechのファイルをクローンし名前を変更
```
$ git clone git@github.com:coachtech-material/laravel-docker-template.git

$ mv laravel-docker-template test-contact-form
 ```
1. dockerをビルド
```
$ docker-compose up -d --build
```
1. mac環境の場合『　docker-compose.yml　』ファイルのの変更が必須
  ```
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
  ```

## 2. Laravel の環境構築

1.  PHP dockerにてcomposerインストール
```
$ docker-compose exec php bash
$ composer install
 ```

3. env.exampleを使用して .envファイル作成し環境変数を変更
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
1. phpを使用するためキーを作成 (PHPのdocker内)
```
$php artisan key:generate
```


## 3.Fortyfy実装

```
composer require laravel/fortify
php artisan vendor:publish -provider="Laravel\Fortify\FortifyServiceProvider"
php artisan migrate
composer require laravel-lang/lang:~7.0 --dev
cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/
```

## 4. Stripeライブラリ導入
```
composer require stripe/stripe-php
```

## 5. mailhog導入

1.「docker-compose.yml」ファイルにてセットアップ
```
 mailhog:
    image: mailhog/mailhog:latest
    container_name: mailhog
    ports:
      - "8025:8025"  # Web UI用
      - "1025:1025
```
2.Laravelの .env 設定
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="example@example.com"
MAIL_FROM_NAME="${APP_NAME}"

```
3.Docker Composeを使ってLaravelとMailHogのコンテナをビルドし実行
```
docker-compose up --build
```

4.MailHog Web UIのアクセス
<http://localhost:8025>　にて送信したメール確認可能
## 5. 使用技術(実行環境)

・Docker. Ver 27.3.1
・php:8.1
・Laravel v10.48.25
・Homebrew Server version: 9.0.1
・mysql  Ver 8.0.26 for Linux on x86_64
・nginx version: nginx/1.21.1
・stripe/stripe-php version 16.5
・mailhog

## 6. 開発環境 URL
開発環境：<http://localhost/>
mailhog: <http://localhost:8025>
mysql: <http://localhost:8080>