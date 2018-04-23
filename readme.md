# Nomadic

Nomadic 是一套讓網友一起整理清單、蒐集資訊、共同評分的 open source 系統。

由 Cafe Nomad 主程式碼中抽離出來，並改寫為通用架構而成。

目前版本支援清單模式、地圖模式，跟評分/編輯/留言/打卡/標籤功能。

## Screenshots

Nomadic 首頁

![首頁](/images/screenshot-homepage.png?raw=true "Homepage")

Nomadic 清單頁面

![清單](/images/screenshot-list.png?raw=true "List")

Nomadic 地圖頁面

![地圖](/images/screenshot-map.png?raw=true "Map")

Nomadic 主題項目頁面

![詳細頁面](/images/screenshot-entity-page.png?raw=true "Entity")

## 現階段的狀況

1. Nomadic 目前還在 beta 階段，系統可能不夠穩定，請斟酌情境使用

2. Nomadic 是由 Cafe Nomad 原始碼中抽離出來而成，但兩者尚未整合，所以發到此處的 PR 目前**不會**更新到 Cafe Nomad

3. 因為是由 Cafe Nomad 中抽離出來，目前程式碼中有很多冗餘的 code / 不合理的 naming，還請海涵。接下來幾個 release 會陸續清理乾淨程式碼

## 安裝

Nomadic 是以 Laravel 5.3 搭配 MySQL 5.5 開發而成

目前只支援 Facebook 登入，因此要在 Facebook 註冊 web app 並於 .env 檔內設定 Facebook client id/secret

另外，因為有用到 Laravel Task Scheduling，所以請記得設定

```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

## 設定

* config/review-fields.php：給使用者評分的欄位項目

* config/info-fields.php：字串類型的資訊編修項目

* config/nomadic.php：其它網站設定資訊

## 地圖模式的開啟設定
1. 在 config/nomadic.php 內將 map-enabled 設為 true
2. 前往 [Google Cloud Platform](https://console.cloud.google.com) 申請 key，開啟 Google Maps JavaScript API 與 Google Maps Geocoding API
3. 在 config/services.php 內將 google.key 填入

## License

Licensed under the GNU General Public License Version 2.0 or later.
