<?php
function __bootstrap()
{
    error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
    chdir(dirname(__file__). '/../../');
    $pwd = getcwd();
    $dirs = array(
        $pwd.DIRECTORY_SEPARATOR.'src',
        $pwd.DIRECTORY_SEPARATOR.'tests',
    );
    $path = implode(PATH_SEPARATOR, $dirs);
    set_include_path($path.PATH_SEPARATOR.get_include_path());

    require_once 'PHPUnit/Framework.php';
    require_once 'PHPUnitHelper/MockAmendingTestCaseBase.php';
    spl_autoload_register(array(new Autoloader, 'loadClass'));

}


class Autoloader
{
    public function loadClass($className)
    {
        $old = getcwd();
        chdir(dirname(__file__). '/../../');
        $dirs = explode(PATH_SEPARATOR, get_include_path());
        foreach ($dirs as $dir) {
            $file = $dir.DIRECTORY_SEPARATOR.$className.'.php';
            if (true === file_exists($file)) {
                require_once($className.'.php');
                chdir($old);
                return true;
            }
        }
        chdir($old);
        return false;
    }
}

__bootstrap();
?>