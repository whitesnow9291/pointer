<?php
/**
 * 마스터자료 (렬거형 등)를 정의한다.
 * 2013/08/28
 * 
 * @author Nonado
 */

# Status
define('STATUS_INVALID', 0);
define('STATUS_VALID', 1);
/*define('STATUS_VALID2', 2);
$StatusName = array(
    STATUS_INVALID => 'OFF',
    STATUS_VALID => 'ON',
    STATUS_VALID2 => 'ON',
);*/
$AdminStatusName = array(
    STATUS_INVALID => '無効',
    STATUS_VALID => '有効'
);

# 운영자의 권한
define('ADMIN_AUTH_GENERAL', 1);
define('ADMIN_AUTH_ACCOUNTING', 2);
define('ADMIN_AUTH_SUPER', 3);
define('ADMIN_AUTH_FXDD_GENERAL', 4);
define('ADMIN_AUTH_FXDD_ACCOUNTANT', 5);
define('ADMIN_AUTH_FXDD_ADMIN', 6);
$AdminAuthority = array(
    ADMIN_AUTH_GENERAL     => '一般管理者',
    ADMIN_AUTH_ACCOUNTING  => '経理担当者', 
    ADMIN_AUTH_SUPER       => '最高管理者',
    ADMIN_AUTH_FXDD_GENERAL    => '一般管理者',
    ADMIN_AUTH_FXDD_ACCOUNTANT => '会計担当者',
    ADMIN_AUTH_FXDD_ADMIN      => 'システム管理者_FX'
);

# Gender
define('GENDER_MALE', 1);
define('GENDER_FEMALE', 2);
$Gender = array(
    GENDER_MALE => '男性',
    GENDER_FEMALE => '女性',
);

# UserType
define('USER_PERSONAL', 1);
define('USER_BUSINESS', 2);
$UserType = array(
    USER_PERSONAL => '個人',
    USER_BUSINESS => '法人',
);
## FXDDへのCSV出力に必須
$UserType_en = array(
    USER_PERSONAL => 'Individual',
    USER_BUSINESS => 'Corporate',
);

# RemitStatus
define('REMIT_STATUS_INAPPLICATION', 1);
define('REMIT_STATUS_CANCELLED', 2);
define('REMIT_STATUS_CONFIRMED', 3);
define('REMIT_STATUS_APPLICATIONERROR', 4);
//define('REMIT_STATUS_INPROCESS', 5);
//define('REMIT_STATUS_PROCESSERROR', 6);
//define('REMIT_STATUS_COMPLETED', 7);
$RemitStatus = array(
    REMIT_STATUS_INAPPLICATION => '手続中',
    REMIT_STATUS_CANCELLED => 'キャンセル',
    REMIT_STATUS_CONFIRMED => '手続完了',
    REMIT_STATUS_APPLICATIONERROR => '手続エラー',
    /*REMIT_STATUS_INPROCESS => '処理中',
    REMIT_STATUS_PROCESSERROR => '処理エラー',
    REMIT_STATUS_COMPLETED => '処理完了',*/
);

/*
$RemitStatus_en = array(
    REMIT_STATUS_INAPPLICATION => 'Reserving',
    REMIT_STATUS_CANCELLED => 'Cancelled',
    REMIT_STATUS_CONFIRMED => 'Reserved',
    REMIT_STATUS_APPLICATIONERROR => 'Reserve Error',
    REMIT_STATUS_INPROCESS => 'Processing',
    REMIT_STATUS_PROCESSERROR => 'Process Error',
    REMIT_STATUS_COMPLETED => 'Processed',
);
*/
# RemitRemark
# Reserved 301 -
define('REMIT_RESERVED_SENT', 301);            // 通知済み
# Application Error 401 ~
define('REMIT_APPLICATIONERROR_CHANGED', 401); // 送金予約情報変更
# Cancel 201 -
define('REMIT_CANCEL_BYUSER', 201);            // ユーザーによるキャンセル
define('REMIT_CANCEL_EXPIRED', 202);           // 期限切れ
define('REMIT_CANCEL_APPLICATIONERROR', 203);  // 返金（手続エラー）
define('REMIT_CANCEL_PROCESSERROR', 204);      // 返金（処理エラー）

$RemitRemark = array(
    REMIT_RESERVED_SENT => '通知済み',
    REMIT_APPLICATIONERROR_CHANGED => '送金予約情報変更',
    REMIT_CANCEL_BYUSER => 'お客様によるキャンセル',
    REMIT_CANCEL_EXPIRED => '有効期限切れ',
    REMIT_CANCEL_APPLICATIONERROR => '返金（手続エラー）'
    //REMIT_CANCEL_PROCESSERROR     => '返金（処理エラー）'
);
$RemitCancelKind = array(
    REMIT_CANCEL_BYUSER => 'お客様によるキャンセル',
    REMIT_CANCEL_EXPIRED => '有効期限切れ',
    REMIT_CANCEL_APPLICATIONERROR => '返金（手続エラー）'
    //REMIT_CANCEL_PROCESSERROR     => '返金（処理エラー）'
);

# depositStatus
define('DEPOSIT_STATUS_SUCCESS',       0x0001); // 正常
define('DEPOSIT_STATUS_WRONGNO',       0x0010); // 送金予約番号不明
define('DEPOSIT_STATUS_WRONGREMITTER', 0x0020); // 送金者不明
define('DEPOSIT_STATUS_WRONGAMOUNT',   0x0040); // 送金金額の相違
define('DEPOSIT_STATUS_WRONGTRANSFER', 0x0080); // 振込方法の相違
define('DEPOSIT_STATUS_DUPLICATED',    0x1000); // 重複入金
define('DEPOSIT_STATUS_RETURNASK',     0x2000); // 返金要請中
define('DEPOSIT_STATUS_RETURNED',      0x4000); // 返金
define('DEPOSIT_STATUS_DELETED',       0x8000); // 削除
define('DEPOSIT_STATUS_UNSETTLED',     0x10F0); // 不明金
$DepositStatus = array(
    DEPOSIT_STATUS_SUCCESS => '正常入金',
    DEPOSIT_STATUS_RETURNASK => '返金要請中',
    DEPOSIT_STATUS_UNSETTLED => '不明金',
    DEPOSIT_STATUS_WRONGNO => '送金予約番号不明',
    DEPOSIT_STATUS_WRONGREMITTER => '送金者不明',
    DEPOSIT_STATUS_WRONGAMOUNT => '送金金額の相違',
    DEPOSIT_STATUS_WRONGTRANSFER => '振込方法の相違',
    DEPOSIT_STATUS_DUPLICATED => '重複入金',
    DEPOSIT_STATUS_RETURNED => '返金済み',
    DEPOSIT_STATUS_DELETED => '削除済み',
);
$DepositStatusWrong = array(
    DEPOSIT_STATUS_WRONGNO => '送金予約番号不明',
    DEPOSIT_STATUS_WRONGREMITTER => '送金者不明',
    DEPOSIT_STATUS_WRONGAMOUNT => '送金金額の相違',
    DEPOSIT_STATUS_WRONGTRANSFER => '振込方法の相違',
    DEPOSIT_STATUS_DUPLICATED => '重複入金',
);

# Client Name
define('CLIENT_NAME', 'FXDD');
$ClientName = array(
    CLIENT_NAME => 'FXDD',
);

# Platform
/*$Platform = array(
    1 => 'Meta Trader',
    2 => 'MTX',
    3 => 'Mirror Trader',
    4 => 'Power Trader',
    5 => 'Viking',
    6 => 'Jforex',
    7 => 'Swordfish',
);*/

# CompanyType
$LegalForm = array(
    1 => 'Company Limited by shares',
    2 => 'Limited Liability Company',
    3 => 'Partnership en commandite',
    4 => 'Partnership en nom collectif',
    5 => 'Limited Partnership',
    6 => 'Private Limited Company',
    7 => 'Public Limited Company',
    8 => 'Registered Charity',
    9 => 'Business Trust',
    10 => 'Corporation(Inc.)',
    11 => 'Doing Business AS(DBA)',
    12 => 'General Partnership',
    13 => 'Joint Stock Association(JSA)',
    14 => 'Limited Liability Limited Partnership(LLLP)',
    15 => 'Limited Liability Partnership(LLP)',
    16 => 'Limited Liability Company(LLC)',
    17 => 'Limited Partnership',
    18 => 'Professional Limited Liability Company(PLLC)',
    19 => 'Professional Corporation(P.C.)',
    20 => 'Public Corporation(Ltd.)',
    21 => 'Pubulic Trades Limites(PTLP)',
    22 => 'Australian Private Company',
    23 => 'Australian Public Company',
    24 => 'Co-operative',
    25 => 'Limited Partnership'
);

$LegalFormRelation = array(
    1 => 'MT',
    2 => 'MT',
    3 => 'MT',
    4 => 'MT',
    5 => 'UK',
    6 => 'UK',
    7 => 'UK',
    8 => 'UK',
    9 => 'US',
    10 => 'US',
    11 => 'US',
    12 => 'US',
    13 => 'US',
    14 => 'US',
    15 => 'US',
    16 => 'US',
    17 => 'US',
    18 => 'US',
    19 => 'US',
    20 => 'US',
    21 => 'US',
    22 => 'AU',
    23 => 'AU',
    24 => 'AU',
    25 => 'AU'
);

$LegalFormCountry = array(
    'MT' => 'Malta',
    'UK' => 'United Kingdom',
    'US' => 'United States of America',
    'AU' => 'Australia'
);

# AccountType
$AccountType = array(
    1 => '普通預金',
    2 => '当座預金',
);
/*
# AccountType
$AccountType_en = array(
    1 => 'Ordinary Saving',
    2 => 'Current',
);
*/
# 도도부현 (일본의 47개 현)
$Prefecture_JA = array(
    '1' => '北海道',
    '2' => '青森県',
    '3' => '岩手県',
    '4' => '秋田県',
    '5' => '宮城県',
    '6' => '山形県',
    '7' => '福島県',
    '8' => '茨城県',
    '9' => '栃木県',
    '10' => '群馬県',
    '11' => '千葉県',
    '12' => '埼玉県',
    '13' => '東京都',
    '14' => '神奈川県',
    '15' => '新潟県',
    '16' => '長野県',
    '17' => '富山県',
    '18' => '石川県',
    '19' => '福井県',
    '20' => '岐阜県',
    '21' => '山梨県',
    '22' => '静岡県',
    '23' => '愛知県',
    '24' => '滋賀県',
    '25' => '三重県',
    '26' => '京都府',
    '27' => '奈良県',
    '28' => '大阪府',
    '29' => '和歌山県',
    '30' => '兵庫県',
    '31' => '鳥取県',
    '32' => '岡山県',
    '33' => '島根県',
    '34' => '広島県',
    '35' => '山口県',
    '36' => '香川県',
    '37' => '徳島県',
    '38' => '愛媛県',
    '39' => '高知県',
    '40' => '福岡県',
    '41' => '大分県',
    '42' => '佐賀県',
    '43' => '長崎県',
    '44' => '宮崎県',
    '45' => '熊本県',
    '46' => '鹿児島県',
    '47' => '沖縄県',
    '48' => '海外'
);

# 도도부현 (일본의 47개 현)
$Prefecture_EN = array(
    '1' => 'Hokkaido',
    '2' => 'Aomori',
    '3' => 'Iwate',
    '4' => 'Akita',
    '5' => 'Miyagi',
    '6' => 'Yamagata',
    '7' => 'Fukushima',
    '8' => 'Ibaraki',
    '9' => 'Tochigi',
    '10' => 'Gunma',
    '11' => 'Chiba',
    '12' => 'Saitama',
    '13' => 'Tokyo',
    '14' => 'Kanagawa',
    '15' => 'Niigata',
    '16' => 'Nagano',
    '17' => 'Toyama',
    '18' => 'Ishikawa',
    '19' => 'Fukui',
    '20' => 'Gifu',
    '21' => 'Yamanashi',
    '22' => 'Shizuoka',
    '23' => 'Aichi',
    '24' => 'Shiga',
    '25' => 'Mie',
    '26' => 'Kyoto',
    '27' => 'Nara',
    '28' => 'Osaka',
    '29' => 'Wakayama',
    '30' => 'Hyogo',
    '31' => 'Tottori',
    '32' => 'Okayama',
    '33' => 'Shimane',
    '34' => 'Hiroshima',
    '35' => 'Yamaguchi',
    '36' => 'Kagawa',
    '37' => 'Tokushima',
    '38' => 'Ehime',
    '39' => 'Kochi',
    '40' => 'Fukuoka',
    '41' => 'Oita',
    '42' => 'Saga',
    '43' => 'Nagasaki',
    '44' => 'Miyazaki',
    '45' => 'Kumamoto',
    '46' => 'Kagoshima',
    '47' => 'Okinawa',
    '48' => 'Foreign'
);

# 화폐
$CurrencyName = array(
    'JPY' => '日本円'/*,
    'USD' => '米ドル',
    'EUR' => 'ユーロ',*/
);
$CurrencyUnit = array(
    'JPY' => '円',
    'USD' => '米ドル',
    'EUR' => 'ユーロ',
);
$CurrencySymbol = array(
    'USD' => '$',
    'EUR' => '€',
    'GBP' => '£',
    'RUB' => 'pуб',
    'JPY' => '￥',
    'AUD' => '$',
);

# CountryName
$CountryName_JA = array(
    'JP' => '日本',
    'US' => '米国'
);
$CountryName_EN = array(
    'JP' => 'Japan',
    'US' => 'United States of America',
);
$CountryNameOther = array(
    'JP' => '日本',
    'US' => '米国'
);

# 나라별 전화번호 코드
$CountryTel = array(
    '81' => 'JP'
);
$CountryOtherTel = array(
    'JP' => '81',
    'US' => '01'
);

# 송금방법3
define('DEPOSIT_METHOD1_DOMESTIC', 1);

# 송금방법1
$RemitMethod1 = array(
    DEPOSIT_METHOD1_DOMESTIC => '国内銀行送金'
);

# 송금방법2
$RemitMethod2 = array(
    1 => 'ネットバンキング', 
    2 => '窓口・ATM'
);

# 송금방법3
define('DEPOSIT_METHOD3_MAILMONEY', 1);
define('DEPOSIT_METHOD3_SIMPLEPAYMENT', 2);
define('DEPOSIT_METHOD3_NORMALPAYMENT', 3);

$RemitMethod3 = array(
    DEPOSIT_METHOD3_MAILMONEY     => 'かんたん振込み（メルマネ）',
    DEPOSIT_METHOD3_SIMPLEPAYMENT => 'かんたん決済',
    DEPOSIT_METHOD3_NORMALPAYMENT => '通常振込み',
);

## FXDDへのCSV出力に必須
$RemitMethod3_en = array(
    DEPOSIT_METHOD3_MAILMONEY     => 'Rakuten Bank Merumane', 
    DEPOSIT_METHOD3_SIMPLEPAYMENT => 'Simple Payment',
    DEPOSIT_METHOD3_NORMALPAYMENT => 'Regular Transfer',
);

# 金融機関番号
define('RAKUTEN_BANKCODE', '0036');

# 会員のステータス
define('STATUS_DELETED', 9);
define('STATUS_ALLOWED', 1);
define('STATUS_DISALLOWED', 0);
$UserStatus = array(
    STATUS_ALLOWED    => '承認',
    STATUS_DISALLOWED => '非承認'
);

# お知らせ受信可否
define('NEWS_MAIL_ALLOWED', 1);
define('NEWS_MAIL_DISALLOWED', 0);
$NewsMailFlag = array(
    NEWS_MAIL_ALLOWED    => '受信する',
    NEWS_MAIL_DISALLOWED => '受信しない'
);

# 会員のステータス（特殊）
define('STATUS_SPECIAL_RESTORE', 1); // 回復

# Language
$Language = array(
    'ja' => '日本語',
    'en' => 'English'
);

# Mail Kind
define('MAIL_VERIFICATION', 1);
define('MAIL_RESET_PASSWORD', 2);
define('MAIL_WELCOME', 3);
define('MAIL_REMIT_APPLICATION_CONFIRM', 11);
define('MAIL_DEPOSIT_CONFIRM', 15);
define('MAIL_NOTIFY_UNKNOWN', 21);
define('MAIL_NOTIFY_UNKNOWN_RETURN', 22);
define('MAIL_NOTIFY_UNKNOWN_SUCCESS', 23);
define('MAIL_NOTIFY_UNKNOWN_DELETE', 24);
define('MAIL_REMIT_APPLICATION_CHANGE', 27);
define('MAIL_REMIT_APPLICATION_CANCEL', 28);
define('MAIL_REMIT_COMPLETE', 30);
define('MAIL_INQUIRY_REPLY', 50);
define('MAIL_INQUIRY_CONTACTUS', 51);
define('MAIL_BULK', 60);

# DepositOperation
define('DEPOSIT_OPERATION_MAIL', 1);
define('DEPOSIT_OPERATION_TALK', 2);
define('DEPOSIT_OPERATION_RETURN', 3);
define('DEPOSIT_OPERATION_CONFIRMED', 4);
define('DEPOSIT_OPERATION_DELETE', 5);
define('DEPOSIT_OPERATION_MOVE', 6);
$DepositOperation = array(
    DEPOSIT_OPERATION_MAIL => 'メール通知',
    DEPOSIT_OPERATION_TALK => '電話連絡',
    DEPOSIT_OPERATION_RETURN => '返金',
    DEPOSIT_OPERATION_CONFIRMED => '手続を完了',
    DEPOSIT_OPERATION_DELETE => '入金履歴削除',
    DEPOSIT_OPERATION_MOVE => '他の送金予約情報に処理',
);

# 本人確認書類
define('CERT_DRIVER_LICENSE', 1);
define('CERT_HEALTH_INSURANCE', 2);
define('CERT_PASSPORT', 3);
define('CERT_RESIDENCE_CARD', 4);
define('CERT_FOREIGN_RESIDENCE_CARD', 5);
define('CERT_OTHER', 6);
$CertName = array(
    CERT_DRIVER_LICENSE => '運転免許証',
    CERT_HEALTH_INSURANCE => '各種健康保険証',
    CERT_PASSPORT => 'パスポート',
    CERT_RESIDENCE_CARD => '住民基本台帳カード',
    CERT_FOREIGN_RESIDENCE_CARD => '在留カード',
    CERT_OTHER => 'その他'
);

# 会員一覧画面　（本人確認書類のアップロードの状態）
define('DOCUMENT_NOTUPLOAD', 1);
define('DOCUMENT_UPLOADED', 2);
$UploadStatus = array(
    DOCUMENT_NOTUPLOAD => '未受付',
    DOCUMENT_UPLOADED => '受付済み',
);

# お問い合わせステータス
define('INQUIRY_RECEIVED', 1);
define('INQUIRY_REPLYED', 2);
$InquiryStatus = array(
    INQUIRY_RECEIVED => '返信前',
    INQUIRY_REPLYED => '返信済み',
);

$InquiryType = array(
    1 => '送金状態について',
    2 => '不具合について',
    3 => '返金について',
    4 => 'その他',
);

# 収納通知ステータス
define('NOTIFICATION_EXPORTED', 0);
define('NOTIFICATION_DOWNLOADED', 1);
$NotificationStatus = array(
    NOTIFICATION_EXPORTED => '出力済み',
    NOTIFICATION_DOWNLOADED => 'ダウンロード済み',
);

# 暗号化方式
define('ENCRYPTION_NONE', 0);
define('ENCRYPTION_SYMMETRIC', 1);
define('ENCRYPTION_PUBLIC', 2);
$EncryptionMethod = array(
    ENCRYPTION_NONE => '暗号化しない',
    //ENCRYPTION_SYMMETRIC => '共通鍵',
    ENCRYPTION_PUBLIC => '公開鍵',
);

# 収納代行手数料の徴収方式
define('CHARGE_COLLECTION_METHOD_DEDUCTION', 1);
define('CHARGE_COLLECTION_METHOD_LUMP_SUM', 2);
$ChargeCollectionMethod = array(
    CHARGE_COLLECTION_METHOD_DEDUCTION => '差引徴収',
    CHARGE_COLLECTION_METHOD_LUMP_SUM  => '締払い徴収'
);

# 通常振込データのステータス
define('DEPOSITCSV_MAILMONEY', 1);
define('DEPOSITCSV_MINUS', 2);
define('DEPOSITCSV_IMPORTED', 3);
define('DEPOSITCSV_PROCESSED', 4);
define('DEPOSITCSV_HUMEI', 99);
$DepositcsvStatus = array(
    DEPOSITCSV_MAILMONEY => 'メルマネ',
    DEPOSITCSV_MINUS => '出金',
    DEPOSITCSV_IMPORTED => 'インポート済み',
    DEPOSITCSV_PROCESSED => '処理済み',
    DEPOSITCSV_HUMEI => 'その他',
);

# 一括メールの送信方式
define('BULK_MAIL_IMMEDIATELY', 1);
define('BULK_MAIL_SCHEDULED', 2);
$BulkMailMethod = array(
    BULK_MAIL_IMMEDIATELY => '即時',
    BULK_MAIL_SCHEDULED   => '定時'
);

# お知らせメール（一括メール）の受信可否
define('BULK_MAIL_FLAG_RECEIVE', 1);
define('BULK_MAIL_FLAG_DENY', 0);
$BulkMailReceptionFlag = array(
    BULK_MAIL_FLAG_RECEIVE => '受信する',
    BULK_MAIL_FLAG_DENY    => '受信しない'
);

# 楽天入金メールの自動処理
define('DEPOSIT_MAIL_UNATTENDED', 0);
define('DEPOSIT_MAIL_FAIL', 1);
define('DEPOSIT_MAIL_SUCCESS', 2);
$DepositMailStatus = array(
        DEPOSIT_MAIL_UNATTENDED => '未処理',
        DEPOSIT_MAIL_FAIL => '処理エラー',
        DEPOSIT_MAIL_SUCCESS => '処理成功'
);

# 表示/非表示ステータス
define('STATUS_HIDE', 0);
define('STATUS_SHOW', 1);
$VisibleStatus = array(
    STATUS_HIDE => '表示しない',
    STATUS_SHOW=> '表示する',
);

# ATMサポートステータス
define('ATM_UNSUPPORT', 0);
define('ATM_SUPPORT', 1);
$AtmSupportStatus = array(
        ATM_UNSUPPORT => 'サポートしない',
        ATM_SUPPORT=> 'サポートする',
);

# 重要フラグ
define('PRIORITY_NORMAL', 0);
define('PRIORITY_HIGH', 1);
$PriorityFlag = array(
    PRIORITY_NORMAL => '普通',
    PRIORITY_HIGH => '重要',
);

$masterData = array(
    //'StatusName' => $StatusName,
    'RemitStatus' => $RemitStatus,
    //'RemitStatus_en' => $RemitStatus_en,
    'RemitRemark' => $RemitRemark,
    'RemitCancelKind' => $RemitCancelKind,
    'DepositStatus' => $DepositStatus,
    'DepositStatusWrong' => $DepositStatusWrong,
    'ClientName' => $ClientName,
    'Prefecture_JA' => $Prefecture_JA,
    'Prefecture_EN' => $Prefecture_EN,
    'Gender' => $Gender,
    'UserType' => $UserType,
    'UserType_en' => $UserType_en, ## FXDDへのCSV出力に必須
    'Language' => $Language,
    //'Platform' => $Platform,
    'AdminAuthority' => $AdminAuthority,
    'AccountType' => $AccountType,
    //'AccountType_en' => $AccountType_en,
    'CurrencyName' => $CurrencyName,
    'CurrencyUnit' => $CurrencyUnit,
    'CurrencySymbol' => $CurrencySymbol,
    'CountryName_JA' => $CountryName_JA,
    'CountryName_EN' => $CountryName_EN,
    'CountryTel' => $CountryTel,
    'RemitMethod1' => $RemitMethod1,
    'RemitMethod2' => $RemitMethod2,
    'RemitMethod3' => $RemitMethod3,
    'RemitMethod3_en' => $RemitMethod3_en, ## FXDDへのCSV出力に必須
    //'UserApprove' => $UserApprove,
    'AdminStatusName' => $AdminStatusName,
    'UserStatus' => $UserStatus,
    'DepositOperation' => $DepositOperation,
    'CertName' => $CertName,
    'InquiryStatus' => $InquiryStatus,
    'InquiryType' => $InquiryType,
    'CountryNameOther' => $CountryNameOther,
    'CountryOtherTel' => $CountryOtherTel,
    'LegalForm' => $LegalForm,
    'LegalFormRelation' => $LegalFormRelation,
    'LegalFormCountry' => $LegalFormCountry,
    'NotificationStatus' => $NotificationStatus,
    'EncryptionMethod' => $EncryptionMethod,
    'ChargeCollectionMethod' => $ChargeCollectionMethod,
    'DepositcsvStatus' => $DepositcsvStatus,
    'UploadStatus' => $UploadStatus,
    'BulkMailMethod' => $BulkMailMethod,
    'BulkMailReceptionFlag' => $BulkMailReceptionFlag,
    'NewsMailFlag' => $NewsMailFlag,
    'DepositMailStatus' => $DepositMailStatus,
    'NewsMailFlag' => $NewsMailFlag,
    'VisibleStatus' => $VisibleStatus,
    'PriorityFlag' => $PriorityFlag,
    'AtmSupportStatus' => $AtmSupportStatus,
);
