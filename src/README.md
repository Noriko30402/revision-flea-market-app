### お問合せフォーム
## 環境構築 - Dockerのビルドからマイグレーション、シーディングまでを記述する
# Dockerの設定

　1:  ギットのクローン
　　  $git clone git@github.com:coachtech-material/laravel-docker-template.git
    2: 名前変更
         $ mv laravel-docker-template test-contact-form
    3:  dockerをビルド
     　$ docker-compose up -d --build
    4:   mac環境の場合『　docker-compose.yml　』ファイルのの変更が必須
　　　mysqlのserviseにて　　　　
　　　platform: linux/amd64　　　を追加する

# Laravel の環境構築
    1:  laravelパッケージのインストール
　   $ docker-compose exec php bash
　　$ composer install
   2: .env.example　を使用して .envファイル作成し環境変数を変更
   3: .　phpを使用するためキーを作成
       docker-compose exec php bash
         php artisan key:generate
        php artisan config:clear
　
　4. 認証機能 PHPコンテナ内
　composer require laravel/fortify
   php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
   php artisan migrate
   composer require laravel-lang/lang:~7.0 --dev
   cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/

# php artisan make:controller AuthController
　データ構築

 1:テーブル・モデル作成
　　php artisan make:model Category -m
　　php artisan make:model Product -m
   php artisan make:model Condition -m
   php artisan make:model Favorite -m
   php artisan make:migration create_Product_category_table
   php artisan make:model Order -m
　
 ## 使用技術(実行環境) - 例: Laravel 8.x(言語やフレームワーク、バージョンなどが記載されていると良い) 
・Docker. Ver 27.3.1
・php:8.1
・Laravel v10.48.25
・Homebrew　Server version: 9.0.1
・mysql  Ver 8.0.26 for Linux on x86_64
・nginx version: nginx/1.21.1
## ER図 < - - - 作成したER図の画像 - - - >
## URL - 開発環境：http://localhost/