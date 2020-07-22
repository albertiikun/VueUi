<h1>HI <?php echo e($user->name); ?> <?php echo e($user->lastName); ?></h1>
<h1>ip Address <?php echo e($ip); ?></h1>
<h1> Somebody just logged in on our platform via <?php if($client != null): ?><?php echo e($client['type']); ?> <?php echo e($client['name']); ?><?php else: ?> Unknown <?php endif; ?></h1>

<h1><?php if($os != null): ?> <?php echo e($os['name']); ?> <?php echo e($os['version']); ?> <?php echo e($os['platform']); ?><?php endif; ?></h1>
<?php if($ipInfo != null): ?>
<h1><?php echo e($ipInfo['iso_code']); ?></h1>
<h1><?php echo e($ipInfo['city']); ?><h1>
<h1><?php echo e($ipInfo['city']); ?><h1>
<?php endif; ?><?php /**PATH D:\Projects\Php\OnionArch\passport\core\container\port\src\resources\views/LoggedIn.blade.php ENDPATH**/ ?>