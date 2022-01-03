<?php

class ObGetAppend
{
    const HTML_TOAST = '<div class="position-fixed p-3" id="toast" style="bottom:0;left:0;z-index:1051;"></div>';
    public static function append()
    {
        global $csrf_token;
        $out = ob_get_contents();
        ob_clean();
        $str = self::HTML_TOAST;
        $str .= stackJS::execute();
        $str .= '<script>window.csrf_token = "' . $csrf_token . '";</script>';
        $out = str_replace('</body>', $str . '</body>', $out);
        echo $out;
    }

    public static function appendHtml($str) {
        $out = ob_get_contents();
        ob_clean();
        $out = str_replace('</body>', $str . '</body>', $out);
        echo $out;
    }
}
