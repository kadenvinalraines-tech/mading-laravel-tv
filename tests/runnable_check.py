import os
import subprocess
import sys

base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

print("=======================================================")
print("🧪 VIBE-CODING 4-STAGE PIPELINE & TEST VERIFICATION")
print("=======================================================")

# STEP 1: Validating PRD & Architecture Blueprint
print("\n[STAGE 1/4] Validating PRD & Architecture Blueprint...")
assert os.path.exists(os.path.join(base_dir, "PRD.md")), "PRD.md missing!"
assert os.path.exists(os.path.join(base_dir, "docs/context7_spec.md")), "Context7 spec missing!"
print("  ✓ PRD.md & Context7 Blueprint verified")

# STEP 2: Validating Ponytail Annotations across slices
print("\n[STAGE 2/4] Validating Ponytail Annotations across slices...")
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
print("  ✓ Ponytail Annotations in 5 Vertical Slices verified")

# STEP 3: Validating Graphify AST extraction & Report
print("\n[STAGE 3/4] Validating Graphify AST extraction & Report...")
assert os.path.exists(os.path.join(base_dir, "graphify-out/GRAPH_REPORT.md")), "GRAPH_REPORT.md missing!"
assert os.path.exists(os.path.join(base_dir, "graphify-out/graph.json")), "graph.json missing!"
print("  ✓ Graphify Output & Dependency Map verified")

# STEP 4: Executing Live End-to-End Test Suite (PHP Runtime)
print("\n[STAGE 4/4] Executing Live Feature & Security Test Suite...")
php_test_path = os.path.join(base_dir, "tests/runnable_test.php")
result = subprocess.run([sys.executable.replace("python3", "php"), php_test_path], cwd=base_dir, capture_output=True, text=True)
if result.returncode != 0:
    # Fallback to 'php' on PATH
    result = subprocess.run(["php", php_test_path], cwd=base_dir, capture_output=True, text=True)

print(result.stdout)
if result.stderr:
    print("Stderr:", result.stderr)

assert result.returncode == 0, f"PHP Runnable Test Suite failed with exit code {result.returncode}"
print("  ✓ Live PHP Feature & Security Suite Passed (100%)")

print("\n=======================================================")
print("🎯 ALL 4 VIBE-CODING PIPELINE STAGES PASSED SUCCESSFULLY")
print("=======================================================")
