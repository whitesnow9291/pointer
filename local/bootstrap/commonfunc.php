<?php
/**
 * 共通関数
 * 
 * @author KHU, KH
 * @since 2011/04/26
 */

/**
 * 正数・負数の切り捨てを一致させる。
 * [+-]floor($value+$addition)
 * 
 * @param $value
 * @param $addition = 0.0
 * @return integer
 */
function g_floorToCenter($value, $addition = 0.0)
{
    // -0.9, +0.9の切り捨てを一致させるため。
    $sign = ($value > 0) ? 1 : -1;
    $value = abs($value);
    return $sign * floor($value + $addition);
}

/**
 * 入金額から代行手数料を計算する。
 * = 入金額 * 代行手数料率 / 100
 * 
 * @param double $amount
 * @param double $rate(%)
 * @return integer
 */
function g_calcChargeAmount($amount, $rate) {
    // （2013/09/19）面談により四捨五入
    // 端数の処理をする（四捨五入）
    return g_floorToCenter($amount * $rate / 100, 0.5);
}

/**
 * レート値を変換して戻す。
 * 
 * 40.30 => 40.3%
 * 21.00 => 21%
 * 
 * @param string $rate
 * @return string
 */
function g_trimRate($rate) {
    if ($rate+0 > 0) {
        if (strpos($rate, '.') !== false) {
            $rate = trim(trim($rate, '0'), '.');
        }
        $rate .= '%';
    } else {
        $rate = '';
    }
    return $rate;
}

/**
 * 値がない場合、デフォルト値を戻す。
 * 
 * @param array $arr
 * @param string $key1
 * @param string $key2
 * @param mixed $default
 * @return mixed 
 */
function g_getArrayValue($arr, $key1, $key2 = '', $default = '')
{
    if (empty($key2)) {
        return (isset($arr[$key1]) ? $arr[$key1] : $default);
    }
    
    return (isset($arr[$key1][$key2]) ? $arr[$key1][$key2] : $default);
}

/**
 * 郵便番号のハイフン区分
 * 
 * @param string $string
 * @return string
 */
function g_postNumberSplit($string) {
    if (!empty($string)) {
        return substr($string, 0, 3).'-'.substr($string,-4);
    } else {
        return '';
    }
}

/**
 * 生年月日のハイフン区分        20050801->2005-08-01
 * 
 * @param $date
 * @return $date
 */
function g_birthdaySplit($date){
    if (!empty($date)) {
        if (strlen($date) <= 8) {
            $year = substr($date,0,4);
            $month = substr($date,4,2);
            $day = substr($date,6,2);
        }
        $date = $year."-".$month."-".$day;
        return $date;
    } else {
        return '0000-00-00';
    }
}

/**
 * 文字列を指定の長さずつスペースで区切りして改行させる。
 * 
 * @param string $string
 * @param integer $lineLen
 * @return string
 */
function g_splitBySpace($string, $lineLen)
{
    $string = mb_convert_kana($string, 'S', 'utf-8');
    $array = explode('　', $string);
    $count = 0;
    $result = '';

    if (empty($array)) {
        return '';
    }

    foreach($array as $key => $value) {
        if ($count + mb_strlen($value, 'utf-8') > $lineLen) {
            if (empty($result)) {
                $result .= ($value . "\n");
                $count = 0;
            } else {
                $result .= ("\n" . $value);
                $count = mb_strlen($value, 'utf-8');
            }
        } else {
            $result .= ($count == 0 ? $value : '　' . $value);
            $count += ($count == 0 ? mb_strlen($value, 'utf-8') : 1 + mb_strlen($value, 'utf-8'));
        }
    }
    return $result;
}

/**
 * レコード配列を指定のフィールドをキーにとして
 * 再整理する。
 * 
 * array(array('id'=>1, 'name'=>'abc'), array('id'=>3, 'name'=>'xyz')) => 
 * => array(1 => array('id'=>1, 'name'=>'abc'), 3 => array('id'=>3, 'name'=>'xyz'))
 * 
 * @param array $data
 * @param string $keyField
 * @return array
 */
function g_makeArrayIDKey($data, $idField='id')
{
    $result = array();
    
    foreach ($data as $record) {
        if (!isset($record[$idField])) {
            continue;
        }
        $result[$record[$idField]] = $record;
    }
    
    return $result;
}

/**
 * 配列の要素を取得する。
 * (参照：g_getArrayValue とほぼ同じ)
 * 
 * @param array $array
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function g_getValue($array, $key, $default)
{
    $key = (string) $key;
    if (isset($array[$key])) {
        return $array[$key];
    }
    return $default;
}

/**
 * 住所から都道府県名を抽出する。
 * 
 * @access public
 * @param string $address
 * @param array $prefectureList 都道府県リスト
 * @return string
 */
function g_getPrefFromFullAddr($address, $prefectureList)
{
    $minLen = 3;
    $maxLen = 5;
    $address = str_replace(SPACE_FULL, SPACE_HALF, $address);
    $address = trim($address);
    
    // 頭から3文字のみを取得してリストから探す。（３、４、５文字まで）
    for ($len = $minLen; $len <= $maxLen; $len ++) {
        $prefecture = mb_substr($address, 0, $len, 'utf-8');
        if (in_array($prefecture, $prefectureList)) {
            return $prefecture;
        }
    }
    
    return '';
}

/**
 * 連想（Associated）配列から指定のフィールド値の配列を取得する。
 * 
 * @access public
 * @param array $records
 * @param string $valueField
 * @param string $keyField
 * @return array
 */
function g_fetchOneField($records, $valueField, $keyField='')
{
    $result = array();
    if (empty($keyField)) {
        foreach ($records as $record) {
            $result[] = $record[$valueField];
        }
        $result = array_unique($result);
    } else {
        foreach ($records as $record) {
            $result[$record[$keyField]] = $record[$valueField];
        }
    }
    
    return $result;
}

/**
 * 現在の時間を取得する。
 * 
 * @return float : Unix timestamp
 */
function g_getCurrentTime()
{
    return microtime(true);
}

/**
 * 実行時間を取得する。
 * 
 * @param float $starttime : Unix timestamp
 * @param string $identifier : prefix string to output
 * @return float
 */
function g_getExecutedTime($starttime = 0, $identifier = '')
{
    if (empty($starttime)) {
        $starttime = microtime(true);
    }
    // 現在時間を取得する。
    $endtime = microtime(true);
    // 実行時間を取得する。
    $executedtime = $endtime - $starttime;
    // 出力チェックする。
    if (!empty($identifier)) {
        echo "<br/>{$identifier} Executed Time {$executedtime}s ";
    }
    // 実行時間を返す。
    return $executedtime;
}

/**
 * クループ化された配列を作る。
 * 
 * array(array('project_id'=>10, 'name'=>'abc'), array('project_id'=>10, 'name'=>'xyz')) => 
 * => array(10 => array(array('project_id'=>10, 'name'=>'abc'), array('project_id'=>10, 'name'=>'xyz')))
 * 
 * @param array $data
 * @param string $groupField
 * @return array
 */
function g_makeGroupArray($data, $groupField)
{
    $result = array();
    
    foreach ($data as $record) {
        if (!isset($record[$groupField])) {
            continue;
        }
        $result[$record[$groupField]][] = $record;
    }
    
    return $result;
}

/**
 * SQLのGROUP BY構文と同じに、
 * グループの最初レコードを取得する。
 * 
 * @param array $data
 * @param string $groupField
 * @return array
 */
function g_getGroupBy($data, $groupField)
{
    $result = array();
    
    foreach ($data as $record) {
        if (!isset($record[$groupField])
            || isset($result[$record[$groupField]])
        ) {
            continue;
        }
        $result[$record[$groupField]] = $record;
    }
    
    return $result;
}

/**
 * パラメータ中で空でない最初の値を取得する。
 * 
 * @variant-count params mixed
 * @return mixed | NULL
 */
function g_getFirstValidValue()
{
    $paramCount = func_num_args();
    
    for ($i = 0; $i < $paramCount; $i++) {
        $paramValue = func_get_arg($i);
        if (!empty($paramValue)) {
            // 空でない最初の値を返す。
            return $paramValue;
        }
    }
    
    // 最初の値を取得する。
    if ($paramCount > 0) {
        $paramValue = func_get_arg(0);
        if (isset($paramValue)) {
            return $paramValue;
        }
    }
    
    // NULLを返す。
    return NULL;
}

/**
 * 漢数字を算用（アラビア）数字に変換する。
 * 
 * @param string $kanNumber : 漢数字
 * @return integer : 算用（アラビア）数字
 */
function g_convertToArabic($kanNumber, $charset = 'UTF-8')
{
    $value = 0;
    $oneValue = 0;
    
    $digitKans = array(1 => '一', '二', '三', '四', '五', '六', '七', '八', '九');
    $unitKans = array(1 => '十', 2 => '百', 3 => '千', 4 => '万', 8 => '億', 12 => '兆');
    
    $length = mb_strlen($kanNumber, $charset);
    
    for ($i = 0; $i < $length; $i ++) {
        $bKanji = false;
        $kanji = mb_substr($kanNumber, $i, 1, $charset);
        foreach ($digitKans as $digit => $digitKan) {
            if ($kanji == $digitKan) {
                $oneValue = $digit;
                $bKanji = true;
                break;
            }
        }
        if ($bKanji) {
            continue;
        }
        foreach ($unitKans as $unit => $unitKan) {
            if ($kanji == $unitKan) {
                $oneValue = ($oneValue == 0 ? 1 : $oneValue);
                $value += $oneValue * pow(10, $unit);
                $oneValue = 0;
                $bKanji = true;
                break;
            }
        }
        if (!$bKanji) {
            break;
        }
    }
    
    $value += $oneValue;
    
    return $value;
}

/**
 * 元文字列のn文字を取得する。
 * 長さが小さい場合、ブランク文字を付ける。
 * 
 * @param string $source
 * @param int $length
 * @param string $blank
 * @param string $encoding
 * @return string $result
 */
function g_strncpy($source, $length, $blank, $encoding = 'UTF-8')
{
    $srcLength = mb_strlen($source, $encoding);
    // 元文字列の長さと比較する。
    if ($srcLength > $length) {
        // 元文字列の部分文字列を取得する。
        $result = mb_substr($source, 0, $length, $encoding);
    } else if ($srcLength == $length) {
        // 元文字列を取得する。
        $result = $source;
    } else {
        // ブランク文字を後ろに付ける。
        $result = $source;
        for ($i = $length - $srcLength; $i > 0; $i --) {
            $result .= $blank;
        }
    }
    
    return $result;
}

/**
 * IE8で日本語ファイル名のダウンロード時に文字化けする問題の対応
 * 文字エンコーディング
 * 
 * @param string $filename
 * @return string $result
 */
function g_encodeFileName($filename)
{
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if (strstr($ua, 'MSIE') && !strstr($ua, 'Opera')) {
        // IE（オペラの仮装でない）はSJISにしないと化ける
        $result = mb_convert_encoding($filename, "SJIS", "UTF-8");
    } else {
        $result = $filename;
    }
    return $result;
}

/**
 * 優先度の形のフィールドを作る。
 * = "IF(`accounting_time` > '1900-01-01 00:00:00', `accounting_time`, `deposit_updated`)"
 * 
 * @param string $strField1
 * @param string $strField2
 * @return string
 */
function g_getPriorityFieldSQL($strField1, $strField2) {
    return "IF({$strField1} > '" . EMPTY_DATETIME . "', {$strField1}, {$strField2})";
}


/**
 * 部分文字列を取得する。
 * 
 * @param  string $value
 * @param  int $offset = 0
 * @param  int $maxLen = -1
 * @param  string $suffix = '...'
 * @param  string $encoding = 'UTF-8'
 * @return string
 */
function g_substrMaxN($value, $offset = 0, $maxLen = -1, $suffix = '...', $encoding = 'UTF-8') {
    if ($maxLen < 0) {
        return $value;
    }
    if (mb_strlen($value, $encoding) < $maxLen) {
        return $value;
    }
    return mb_substr($value, $offset, $maxLen, $encoding) . $suffix;
}

/**
 * FX Broker情報からフォロー可能性をチェックする。
 */
function g_checkFollowOfBroker($brokerInfo) {
    $masterData = Zend_Registry::get('master_data');
    if (!empty($brokerInfo['code']) && isset($masterData['allowedFollowBrokers'][$brokerInfo['code']])) {
        return true;
    }
    return false;
}

/**
 * 言語による名前を作る。
 * 
 * @access public
 * @param  string $lastName
 * @param  string $firstName
 * @param  string $language = ''
 * @return string
 */
function g_getDispName($lastName, $firstName, $language = '') {
    if ($language == 'ja') {
        return "{$lastName}　{$firstName}"; // FULL SPACE
    }
    return "{$firstName} {$lastName}"; // HALF SPACE
}

/**
 * 会員情報から言語による名前を作る。
 *
 * @access public
 * @param  string $userInfo
 * @param  string $language = ''
 * @param  mixed $mode = null (null : only kanji, false: only kana, true: kanji and kana) 
 * @param  boolean $multiLine = false
 * @return string
 */
function g_getUserName($userInfo, $language = '', $mode = null, $multiLine = false) {
    $name = '';
    // Objectの場合、Arrayに変換する。
    if (!empty($userInfo) && is_object($userInfo)) {
        $userInfo = (array)$userInfo;
    }
    if ($language == 'ja') {
        if (null === $mode) {
            $name = g_getDispName($userInfo['last_name_kanji'], $userInfo['first_name_kanji'], 'ja');
        } else if (false === $mode) {
            $name = g_getDispName($userInfo['last_name_kana'], $userInfo['first_name_kana'], 'ja');
        } else if ($mode) {
            $name = g_getDispName($userInfo['last_name_kanji'], $userInfo['first_name_kanji'], 'ja');
            if ($multiLine) {
                $name .= '<br/>';
            }
            $name .= sprintf('（%s）', g_getDispName($userInfo['last_name_kana'], $userInfo['first_name_kana'], 'ja'));
        }
    } else {
        $name = g_getDispName($userInfo['last_name_en'], $userInfo['first_name_en']); 
    }
    
    return $name;
}

/**
 * DEBUG情報を取得する。
 * 
 * @param  void
 * @return int
 */
function g_debugInfo() {
    $debugInfos = debug_backtrace();
    foreach ($debugInfos as $debugInfo) {
        echo 'callstack : ', $debugInfo['file'], ':', $debugInfo['line'], '<br/>';
    }
    
    return 0;
}

/**
 * ページ・ナビゲーションを生成する。（管理画面用）
 * 
 * @param array $paginator
 * @return string
 */
function g_AdminPageNavi($paginator, $urlPrefix='?page=') {
    $strPageNavi = '';
    
    if ($paginator->pageCount > 1) {
        ob_start();
        
        // Previous Page
        if (isset($paginator->previous)): ?>
            <li class="prev"><a href="<?php echo($urlPrefix . $paginator->first) ?>"><i class="icon-step-backward"></i></a></li>
            <li class="prev"><a href="<?php echo($urlPrefix . $paginator->previous) ?>"><i class="icon-backward"></i></a></li>
        <?php else: ?>
            <li class="prev disabled"><a href="#"><i class="icon-step-backward"></i></a></li>
            <li class="prev disabled"><a href="#"><i class="icon-backward"></i></a></li>
        <?php
        endif;
        // Page number list
        $i = 0;
        foreach ($paginator->pagesInRange as $page): 
            if ($page != $paginator->current): ?>
                <li><a href="<?php echo($urlPrefix . $page) ?>"><?php echo($page) ?></a></li>
            <?php else: ?>
                <li class="active"><a href="#"><?php echo($page) ?></a></li>
           <?php endif; 
           $i ++;
        endforeach; 
        // Next Page
        if (isset($paginator->next)): ?>
            <li class="next"><a href="<?php echo($urlPrefix . $paginator->next) ?>"><i class="icon-forward"></i></a></li>
            <li class="next"><a href="<?php echo($urlPrefix . $paginator->last) ?>"><i class="icon-step-forward"></i></a></li>
        <?php else: ?>
            <li class="next disabled"><a href="#"><i class="icon-forward"></i></a></li>
            <li class="next disabled"><a href="#"><i class="icon-step-forward"></i></a></li>
        <?php endif;
        
        $strPageNavi = ob_get_clean();
        $strPageNavi = '<div class="pagination pull-right"><ul>' . $strPageNavi . '</ul></div>';
    }
    return $strPageNavi;  
}

/**
 * Output html tag to show sort icon
 * 
 * @param string $curSort
 * @param string $thisSort
 * @param string $sortOrder
 */
function g_AdminSortIcon($curSort, $thisSort, $sortOrder) {
    if ($curSort == $thisSort) {
        echo( $sortOrder == 'DESC' ? '<i class="icon-sort-down"></i>' : 
                                      '<i class="icon-sort-up"></i>');
        return;
    }
    
    echo '<i class="icon-sort"></i>';
}

/**
 * MACRO: Output 'selected' option
 *
 * @param mixed $val1
 * @param string $val2
 * @param boolean $multiple
 */
function g_Selected($val1, $val2, $multiple = false) {
    if ($multiple) {
        if (!empty($val1) && in_array($val2, $val1)) {
            echo 'selected="selected"';
        }
    } else {
        if ($val1 == $val2) {
            echo 'selected="selected"';
        }
    }
}

/**
 * MACRO: Output 'checked' option
 *
 * @param mixed $val1
 * @param string $val2
 * @param boolean $multiple
 */
function g_Checked($val1, $val2, $multiple = false) {
    if ($multiple) {
        if (in_array($val2, $val1)) {
            echo 'checked="checked"';
        }
    } else {
        if ($val1 == $val2) {
            echo 'checked="checked"';
        }
    }
}

/**
 * MACRO: Output formatted error message
 * 
 * @param string $field
 * @param Illuminate\Support\ViewErrorBag $errors
 * @return void
 */
function g_renderError($field, $errors) {
    $errorBag = $errors->getBag('default');
    if (!$errorBag->has($field)) {
        return;
    }
    
    $errorMessages = $errorBag->get($field);
    $cnt = count($errorMessages);
    if ($cnt == 1) {
        echo '<span class="help-block">' . $errorMessages[0] . '</span>';
    } else {
        foreach ($errorMessages as $errorMessage) {
            echo '<span class="help-block">・' . $errorMessage . '</span>';
        }
    }
}

/**
 * N日後のDateを取得する。
 */
function g_getNDaysDate($curDate, $days, $format = '')
{
    $timeStamp = 0;
    if (empty($curDate)) {
        $timeStamp = time();
    } else {
        $timeStamp = strtotime($curDate);
    }
    if (empty($format)) {
        $format = MYSQL_DATETIME;
    }
    // 1h =  24 * 60 * 60s = 86400s
    return date($format, $timeStamp + $days * 86400);
}

/**
 * 同一性をチェックする。
 * 
 * @access public
 * @param  mixed $value1
 * @param  mixed @value
 * @param  boolean $strict = false
 * @param  boolean $caseInsensitive = false
 * @return boolean
 */
function g_checkSameValue($value1, $value2, $strict = false, $caseInsensitive = false) {
    if ($strict) {
        return $value1 === $value2;
    }
    if (empty($value1) && empty($value2)) { 
    } else if (empty($value1) && !empty($value2)) {
        return false;
    } else if (!empty($value1) && empty($value2)) {
        return false;
    }
    if ($caseInsensitive) {
        return strcasecmp($value1, $value2) == 0;
    }
    return $value1 == $value2;
}

/**
 * 2次元配列のフィールドを合計する。
 * 
 * @param  array $records
 * @param  mixed $fields
 * @return mixed
 */
function g_getTotalInfo($records, $fields) {
    if (empty($fields)) {
        return array();
    }
    if (!is_array($fields)) {
        $totalInfo = 0;
        foreach ($records as $record) {
            $totalInfo += !empty($record[$fields]) ? $record[$fields] : 0;
        }
    } else {
        $totalInfo = array();
        if (isset($fields[0]) && $fields[0] == '*') {
            if (!empty($records)) {
                $fields = array_keys(current($records));
            } else {
                $fields = array();
            }
        }
        foreach ($fields as $field) {
            $total = 0;
            foreach ($records as $record) {
                $total += !empty($record[$field]) ? $record[$field] : 0;
            }
            $totalInfo[$field] = $total;
        }
    }
    
    return $totalInfo;
}

/**
 * 日付の形式を変更する。（日本語　->　英語）
 * 
 * Arrayの中、指定の項目だけが対象になる。
 * 
 * @param array $data
 * @param array $fields
 * @param boolean $hasTime = false
 * @return array
 */
function g_changeDateFormat_JA2EN($data, $fields, $hasTime = false) {
    $date = new Zend_Date();
    $formatJA = Zend_Date::YEAR . '/' . Zend_Date::MONTH . '/' . Zend_Date::DAY;
    $formatEN = Zend_Date::DAY . '-' . Zend_Date::MONTH . '-' . Zend_Date::YEAR;
    
    $cnt = count($fields);
    for ($i = 0; $i < $cnt; $i ++) {
        $field = $fields[$i];
        if (empty($data[$field]) || !preg_match('/([0-9]{4}[\/-][0-9]{1,2}[\/-][0-9]{1,2})/', $data[$field])) {
            continue;
        }
        if ($hasTime) {
            $data[$field] = preg_replace('/([0-9]{4})[\/-]([0-9]{1,2})[\/-]([0-9]{1,2})/', '$3-$2-$1', $data[$field]);
        } else {
            $date->set($data[$field], $formatJA);
            $data[$field] = $date->get($formatEN);
        }
    }
        
    return $data;
}

/**
 * 日付の形式を変更する。（英語　->　日本語）
 *
 * Arrayの中、指定の項目だけが対象になる。
 *
 * @param array $data
 * @param array $fields
 * @param boolean $hasTime = false
 * @return array
 */
function g_changeDateFormat_EN2JA($data, $fields, $hasTime = false) {
    $date = new Zend_Date();
    $formatJA = Zend_Date::YEAR . '/' . Zend_Date::MONTH . '/' . Zend_Date::DAY;
    $formatEN = Zend_Date::DAY . '-' . Zend_Date::MONTH . '-' . Zend_Date::YEAR;

    $cnt = count($fields);
    for ($i = 0; $i < $cnt; $i ++) {
        $field = $fields[$i];
        if (empty($data[$field]) || !preg_match('/([0-9]{1,2}[\/-][0-9]{1,2}[\/-][0-9]{4})/', $data[$field])) {
            continue;
        }
        if ($hasTime) {
            $data[$field] = preg_replace('/([0-9]{1,2})[\/-]([0-9]{1,2})[\/-]([0-9]{4})/', '$3/$2/$1', $data[$field]);
        } else {
            $date->set($data[$field], $formatEN);
            $data[$field] = $date->get($formatJA);
        }
    }

    return $data;
}

/**
 * 年月の形式を変更する。（日本語　->　英語）
 *
 * Arrayの中、指定の項目だけが対象になる。
 *
 * @param array $data
 * @param array $fields
 * @return array
 */
function g_changeYearMonthFormat_JA2EN($data, $fields) {
    $date = new Zend_Date();
    $formatJA = Zend_Date::YEAR . '/' . Zend_Date::MONTH;
    $formatEN = Zend_Date::MONTH . '-' . Zend_Date::YEAR;

    $cnt = count($fields);
    for ($i = 0; $i < $cnt; $i ++) {
        $field = $fields[$i];
        if (empty($data[$field]) || !preg_match('/([0-9]{4}[\/-][0-9]{1,2})/', $data[$field])) {
            continue;
        }
        $date->set($data[$field], $formatJA);
        $data[$field] = $date->get($formatEN);
    }

    return $data;
}

/**
 * 年月の形式を変更する。（英語　->　日本語）
 *
 * Arrayの中、指定の項目だけが対象になる。
 *
 * @param array $data
 * @param array $fields
 * @return array
 */
function g_changeYearMonthFormat_EN2JA($data, $fields) {
    $date = new Zend_Date();
    $formatJA = Zend_Date::YEAR . '/' . Zend_Date::MONTH;
    $formatEN = Zend_Date::MONTH . '-' . Zend_Date::YEAR;

    $cnt = count($fields);
    for ($i = 0; $i < $cnt; $i ++) {
        $field = $fields[$i];
        if (empty($data[$field]) || !preg_match('/([0-9]{1,2}[\/-][0-9]{4})/', $data[$field])) {
            continue;
        }
        $date->set($data[$field], $formatEN);
        $data[$field] = $date->get($formatJA);
    }

    return $data;
}

/**
 * Make full path
 * 
 * @param string $basePath
 * @param string $file
 */
function g_makeFullpath($basePath, $file) {
    if (empty($basePath)) {
        return $file;
    }
    $basePath = str_replace(array("/", "\\"), DIRECTORY_SEPARATOR, $basePath);
    return $basePath . (substr($basePath, -1) != DIRECTORY_SEPARATOR ? DIRECTORY_SEPARATOR : '') . $file;
}

/**
 * Date on other zone
 * 
 * @param  string $zone
 * @param  string $format
 * @param  int $time
 * @return string
 */
function g_dateOtherZone($zone, $format, $time) {
    $oldZone = date_default_timezone_get();
    // new zone
    date_default_timezone_set($zone);
    $strDate = date($format, $time);
    // restore zone
    date_default_timezone_set($oldZone);
    return $strDate;
}

function g_trimSpace($str) {
    // 行頭の半角、全角スペースを、空文字に置き換える
    $str = preg_replace('/^[ 　]+/u', '', $str);
    
    // 末尾の半角、全角スペースを、空文字に置き換える
    $str = preg_replace('/[ 　]+$/u', '', $str);
    
    return $str;
}
/* 全角、半角スペースを削除する。 */
function g_removeSpace($str) {
    // 半角、全角スペースを、空文字に置き換える
    return preg_replace('/[ 　]+/u', '', $str);
}
/* 改行文字を削除する。　*/
function g_removeNewline($str) {
    // 半角、全角スペースを、空文字に置き換える
    return preg_replace('/[\r\n]+/u', '', $str);
}
/* 小文字を大文字に置換する。 */
function g_strToUpper($subject, $param = 'zenkaku') {
    // http://www.atmarkit.co.jp/bbs/phpBB/viewtopic.php?topic=25618&forum=26
    // 全角小文字
    $search = $replace = array();
    switch ($param) {
        case 'hankaku':
            // 半角小文字
            $search = Array('ｧ', 'ｨ', 'ｩ', 'ｪ', 'ｫ', 'ヵ', 'ヶ', 'ｯ', 'ｬ', 'ｭ', 'ｮ', 'ﾜ');
            $replace = Array('ｱ', 'ｲ', 'ｳ', 'ｴ', 'ｵ', 'ｶ', 'ｹ', 'ﾂ', 'ﾔ', 'ﾕ', 'ﾖ', 'ﾜ');
            break;
        case 'zenkaku':
            $search = Array('ァ', 'ィ', 'ゥ', 'ェ', 'ォ', 'ヵ', 'ヶ', 'ッ', 'ャ', 'ュ', 'ョ', 'ヮ');
            $replace = Array('ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'ケ', 'ツ', 'ヤ', 'ユ', 'ヨ', 'ワ');
            break;
    }
    return strtoupper(str_replace($search, $replace, $subject));
}