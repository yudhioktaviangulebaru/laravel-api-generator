# Laravel API Generator

a simple artisan command to generate all things you need 

### Install 
```composer require yudhi/apigen:dev-master```

### Configuration
- Open ```config/apigen.php``` file 
- Change value ```"abstractControllerName" => Controller::class``` to ```"abstractControllerName" => "App\\Http\\Controllers\\Controller"```

### Artisan Command Table

| Command                                              | Description |
|------------------------------------------------------| --- |
| `php artisan apigen:make <module_name>`              | Generate all things you need for API |

### Generated File
You can check your generate file on ```<root>/App/Core/<your_module_name>```

