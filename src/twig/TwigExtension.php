<?php namespace src\twig;

use Slim\Slim;

class TwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'slim-framework-skeleton';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('assetUrl', array($this, 'assetUrl')),
        );
    }

    public function assetUrl($file, $appName = 'default')
    {
        $req = Slim::getInstance($appName)->request();
        $uri = $req->getUrl() . $req->getRootUri();

        if ($file[0] === '/') {
            return $uri . $file;
        }

        return $uri . '/' . $file;
    }
}
