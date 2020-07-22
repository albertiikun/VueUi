<h1> <?php echo e($user->name); ?> <?php echo e($user->email); ?> </h1>
<a href="http://localhost:8080/reset?token=<?php echo e($token); ?>&email=<?php echo e($user->email); ?>">link</a>
<?php /**PATH C:\laragon\www\Authentication\core\container\port\src\resources\views/ForgotPassword-Email.blade.php ENDPATH**/ ?>