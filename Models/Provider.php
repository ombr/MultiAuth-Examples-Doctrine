<?php
namespace Models;
/**
 * @Entity
 */
class Provider{
	/**
	 * The id for all the entities.
	 * @Id
	 * @Column(type="integer")
	 * @generatedValue
	 */
    private $id;


    /**
	 * @Column(type="string")
     */
    private $providerId;

    /**
	 * @Column(type="string")
     */
    private $userId;

    /**
	 * @Column(type="string")
     */
    private $datas;


    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
        return $this;
    }

    public function getProviderId(){
        return $this->providerId;
    }
    public function setProviderId($providerId){
        $this->providerId=$providerId;
        return $this;
    }
    public function getUserId(){
        return $this->userId;
    }
    public function setUserId($userId){
        $this->userId=$userId;
        return $this;
    }
    public function getDatas(){
        return $this->datas;
    }
    public function setDatas($datas){
        $this->datas=$datas;
        return $this;
    }

}
?>
