# Graph Report - mading-laravel-tv  (2026-09-17)

## Corpus Check
- cluster-only mode — file stats not available

## Summary
- 103 nodes · 165 edges · 19 communities (9 shown, 10 thin omitted)
- Extraction: 93% EXTRACTED · 7% INFERRED · 0% AMBIGUOUS · INFERRED: 12 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `b9d574af`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Content
- RunningText
- runnable_test.php
- Illuminate\Http\Request
- composer.json
- User
- 2026_01_01_000000_create_tables.php
- app.php
- runnable_check.py

## God Nodes (most connected - your core abstractions)
1. `Content` - 15 edges
2. `RunningText` - 14 edges
3. `User` - 11 edges
4. `Setting` - 10 edges
5. `RunningTextController` - 9 edges
6. `ContentController` - 8 edges
7. `AuthController` - 8 edges
8. `ModerationController` - 7 edges
9. `DisplayTvController` - 5 edges
10. `require` - 4 edges

## Surprising Connections (you probably didn't know these)
- `Content` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/Content.php →   _Bridges community 0 → community 5_
- `Content` --inherits--> `Illuminate\Database\Eloquent\Model`  [EXTRACTED]
  app/Models/Content.php →   _Bridges community 0 → community 2_
- `RunningText` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/RunningText.php →   _Bridges community 1 → community 5_
- `RunningText` --inherits--> `Illuminate\Database\Eloquent\Model`  [EXTRACTED]
  app/Models/RunningText.php →   _Bridges community 1 → community 2_
- `RunningTextController` --inherits--> `Illuminate\Routing\Controller`  [EXTRACTED]
  app/Features/RunningText/Controllers/RunningTextController.php →   _Bridges community 1 → community 0_

## Import Cycles
- None detected.

## Communities (19 total, 10 thin omitted)

### Community 0 - "Content"
Cohesion: 0.16
Nodes (6): ContentController, DisplayTvController, ModerationController, Content, Illuminate\Routing\Controller, Illuminate\Support\Facades\Route

### Community 1 - "RunningText"
Cohesion: 0.19
Nodes (5): RunningTextController, RunningText, Setting, DatabaseSeeder, Illuminate\Database\Seeder

### Community 2 - "runnable_test.php"
Cohesion: 0.29
Nodes (4): Illuminate\Database\Eloquent\Model, Illuminate\Support\Facades\Artisan, Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Hash

### Community 3 - "Illuminate\Http\Request"
Cohesion: 0.23
Nodes (4): AuthController, RoleMiddleware, Closure, Illuminate\Http\Request

### Community 4 - "composer.json"
Cohesion: 0.18
Nodes (10): autoload, psr-4, name, App\\, Database\\Seeders\\, require, laravel/framework, laravel/tinker (+2 more)

### Community 5 - "User"
Cohesion: 0.32
Nodes (3): User, Illuminate\Database\Eloquent\Concerns\HasUuids, Illuminate\Foundation\Auth\User

### Community 6 - "2026_01_01_000000_create_tables.php"
Cohesion: 0.33
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 7 - "app.php"
Cohesion: 0.50
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 8 - "runnable_check.py"
Cohesion: 0.50
Nodes (3): os, subprocess, sys

## Knowledge Gaps
- **7 isolated node(s):** `name`, `App\\`, `Database\\Seeders\\`, `laravel/framework`, `laravel/tinker` (+2 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 45 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **10 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Content` connect `Content` to `RunningText`, `runnable_test.php`, `User`?**
  _High betweenness centrality (0.079) - this node is a cross-community bridge._
- **Why does `User` connect `User` to `RunningText`, `runnable_test.php`, `Illuminate\Http\Request`?**
  _High betweenness centrality (0.072) - this node is a cross-community bridge._
- **Why does `RunningText` connect `RunningText` to `Content`, `runnable_test.php`, `User`?**
  _High betweenness centrality (0.065) - this node is a cross-community bridge._
- **Are the 6 inferred relationships involving `Content` (e.g. with `.destroy()` and `.index()`) actually correct?**
  _`Content` has 6 INFERRED edges - model-reasoned connections that need verification._
- **Are the 4 inferred relationships involving `RunningText` (e.g. with `.destroy()` and `.index()`) actually correct?**
  _`RunningText` has 4 INFERRED edges - model-reasoned connections that need verification._
- **Are the 2 inferred relationships involving `Setting` (e.g. with `.index()` and `.updateProfile()`) actually correct?**
  _`Setting` has 2 INFERRED edges - model-reasoned connections that need verification._
- **What connects `name`, `App\\`, `Database\\Seeders\\` to the rest of the system?**
  _7 weakly-connected nodes found - possible documentation gaps or missing edges._