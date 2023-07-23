<?php

namespace MyApp\src;

class Application{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Database $db;

    public function __construct($rootPath, array $config)
    {
        self::$app=$this;
        self::$ROOT_DIR=$rootPath;
        $this->request=new Request();
        $this->response=new Response();
        $this->router=new Router( $this->request,$this->response);
        $this->db= new Database($config['db']);


    }

    public function run()
    {
      echo $this->router->resolve();

    }

}