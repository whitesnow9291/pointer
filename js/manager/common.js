/**
 * Common functions
 * 2015/06/01
 * 
 * @author KHU
 */

$(function() {
	// Check all
	$('table th input:checkbox').on('click' , function(){
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox')
		.each(function(){
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
			
	});
	
    // 検索条件：クリアボタンの動作
    $("#condition-reset").click(function() {
        clearForm("#condition-form");
    });
    
    // 一括削除ボタンの動作
    $(".delete-multiple").click(function() {
    	deleteRecords("#list-form", "?delete");
    });

    // ステータスの切り替えボタンの動作
    $(".exchange-multiple").click(function() {
    	exchangeStatus("#list-form", "?exchange");
    });

    // エラーの入力欄に"error"クラスを適用する。
    if ($("form#input-form").length > 0) {
        $("form#input-form .help-block").parents(".control-group").addClass("error");
        //$("form#input-form .help-inline").parents(".control-group").addClass("error");
    }

    // 現在のページに当たるメニューをHIGHLIGHTする。
    if (typeof CUR_MENU_NO === "undefined" || CUR_MENU_NO == undefined || CUR_MENU_NO == "") {
        CUR_MENU_NO = 0;
    } else {
        CUR_MENU_NO = parseInt(CUR_MENU_NO);
    }
    if (CUR_MENU_NO > 0) {
        var menuObj = $("ul.nav-list > li:nth-child(" + CUR_MENU_NO + ")");
        if (menuObj.length > 0) {
            menuObj.addClass("active"); // .addClass("open")
        }
    }
});

/**
 * フォームに属する全ての項目を空欄にする。
 * 
 * @param string selector
 * @return void
 */
function clearForm(selector) {
    var frmObj = $("form" + selector);
    if (frmObj.length == 0) {
        return;
    }
    
    $("input[type=text]", frmObj).val("");
    $("select option", frmObj).removeAttr("selected");
    $("input[type=checkbox]", frmObj).removeAttr("checked");
    $("input[type=radio]", frmObj).removeAttr("checked");
    // uniform checkbox
    $(".checker > .checked", frmObj).removeClass("checked");
    // checker group
    $(".checker-group input[type=checkbox]", frmObj).attr("checked", "checked");
    $(".checker-group .checker > span", frmObj).addClass("checked");
}

/**
 * フォームをsubmitする。
 *
 * @param string formSelector
 * @param string uri
 * @param array params
 * @return void
 */
function submitForm(formSelector, uri) {
    if (uri != undefined) {
        $('form'+formSelector).attr('action', uri);
    }
    $('form'+formSelector).submit();
}

/**
 * 一覧画面でチェックされてある項目があるかどうかをチェックする。
 *
 * @param string formSelector
 * @return boolean
 */
function hasChecked(formSelector) {
	if (formSelector && formSelector.length > 0) {
		return $("form" + formSelector + " table tr > td:first-child input[type='checkbox']:checked").length > 0;
	}
    return $("table tr > td:first-child input[type='checkbox']:checked").length > 0;
}

/**
 * リスト画面で選択されてある項目を削除する。
 *
 * @param string formSelector
 * @param string uri
 * @return
 */
function deleteRecords(formSelector, uri) {
    if (!hasChecked()) {
        alert(MSG_COMMON_DEL_NOSELECT);
        return false;
    }

    if (confirm(MSG_COMMON_DEL_CONFIRM) == false)
        return false;
    // set submit method as DELETE, and submit form 
    $("form" + formSelector + " input[name='_method']").val("DELETE");
    submitForm(formSelector, uri);
    return true;
}

/**
 * リスト画面で選択されてある項目の状態を切り替える。
 *
 * @param string formSelector
 * @param string uri
 * @return
 */
function exchangeStatus(formSelector, uri) {
    if (!hasChecked()) {
        alert(MSG_COMMON_EXCHANGE_NOSELECT);
        return false;
    }

    /*if (confirm(MSG_COMMON_EXCHANGE_CONFIRM) == false)
        return false;*/

    // set submit method as EXCHANGE, and submit form
    $("form" + formSelector + " input[name='_method']").val("EXCHANGE");
    submitForm(formSelector, uri);
    return true;
}