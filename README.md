# 導入時に行う操作

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
git reset --hard origin/ACL-login
git remote set-url origin https://github.com/ユーザー名/プロジェクト名.git
```

## composer の更新
- composer.lock を削除
- cmd_for_php.bat
```
cd C:\bigcrunch\プロジェクト名
composer install
```

## タイトルの変更
- config/app.php
```
'App' => [
	...
+   "title" => "任意（表示名）",
+   "projectName" => "bigcrunch",
],
```

## DB設定
- http://localhost/phpmyadmin/index.php にアクセス
- DB 作成
	- utf8-general-ci
	```
	CREATE TABLE users (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255) NOT NULL UNIQUE,
	password CHAR(60) NOT NULL,
	group_id INT(11) NOT NULL,
	created DATETIME DEFAULT CURRENT_TIMESTAMP,
	modified DATETIME DEFAULT CURRENT_TIMESTAMP
	);

	CREATE TABLE groups (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	created DATETIME DEFAULT CURRENT_TIMESTAMP,
	modified DATETIME DEFAULT CURRENT_TIMESTAMP
	);
	```

- app.php 268行目付近
```
    'username' => 'root',
    'password' => '',
    'database' => 'DB名',
    'encoding' => 'utf8',
```

## vendor の修正
- /vendor/cakephp/acl/src/AclExtras.php 61行目
```
-    public $rootNode = 'controllers';
+    public $rootNode = 'App';
```

## ACLテーブルの の更新
- cmd_for_php.bat
```
cd C:\bigcrunch\プロジェクト名\bin
cake Migrations.migrations migrate -p Acl
cake acl_extras aco_sync
```

## 確認
- AppController.php 34行目
	- $this->Auth->allow(); のコメントアウトを外す（一番最初にアカウントを作るときの設定）

- localhost/プロジェクト名/groups/add
	- admin を追加
	- edit で、全権限をYesに変更
	- users/add にアクセスして、以下の権限で追加
		- name: root
		- pw: root
		- group: admin
- users/logout にアクセス


- AppController.php を再度コメントアウト
- http://localhost/プロジェクト名 にアクセスする
	- ログイン画面に飛ぶはず
- root でログイン
	- 初期ページが出てくることを確認

- groups/add で、viewerグループを追加
	- editで、indexとviewのみYesに設定
- users/addで、viewerグループのユーザーを追加
- viewer権限で再ログイン
- http://localhost/プロジェクト名/users にアクセス
	- New User を押して、エラーが出ればOK