/**
 * Created by xiaopeng.cai on 14-6-27.
 * 页面导航 rtx名
 */
$(function () {
    $.ajax({
        type: "GET",
        async: false,
        dataType: "json",
        url: "/login/name.do",
        success: function (json) {
            var str = "";
            if (json.status == 0) {
                str = json.data;
                $("#welName").html(str);
            } else {
                str = json.message;
                bootbox.dialog({
                        message: str,
                        buttons: {
                            confirm: {
                                label: "取消",
                                className: "btn-primary btn-sm"
                            }
                        }
                    }
                );
            }
        },
        error: function (data) {
            bootbox.dialog({
                    message: data.message,
                    buttons: {
                        confirm: {
                            label: "取消",
                            className: "btn-primary btn-sm"
                        }
                    }
                }
            );
        }
    });
});

Date.prototype.Format = function(fmt)
{ //author: meizz
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt))
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
        if(new RegExp("("+ k +")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
}