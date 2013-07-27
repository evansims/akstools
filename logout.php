<? $pageid='logout'; include('settings.php'); include('phpheader.php'); include('header.php'); ?>

<p>You have been logged out - <a href='index.php'>click here</a> to return to the main page.</p>
<? $user->logout(); ?>

<? include('footer.php');?>