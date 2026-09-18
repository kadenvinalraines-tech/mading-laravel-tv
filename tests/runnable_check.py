import os

base_dir = "/home/user-coder/projects/mading-laravel-tv"

# Runnable verification check
print("[STEP 1/4] Validating PRD & Architecture Blueprint...")
assert os.path.exists(os.path.join(base_dir, "PRD.md")), "PRD.md missing!"
assert os.path.exists(os.path.join(base_dir, "docs/context7_spec.md")), "Context7 spec missing!"
print("-> PRD & Context7 Blueprint OK")

print("[STEP 2/4] Validating Ponytail Annotations across slices...")
slices = [
    "app/Features/Auth/Controllers/AuthController.php",
    "app/Features/DisplayTv/Controllers/DisplayTvController.php",
    "app/Features/ContentSubmission/Controllers/ContentController.php",
    "app/Features/Moderation/Controllers/ModerationController.php",
    "app/Features/RunningText/Controllers/RunningTextController.php"
]
for s in slices:
    raw = open(os.path.join(base_dir, s)).read()
    assert "// ponytail:" in raw, f"Ponytail annotation missing in {s}"
print("-> Ponytail Annotations in 5 Slices OK")

print("[STEP 3/4] Validating Graphify AST extraction & Report...")
assert os.path.exists(os.path.join(base_dir, "graphify-out/GRAPH_REPORT.md")), "GRAPH_REPORT.md missing!"
assert os.path.exists(os.path.join(base_dir, "graphify-out/graph.json")), "graph.json missing!"
print("-> Graphify Output OK")

print("[STEP 4/4] Validating Business Rules in Code...")
cc = open(os.path.join(base_dir, "app/Features/ContentSubmission/Controllers/ContentController.php")).read()
assert "$status = $user->isSiswa() ? 'pending' : 'approved';" in cc, "Business rule approval mismatch!"
print("-> Business Rules Verification OK")

print("\n=== ALL VIBE-CODING PIPELINE CHECKS PASSED ===")
