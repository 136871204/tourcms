/**
 * PlaceHolder���
 * $(input).placeholder({
 *   word:     // @string ��ʾ�ı�
 *   color:    // @string �ı���ɫ
 *   evtType:  // @string focus|keydown ����placeholder���¼�����
 * })
 *
 */
$.fn.placeholder = function(option, callback) {
    var settings = $.extend({
        word: '',
        color: '#ccc',
        evtType: 'focus'
    }, option)
 
    function bootstrap($that) {
        // some alias 
        var word    = settings.word
        var color   = settings.color
        var evtType = settings.evtType
 
        // default
        var defColor = $that.css('color')
        var defVal   = $that.val()
 
        if (defVal == '' || defVal == word) {
            $that.css({color: color}).val(word)
        } else {
            $that.css({color: defColor})
        }
 
        function switchStatus(isDef) {
            if (isDef) {
                $that.val('').css({color: defColor})    
            } else {
                $that.val(word).css({color: color})
            }
        }
        function asFocus() {
            $that.bind(evtType, function() {
                var txt = $that.val()
                if (txt == word) {
                    switchStatus(true)
                }
            }).bind('blur', function() {
                var txt = $that.val()
                if (txt == '') {
                    switchStatus(false)
                }
            })
        }
        function asKeydown() {
            $that.bind('focus', function() {
                var elem = $that[0]
                var val  = $that.val()
                if (val == word) {
                    setTimeout(function() {
                        // ��궨λ����λ
                        $that.setCursorPosition({index: 0})
                    }, 10)                  
                }
            })
        }
 
        if (evtType == 'focus') {
            asFocus()
        } else if (evtType == 'keydown') {
            asKeydown()
        }
 
        // keydown�¼��ﴦ��placeholder
        $that.keydown(function() {
            var val = $that.val()
            if (val == word) {
                switchStatus(true)
            }
        }).keyup(function() {
            var val = $that.val()
            if (val == '') {
                switchStatus(false)
                $that.setCursorPosition({index: 0})
            }
        })
    }
 
    return this.each(function() {
        var $elem = $(this)
        bootstrap($elem)
        if ($.isFunction(callback)) callback($elem)
    })
}