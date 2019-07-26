# 導入後に行う操作

## プロジェクト作成
- cmd_for_php.bat
```
cd C:\bigcrunch
composer create-project --prefer-dist cakephp/app プロジェクト名
```

## テンプレート読み込み
- git bash
```
cd C:\bigcrunch\プロジェクト名
git init
git remote add origin https://github.com/pulcherriman/bigcrunch-template.git
git fetch origin
git reset --hard origin/master
```

## composer の更新
- cmd_for_php.bat
```
cd C:\bigcrunch\プロジェクト名
composer install
```