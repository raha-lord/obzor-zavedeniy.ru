<?php


class Router
{
    private $routes;
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include ($routesPath);
    }

    /**
     * Returns request string
     * @return string
    **/
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    public function run()
    {
        //Полуить строку запроса
        $uri = $this->getURI();
        //Проверить наличие запроса в списке
        foreach ($this->routes as $uriPattern => $patch)
        {
            if (preg_match("~$uriPattern~",$uri))
            {
                $internalRouts = preg_replace("~$uriPattern~",$patch,$uri);
                $segments = explode('/',$internalRouts);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;

                //Подключаем файл класса котроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile))
                {
                    include_once ($controllerFile);
                }
                //echo $controllerName;
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
                if ($result==NULL)
                {
                    Errors::getNotFoundError();
                }

                if ($result != null)
                    break;
            }
        }
    }

}