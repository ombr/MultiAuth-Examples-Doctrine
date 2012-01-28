<?php
namespace Models;

use \Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
/**
 * @Entity
 */
class User implements \MultiAuth\User{

	/**
	 * The id for all the entities.
	 * @Id
	 * @Column(type="integer")
	 * @generatedValue
	 */
    private $id;

    /**
     * @ManyToMany(targetEntity="\Models\Provider")
     */
    private $providers;

    public function __construct(){
        $this->providers = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }
    public function setId($Id){
        $this->Id=$Id;
        return $this;
    }
    public function addProvider($provider){
        $this->providers[] = $provider;
    }

    public function getProviders(){
        return $this->providers;
    }
    /*
     * @deprecated
     */
    public function setProviders($providers){
        $this->providers=$providers;
        return $this;
    }
    
}
?>
