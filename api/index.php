<?php

require 'vendor/autoload.php';

include 'config/env.php';

include 'app/Database.php';

include 'app/Controllers/AuthController.php';
include 'app/Controllers/UserController.php';

include 'app/Middleware/AuthMiddleware.php';

include 'app/Repositories/UserRepository.php';
include 'app/Repositories/ProfileRepository.php';

include 'app/Services/AuthService.php';
include 'app/Services/UserService.php';

require 'public/routes.php';
