$(function () {
    function face(x) {
        var faceText = null;
        switch (x) {
            case 1:
                faceText = '[/微笑]';
                break;
            case 2:
                faceText = '[/难过]';
                break;
            case 3:
                faceText = '[/开心]';
                break;
            case 4:
                faceText = '[/眨眼]';
                break;
            case 5:
                faceText = '[/流泪]';
                break;
            case 6:
                faceText = '[/调皮]';
                break;
            case 7:
                faceText = '[/生气]';
                break;
            case 8:
                faceText = '[/哈欠]';
                break;
            case 9:
                faceText = '[/幸福]';
                break;
            case 10:
                faceText = '[/色]';
                break;
            case 11:
                faceText = '[/撇嘴]';
                break;
            case 12:
                faceText = '[/酷]';
                break;
        }
        return faceText;
    }

    //comment images model box
    var promptDialogBox = $(".prompt-dialog-box");
    var commentFaSmileO=$(".comment-fa-smile-o");
    var dialogContentli = $(".dialog-content>li");
    commentFaSmileO.click(function (e) {
        var x = e.pageX;
        var y = e.pageY;

        promptDialogBox.toggle().css({
            "margin-left": x/1.45
        });
        $("content").click(function () {
            promptDialogBox.hide();
        })
    });

    dialogContentli.click(function () {
        var v_id = $(this).attr('class');
        var faceText = null;
        for (var i = 1; i <= 12; i++) {
            if ('face_' + i == v_id) {
                break;
            }
        }

        promptDialogBox.hide();
        $("#comment-textarea").append(face(i));
    });

    //reply images model box
    var replyPromptDialogBox = $(".reply-prompt-dialog-box");
    var replyDialogContentli = $(".reply-dialog-content>li");
    $(".reply-fa-smile-o").click(function (e) {
        var replyX = e.pageX;
        var replyY = e.pageY;

        replyPromptDialogBox.toggle().css({
            "margin-left": replyX/1.6
        });
    });
    replyDialogContentli.click(function () {
        var replyV_id = $(this).attr('class');
        for (var i = 1; i <= 12; i++) {
            if ('face_' + i == replyV_id) {
                break;
            }
        }
        replyPromptDialogBox.hide();
        $("#reply-textarea").append(face(i));
    });

    //reply btn click
    var replyBtn = $(".reply-btn");

    replyBtn.click(function () {
        $(".reply-prompt-dialog-box").hide();
        var commentListLi = $(this).parent().parent().parent();
        var commnetReply = $("#reply");
        commnetReply.css({
            "display":"block",
            "animation": "replayAnimation 0.3s linear normal"
        });
        commentListLi.after(commnetReply);
    });

    //upload comment images file
    $(".comment-fa-image").click(function () {
        $("#comment-fa-image").click();
    });

    $(".reply-fa-image").click(function () {
        $("#reply-fa-image").click();
    });


});