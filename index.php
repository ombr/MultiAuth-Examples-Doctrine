<?php
require_once 'bootstrap.php';

$authentification = new MultiAuth\MultiAuth(
    array(
        'hybridAuth'=>$hybridAuthConfigs,
        'accountsFromProviderIdFunction'=>
        function($providerId,$userId){
            $query = App::getEm()->createQuery('SELECT u
                FROM \Models\User u LEFT JOIN u.providers p 
                WHERE p.providerId = :providerId
                AND p.userId = :userId');
            $query->setParameters(array(
                'providerId' => $providerId,
                'userId' => $userId,
            ));
            $array = $query->getResult();
            return $array;
        },
            'getAccountFunction'=>
            function($id){
                if( isset( $id ) ){
                    return App::getEm()->find('\Models\User',$id);
                }
                return null;
            },
            'createAccountFunction'=>
            function($test = null){
                $user = new \Models\User();
                $em = App::getEm();
                $em->persist($user);
                $em->flush();
                return $user;
            },
                'addProviderToAccount'=>
                function($account, $providerId, $userId, $datas){
                    $provider = new \Models\Provider();
                    $provider->setProviderId($providerId);
                    $provider->setDatas($datas);
                    $provider->setUserId($userId);
                    $em = App::getEm();
                    $em->persist($provider);
                    $account->addProvider($provider);
                    $em->flush();
                    return $user;
                },
                )
            );
if(isset($_GET['logout'])){
    $authentification->logout();
}
//var_dump($_SESSION);
$user = $authentification->login();
echo '<br>';
echo "You are logged in ".$user->getId().' !';
echo '<br>';
foreach($authentification->getAccounts() as $a){
    echo $a->getId().' and ';
}
echo '<br>';
echo '<br>';
echo '<br>';
foreach($user->getProviders() as $p){
    $hybridAuthProvider = $authentification->getHybridAuthProvider(
        $p->getProviderId(),
        $p->getDatas()
    );
    echo $p->getProviderId().'<br>';
    try{
        var_dump($hybridAuthProvider->getUserProfile());
    }catch(Exception $e){
        echo "Une erreur est survenue !!";
    }
    echo '<br><br>';
}
echo '<br>';
echo '<br>';
echo '<br>';
echo "PRIVATE PART :-D";
echo "Want to add a way to loggin :";
$authentification->loginPage();
?>
