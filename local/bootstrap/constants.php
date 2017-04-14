<?php

# 共通関数を定義しているファイル
//require_once ROOT_PATH . '/config/commonfunc.php';

# セッションのNAMESPACEを定義する。
define('SESSION_NAME_ADMIN_PREFIX', 'pointer.admin.');

# 管理者のACL関連情報を定義する。
define('AUTH_ROLE_ADMIN_NOTLOGIN',    'NOTLOGIN');
define('AUTH_ROLE_ADMIN_GENERAL',     'GENERAL');
define('AUTH_ROLE_ADMIN_ACCOUNTING',  'ACCOUNTING');
define('AUTH_ROLE_ADMIN_SUPER',       'SUPER_ADMIN');

define('AUTH_RESOURCE_ADMIN_NOTLOGIN',    'NOTLOGIN_PAGE');
define('AUTH_RESOURCE_ADMIN_GENERAL',     'GENERAL_PAGE');
define('AUTH_RESOURCE_ADMIN_ACCOUNTING',  'ACCOUNTING_PAGE');
define('AUTH_RESOURCE_ADMIN_SUPER',       'SUPER_ADMIN_PAGE');

define('MESSAGE_FORBIDDEN_VIP_ACCESS', '権限によりアクセスできない画面です。');

## Date, Time Format
# Empty Date, DateTime
define('EMPTY_DATE', '1900-01-01');
define('EMPTY_DATETIME', '1900-01-01 00:00:00');
# Max Valid Date
define('MAX_VALID_DATE', '3000-01-01');
# MySQL Date
define('MYSQL_DATE', 'Y-m-d');
# MySQL DateTime
define('MYSQL_DATETIME', 'Y-m-d H:i:s');

# MAX EXECUTION TIME
define('MAX_EXEC_TIME', 3600);

# UPLOAD MAX FILE SIZE
define('UPLOAD_MAX_FILESIZE', 6*1024*1024);

# POST MAX SIZE
define('POST_MAX_SIZE', 6*1024*1024);
