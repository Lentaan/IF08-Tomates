<?php

define("ROOT_DIR", dirname(__DIR__,1), 0);
const BASE_URL = 'http://local.projetlo07.fr/public/';
const CONTROLLER_DIR = ROOT_DIR.'/app/controller/';
const MODEL_DIR = ROOT_DIR.'/app/model/';
const VIEW_DIR = ROOT_DIR.'/app/view/';

include_once '../app/router/router.php';