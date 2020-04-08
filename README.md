# Resumes, 履歷們

簡單存放與檢視履歷的網站

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

首先，利用 [HomeBrew](https://brew.sh) 安裝 composer 到您的環境中

```
brew install composer
```

接著，利用 composer 安裝 Laravel

```
composer global require laravel/installer
```

最後，在我們環境架設中，我們也需要 [docker](https://www.docker.com)。

### Installing

首先，進入到專案的資料夾，先使用 composer 將套件載入。

```
composer install
```

套件載入完後，將 `.env` 生成；
```
cp .env.example .env
```
接著，使用 artisan 生成一把 key。
```
php artisan key:generate
```

## Deployment

我們還需要 [Laradock](http://laradock.io) 幫助我們架設環境：在我們的專案中下以下指令


```
git clone https://github.com/Laradock/laradock.git
```

接著，進入 **laradock** 資料夾,生成 `.env`。

```
cp env-example .env
```

下一步，用 docker 跑 container

```
docker-compose up -d nginx mysql redis workspace
```
最後，我們還需要建立資料庫。首先，在與資料庫互動前，必須將 `.env` 中的 `DB_HOST` 從 `mysql` 改成 `127.0.0.1`，接著在專案資料夾輸入
```
php artisan migrate
```
Migration 完成後，將 `.env` 的 `DB_HOST` 改回 `mysql`，專案就可以在 http://127.0.0.1 上看到。

## Running the tests

可以下`php artisan db:seed`，資料庫將建立 10 組一般會員、20 份履歷（隨機分配給會員）、Admin 與 Super Admin 各 1 位，與 10 組 Tag。

## Built With

* [Laravel](http://laravel.com) - The web framework

## Authors

* **Harbor Liu** 

## Acknowledgments

* 練習用的專案：學習 Eloquent ORM 的 many-to-many relationship
* 額外做的 feature：
    * 會員履歷數限制三篇；
    * 登入功能，會員制：有會員才可檢視履歷內容、新增履歷；
    * 會員權限：權限分為 Super Admin、Admin 和 Member（一般會員），Super Admin 與 Admin 有新增標籤的權限；Super Admin 有編輯與刪除每位會員履歷的權限。

