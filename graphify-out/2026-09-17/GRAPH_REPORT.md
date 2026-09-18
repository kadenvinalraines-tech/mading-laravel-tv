# Graph Report - mading-laravel-tv  (2026-09-17)

## Corpus Check
- cluster-only mode — file stats not available

## Summary
- 101 nodes · 150 edges · 21 communities (7 shown, 14 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `b9d574af`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- RunningText
- Illuminate\Http\Request
- Content
- User
- composer.json
- 2026_01_01_000000_create_tables.php
- RoleMiddleware.php
- app.php
- os

## God Nodes (most connected - your core abstractions)
1. `Content` - 17 edges
2. `RunningText` - 15 edges
3. `Setting` - 11 edges
4. `User` - 11 edges
5. `RunningTextController` - 8 edges
6. `AuthController` - 8 edges
7. `ContentController` - 7 edges
8. `ModerationController` - 6 edges
9. `DisplayTvController` - 5 edges
10. `require` - 4 edges

## Surprising Connections (you probably didn't know these)
- `DisplayTvController` --inherits--> `Illuminate\Routing\Controller`  [EXTRACTED]
  app/Features/DisplayTv/Controllers/DisplayTvController.php →   _Bridges community 0 → community 1_
- `RunningText` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/RunningText.php →   _Bridges community 0 → community 2_
- `ContentController` --inherits--> `Illuminate\Routing\Controller`  [EXTRACTED]
  app/Features/ContentSubmission/Controllers/ContentController.php →   _Bridges community 2 → community 1_
- `User` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/User.php →   _Bridges community 3 → community 2_

## Import Cycles
- None detected.

## Communities (21 total, 14 thin omitted)

### Community 0 - "RunningText"
Cohesion: 0.16
Nodes (6): DisplayTvController, RunningTextController, RunningText, Setting, Illuminate\Database\Eloquent\Model, Illuminate\Support\Facades\Route

### Community 1 - "Illuminate\Http\Request"
Cohesion: 0.22
Nodes (4): AuthController, Illuminate\Http\Request, Illuminate\Routing\Controller, Illuminate\Support\Facades\Auth

### Community 2 - "Content"
Cohesion: 0.18
Nodes (4): ContentController, ModerationController, Content, Illuminate\Database\Eloquent\Concerns\HasUuids

### Community 3 - "User"
Cohesion: 0.21
Nodes (5): User, DatabaseSeeder, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User, Illuminate\Support\Facades\Hash

### Community 4 - "composer.json"
Cohesion: 0.18
Nodes (10): autoload, psr-4, name, App\\, Database\\Seeders\\, require, laravel/framework, laravel/tinker (+2 more)

### Community 5 - "2026_01_01_000000_create_tables.php"
Cohesion: 0.33
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 7 - "app.php"
Cohesion: 0.50
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

## Knowledge Gaps
- **7 isolated node(s):** `name`, `App\\`, `Database\\Seeders\\`, `laravel/framework`, `laravel/tinker` (+2 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 45 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **14 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Content` connect `Content` to `RunningText`, `Illuminate\Http\Request`?**
  _High betweenness centrality (0.101) - this node is a cross-community bridge._
- **Why does `User` connect `User` to `Illuminate\Http\Request`, `Content`?**
  _High betweenness centrality (0.080) - this node is a cross-community bridge._
- **Why does `RunningText` connect `RunningText` to `Illuminate\Http\Request`, `Content`, `User`?**
  _High betweenness centrality (0.079) - this node is a cross-community bridge._
- **What connects `name`, `App\\`, `Database\\Seeders\\` to the rest of the system?**
  _7 weakly-connected nodes found - possible documentation gaps or missing edges._