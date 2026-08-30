# 枝LP①｜GitHub練習ルール

このリポジトリは、相模原市のハウスクリーニングLPを改善しながら、
**Issue → ブランチ → コミット → Pull Request → レビュー → マージ**を練習する場所。

## このリポジトリでの目的

- LPを他の人に確認してもらえる静的プレビューを作る
- mainを直接変更せず、実務に近いGitHubの流れを一周する
- コマンドの意味と、その実行結果を本人が確認しながら進める

## 進め方

1. Issueを1件作る
2. Issueに対応するブランチを1本作る
3. 意味のまとまりが1つの変更だけを行う
4. ローカルでPC幅・スマホ幅を確認する
5. 差分を確認してコミットする
6. ブランチをGitHubへpushする
7. Pull Requestを作る
8. PRの差分を確認する
9. PRをsquash mergeし、作業ブランチを削除する

## AIエージェントが守ること

- コマンドを実行する前に、そのコマンドが何をするかを一言説明する
- 勝手に全工程を終わらせず、各段階の結果を本人へ見せる
- mainへ直接マージしない
- 意味の異なる修正を1つのIssue・ブランチ・PRへ混ぜない
- 未確認の料金、実績、保険、即日対応、割引などを追加しない
- GitHubへの外部操作は実行直前に本人へ確認する

確認が必要な外部操作：

- GitHubリポジトリの作成・公開設定変更
- `gh issue create`
- `git push`
- `gh pr create`
- `gh pr merge`

## ファイルの役割

- `wordpress/page-housecleaning-sagamihara.php`：編集する正本
- `scripts/build-static.mjs`：PHP原稿から静的確認版を生成
- `index.html`：GitHub Pagesで表示する生成物
- `images/`：静的確認版で使う画像

PHP原稿を変更したら、次を実行して`index.html`を更新する。

```bash
node scripts/build-static.mjs
```

## 検証

```bash
python3 -m http.server 8000
```

- PC幅とスマホ幅を実際に確認する
- 実行したコマンドと結果を報告する
- GitHub Pagesは静的確認版であり、WordPressのPHP実行やフォーム送信は確認できない

## 引き継ぎ

区切りがついたら、`~/AIエージェント作業用/00_進捗メモ.md`へ
`（Codex で作業）`と明記して追記する。

