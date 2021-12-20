# Laravel_php

簡易部落格
用 Laravel 寫 RESTful API
* 版本
  * Laravel Framework 8.64.0
  * PHP 7.4.22
* 功能
  * 文章的 CRUD
    * 新增、修改時進行表單驗證
    * 文章列表查詢可限制筆數分頁
  * 文章類別的 CRUD
* 資料表
    * Post
    
        | 欄位       | 說明    | 格式        | 備註      |
        | ---------  | ------ | ----------  | --------  |
        | id         | ID     | BIGINT(20)  |           |
        | title      | 標題    | VARCHAR(50) |           |
        | content    | 內容    | TEXT        |           |
        | catagoryId | 文章分類 | INT(10)     | 預設 0    |
        | status     | 文章狀態 | VARCHAR(10) | 預設draft |
        | created_at | 創建時間 | TIMESTAMP   | 預設NULL  |
        | updated_at | 更新時間 | TIMESTAMP   | 預設NULL  |
    * Catagory
        | 欄位         | 說明     | 格式        | 備註      |
        | ----------- | -------- | ----------  | --------  |
        | catagoryId  | 分類ID   | INT(10)     |           |
        | catagoryName| 類別名稱 | VARCHAR(50) |           |
        | created_at  | 創建時間 | TIMESTAMP   | 預設NULL  |
        | updated_at  | 更新時間 | TIMESTAMP   | 預設NULL  |
