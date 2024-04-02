Rese(レストラン予約システム)

環境構築について

※以下を前提としています
dockerインストール済み
windowsユーザはwsl2使用
テキストエディタとしてvscode使用

・展開する予定のディレクトリへ移動のうえ以下実施

~~~
git clone git@github.com:dbymmt/assignment2_on_restaurants_reservation.git
~~~

カレントディレクトリに「assignment2_on_restaurants_reservation」が作成され
配下に以下が作成される
- docker(ディレクトリ)
- src(ディレクトリ)
- docker-compose.yml(ファイル)

※assignment2_on_restaurants_reservationという名前について
必要であれば適宜mvコマンド等で名前を変更してください

・先ほど作成された「assignment2_onrestaurants_reservation」に移動する

~~~
cd assignment2_on_restaurants_reservation(もしくはリネーム後ディレクトリ名)
~~~
※リネームしている場合はそのリネームしたディレクトリに移動

・各dockerコンテナ起動

~~~
docker-compose up -d --build
~~~

・環境ファイルの作成、編集

~~~
cp .env.example .env
~~~

・.envの編集
以下に変更すること

~~~
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
~~~

※データベース名、ユーザ名、パスワードを任意のものに変更したい場合
docker-compose.ymlのmysqlディレクティブにて
　データベース名→MYSQL_DATABASE:
　ユーザ名→MYSQL_USER:
　パスワード→MYSQL_PASSWORD:
　をそれぞれ編集したうえで.envの該当箇所をその任意のものに変更してください

・phpコンテナに入る

~~~
docker-compose exec php bash
~~~
→dockerコンテナ"php"に入ることによりプロンプト変更(環境依存)

・laravel8インストール

~~~
composer install
~~~
→インストールが完了することを確認する

・鍵の作成

~~~
php artisan key:generate
~~~
→成功したことを確認

・各テーブル、テストデータ作成

~~~
php artisan migrate:fresh --seed
~~~
→成功したことを確認

・storage/app/publicフォルダの仕様宣言

~~~
php artisan storage:link
~~~
→publicの下に「storage」リンクが作成される

・画像用ディレクトリ作成

~~~
mkdir storage/app/public/images
~~~
→ディレクトリがあることを確認

・必要な画像をダウンロードし「images」ディレクトリに移動

以下コマンドを逐次実施

~~~
curl -OL https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg && mv sushi.jpg storage/app/public/images
~~~

~~~
curl -OL https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg && mv izakaya.jpg storage/app/public/images
~~~

~~~
curl -OL https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg && mv yakiniku.jpg storage/app/public/images
~~~

~~~
curl -OL https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg && mv italian.jpg storage/app/public/images
~~~

~~~
curl -OL https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg && mv ramen.jpg storage/app/public/images
~~~

「images」フォルダにsushi.jpg, izakaya.jpg, yakiniku.jpg, italian.jpg, ramen.jpgが作成される


