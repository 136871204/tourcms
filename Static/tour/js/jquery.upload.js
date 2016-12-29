/**
 * Created by Administrator on 14-8-4.
 */

(function($) {
    var noop = function(){ return true; };
    var frameCount = 0;

    $.uploadDefault = {
        url: '',
        fileName: 'filedata',
        dataType: 'json',
        fileType: '*',
        params: {},
        onSend: noop,
        onSubmit: noop,
        onComplate: noop
    };

    $.upload = function(options) {
        var opts = $.extend(jQuery.uploadDefault, options);
        if (opts.url == '') {
            return;
        }

        var canSend = opts.onSend();
        if (!canSend) {
            return;
        }

        var frameName = 'upload_frame_' + (frameCount++);
        var iframe = $('<iframe style="position:absolute;top:-9999px" />').attr('name', frameName);
        var form = $('<form method="post" style="display:none;" enctype="multipart/form-data" />').attr('name', 'form_' + frameName);
        form.attr("target", frameName).attr('action', opts.url);

        // form中增加数据域
        var formHtml = '<input type="file" name="' + opts.fileName + '" onchange="onChooseFile(this,\''+opts.fileType+'\')">';
        for (key in opts.params) {
            formHtml += '<input type="hidden" name="' + key + '" value="' + opts.params[key] + '">';
        }
        form.append(formHtml);

        iframe.appendTo("body");
        form.appendTo("body");

        form.submit(opts.onSubmit);

        // iframe 在提交完成之后
        iframe.load(function() {
            var contents = $(this).contents().get(0);
            var data = $(contents).find('body').text();
            if ('json' == opts.dataType) {
                //data = window.eval('(' + data + ')');
            }
            opts.onComplate(data);
            setTimeout(function() {
                iframe.remove();
                form.remove();
            }, 5000);
        });

        // 文件框
        var fileInput = $('input[type=file][name=' + opts.fileName + ']', form);
        fileInput.click();
    };
})(jQuery);

// 选中文件, 提交表单(开始上传)
var onChooseFile = function(fileInputDOM,fileType) {
    var flag = checkFileType(fileInputDOM,fileType);
    if(flag){
        var form = $(fileInputDOM).parent();
        form.submit();
    }

};

var checkFileType = function(fileInputDOM,fileType)
{
    var ext = fileInputDOM.value.substring(fileInputDOM.value.lastIndexOf(".")+1);

    if(ext!='')
    {
        if(fileType!='*')
        {
            var arr = fileType.split(',');

            if($.inArray(ext,arr)==-1){

                ST.Util.showMsg('文件类型不正确,请上传'+fileType+'格式的文件',5,1000);
                fileInputDOM.value ='';
                return false;

            }
        }

    }

    return true;

}
