<?php
/**
 *
 * 图片懒加载 
 *
 * @package LazyLoading 
 * @author LittleJake
 * @version 1.0.0
 * @site https://blog.littlejake.tk
 */
class LazyLoading_Plugin implements Typecho_Plugin_Interface {
     /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}

    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){

    }

    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render() {
        
    }

    /**
     *添加js
     *@return void
     */
    public static function footer() {
            echo <<<HTML
<script type="text/javascript">
    

    //offsetTop是元素与offsetParent的距离，循环获取直到页面顶部
    function getTop(e) {
        var T = e.offsetTop;
        while(e = e.offsetParent) {
            T += e.offsetTop;
        }
        return T;
    }

    function lazyLoad() {
		var imgs = document.querySelectorAll('img');
        var H = window.innerHeight;
        var S = document.documentElement.scrollTop || document.body.scrollTop;
        for (var i = 0; i < imgs.length; i++) {
			if(H + S > getTop(imgs[i])) {
				if(imgs[i].getAttribute('data-src')) {
					imgs[i].src = imgs[i].getAttribute('data-src');
					imgs[i].setAttribute('data-src', '');
				}
			}
			
			if(!imgs[i].src)
				imgs[i].src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAABkAQMAAAD5SO1IAAAABlBMVEUAAAAzMzPI8eYgAAAAAXRSTlMAQObYZgAAAWNJREFUSMft1D9qwzAUBvBnVFAGY3XMIKwrBLoYKuIrafQQGhsN6RDIDXqU4qLBlwjFR0g2DyLqUxuI/1JClw7+3vDAP2x/9iCYM+eaEAdgBRDkQPK2xDgAGQAph0KhHpdwUmBSHrxQlEQXoNoSbd0lEyUpndGF7TTwktbkw5mdvgy6KUVMZQ6UDuSkSKXNOxuKa0hVGMtcPiaBacbkjOLvgb7URKN8RjBsQLCyObChqKdKa7PbkZsI9y3bs9P4pZW7CXNvXtKTC5zRpiXUhSgrVr5AZorcwpw5/yzhz+LLgcRXkffIr0+DEQlK8kr44rEmi57QE7PsyJ8bduwJa4QVVqa4ehJLucFZ4+qJ5JnMpPSrJ0mcccVRFO9LpLwkd0k8JTL2DVASySPaFo6XEi9ysxYsb507wqY4KMJ2hLmD/wde2LEj1JGa7ul+mXDg/j2j4TCRlZwSmU1J2kyJqGHO3/IF+uyqnXXz3R4AAAAASUVORK5CYII="
		}
            
    }

    window.onscroll = function () {
        lazyLoad();
    }
		
	lazyLoad();
</script>

HTML;

    }
}
