linebot-wedding-receive
==

婚禮帶位小幫手（LINE Bot範例）

方法有二(需寫程式與不需寫程式)：

1. 不需寫程式
    
    ```
    1-1 Line Manager > 帳號設定 > Message API 設定 > Auto-reply messages => 允許
    1-2 Line Manager > 訊息 > 關鍵字回應訊息 > 逐筆編譯關鍵字
    ```


2. 需寫程式，如下步驟

## 步驟:

1. 詳細閱讀 [appcoda 開發指南：使用 LINE Bot PHP SDK 打造問答型聊天機器人](https://www.appcoda.com.tw/line-chatbot-sdk/)

    ```
    1-1 申請 LINE@ ID ([https://business.line.me](https://business.line.me))
    1-2 LINE@ MANAGER > 帳號設定 > Message API 設定 > 點選 『LINE Developers』
    1-3 Use webhooks => 允許
    1-4 Webhook URL Requires SSL => 需輸入您的 https 網址
    1-5 Allow bot to join group chats => 允許
    1-6 Auto-reply messages => Disabled
    1-7 Greeting messages => 允許
    以上作業完成後，可回到 『Message API 設定』，確認 API 設定狀態    
    ```

2. 從 [Google sheet 婚禮桌次轉 JSON 文件](https://docs.google.com/spreadsheets/d/16uXte1K6TQWZeiR_X1OquJD98T6SuUNbgqLYfiid1fY/edit#gid=0) `建立副本至您的 Google Drive`

    ```
    Google sheet 婚禮桌次作業說明：
    1. A 欄（photo_url）: 圖片網址（會自動依照 E欄 所輸入的桌次修改顯示圖片網址）
    2. B 欄（title）:  顯示桌次（會自動依照 E欄 所輸入的桌次修改顯示桌次說明，如：第二桌）
    3. C 欄（keyword）：輸入賓客名稱
    4. D 欄（桌次）：主要是要控制 A, B 欄位，不會實際應用於程式中
    5. 將 sheet 發佈為 json 格式，請參考 [appcoda 開發指南：使用 LINE Bot PHP SDK 打造問答型聊天機器人](https://www.appcoda.com.tw/line-chatbot-sdk/)
    ```

3. git clone https://github.com/demotascha/linebot-wedding-receive.git . 
4. 修改 index.php 第 25-27 行，將您的資訊複製上去
5. ![alt text](https://storage.googleapis.com/demotascha/example.png)


## Google sheet 知識庫範例

1. [Google sheet 婚禮桌次 原始檔範例](https://docs.google.com/spreadsheets/d/16uXte1K6TQWZeiR_X1OquJD98T6SuUNbgqLYfiid1fY/edit#gid=0)
2. [Google sheet 婚禮桌次轉 JSON 文件](https://spreadsheets.google.com/feeds/list/16uXte1K6TQWZeiR_X1OquJD98T6SuUNbgqLYfiid1fY/od6/public/values?alt=json), 

## 開發需求

- Line 帳號申請（相關資源第九點）
- https 網域空間（您的網址，LINE官方需要驗證）
- 照片儲存地點 (最後可轉為公開的存取的網址，如：http://www.ooo.com/img/桌次1.jpeg）
- google sheet 婚禮桌次編排
- PHP 5.4 or later

## 相關網路資源

1. [appcoda 開發指南：使用 LINE Bot PHP SDK 打造問答型聊天機器人](https://www.appcoda.com.tw/line-chatbot-sdk/)
2. [LINE@ MANAGER](https://admin-official.line.me/)
3. [開發者文件](https://devdocs.line.me/)
4. [開發者網站的教學文章](https://developers.line.me/messaging-api/getting-started)
5. [LINE PHP SDK](https://github.com/line/line-bot-sdk-php)
6. [Microsoft Azure](https://azure.microsoft.com/zh-tw/free/)
7. [註冊 Google 帳號](https://accounts.google.com/SignUp?hl=zh-TW)
8. [Google 雲端硬碟](https://drive.google.com/drive/)
9. [LINE Business Center](https://business.line.me/auth)
