# Context7 Retrieved Documentation Log

## ROUTING_MIDDLEWARE (Library: /laravel/laravel)
Query: Route middleware group prefix

### Group Routes

Source: https://github.com/laravel/laravel/blob/13.x/_autodocs/api-reference/routing.md

Applies shared middleware or prefixes to a collection of routes.

```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show']);
    Route::get('/profile', [ProfileController::class, 'show']);
});

Route::prefix('api')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Protected routes here
});
```

--------------------------------

### Define Middleware Types

Source: https://github.com/laravel/laravel/blob/13.x/_autodocs/api-reference/routing.md

Examples of registering global middleware, aliasing route middleware, and defining middleware groups.

```php
// Global middleware (runs on all requests)
$middleware->append(LogActivity::class);

// Route middleware (applied to specific routes)
$middleware->alias([
    'verified' => VerifyEmailAddress::class,
    'admin' => IsAdmin::class,
]);

// Middleware groups
$middleware->group('api', [
    'throttle:api',
    'auth:sanctum',
]);
```

### Routing API Reference > Route Groups

Source: https://github.com/laravel/laravel/blob/13.x/_autodocs/api-reference/routing.md

Route groups enable the application of shared configuration, such as middleware or URL prefixes, to a collection of routes. This simplifies the management of protected routes or API-specific endpoints by grouping them logically.

--------------------------------

### Middleware > Middleware Configuration

Source: https://github.com/laravel/laravel/blob/13.x/_autodocs/api-reference/routing.md

Middleware acts as a layer that processes incoming requests before they reach their designated route handlers. It can be configured globally to run on all requests, applied to specific routes via aliases, or organized into groups for shared functionality.

--------------------------------

### Related Classes and Services > Illuminate\Foundation\Configuration\Middleware

Source: https://github.com/laravel/laravel/blob/13.x/_autodocs/api-reference/application.md

The Middleware configuration class allows developers to register global middleware for every request, define route-specific middleware, manage middleware groups, and configure trusted proxies and headers.

## ELOQUENT_UUID (Library: /laravel/framework)
Query: HasUuids model uuid primary key

### Define UUID Column

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/schema-builder.md

Creates a UUID column, defaulting to 'id' if no column name is provided.

```php
public function uuid(string $column = 'id'): ColumnDefinition
```

```php
$table->uuid(); // Column 'id'
$table->uuid('user_id');
```

--------------------------------

### Find models by primary key

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/eloquent-builder.md

Retrieve a single model by its primary key or throw an exception if not found.

```php
$user = User::find(1);
```

```php
$user = User::findOrFail(1); // 404 if not found
```

--------------------------------

### find

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/query-builder.md

Find by primary key.

```APIDOC
## find($id, $columns = ['*'])

### Description
Find by primary key.
```

--------------------------------

### Find Model or Fail

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/eloquent-model.md

Retrieve a model by primary key or throw a ModelNotFoundException if no record exists.

```php
$user = User::findOrFail(1);
```

### Illuminate\Database\Eloquent\Model > Class Properties

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/eloquent-model.md

Eloquent models utilize several configurable properties to define database behavior. Key settings include the associated table name, primary key configuration, automatic timestamp management for created and updated fields, and connection definitions. Additionally, developers can manage security through fillable or guarded attributes and define eager loading relationships to optimize database queries.

## FILE_UPLOADS (Library: /laravel/framework)
Query: UploadedFile store public disk

### putFile

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/filesystem.md

Stores an uploaded file to the specified path.

```APIDOC
## putFile

### Description
Store an uploaded file.

### Parameters
- **$path** (string) - Required - Directory path
- **$file** (UploadedFile) - Required - Uploaded file
- **$options** (mixed) - Optional - Storage options

### Returns
- string - Stored path

### Example
$path = Storage::putFile('avatars', request()->file('avatar'));
```

--------------------------------

### Storage(string $disk = null)

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/filesystem.md

The Storage helper function provides access to the StorageManager, allowing users to interact with configured filesystem disks.

```APIDOC
## Storage(string $disk = null)

### Description
Access the storage disk manager to perform file operations.

### Signature
`function Storage(string $disk = null): StorageManager`

### Parameters
- **disk** (string) - Optional - The name of the disk to access.

### Usage Example
```php
Storage::disk('s3')->put('file.txt', 'contents');
Storage::disk('local')->get('file.txt');
```
```

--------------------------------

### config/filesystems.php exact keys

Source: https://github.com/laravel/framework/blob/13.x/config/filesystems.php

Top-level keys: default, disks (local/public/s3), links

```php
<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim((string) env('APP_URL'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
```

--------------------------------

### Set file visibility with setVisibility

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/filesystem.md

Updates the visibility of a file to either 'public' or 'private'.

```php
Storage::setVisibility('secret.pdf', 'private');
```

--------------------------------

### Get public URL in PHP

Source: https://github.com/laravel/framework/blob/13.x/_autodocs/api-reference/filesystem.md

Generates a public URL for the specified file path.

```php
$url = Storage::url('avatars/user1.jpg');
// https://example.com/storage/avatars/user1.jpg
```
