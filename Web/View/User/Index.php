<h1>User</h1>
<?php
/** @var Web_Model_User $user **/ 
foreach($viewData as $user):
?>

<div>
    <span>UserID: <?=$user->id?></span>
    <span>First: <?=$user->firstname?></span>
    <span>Last: <?=$user->lastname?></span>
    <span>Created: <?=$user->created?></span>
</div>

<?php endforeach;?>

