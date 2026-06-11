# お米在庫管理システム

## 概要

Laravelを使用して作成したお米在庫管理システムです。

品種ごとの在庫数や価格を管理できるCRUDアプリケーションとして作成しました。

## 画面イメージ
### 商品一覧

![商品一覧](screenshots/index.png)

### 商品登録

![商品登録](screenshots/create.png)

### 商品詳細

![商品詳細](screenshots/show.png)

### 商品編集

![商品編集](screenshots/edit.png)


## 主な機能

* 商品一覧表示
* 商品登録
* 商品詳細表示
* 商品編集
* 商品削除
* 品種検索
* ページネーション
* バリデーション
* フラッシュメッセージ
* 削除確認ダイアログ
* 在庫切れ商品の強調表示

## 使用技術

| 項目        | 内容     |
| --------- | ------ |
| PHP       | 8.2    |
| Laravel   | 12     |
| Bootstrap | 5      |
| Database  | SQLite |

## テーブル設計

### products

| カラム名        | 型       | 説明     |
| ----------- | ------- | ------ |
| id          | bigint  | ID     |
| variety     | string  | 品種     |
| stock_5kg   | integer | 5kg在庫  |
| stock_10kg  | integer | 10kg在庫 |
| stock_20kg  | integer | 20kg在庫 |
| stock_30kg  | integer | 30kg在庫 |
| price_5kg   | integer | 5kg価格  |
| price_10kg  | integer | 10kg価格 |
| price_20kg  | integer | 20kg価格 |
| price_30kg  | integer | 30kg価格 |
| description | text    | 説明     |

## 工夫した点

* FormRequestを利用してバリデーションを実装
* 共通レイアウトを利用して画面構成を統一
* 検索機能とページネーションを組み合わせて実装
* 在庫0の商品を赤文字で表示

## 今後の改善案

* ソート機能
* CSV出力機能
* 在庫アラート機能
