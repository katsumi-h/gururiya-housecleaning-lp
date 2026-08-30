# ぐるり屋本舗｜相模原市ハウスクリーニングLP

相模原市向けハウスクリーニングLPの制作・確認用リポジトリです。

このリポジトリには、WordPress用PHP原稿と、GitHub Pagesで表示する静的HTML版を収録します。

## ファイル構成

- `wordpress/page-housecleaning-sagamihara.php`：WordPress用の原稿
- `index.html`：GitHub Pages用の静的確認版
- `scripts/build-static.mjs`：静的確認版の生成処理
- `images/`：表示画像

## 静的確認版を更新する

```bash
node scripts/build-static.mjs
```

## ローカルで確認する

```bash
python3 -m http.server 8000
```

ブラウザで `http://127.0.0.1:8000/` を開きます。

## 注意

- GitHub PagesではPHPは実行されません。
- 電話・フォームの計測、WordPressテーマとの干渉、フォーム送信は別途本番前に確認します。
- 静的確認版には検索エンジン向けの`noindex, nofollow`を設定します。

