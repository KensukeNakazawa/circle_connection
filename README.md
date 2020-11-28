# はじめに
## circle_connection(開発中)
大学生とサークルをマッチングさせ、新入生がサークルを探しやすくしたり、サークルが勧誘をしやすくするためのアプリケーション

## 使用技術
- PHP
- Laravel
- Vue.js
- Axios
- vuerouter
- vuex

## 必須ソフトウェア
- Docker
- docker-compose
- git

# 環境構築
このリポジトリをクローンしたディレクトリに移動し下記のコマンドを入力する
> make set-up

http://127.0.0.1:8000/ ここにアクセスする
初期ユーザーデータ

サークル
- email: test-circle@gmail.com
- pass: test1234

ユーザー
- email: test-user@gmail.com
- pass: test1234

make コマンドが使えない環境では
Makefileのset-up以下にあるコマンドを入力してください。
