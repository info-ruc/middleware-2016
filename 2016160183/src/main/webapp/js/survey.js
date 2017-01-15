/**
 * @version : 1.0.0
 * @author : weishen.xie
 * @since : 15-2-11 下午8:51
 */

function openDialog(submitType) {
    $("#add-monitor-window").removeClass('hide').dialog({
        width: 830,
        height: "auto",
        resizable: false,
        modal: true,
        autoOpen: false,
        show: "fold",
        hide: "slide",
        buttons: [
            {
                html: "<i class='ace-icon fa fa-check bigger-110'></i> 保存",
                class: "btn btn-info",
                click: function () {
                    doSubmit(submitType);
                }
            },
            {
                html: "<i class='ace-icon fa fa-times bigger-110'></i> 取消",
                class: "btn",
                type: "reset",
                click: function () {
                    $(this).dialog("close");

                }
            }
        ],
        close: function () {
            parent.location.reload();
        }
    });
    $(function () {
        if (submitType == "update") {
            $("#dialog-title").text($("#dialog-title").text().replace("新增", "修改"));
        }
        $("#add-monitor-window").dialog("open");
    });
}

function openUpdatePage(id) {
    $.ajax({
        type: "post",
        async: false,
        url: "/survey/doSurvey.do",
        data: {
            "id": id
        },
        success: function (json) {
            if (json.status == 0) {
                var monitor = $.parseJSON(json.data);
                openDialog("update");
            } else {
                bootbox.dialog({
                        message: json.message,
                        buttons: {
                            danger: {
                                label: "确认",
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
                        danger: {
                            label: "确认",
                            className: "btn-primary btn-sm"
                        }
                    }
                }
            );
        }
    })
}

function deleteConfig(id) {
    bootbox.confirm("确定要删除该投票？", function (result) {
        if (result == true) {
            $.ajax({
                type: "post",
                async: false,
                url: "/survey/deleteSurvey.do",
                data: {
                    "id": id
                },
                success: function (json) {
                    var str = "";
                    if (json.status == 0) {
                        str = json.data;
                    } else {
                        str = json.message;
                    }
                    bootbox.dialog({
                            message: str,
                            buttons: {
                                danger: {
                                    label: "确认",
                                    className: "btn-primary btn-sm",
                                    callback: window.location.reload()
                                }
                            }
                        }
                    );
                },
                error: function (data) {
                    bootbox.dialog({
                            message: data.message,
                            buttons: {
                                danger: {
                                    label: "确认",
                                    className: "btn-primary btn-sm",
                                    callback: window.location.reload()
                                }
                            }
                        }
                    );
                }
            })
        } else {
            return;
        }
    })
}

function doSubmit(submitType) {
    var id = $("#form-field-id").val();
    var title = $("#form-field-title").val();
    var mode = $("#form-field-mode").val();
    var endTime = new Date($("#form-field-end-time").val());
    var createTime = new Date();

    if (title == null || title == "") {
        alert("标题不能为空");
        $("#form-field-title").focus();
        return;
    }

    if (mode == null || mode == "") {
        alert("投票模式不能为空");
        $("#form-field-mode").focus();
        return;
    }

    if (endTime == null || endTime == "") {
        alert("截止时间不能为空");
        $("#form-field-endTime").focus();
        return;
    }

    // 根据提交类型变更弹出层
    var postUrl = "/survey/addSurvey.do";
    if (submitType == "add") {
    }

    $.ajax({
        type: "post",
        async: false,
        url: postUrl,
        data: {
            "id": id, "topic": title,
            "mode": mode, "endTime": endTime,
            "createTime": createTime
        },
        success: function (json) {
            var str = json;

            bootbox.dialog({
                    message: str,
                    buttons: {
                        confirm: {
                            label: "确认",
                            className: "btn-primary btn-sm",

                            callback: function () {
                                $("#add-monitor-window").dialog("close");
                            }
                        }
                    }
                }
            );
        },
        error: function (data) {
            bootbox.dialog({
                    message: data.message,
                    buttons: {
                        danger: {
                            label: "确认",
                            className: "btn-primary btn-sm"
                        }
                    }
                }
            );
        }
    })
}

