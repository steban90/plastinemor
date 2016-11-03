<?php

#================ cnm.php :: CHECK FOR NEW MESSAGES
# This file is to update the .tag in plasti.php
# the idea is to check for new messages, if there are, check if the
# chat window is NOT open then add N new messages to .tag

require_once '../../config.php';

$msgAdmin = new MessagesHandler();

$assoc_count = $msgAdmin->getCountMessagesByClient();

echo json_encode($assoc_count);        