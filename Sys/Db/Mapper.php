<?php
class Sys_Db_Mapper
{
    private $user;
    private $pass;
    private $base;
    private $host;
    private $port;

    public function __construct($user,$pass,$base,$host,$port=3306)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->base = $base;
        $this->host = $host;
        $this->port = $port;
    }

    public function Map($query, $obj)
    {
        try 
        {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->base", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare($query);
            $mode = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $exec = $stmt->execute();
            
            $result = array();

            while($data = $stmt->fetch())
            {
                $result[] = $this->MapItem($data,$obj);
            }
            
            $conn = null;

            return $result;
        }
        catch(PDOException $e)
        {
            $conn = null;
            throw $e;
        }
    }

    private function MapItem($data, $object)
    {
        $item = new $object;
        $reflector = new ReflectionClass($object);
        
        foreach($reflector->getProperties() as $prop)
        {
            $item->{$prop->name} = $data[$prop->name];
        }

        return $item;
    }

    public function UnMap($query,$object)
    {
        try 
        {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->base", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare($query);
            
            $stmt = $this->UnMapItem($stmt,$object);
            
            $stmt->execute();

            $conn = null;

            //return $result;
        }
        catch(PDOException $e)
        {
            $conn = null;
            throw $e;
        }
    }

    private function UnMapItem($stmt, $object)
    {
        $reflector = new ReflectionClass(get_class($object));
        
        foreach($reflector->getProperties() as $prop)
        {
            if (strpos($stmt->queryString,":".$prop->name)>0)
                $stmt->bindValue(":".$prop->name, $object->{$prop->name});
        }

        return $stmt;
    }
}