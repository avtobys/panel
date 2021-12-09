<?php

class stackJS
{
    /**
     * add js code to execute from timeout stack
     * @param string $code
     * @param integer $timeout
     */
    public static function add($code, $timeout = 0)
    {
        $_SESSION['stackJS'] = empty($_SESSION['stackJS']) ? [] : $_SESSION['stackJS'];
        $_SESSION['stackJS'][] = [
            'code' => $code,
            'timeout' => $timeout,
            'timestamp' => time()
        ];
    }

    /** @return string js code to execute */
    public static function execute()
    {
        if (empty($_SESSION['stackJS'])) {
            return '';
        }
        $code = '';
        foreach ($_SESSION['stackJS'] as $key => $value) {
            if ($value['timestamp'] + $value['timeout'] <= time()) {
                $code .= $value['code'];
                unset($_SESSION['stackJS'][$key]);
            }
        }
        return $code ? "<script>$code</script>" : "";
    }
}
