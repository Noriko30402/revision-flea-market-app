# フリマアプリ

## 1. Dockerの設定

1. クローン

```
git clone git@github.com:Noriko30402/revision-flea-market-app.git
 ```

2. dockerをビルド

```
docker-compose up -d --build
```

3. mac環境の場合『　docker-compose.yml　』ファイルの変更が必須
   mysql:内にて下記を追記

  ```
    platform: linux/amd64
  ```

## 2. Laravel の環境構築

1. PHP dockerにてインストール

```
docker-compose exec php bash
composer install
 ```

2. env.exampleをコピーして .envファイル作成し環境変数を変更

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

3. phpを使用するためキーを作成 (PHPのdocker内)

```
php artisan key:generate
php artisan config:clear
```

4. マイグレーションの実行

```
php artisan migrate
```

5. シーディングの実行

```
php artisan db:seed
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

### ダミーユーザー<br>
名前: ユーザー１<br>
メールアドレス: user-one@test.com　<br>
パスワード: password<br>

名前:　ユーザー2<br>
メールアドレス: user-two@test.com<br>
パスワード: password

名前:　ユーザー3<br>
メールアドレス: user-three@test.com<br>
パスワード: password

## 5. 使用技術(実行環境)

・Docker. Ver 27.3.1
・php:8.1
・Laravel v10.48.25
・Homebrew Server version: 9.0.1
・mysql  Ver 8.0.26 for Linux on x86_64
・nginx  1.21.1
・stripe-php version 16.5
・mailhog

## 6. 開発環境 URL

フリマアプリトップページ：<http://localhost/>
mailhog: <http://localhost:8025>
phpMyAdmin: <http://localhost:8080>
