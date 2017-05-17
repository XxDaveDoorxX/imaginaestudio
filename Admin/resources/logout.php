<?php
session_name("sadmin");
session_start();
session_destroy();
if (!(isset($_REQUEST['privado'])))
{
    header('Location: ../.');
}
else
    header('Location: ../.');