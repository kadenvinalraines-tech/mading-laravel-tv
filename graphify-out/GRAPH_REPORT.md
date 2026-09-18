# Graph Report - mading-laravel-tv  (2026-09-17)

## Corpus Check
- cluster-only mode — file stats not available

## Summary
- 154 nodes · 220 edges · 20 communities (10 shown, 10 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `d87e0225`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- Content
- RunningText
- 2026_01_01_000000_create_users_table.php
- Illuminate\Http\Request
- package.json
- User
- config
- require-dev
- app.php
- console.php
- artisan

## God Nodes (most connected - your core abstractions)
1. `Content` - 20 edges
2. `RunningText` - 16 edges
3. `User` - 13 edges
4. `Setting` - 11 edges
5. `RunningTextController` - 8 edges
6. `AuthController` - 8 edges
7. `ContentController` - 7 edges
8. `ModerationController` - 6 edges
9. `require` - 6 edges
10. `require-dev` - 6 edges

## Surprising Connections (you probably didn't know these)
- `Content` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/Content.php →   _Bridges community 1 → community 6_
- `Content` --inherits--> `Illuminate\Database\Eloquent\Model`  [EXTRACTED]
  app/Models/Content.php →   _Bridges community 1 → community 2_
- `RunningText` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/RunningText.php →   _Bridges community 2 → community 6_
- `AuthController` --inherits--> `Illuminate\Routing\Controller`  [EXTRACTED]
  app/Features/Auth/Controllers/AuthController.php →   _Bridges community 4 → community 1_

## Import Cycles
- None detected.

## Communities (20 total, 10 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.07
Nodes (26): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+18 more)

### Community 1 - "Content"
Cohesion: 0.16
Nodes (7): ContentController, DisplayTvController, ModerationController, Content, Illuminate\Routing\Controller, Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Route

### Community 2 - "RunningText"
Cohesion: 0.16
Nodes (7): RunningTextController, RunningText, Setting, DatabaseSeeder, Illuminate\Database\Eloquent\Model, Illuminate\Database\Seeder, Illuminate\Support\Facades\Hash

### Community 3 - "2026_01_01_000000_create_users_table.php"
Cohesion: 0.19
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 4 - "Illuminate\Http\Request"
Cohesion: 0.21
Nodes (5): AuthController, RoleMiddleware, Closure, Illuminate\Http\Request, Symfony\Component\HttpFoundation\Response

### Community 5 - "package.json"
Cohesion: 0.15
Nodes (12): devDependencies, axios, laravel-vite-plugin, vite, private, scripts, build, dev (+4 more)

### Community 6 - "User"
Cohesion: 0.26
Nodes (5): User, Illuminate\Database\Eloquent\Concerns\HasUuids, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable

### Community 7 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 8 - "require-dev"
Cohesion: 0.33
Nodes (6): require-dev, fakerphp/faker, laravel/pint, mockery/mockery, nunomaduro/collision, phpunit/phpunit

### Community 9 - "app.php"
Cohesion: 0.50
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

## Knowledge Gaps
- **38 isolated node(s):** `description`, `keywords`, `dont-discover`, `license`, `minimum-stability` (+33 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 77 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **10 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Content` connect `Content` to `RunningText`, `User`?**
  _High betweenness centrality (0.054) - this node is a cross-community bridge._
- **Why does `User` connect `User` to `RunningText`, `Illuminate\Http\Request`?**
  _High betweenness centrality (0.040) - this node is a cross-community bridge._
- **Why does `RunningText` connect `RunningText` to `Content`, `User`?**
  _High betweenness centrality (0.033) - this node is a cross-community bridge._
- **What connects `description`, `keywords`, `dont-discover` to the rest of the system?**
  _38 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.07407407407407407 - nodes in this community are weakly interconnected._