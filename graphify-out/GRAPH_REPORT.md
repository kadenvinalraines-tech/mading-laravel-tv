# Graph Report - mading-laravel-tv  (2026-09-17)

## Corpus Check
- cluster-only mode — file stats not available

## Summary
- 96 nodes · 148 edges · 19 communities (6 shown, 13 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `e824d5df`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Content
- Illuminate\Http\Request
- User
- composer.json
- RunningText
- Setting
- 2026_01_01_000000_create_tables.php
- RoleMiddleware.php
- app.php

## God Nodes (most connected - your core abstractions)
1. `Content` - 17 edges
2. `RunningText` - 15 edges
3. `User` - 11 edges
4. `Setting` - 11 edges
5. `AuthController` - 8 edges
6. `RunningTextController` - 8 edges
7. `ContentController` - 7 edges
8. `ModerationController` - 6 edges
9. `DisplayTvController` - 5 edges
10. `require` - 4 edges

## Surprising Connections (you probably didn't know these)
- `ContentController` --inherits--> `Illuminate\Routing\Controller`  [EXTRACTED]
  app/Features/ContentSubmission/Controllers/ContentController.php →   _Bridges community 0 → community 1_
- `Content` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/Content.php →   _Bridges community 0 → community 2_
- `RunningTextController` --inherits--> `Illuminate\Routing\Controller`  [EXTRACTED]
  app/Features/RunningText/Controllers/RunningTextController.php →   _Bridges community 4 → community 1_
- `RunningText` --mixes_in--> `Illuminate\Database\Eloquent\Concerns\HasUuids`  [EXTRACTED]
  app/Models/RunningText.php →   _Bridges community 4 → community 2_
- `Setting` --inherits--> `Illuminate\Database\Eloquent\Model`  [EXTRACTED]
  app/Models/Setting.php →   _Bridges community 5 → community 2_

## Import Cycles
- None detected.

## Communities (19 total, 13 thin omitted)

### Community 0 - "Content"
Cohesion: 0.15
Nodes (5): ContentController, DisplayTvController, ModerationController, Content, Illuminate\Support\Facades\Route

### Community 1 - "Illuminate\Http\Request"
Cohesion: 0.25
Nodes (4): AuthController, Illuminate\Http\Request, Illuminate\Routing\Controller, Illuminate\Support\Facades\Auth

### Community 2 - "User"
Cohesion: 0.24
Nodes (4): User, Illuminate\Database\Eloquent\Concerns\HasUuids, Illuminate\Database\Eloquent\Model, Illuminate\Foundation\Auth\User

### Community 3 - "composer.json"
Cohesion: 0.18
Nodes (10): autoload, psr-4, name, App\\, Database\\Seeders\\, require, laravel/framework, laravel/tinker (+2 more)

### Community 5 - "Setting"
Cohesion: 0.28
Nodes (4): Setting, DatabaseSeeder, Illuminate\Database\Seeder, Illuminate\Support\Facades\Hash

### Community 6 - "2026_01_01_000000_create_tables.php"
Cohesion: 0.33
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

## Knowledge Gaps
- **7 isolated node(s):** `name`, `App\\`, `Database\\Seeders\\`, `laravel/framework`, `laravel/tinker` (+2 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 40 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **13 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Content` connect `Content` to `Illuminate\Http\Request`, `User`?**
  _High betweenness centrality (0.112) - this node is a cross-community bridge._
- **Why does `User` connect `User` to `Illuminate\Http\Request`, `Setting`?**
  _High betweenness centrality (0.089) - this node is a cross-community bridge._
- **Why does `RunningText` connect `RunningText` to `Content`, `Illuminate\Http\Request`, `User`, `Setting`?**
  _High betweenness centrality (0.088) - this node is a cross-community bridge._
- **What connects `name`, `App\\`, `Database\\Seeders\\` to the rest of the system?**
  _7 weakly-connected nodes found - possible documentation gaps or missing edges._