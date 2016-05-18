Sightseeing
---
旅先で、現地の人に観光案内をしてもらいたい！
観光チラシには載ってないところに連れてってほしい！

## サイト
[デモサイト](http://sightseeing.herokuapp.com)  
[スライド](https://docs.google.com/presentation/d/1usUssjlk-ybTL1uZpfUuLBlyJByeWhcbaRi5dy-fSNg/edit?usp=sharing)

## 概要
* 観光案内をしたい/できる人と観光案内してもらいたいユーザー同士をマッチング
* 言語指定機能を取り入れ、海外の観光客にも使えるように
 - 海外の言語だけでなく、方言の指定機能も実装することで国内の観光客も使えるようにする

## 機能
* ユーザー登録/認証
* 案内者登録機能
* 案内者一覧の取得
 - 言語指定
* ユーザーマッチング機能

## 未実装
* 案内者による観光客承認メソッド
 - /guides/:id/requests/:id
* 案内者による観光客否認メソッド
 - /guides/:id/requests/:id
* 案内者と観光者の対話用掲示板
 - /guides/:id/board

## TODO
* 日本語化
 - 多言語化
 - 現在バリデートエラーメッセージ等が英語
* ユーザー認証時他、メール送信
* validate
 - ex. ユーザープロフィール何もうめなくても登録できてしまう
* 画像のアップロード
 - XXX: Cloud Vision APIとか使って不適切な画像を弾きたい
* マスターテーブルに分ける
 - ex. 言語/方言テーブル
 - ex. 場所。現在"都道府県名の日本語文字列"で管理している
* 場所を座標にする
 - 現在"都道府県名の文字列"で表しているため、座標にする
 - 座標にして「現在位置周囲の案内検索」を現在いる座標から半径n pt 以内で検索可能にする
 - ex. カラムは id, 座標, 座標から取得した都道府県名
* try/catchとトラン
 - DBのエラーハンドリングをしていない(!!)
* DRY
 - いろいろと共通化に突っ込む必要有り

## 言い訳
* あくまでモックアップです。