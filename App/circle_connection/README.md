# CircleConnection

## 構成
- backend: php(laravel ver:6.2)
- frontend: vue.js


## ディレクトリの役割
* app/Http/Controllers
    - 認証/認可
    - 入力バリデーション
    - Request受け取り
    - Response返却
* app/Services
    - ビジネスロジック
    - トランザクションを貼るのはここ
    - ドメイン単位で分ける
* app/Repositories
    - DBロジック
    - テーブル単位でわける
* app/Models
    - Laravelのモデル配置先
* app/Presenters
    - ControllerからViewへ渡すデータ整形

## マジカルナンバー
* ユーザータイプ(user_type_id)
    - 1: ユーザー
    - 2: サークル
    - 3: 管理者

## 規約
- DBの定義を変更するときは必ずマイグレーションを用いること
- クラス、メソッド単位でコメントを入れること
- PHPのコードはPSR-2に準じること
- css, jsをpublic に書かないこと
- scssのファイルはjsのコンポーネントのディレクトリごとに分ける

## Tips

### テスト方法
アプリのルートディレクトリで
> ./vendor/bin/phpunit

### キャッシュクリア
> php artisan cache:clear

> php artisan config:clear 

> php artisan route:clear 