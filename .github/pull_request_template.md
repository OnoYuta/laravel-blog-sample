/cc 
<!-- 通知したい人にメンションを追加してください -->
<!-- レビュー待ちを減らすため出来るだけ一つの変更バッチを小さく保つことを意識しましょう -->
<!-- 【重要】: Pull Requestの作成前にissueを作成してください -->

## チェックリスト
<!-- 各チェックリストの項目が埋まっていることを確認し、埋まっていない場合は補足の説明を書いてください -->
- [ ] 実装対象のissueを作成し参照している
- [ ] 他に依存するPull Requestがない
  - [ ] 他に依存するPull Requestはあるがissueへのリンクを貼っている
- [ ] 一つのPRで複数の問題を扱っていない
- [ ] 実装内容について懸念点はない
  - [ ] 実装内容について懸念点があるが説明されている
- [ ] テストを書いている
  - [ ] テストコードがない場合, コードの安全性を保証するために実行したテストが書かれている（実際に実行したコマンドとそのアウトプット等）
- [ ] CIでのテストを通過している
- [ ] コンフリクトしていない

## 変更の種類
<!-- 変更の種類にチェックを入れてください, 例: Viewの変更 →  UIの変更 -->
- [ ] バグFix
- [ ] 新規実装 (破壊的変更でない機能の追加)
- [ ] 破壊的変更 (既存機能が期待通りの動作をしなくなるような変更)
- [ ] コンフィグの変更
- [ ] ビルドシステムに関わる変更 (例: composer, npm, CircleCI)
- [ ] ビジネスロジックの実装
- [ ] UIの変更
  - [ ] 変更内容のスクリーンショットもしくは動画（GIF等）が貼ってある
- [ ] スタイルの変更 (フォーマット, 改行, 空白, etc...)
- [ ] リファクタリング (コードの振る舞いに影響を与えない変更)
- [ ] ドキュメントの変更
- [ ] テストの追加 (新規追加や欠けているテストの追加)
- [ ] それ以外のコードの動作に影響を与えない変更

## Context
<!-- このPull Requestが属するコンテキストを書いてください -->
<!-- 例:-->
<!-- 良い例: - Refs #issueナンバー -->
<!-- 良い例: - Close #15 (PRのマージと同時にissueをCloseする場合) -->
<!-- 良い例: - JIRAチケットURL -->
<!-- 良い例: - 仕様書URL -->
<!-- 良い例: - デザインURL -->
<!-- 良い例: - 依存するPull Request No e.g. #13 -->

## Problem
<!-- 問題としている対象を書いてください -->
<!-- 例: -->
<!-- 良い例: - チケットNo.○○の~~を実装するため○○を追加する必要がある. URL: ~ -->
<!-- 良い例: - 現在○○だが○○なため、○○といった問題を抱えている. その原因は○○のため -->
<!-- 悪い例: - ログインを実装したい -->

## Solution
<!-- どのようにこの問題を解決しようと考えているか -->
<!-- 例 -->
<!-- 良い例: - ○○の問題に対して○○というソリューションを使うことで問題を解決出来る. URL: ~ -->
<!-- 良い例: - ○○といったカラム名を○○に修正することで○○の問題が解決する. なぜなら〜だから -->
<!-- 良い例: - ○○に○を追加する. ただ○○という点については悩んでいるのでディスカッションしたい -->
<!-- 良い例: - 実装のスクリーンショット.jpg -->
<!-- 悪い例: - 画面を追加 -->

## Testing
<!-- テストコードが無い場合実行したテストをここで説明 -->
<!-- 良い例: 実行したコマンドと結果の出力のセット -->
<!-- 良い例: エビデンスとなるスクリーンショット, 動画等 -->
<!-- 悪い例: 再現方法が不明瞭なテスト方法. e.g. コマンドを実行して目視で確認した -->
